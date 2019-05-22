<?php

namespace alexeevdv\React\Smpp\Pdu;

class UnbindResp extends Pdu implements Contract\UnbindResp
{
    public function getCommandId(): int
    {
        return 0x80000006;
    }
}
