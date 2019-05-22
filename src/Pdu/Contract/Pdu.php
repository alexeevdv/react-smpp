<?php

namespace alexeevdv\React\Smpp\Pdu\Contract;

interface Pdu
{
    public function getCommandLength(): int;

    public function getCommandId(): int;

    public function getCommandStatus(): int;

    public function getSequenceNumber(): int;

    public function getBody(): string;

    public function __toString(): string;
}
