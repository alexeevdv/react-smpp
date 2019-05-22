<?php

namespace alexeevdv\React\Smpp\Pdu\Contract;

interface SubmitSm extends Pdu
{
    // TODO combine to Address object
    public function getSourceAddressTon(): int;

    public function getSourceAddressNpi(): int;

    public function getSourceAddress(): string;

    // TODO combine to Address object
    public function getDestinationAddressTon(): int;

    public function getDestinationAddressNpi(): int;

    public function getDestinationAddress(): string;

    public function getEsmClass(): int;

    public function getDataCoding(): int;

    public function getSmLength(): int;

    public function getShortMessage(): string;
}
