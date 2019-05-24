<?php

namespace alexeevdv\React\Smpp\Pdu;

use alexeevdv\React\Smpp\Utils\DataWrapper;

abstract class BindResp extends Pdu implements Contract\BindResp
{
    /**
     * @var string
     */
    private $systemId;

    public function __construct($body = '')
    {
        parent::__construct($body);
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
