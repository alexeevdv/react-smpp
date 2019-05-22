<?php

namespace alexeevdv\React\Smpp\Pdu\Contract;

interface Factory
{
    public function createFromBuffer(string $buffer): Pdu;
}
