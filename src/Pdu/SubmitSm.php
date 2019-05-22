<?php

namespace alexeevdv\React\Smpp\Pdu;

class SubmitSm extends Pdu implements Contract\SubmitSm
{
    private $sourceAddressTon;
    private $sourceAddressNpi;
    private $sourceAddress;
    private $destinationAddressTon;
    private $destinationAddressNpi;
    private $destinationAddress;

    public function __construct(int $status, int $sequence, $body = '')
    {
        parent::__construct($status, $sequence, $body);

        if (strlen($body) === 0) {
            return;
        }
    }

    public function getCommandId(): int
    {
        return 0x00000004;
    }

    public function getSourceAddressTon(): int
    {
        return $this->sourceAddressTon;
    }

    public function getSourceAddressNpi(): int
    {
        return $this->sourceAddressTon;
    }

    public function getSourceAddress(): string
    {
        return $this->sourceAddress;
    }

    public function getDestinationAddressTon(): int
    {
        return $this->destinationAddressTon;
    }

    public function getDestinationAddressNpi(): int
    {
        return $this->destinationAddressNpi;
    }

    public function getDestinationAddress(): string
    {
        return $this->destinationAddress;
    }

    public function getEsmClass(): int
    {
        return 0;
    }

    public function getDataCoding(): int
    {
        return 0;
    }

    public function getSmLength(): int
    {
        return 0;
    }

    public function getShortMessage(): string
    {
        return '';
    }

}
