<?php

namespace alexeevdv\React\Smpp\Pdu;

class DeliverSmResp extends SubmitSmResp implements Contract\DeliverSmResp
{
    public function getCommandId(): int
    {
        return 0x80000005;
    }
}
