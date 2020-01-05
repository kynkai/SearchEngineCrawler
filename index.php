<?php

require_once "vendor/autoload.php";

require_once "src/simple_html_dom.php";

use Zend\Http\Client;
use Zend\Http\Request;
use SearchEnginePartner\Bing\Algo;
use SearchEnginePartner\Bing\BingSearch;
use SearchEnginePartner\Yahoo\YahooSearch;


$rs = [];

$bing = new BingSearch();

//$bing = new YahooSearch();

$bing->query = "fa";
$bing->count = 10000;
$bing->location = "vi_Vi";


for ($i=0; $i < 1 ; $i++) { 

   // $search = $bing->getSearch();

    $image = $bing->getImage();

    $bing->first = $i*10;

    //$video = $bing->getVideo();

    array_push($rs,$image);

}


header('Content-Type: application/json');

echo json_encode($rs);
