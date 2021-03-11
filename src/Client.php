<?php

namespace alexeevdv\React\Smpp;

use alexeevdv\React\Smpp\Pdu\Factory;
use Psr\Log\NullLogger;
use React\Promise\Deferred;
use React\Socket\ConnectionInterface;
use React\Socket\ConnectorInterface;

class Client implements ConnectorInterface
{
    /**
     * @var ConnectorInterface
     */
    private $connector;

    public function __construct(ConnectorInterface $connector)
    {
        $this->connector = $connector;
    }

    public function connect($uri)
    {
        return $this->connector->connect($uri)->then(function (ConnectionInterface $conn) {
            $deferred = new Deferred();
            $deferred->resolve(new Connection($conn, new Factory(), new NullLogger()));
            return $deferred->promise();
        });
    }
}
