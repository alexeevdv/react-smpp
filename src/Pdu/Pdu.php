<?php

namespace alexeevdv\React\Smpp\Pdu;

abstract class Pdu
{
    /**
     * @var int
     */
    private $commandStatus = 0;

    /**
     * @var int
     */
    private $sequenceNumber = 1;

    /**
     * @var string
     */
    private $body;

    public function __construct($body = '')
    {
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

    public function setCommandStatus(int $status): self
    {
        $this->commandStatus = $status;
        return $this;
    }

    public function getSequenceNumber(): int
    {
        return $this->sequenceNumber;
    }

    public function setSequenceNumber(int $sequenceNumber): self
    {
        $this->sequenceNumber = $sequenceNumber;
        return $this;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
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
