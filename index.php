<?php

require_once "vendor/autoload.php";

require_once "src/simple_html_dom.php";

use Zend\Http\Client;
use Zend\Http\Request;
use SearchEnginePartner\Bing\Algo;
use SearchEnginePartner\Bing\BingSearch;
use SearchEnginePartner\Yahoo\YahooSearch;
use SearchEnginePartner\Google\GoogleSearch;

$rs = [];

$bing = new BingSearch();

//$bing = new YahooSearch();

$bing = new GoogleSearch();

$bing->query = "fa";
$bing->count = 10;
$bing->location = "vi_Vi";

$video = $image = $search = [];

for ($i=0; $i < 1 ; $i++) { 

    $search = $bing->getSearch();

    $image = $bing->getImage();

    $video = $bing->getVideo();

    array_push($rs,$image,$search,$video);

    $bing->first = $i*10;

}


header('Content-Type: application/json');

echo json_encode($rs);
