<?php

namespace alexeevdv\React\Smpp\Pdu\Contract;

interface BindTransmitter extends Pdu
{
    public function getSystemId(): string;

    public function getPassword(): string;
}
