<?php

use alexeevdv\React\Smpp\Client;
use alexeevdv\React\Smpp\Connection;
use alexeevdv\React\Smpp\Pdu\BindTransmitter;
use alexeevdv\React\Smpp\Pdu\BindTransmitterResp;
use alexeevdv\React\Smpp\Pdu\DeliverSm;
use alexeevdv\React\Smpp\Pdu\DeliverSmResp;
use alexeevdv\React\Smpp\Pdu\SubmitSm;
use alexeevdv\React\Smpp\Pdu\SubmitSmResp;
use alexeevdv\React\Smpp\Proto\Address;
use Firehed\SimpleLogger\Stdout;
use React\EventLoop\Factory as LoopFactory;
use React\Socket\Connector;

require_once 'vendor/autoload.php';

$loop = LoopFactory::create();
$logger = new Stdout();
$connector = new Connector($loop);

$client = new Client($connector);

$client
    ->connect('127.0.0.1:2775')
    ->then(function (Connection $connection) use ($logger) {
        $logger->info('Connected');

        $connection->on(DeliverSm::class, function (DeliverSm $pdu) use ($connection) {
            $connection->replyWith(new DeliverSmResp());
        });

        $bindTransmitter = new BindTransmitter();
        $bindTransmitter->setSystemId('user');
        $bindTransmitter->setPassword('password');

        $connection
            ->send($bindTransmitter)
            ->then(function (BindTransmitterResp $pdu) use ($connection, $logger) {
                $logger->info('Binded');

                $submitSm = new SubmitSm();
                $submitSm->setSourceAddress(new Address(
                    Address\Ton::international(),
                    Address\Npi::isdn(),
                    '1234567890'
                ));
                $submitSm->setDestinationAddress(new Address(
                    Address\Ton::international(),
                    Address\Npi::isdn(),
                    '1234567890'
                ));
                $submitSm->setShortMessage('Hello there!');
                return $connection->send($submitSm);
            })
            ->then(function (SubmitSmResp $pdu) use ($connection, $logger) {
                $logger->info('Submited. message_id: {messageId}', [
                    'messageId' => $pdu->getMessageId(),
                ]);
                $connection->end();
            })
        ;
    })
;

$loop->run();
