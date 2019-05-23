<?php

namespace alexeevdv\React\Smpp\Proto\Contract;

interface DataCoding
{
    const DEFAULT = 0;
    const IA5 = 1; // IA5 (CCITT T.50)/ASCII (ANSI X3.4)
    const BINARY_ALIAS = 2;
    const ISO8859_1 = 3; // Latin 1
    const BINARY = 4;
    const JIS = 5;
    const ISO8859_5 = 6; // Cyrillic
    const ISO8859_8 = 7; // Latin/Hebrew
    const UCS2 = 8; // UCS-2BE (Big Endian)
    const PICTOGRAM = 9;
    const ISO2022_JP = 10; // Music codes
    const KANJI = 13; // Extended Kanji JIS
    const KSC5601 = 14;
    
    public function encode(string $data): string;

    public function decode(string $data): string;
}
