<?php

namespace alexeevdv\React\Smpp;

use React\Socket\ConnectionInterface;
use React\Stream\WritableStreamInterface;

class Connection implements ConnectionInterface
{
    /**
     * @var ConnectionInterface
     */
    private $connection;

    /**
     * @var int
     */
    private $sequenceNumber = 1;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function getRemoteAddress()
    {
        return $this->connection->getRemoteAddress();
    }

    public function getLocalAddress()
    {
        return $this->connection->getLocalAddress();
    }

    public function on($event, callable $listener)
    {
        $this->connection->on($event, $listener);
    }

    public function once($event, callable $listener)
    {
        $this->connection->once($event, $listener);
    }

    public function removeListener($event, callable $listener)
    {
        $this->connection->removeListener($event, $listener);
    }

    public function removeAllListeners($event = null)
    {
        $this->connection->removeAllListeners($event);
    }

    public function listeners($event = null)
    {
        $this->connection->listeners($event);
    }

    public function emit($event, array $arguments = [])
    {
        $this->connection->emit($event, $arguments);
    }

    public function isReadable()
    {
        return $this->connection->isReadable();
    }

    public function pause()
    {
        $this->connection->pause();
    }

    public function resume()
    {
        $this->connection->resume();
    }

    public function pipe(WritableStreamInterface $dest, array $options = array())
    {
        return $this->connection->pipe($dest, $options);
    }

    public function close()
    {
        $this->connection->close();
    }

    public function isWritable()
    {
        return $this->connection->isWritable();
    }

    public function write($data)
    {
        return $this->connection->write($data);
    }

    public function end($data = null)
    {
        $this->connection->end($data);
    }

    public function getNextSequenceNumber(): int
    {
        return $this->sequenceNumber++;
    }
}
