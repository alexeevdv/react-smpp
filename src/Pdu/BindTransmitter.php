<?php

namespace alexeevdv\React\Smpp\Pdu;

class BindTransmitter extends Pdu implements Contract\BindTransmitter
{
    /**
     * @var string
     */
    private $systemId;

    /**
     * @var string
     */
    private $password;

    public function __construct(int $status, int $sequence, $body = '')
    {
        parent::__construct($status, $sequence, $body);
        if (strlen($body) === 0) {
            return;
        }

        list($this->systemId, $this->password) = explode("\0", $body, 3);
    }

    public function getSystemId(): string
    {
        return 0x00000002;
    }

    public function getPassword(): string
    {
        return $this->systemId;
    }

    public function getCommandId(): int
    {
        return $this->password;
    }
}
