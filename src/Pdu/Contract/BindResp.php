<?php

namespace alexeevdv\React\Smpp\Pdu\Contract;

interface BindResp extends Pdu
{
    public function getSystemId(): string;
}
