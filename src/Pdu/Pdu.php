<?php

namespace alexeevdv\React\Smpp\Pdu;

abstract class Pdu implements Contract\Pdu
{
    /**
     * @var int
     */
    private $commandStatus;

    /**
     * @var int
     */
    private $sequenceNumber;

    /**
     * @var string
     */
    private $body;

    public function __construct(int $status, int $sequence, $body = '')
    {
        $this->commandStatus = $status;
        $this->sequenceNumber = $sequence;
        $this->body = $body;
    }

    public function getCommandLength(): int
    {
        return 16 + strlen($this->getBody());
    }

    public function getCommandStatus(): int
    {
        return $this->commandStatus;
    }

    public function getSequenceNumber(): int
    {
        return $this->sequenceNumber;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function __toString(): string
    {
        return pack(
            'NNNN',
            $this->getCommandLength(),
            $this->getCommandId(),
            $this->getCommandStatus(),
            $this->getSequenceNumber()
        ) . $this->getBody();
    }
}
