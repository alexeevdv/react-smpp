<?php

namespace alexeevdv\React\Smpp;

use alexeevdv\React\Smpp\Pdu\BindReceiver;
use alexeevdv\React\Smpp\Pdu\BindTransceiver;
use alexeevdv\React\Smpp\Pdu\CancelSm;
use alexeevdv\React\Smpp\Pdu\Contract\BindTransmitter;
use alexeevdv\React\Smpp\Pdu\Contract\Pdu;
use alexeevdv\React\Smpp\Pdu\Contract\SubmitSm;
use alexeevdv\React\Smpp\Pdu\DeliverSmResp;
use alexeevdv\React\Smpp\Pdu\EnquireLink;
use alexeevdv\React\Smpp\Pdu\Factory;
use alexeevdv\React\Smpp\Pdu\QuerySm;
use alexeevdv\React\Smpp\Pdu\ReplaceSm;
use alexeevdv\React\Smpp\Pdu\Unbind;
use Evenement\EventEmitter;
use React\EventLoop\LoopInterface;
use React\Socket\ConnectionInterface;
use React\Socket\Server as SocketServer;
use React\Socket\ServerInterface;

final class Server extends EventEmitter implements ServerInterface
{
    /**
     * @var SocketServer
     */
    private $server;

    public function __construct($uri, LoopInterface $loop, array $context = array())
    {
        $server = new SocketServer($uri, $loop, $context);
        $this->server = $server;

        $that = $this;
        $this->server->on('connection', function (ConnectionInterface $conn) use ($loop, $that) {
            $connection = new Connection($conn);

            // TODO start timer for enquire_link

            $connection->on('data', function ($data) use ($connection) {
                $pduFactory = new Factory;
                try {
                    $pdu = $pduFactory->createFromBuffer($data);
                    $connection->emit('pdu', [$pdu]);
                } catch (\Exception $e) {
                    // TODO GENERIC_NACK
                    $connection->emit('error', [$e]);
                }
            });

            $connection->on('pdu', function (Pdu $pdu) use ($connection) {
                if ($pdu instanceof BindReceiver) {
                    return $connection->emit('bind_receiver', [$pdu]);
                }

                if ($pdu instanceof BindTransmitter) {
                    return $connection->emit('bind_transmitter', [$pdu]);
                }

                if ($pdu instanceof QuerySm) {
                    return $connection->emit('query_sm', [$pdu]);
                }

                if ($pdu instanceof SubmitSm) {
                    return $connection->emit('submit_sm', [$pdu]);
                }

                if ($pdu instanceof DeliverSmResp) {
                    return $connection->emit('deliver_sm_resp', [$pdu]);
                }

                if ($pdu instanceof Unbind) {
                    return $connection->emit('unbind', [$pdu]);
                }

                if ($pdu instanceof ReplaceSm) {
                    return $connection->emit('replace_sm', [$pdu]);
                }

                if ($pdu instanceof CancelSm) {
                    return $connection->emit('cancel_sm', [$pdu]);
                }

                if ($pdu instanceof BindTransceiver) {
                    return $connection->emit('bind_transceiver', [$pdu]);
                }

                if ($pdu instanceof EnquireLink) {
                    return $connection->emit('enquire_link', [$pdu]);
                }
            });

            $connection->on('send', function (Pdu $pdu) use ($connection) {
                $connection->write($pdu->__toString());
            });

            $that->emit('connection', [$connection]);
        });
    }

    public function getAddress()
    {
        return $this->server->getAddress();
    }

    public function pause()
    {
        $this->server->pause();
    }

    public function resume()
    {
        $this->server->resume();
    }

    public function close()
    {
        $this->server->close();
    }
}
