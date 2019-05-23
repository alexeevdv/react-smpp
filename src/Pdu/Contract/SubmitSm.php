<?php

namespace alexeevdv\React\Smpp\Pdu\Contract;

use alexeevdv\React\Smpp\Proto\Contract\Address;
use DateTimeInterface;

interface SubmitSm extends Pdu
{
    public function getServiceType(): string;

    public function getSourceAddress(): Address;

    public function getDestinationAddress(): Address;

    public function getEsmClass(): int;

    public function getDataCoding(): int;

    public function getShortMessage(): string;

    public function getValidityPeriod(): ?DateTimeInterface;

    public function getScheduleDeliveryTime(): ?DateTimeInterface;
}
