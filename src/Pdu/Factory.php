<?php

namespace alexeevdv\React\Smpp\Pdu;

use alexeevdv\React\Smpp\Exception\MalformedPdu;
use alexeevdv\React\Smpp\Exception\UnknownPdu;
use alexeevdv\React\Smpp\Utils\DataWrapper;

class Factory
{
    private $classMap = [
        0x80000000 => GenericNack::class,
        0x00000001 => BindReceiver::class,
        0x80000001 => BindReceiverResp::class,
        0x00000002 => BindTransmitter::class,
        0x80000002 => BindTransmitterResp::class,
        0x00000003 => QuerySm::class,
        0x80000003 => QuerySmResp::class,
        0x00000004 => SubmitSm::class,
        0x80000004 => SubmitSmResp::class,
        0x00000005 => DeliverSm::class,
        0x80000005 => DeliverSmResp::class,
        0x00000006 => Unbind::class,
        0x80000006 => UnbindResp::class,
        0x00000007 => ReplaceSm::class,
        0x80000007 => ReplaceSmResp::class,
        0x00000008 => CancelSm::class,
        0x80000008 => CancelSmResp::class,
        0x00000009 => BindTransceiver::class,
        0x80000009 => BindTransceiverResp::class,
        0x00000015 => EnquireLink::class,
        0x80000015 => EnquireLinkResp::class,
    ];

    public function createFromBuffer(string $buffer): Pdu
    {
        $wrapper = new DataWrapper($buffer);
        if ($wrapper->bytesLeft() < 16) {
            throw new MalformedPdu(bin2hex($buffer));
        }

        $length = $wrapper->readInt32();
        if (strlen($buffer) !== $length) {
            throw new MalformedPdu(bin2hex($buffer));
        }

        $id = $wrapper->readInt32();
        $status = $wrapper->readInt32();
        $sequence = $wrapper->readInt32();

        if (!isset($this->classMap[$id])) {
            throw new UnknownPdu(bin2hex($id));
        }

        $className = $this->classMap[$id];
        /** @var Pdu $pdu */
        $pdu = new $className(substr($buffer, 16));
        $pdu->setCommandStatus($status);
        $pdu->setSequenceNumber($sequence);
        return $pdu;
    }
}
