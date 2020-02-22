<?php
require_once "vendor/autoload.php";

use SearchEnginePartner\Modal\Param\SearchParam;
use SearchEnginePartner\Bing\BingSearch;

$rs = [];

$video = $image = $search = $suggests = $algos = $additionals = [];

$param = new SearchParam();

$param->setKeyWord("fa");
$param->setCount(33);
//
$param->setLocation("en-in");
//$param->setLocation("nl-nl");
//$param->setLocation("vi-vn");

$bingSearch = new BingSearch(); $bingSearch->setSearchParam($param);

$imageResponse = $bingSearch->getImage();

$image = $imageResponse->getImageItem();

//var_dump($image);return;

$suggestsResponse = $bingSearch->getSuggests();

$suggests = $suggestsResponse->getSuggestModals();

$homeResponse = $bingSearch->getHomePage();

$search = $homeResponse->getAlgos();

$additionals = $homeResponse->getAdditionals();

$videoResponse = $bingSearch->getVideo();

$video = $videoResponse->getVideoItem();

array_push($rs,$search,$image,$video,$suggests,$additionals);

header('Content-Type: application/json');

echo json_encode($rs,JSON_PRETTY_PRINT);
