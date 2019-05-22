<?php

namespace alexeevdv\React\Smpp\Pdu;

class SubmitSmResp extends Pdu implements Contract\SubmitSmResp
{
    public function getCommandId(): int
    {
        return 0x80000004;
    }
}
