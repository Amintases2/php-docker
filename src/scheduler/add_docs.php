<?php

define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/vendor/autoload.php';

$client = Elastic\Elasticsearch\ClientBuilder::create()
    ->setHosts(['elasticsearch:9200'])
    ->build();



$client->create();


//$pdo = new PDO("mysql:host=db;dbname=my_db", 'root', 'root');
//
//for($i = 0; $i<10;$i+=1){
//    $pdo->query("insert into lot(title, description, price) values ('машина', 'продаю машину', 100)");
//}
//
//for($i = 0; $i<10;$i+=1){
//    $pdo->query("insert into lot(title, description, price) values ('кросовок', 'продаю кросовок', 100)");
//}
