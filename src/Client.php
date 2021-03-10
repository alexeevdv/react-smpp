<?php

namespace alexeevdv\React\Smpp;

use alexeevdv\React\Smpp\Pdu\Factory;
use Psr\Log\NullLogger;
use React\Socket\ConnectionInterface;
use React\Socket\ConnectorInterface;
use function React\Promise\resolve;

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

            // TODO start enquire link timer

            return resolve(new Connection($conn, new Factory(), new NullLogger()));
        });
    }
}
