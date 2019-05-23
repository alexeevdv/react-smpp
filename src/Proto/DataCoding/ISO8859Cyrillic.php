<?php

namespace alexeevdv\React\Smpp\Proto\DataCoding;

use alexeevdv\React\Smpp\Proto\Contract\DataCoding;

class ISO8859Cyrillic implements DataCoding
{
    public function decode(string $data): string
    {
        return iconv('ISO-8859-5', 'UTF-8', $data);
    }

    public function encode(string $data): string
    {
        return iconv('UTF-8', 'ISO-8859-5', $data);
    }
}
