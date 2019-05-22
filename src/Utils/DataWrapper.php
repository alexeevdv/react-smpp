<?php

namespace alexeevdv\React\Smpp\Utils;

class DataWrapper
{
    private $position = 0;
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function readInt32(): ?int
    {
        @extract(unpack("Nvalue", $this->data, $this->position));
        $this->position += 4;
        return $value;
    }

    public function readNullTerminatedString(): ?string
    {
        $data = null;

        while ($this->position < strlen($this->data) && $this->data[$this->position] != "\0") {
            $data .= $this->data[$this->position];
            $this->position++;
        }
        $this->position++;

        return $data;
    }
}
