<?php
error_reporting(E_ALL);
date_default_timezone_set('UTC');
ini_set('memory_limit', '8M');

include __DIR__ . '/../vendor/autoload.php';

use MySQLReplication\BinLogStream;
use MySQLReplication\Config\ConfigService;

$binLogStream = new BinLogStream(
    (new ConfigService())->makeConfigFromArray([
        'user' => 'root',
        'host' => '192.168.1.100',
        'password' => 'root',
        //'gtid' => '9b1c8d18-2a76-11e5-a26b-000c2976f3f3:1-177592',
    ])
);
while (1)
{
    $result = $binLogStream->getBinLogEvent();
    if (!is_null($result))
    {
        // all events got __toString() implementation
        echo $result;

        // all events got JsonSerializable implementation
        //echo json_encode($result, JSON_PRETTY_PRINT);

        //echo 'Memory usage ' . round(memory_get_usage() / 1048576, 2) . ' MB' . PHP_EOL;
    }
}
