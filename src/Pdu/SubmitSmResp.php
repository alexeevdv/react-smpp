<?php

namespace alexeevdv\React\Smpp\Pdu;

use alexeevdv\React\Smpp\Utils\DataWrapper;

class SubmitSmResp extends Pdu implements Contract\SubmitSmResp
{
    /**
     * @var string
     */
    private $messageId;

    public function __construct(int $status, int $sequence, $body = '')
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
}
