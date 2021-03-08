# react-smpp

Async SMPP server and client implementations for ReactPHP.

## SMPP server example

```php
<?php

use alexeevdv\React\Smpp\Pdu\BindTransmitterResp;
use alexeevdv\React\Smpp\Pdu\Contract\BindTransmitter;
use alexeevdv\React\Smpp\Pdu\SubmitSm;
use alexeevdv\React\Smpp\Proto\CommandStatus;
use alexeevdv\React\Smpp\Server;
use React\Socket\ConnectionInterface;

require_once 'vendor/autoload.php';

$loop = React\EventLoop\Factory::create();
$smppServer = new Server('127.0.0.1:2775', $loop);

$smppServer->on('connection', function (ConnectionInterface $connection) use ($loop) {
    echo 'SMPP client connected' . PHP_EOL;

    $connection->on('data', function ($data) {
        echo bin2hex($data) . PHP_EOL;
    });

    $connection->on('bind_transmitter', function (BindTransmitter $pdu) use ($connection) {
        echo 'BIND' . PHP_EOL;
        $response = new BindTransmitterResp(CommandStatus::ESME_ROK, $pdu->getSequenceNumber());
        $connection->emit('send', [$response]);
    });

    $connection->on('submit_sm', function (SubmitSm $pdu) use ($connection) {

    });

    $connection->on('error', function ($error) use ($connection) {
        echo 'ERROR' . PHP_EOL;
        //var_dump($error);
        //$connection->close();
    });
});

$loop->run();
```
