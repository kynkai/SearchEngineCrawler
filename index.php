<?php

require_once "vendor/autoload.php";

use SearchEnginePartner\Bing\BingSearch;
use SearchEnginePartner\Yahoo\YahooSearch;
use SearchEnginePartner\Google\GoogleSearch;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use SearchEnginePartner\StaticRealTime;

$log = new Logger('name');
$log->pushHandler(new StreamHandler('data/path/to/your.log', Logger::WARNING));
StaticRealTime::$LOGGER = $log;

$rs = [];

$bing = new BingSearch();

//$bing = new YahooSearch();

$bing = new GoogleSearch();

$bing->query = "fa";
$bing->count = 10;
$bing->location = "vi_Vi";

$video = $image = $search = $suggests = [];

for ($i=0; $i < 1 ; $i++) { 

    $search = $bing->getSearch();

    $image = $bing->getImage();

    $video = $bing->getVideo();

    $suggests = $bing->getSuggests();

    array_push($rs,$image,$search,$video,$suggests);

    $bing->first = $i*10;

}


header('Content-Type: application/json');

echo json_encode($rs);
