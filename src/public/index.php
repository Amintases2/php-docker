<?php

define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/vendor/autoload.php';

$client = Elastic\Elasticsearch\ClientBuilder::create()
    ->setHosts(['elasticsearch:9200'])
    ->build();

$params = [
    'index' => 'my_idx',
];

$response = $client->search($params)->asObject();

dd($response->hits->hits);
