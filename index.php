<?php

require_once "vendor/autoload.php";

use SearchEnginePartner\Bing\BingSearch;
use SearchEnginePartner\Yahoo\YahooSearch;
use SearchEnginePartner\Google\GoogleSearch;
use Monolog\Handler\StreamHandler;
use SearchEnginePartner\Logger;

$log = new Logger('name');

$log->pushHandler(new StreamHandler('data/path/to/your.log', Logger::WARNING));

$rs = [];

$bing = new BingSearch();

//$bing = new YahooSearch();

//$bing = new GoogleSearch();

$bing->setKeyWord("fa");
$bing->setCount(10);
$bing->setLocation("vi_Vi");

$video = $image = $search = $suggests = [];

for ($i=0; $i < 1 ; $i++) { 

    $search = $bing->getHomePageResultObject();

    $image = $bing->getImageResultObject();

    $video = $bing->getVideoResultObject();

    $suggests = $bing->getSuggestsResultObject();

    array_push($rs,$image,$search,$video,$suggests);

    $bing->first = $i*10;

}

$records = $bing->getRecords();

//var_dump($records);

$log->logs(Logger::DEBUG,$records);

header('Content-Type: application/json');

echo json_encode($rs,JSON_PRETTY_PRINT);
