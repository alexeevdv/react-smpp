<?php

namespace alexeevdv\React\Smpp\Pdu;

class GenericNack extends Pdu implements Contract\GenericNack
{
    public function getCommandId(): int
    {
        return 0x80000000;
    }
}
