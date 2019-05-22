<?php

namespace alexeevdv\React\Smpp\Pdu;

class Unbind extends Pdu implements Contract\Unbind
{
    public function getCommandId(): int
    {
        return 0x00000006;
    }
}
