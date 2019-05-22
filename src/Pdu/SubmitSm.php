<?php

namespace alexeevdv\React\Smpp\Pdu;

class SubmitSm extends Pdu implements Contract\SubmitSm
{
    public function getCommandId(): int
    {
        return 0x00000004;
    }
}
