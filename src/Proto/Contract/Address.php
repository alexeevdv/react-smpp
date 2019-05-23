<?php

namespace alexeevdv\React\Smpp\Proto\Contract;

interface Address
{
    const TON_UNKNOWN = 0b00000000;
    const TON_INTERNATIONAL = 0b00000001;
    const TON_NATIONAL = 0b00000010;
    const TON_NETWORK_SPECIFIC = 0b00000011;
    const TON_SUBSCRIBER_NUMBER = 0b00000100;
    const TON_ALPHANUMERIC = 0b00000101;
    const TON_ABBREVIATED = 0b00000110;

    const NPI_UNKNOWN = 0b00000000;
    const NPI_ISDN = 0b00000001;
    const NPI_DATA = 0b00000011;
    const NPI_TELEX = 0b00000100;
    const NPI_LAND_MOBILE = 0b00000110;
    const NPI_NATIONAL = 0b00001000;
    const NPI_PRIVATE = 0b00001001;
    const NPI_ERMES = 0b00001010;
    const NPI_INTERNET_IP = 0b00001110;
    const NPI_WAP_CLIENT_ID = 0b00010010;

    public function getTon(): int;

    public function getNpi(): int;

    public function getValue(): string;
}
