<?php

namespace alexeevdv\React\Smpp\Pdu;

class QuerySm extends Pdu implements Contract\QuerySm
{
    public function getCommandId(): int
    {
        return 0x00000003;
    }
}
