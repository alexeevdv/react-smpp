<?php

namespace alexeevdv\React\Smpp\Pdu;

class ReplaceSm extends Pdu implements Contract\ReplaceSm
{
    public function getCommandId(): int
    {
        return 0x00000007;
    }
}
