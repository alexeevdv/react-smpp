<?php

namespace alexeevdv\React\Smpp\Pdu\Contract;

interface TLV
{
    public function getTag(): int;

    public function getValue(): string;
}
