<?php

namespace alexeevdv\React\Smpp;

use alexeevdv\React\Smpp\Pdu\Pdu;
use alexeevdv\React\Smpp\Pdu\Factory;
use Psr\Log\LoggerInterface;
use React\Promise\Deferred;
use React\Promise\Promise;
use React\Socket\ConnectionInterface;
use React\Stream\Util;
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

    /**
     * @var Factory
     */
    private $pduFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(ConnectionInterface $connection, Factory $pduFactory, LoggerInterface $logger)
    {
        $this->connection = $connection;
        $this->pduFactory = $pduFactory;
        $this->logger = $logger;

        $this->connection->on('data', function ($data) {
            try {
                $pdu = $this->pduFactory->createFromBuffer($data);
                $this->logger->info('pdu {class}', [
                    'class' => get_class($pdu),
                ]);
                $this->connection->emit('pdu', [$pdu]);
                $this->connection->emit(get_class($pdu), [$pdu]);
            } catch (\Throwable $e) {
                $this->logger->error('Failed to decode pdu data', [
                    'exception' => $e,
                ]);
                $this->connection->emit('error', [$e]);
            }
        });
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

    public function replyWith(Pdu $pdu): void
    {
        $this->logger->debug(bin2hex($pdu->__toString()));
        $this->connection->write($pdu->__toString());
    }

    public function send(Pdu $pdu, float $timeout = 2.0): Promise
    {
        $pdu->setSequenceNumber($this->getNextSequenceNumber());

        $deferred = new Deferred();

        // TODO implement timeout for $deferred->reject()

        $pduEventListener = function (Pdu $event) use ($pdu, $deferred, &$pduEventListener) {
            if ($event->getSequenceNumber() === $pdu->getSequenceNumber()) {
                $deferred->resolve($event);
                $this->connection->removeListener('pdu', $pduEventListener);
            }
        };

        $this->connection->on('pdu', $pduEventListener);
        $this->connection->write($pdu->__toString());

        return $deferred->promise();
    }
}
