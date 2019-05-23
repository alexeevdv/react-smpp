<?php

namespace alexeevdv\React\Smpp\Pdu;

use alexeevdv\React\Smpp\Utils\DataWrapper;

class BindTransmitterResp extends Pdu implements Contract\BindTransmitterResp
{
    /**
     * @var string
     */
    private $systemId;

    public function __construct(int $status, int $sequence, $body = '')
    {
        parent::__construct($status, $sequence, $body);
        if (strlen($body) === null) {
            return;
        }

        $wrapper = new DataWrapper($body);
        $this->setSystemId(
            $wrapper->readNullTerminatedString(16)
        );
        /**
         * optional
         *
         * sc_interface_version TLV
         */
    }

    public function getCommandId(): int
    {
        return 0x80000002;
    }

    public function getSystemId(): string
    {
        return $this->systemId;
    }

    public function setSystemId(string $systemId): self
    {
        $this->systemId = $systemId;
        return $this;
    }
}
