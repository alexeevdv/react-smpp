<?php

namespace alexeevdv\React\Smpp\Proto\Contract;

interface DataCoding
{
    public const DEFAULT = 0;
    public const IA5 = 1; // IA5 (CCITT T.50)/ASCII (ANSI X3.4)
    public const BINARY_ALIAS = 2;
    public const ISO8859_1 = 3; // Latin 1
    public const BINARY = 4;
    public const JIS = 5;
    public const ISO8859_5 = 6; // Cyrillic
    public const ISO8859_8 = 7; // Latin/Hebrew
    public const UCS2 = 8; // UCS-2BE (Big Endian)
    public const PICTOGRAM = 9;
    public const ISO2022_JP = 10; // Music codes
    public const KANJI = 13; // Extended Kanji JIS
    public const KSC5601 = 14;

    public function encode(string $data): string;

    public function decode(string $data): string;
}
