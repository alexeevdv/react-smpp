<?php

namespace alexeevdv\React\Smpp\Pdu\Contract;

interface BindTransmitterResp extends Pdu
{
    public function getSystemId(): string;
}
