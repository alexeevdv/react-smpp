<?php

namespace alexeevdv\React\Smpp\Pdu;

use alexeevdv\React\Smpp\Utils\DataWrapper;

trait TLVTrait
{
    /** @var TLV[] */
    protected $tlv = [];

    /**
     * Returns the TLV for the passed tag if exists
     *
     * @param int $tag
     *
     * @return TLV|null
     */
    public function getTLV(int $tag): ?TLV
    {
        return $this->tlv[$tag] ?? null;
    }

    /**
     * Add the passed TLV
     *
     * @param TLV $tlv
     */
    public function setTLV(TLV $tlv): void
    {
        $this->tlv[$tlv->getTag()] = $tlv;
    }

    /**
     * Generate TLVs from passed DataWrapper
     *
     * @param DataWrapper $wrapper
     */
    public function generateFromDatawrapper(DataWrapper $wrapper): void
    {
        while ($wrapper->bytesLeft()) {
            $tlv = $wrapper->readTLV();
            $this->setTLV($tlv);
        }
    }
}