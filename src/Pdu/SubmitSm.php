<?php

namespace alexeevdv\React\Smpp\Pdu;

use alexeevdv\React\Smpp\Proto\Address;
use alexeevdv\React\Smpp\Proto\Contract\Address as AddressContract;
use alexeevdv\React\Smpp\Proto\Contract\DataCoding;
use alexeevdv\React\Smpp\Proto\DataCoding\UCS2;
use alexeevdv\React\Smpp\Utils\DataWrapper;

class SubmitSm extends Pdu implements Contract\SubmitSm
{
    /**
     * @var string
     */
    private $serviceType;

    /**
     * @var AddressContract
     */
    private $sourceAddress;

    /**
     * @var AddressContract
     */
    private $destinationAddress;

    /**
     * @var int
     */
    private $dataCoding;

    /**
     * @var string
     */
    private $shortMessage;

    /**
     * @var int
     */
    private $esmClass;

    public function __construct(int $status, int $sequence, $body = '')
    {
        parent::__construct($status, $sequence, $body);

        if (strlen($body) === 0) {
            return;
        }

        $wrapper = new DataWrapper($body);
        $this->setServiceType(
            $wrapper->readNullTerminatedString(6)
        );
        $this->setSourceAddress(new Address(
            $wrapper->readInt8(),
            $wrapper->readInt8(),
            $wrapper->readNullTerminatedString(21)
        ));
        $this->setDestinationAddress(new Address(
            $wrapper->readInt8(),
            $wrapper->readInt8(),
            $wrapper->readNullTerminatedString(21)
        ));
        $this->setEsmClass(
            $wrapper->readInt8()
        );

        // protocol_id int8
        $wrapper->readInt8();

        // priority_flag int8
        $wrapper->readInt8();

        // schedule_delivery_time C-string 1 or 17
        $wrapper->readNullTerminatedString(17);

        // validity_period C-string 1 or 17
        $wrapper->readNullTerminatedString(17);

        // registered_delivery int8
        $wrapper->readInt8();

        // replace_if_present_flag int8
        $wrapper->readInt8();

        $this->setDataCoding(
            $wrapper->readInt8()
        );

        // sm_default_msg_id int8
        $wrapper->readInt8();

        $smLength = $wrapper->readInt8();
        $shortMessage = $wrapper->readBytes($smLength);

        if ($this->getDataCoding() === DataCoding::UCS2) {
            $decoder = new UCS2;
            $shortMessage = $decoder->decode($shortMessage);
        }

        $this->setShortMessage(
            $shortMessage
        );

        /* Body layout
        optional

        user_message_reference TLV
        source_port TLV
        source_addr_subunit TLV
        destination_port TLV
        dest_addr_subunit TLV
        sar_msg_ref_num TLV
        sar_total_segments TLV
        sar_segment_seqnum TLV
        more_messages_to_send TLV
        payload_type TLV
        message_payload TLV
        privacy_indicator TLV
        callback_num TLV
        callback_num_pres_ind TLV
        callback_num_atag TLV
        source_subaddress TLV
        dest_subaddress TLV
        user_response_code TLV
        display_time TLV
        sms_signal TLV
        ms_validity TLV
        ms_msg_wait_facilities TLV
        number_of_messages TLV
        alert_on_msg_delivery TLV
        language_indicator TLV
        its_reply_type TLV
        its_session_info TLV
        ussd_service_op TLV

        */

    }

    public function getCommandId(): int
    {
        return 0x00000004;
    }

    public function getServiceType(): string
    {
        return $this->serviceType;
    }

    public function setServiceType(string $serviceType): self
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    public function getSourceAddress(): AddressContract
    {
        return $this->sourceAddress;
    }

    public function setSourceAddress(AddressContract $address): self
    {
        $this->sourceAddress = $address;
        return $this;
    }

    public function getDestinationAddress(): AddressContract
    {
        return $this->destinationAddress;
    }

    public function setDestinationAddress(AddressContract $address): self
    {
        $this->destinationAddress = $address;
        return $this;
    }

    public function getEsmClass(): int
    {
        return $this->esmClass;
    }

    public function setEsmClass(int $esmClass): self
    {
        $this->esmClass = $esmClass;
        return $this;
    }

    public function getDataCoding(): int
    {
        return $this->dataCoding;
    }

    public function setDataCoding(int $dataCoding): self
    {
        $this->dataCoding = $dataCoding;
        return $this;
    }

    public function getShortMessage(): string
    {
        return $this->shortMessage;
    }

    public function setShortMessage(string $shortMessage): self
    {
        $this->shortMessage = $shortMessage;
        return $this;
    }
}
