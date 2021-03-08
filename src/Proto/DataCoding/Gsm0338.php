<?php

namespace alexeevdv\React\Smpp\Proto\DataCoding;

use alexeevdv\React\Smpp\Proto\Contract\DataCoding;

class Gsm0338 implements DataCoding
{
    public function encode(string $data): string
    {
        $replaced = strtr($data, $this->getMapping());
        // Replace unconverted UTF-8 chars from codepages U+0080-U+07FF,
        // U+0080-U+FFFF and U+010000-U+10FFFF with a single ?
        return preg_replace(
            '/([\\xC0-\\xDF].)|([\\xE0-\\xEF]..)|([\\xF0-\\xFF]...)/m',
            '?',
            $replaced
        );
    }

    public function decode(string $data): string
    {
        return strtr($data, array_flip($this->getMapping()));
    }

    private function getMapping()
    {
        return [
            '@' => "\x00",
            '£' => "\x01",
            '$' => "\x02",
            '¥' => "\x03",
            'è' => "\x04",
            'é' => "\x05",
            'ù' => "\x06",
            'ì' => "\x07",
            'ò' => "\x08",
            'Ç' => "\x09",
            'Ø' => "\x0B",
            'ø' => "\x0C",
            'Å' => "\x0E",
            'å' => "\x0F",
            'Δ' => "\x10",
            '_' => "\x11",
            'Φ' => "\x12",
            'Γ' => "\x13",
            'Λ' => "\x14",
            'Ω' => "\x15",
            'Π' => "\x16",
            'Ψ' => "\x17",
            'Σ' => "\x18",
            'Θ' => "\x19",
            'Ξ' => "\x1A",
            'Æ' => "\x1C",
            'æ' => "\x1D",
            'ß' => "\x1E",
            'É' => "\x1F",
            // all \x2? removed
            // all \x3? removed
            // all \x4? removed
            'Ä' => "\x5B",
            'Ö' => "\x5C",
            'Ñ' => "\x5D",
            'Ü' => "\x5E",
            '§' => "\x5F",
            '¿' => "\x60",
            'ä' => "\x7B",
            'ö' => "\x7C",
            'ñ' => "\x7D",
            'ü' => "\x7E",
            'à' => "\x7F",
            '^' => "\x1B\x14",
            '{' => "\x1B\x28",
            '}' => "\x1B\x29",
            '\\' => "\x1B\x2F",
            '[' => "\x1B\x3C",
            '~' => "\x1B\x3D",
            ']' => "\x1B\x3E",
            '|' => "\x1B\x40",
            '€' => "\x1B\x65"
        ];
    }
}
