<?php

declare(strict_types=1);

namespace alexeevdv\React\Smpp;

class ServerConfig
{
    /**
     * @var string
     */
    private $uri = '127.0.0.1:2775';

    public function getUri(): string
    {
        return $this->uri;
    }

    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }
}
