<?php

namespace alexeevdv\React\Smpp;

use alexeevdv\React\Smpp\Pdu\EnquireLink;
use alexeevdv\React\Smpp\Pdu\EnquireLinkResp;
use alexeevdv\React\Smpp\Pdu\Factory;
use alexeevdv\React\Smpp\Proto\CommandStatus;
use Psr\Log\LoggerInterface;
use React\Socket\ConnectionInterface;
use React\Socket\Server as SocketServer;
use React\Socket\ServerInterface;

class Server implements ServerInterface
{
    /**
     * @var SocketServer
     */
    private $socketServer;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(SocketServer $socketServer, LoggerInterface $logger)
    {
        $this->socketServer = $socketServer;
        $this->logger = $logger;

        $this->socketServer->on('connection', function (ConnectionInterface $conn) {
            $this->logger->info('SMPP client connected. IP address: {address}', [
                'address' => $conn->getRemoteAddress(),
            ]);

            $connection = new Connection($conn, new Factory(), $this->logger);

            // TODO start timer for enquire_link

            $connection->on(EnquireLink::class, function (EnquireLink $pdu) use ($connection) {
                $this->logger->info('enquire_link');
                $response = new EnquireLinkResp();
                $response->setCommandStatus(CommandStatus::ESME_RSYSERR);
                $response->setSequenceNumber($pdu->getSequenceNumber());
                $connection->replyWith($response);
            });

            $this->socketServer->emit(Connection::class, [$connection]);
        });
    }

    public function getAddress()
    {
        return $this->socketServer->getAddress();
    }

    public function pause()
    {
        $this->socketServer->pause();
    }

    public function resume()
    {
        $this->socketServer->resume();
    }

    public function close()
    {
        $this->socketServer->close();
    }

    public function on($event, callable $listener)
    {
        $this->socketServer->on($event, $listener);
    }

    public function once($event, callable $listener)
    {
        $this->socketServer->once($event, $listener);
    }

    public function removeListener($event, callable $listener)
    {
        $this->socketServer->removeListener($event, $listener);
    }

    public function removeAllListeners($event = null)
    {
        $this->socketServer->removeAllListeners($event);
    }

    public function listeners($event = null)
    {
        $this->socketServer->listeners($event);
    }

    public function emit($event, array $arguments = [])
    {
        $this->socketServer->emit($event, $arguments);
    }
}
