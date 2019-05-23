<?php

namespace alexeevdv\React\Smpp\Pdu;

use alexeevdv\React\Smpp\Utils\DataWrapper;

class SubmitSmResp extends Pdu implements Contract\SubmitSmResp
{
    /**
     * @var string
     */
    private $messageId;

    public function __construct(int $status = 0, int $sequence = 1, $body = '')
    {
        parent::__construct($status, $sequence, $body);

        if (strlen($body) === 0) {
            return;
        }

        $wrapper = new DataWrapper($body);
        $this->messageId = $wrapper->readNullTerminatedString(65);
    }

    public function getCommandId(): int
    {
        return 0x80000004;
    }

    public function getMessageId(): string
    {
        return $this->messageId;
    }

    public function setMessageId(string $messageId): self
    {
        $this->messageId = $messageId;
        return $this;
    }

    public function __toString(): string
    {
        $wrapper = new DataWrapper('');
        $wrapper->writeNullTerminatedString($this->getMessageId());
        $this->setBody($wrapper->__toString());
        return parent::__toString();
    }
}
