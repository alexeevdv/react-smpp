<?php

use alexeevdv\React\Smpp\Connection;
use alexeevdv\React\Smpp\Pdu\BindTransmitter;
use alexeevdv\React\Smpp\Pdu\BindTransmitterResp;
use alexeevdv\React\Smpp\Pdu\SubmitSm;
use alexeevdv\React\Smpp\Pdu\SubmitSmResp;
use alexeevdv\React\Smpp\Proto\CommandStatus;
use alexeevdv\React\Smpp\Server;
use Firehed\SimpleLogger\Stdout;
use React\EventLoop\Factory as LoopFactory;
use React\Socket\Server as SocketServer;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$loop = LoopFactory::create();
$socketServer = new SocketServer('127.0.0.1:2775', $loop);
$logger = new Stdout();
$smppServer = new Server($socketServer, $logger);

$smppServer->on(Connection::class, static function (Connection $connection) use ($logger) {
    $connection->on(BindTransmitter::class, static function (BindTransmitter $pdu) use ($connection, $logger) {
        $logger->info('bind_transmitter. system_id: {systemId}, password: {password}', [
            'systemId' => $pdu->getSystemId(),
            'password' => $pdu->getPassword(),
        ]);

        $response = new BindTransmitterResp();
        $response->setCommandStatus(CommandStatus::ESME_ROK);
        $response->setSequenceNumber($pdu->getSequenceNumber());
        $connection->replyWith($response);
    });

    $connection->on(SubmitSm::class, static function (SubmitSm $pdu) use ($connection, $logger) {
        $logger->info('sumbit_sm. source: {source}, destination: {destination}, short_message: {shortMessage}', [
            'source' => $pdu->getSourceAddress() !== null ? $pdu->getSourceAddress()->getValue() : null,
            'destination' => $pdu->getDestinationAddress()->getValue(),
            'shortMessage' => $pdu->getShortMessage(),
        ]);

        $response = new SubmitSmResp();
        $response->setSequenceNumber($pdu->getSequenceNumber());
        $response->setCommandStatus(CommandStatus::ESME_ROK);
        $response->setMessageId(uniqid('', true));
        $connection->replyWith($response);
    });

    $connection->on('error', static function (Throwable $e) use ($connection, $logger) {
        $logger->error($e->getMessage(), ['exception' => $e]);
        $connection->close();
    });
});

$loop->run();
