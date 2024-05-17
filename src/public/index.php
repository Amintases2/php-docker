<?php

define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/vendor/autoload.php';



//dd($pdo);





$client = Elastic\Elasticsearch\ClientBuilder::create()
    ->setHosts(['elasticsearch:9200'])
    ->build();

$params = [
    'index' => 'users',
    'firstname' => 'Alex'
];

$response = $client->search()->asArray();

dd($response);


