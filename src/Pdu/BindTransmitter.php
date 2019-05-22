<?php

namespace alexeevdv\React\Smpp\Pdu;

use alexeevdv\React\Smpp\Utils\DataWrapper;

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

        $wrapper = new DataWrapper($body);
        $this->systemId = $wrapper->readNullTerminatedString();
        $this->password = $wrapper->readNullTerminatedString();
    }

    public function getCommandId(): int
    {
        return 0x00000002;
    }

    public function getSystemId(): string
    {
        return $this->systemId;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
