<?php

namespace alexeevdv\React\Smpp;

use alexeevdv\React\Smpp\Pdu\EnquireLink;
use alexeevdv\React\Smpp\Pdu\Factory;
use Psr\Log\NullLogger;
use React\EventLoop\LoopInterface;
use React\Promise\Deferred;
use React\Socket\ConnectionInterface;
use React\Socket\ConnectorInterface;

class Client implements ConnectorInterface
{
    private const ENQUIRE_LINK_INTERVAL = 30;

    /**
     * @var ConnectorInterface
     */
    private $connector;

    /**
     * @var LoopInterface
     */
    private $loop;

    public function __construct(ConnectorInterface $connector, LoopInterface $loop)
    {
        $this->connector = $connector;
        $this->loop = $loop;
    }

    public function connect($uri)
    {
        return $this->connector->connect($uri)->then(function (ConnectionInterface $conn) {
            $connection = new Connection($conn, new Factory(), new NullLogger());

            $enquireLinkTimer = $this->loop->addPeriodicTimer(
                self::ENQUIRE_LINK_INTERVAL,
                function () use ($connection) {
                    $enquireLink = new EnquireLink();
                    $connection->send($enquireLink)->otherwise(function () use ($connection) {
                        // TODO throw exception instead?
                        $connection->close();
                    });
                }
            );

            $connection->on('close', function () use ($enquireLinkTimer) {
                $this->loop->cancelTimer($enquireLinkTimer);
            });

            $deferred = new Deferred();
            $deferred->resolve($connection);
            return $deferred->promise();
        });
    }
}
