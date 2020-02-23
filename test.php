<?php
require_once "vendor/autoload.php";

use SearchEnginePartner\Modal\Param\SearchParam;
use SearchEnginePartner\Bing\BingSearch;
use SearchEnginePartner\Google\GoogleSearch;

$rs = [];

$video = $image = $suggests = $algos = $additionals = [];

$param = new SearchParam();

$param->setKeyWord("fa");
$param->setCount(33);
//
$param->setLocation("en-in");
//$param->setLocation("nl-nl");
//$param->setLocation("vi-vn");

$search = new BingSearch(); 

//$search = new GoogleSearch();

$search->setSearchParam($param);

$imageResponse = $search->getImage();

$image = $imageResponse->getImageItem();

//var_dump($image);return;

$suggestsResponse = $search->getSuggests();

$suggests = $suggestsResponse->getSuggestModals();

$homeResponse = $search->getHomePage();

$algos = $homeResponse->getAlgos();

$additionals = $homeResponse->getAdditionals();

$videoResponse = $search->getVideo();

$video = $videoResponse->getVideoItem();

$rs["algos"] = $algos;
$rs["image"] = $image;
$rs["video"] = $video;
$rs["suggests"] = $suggests;
$rs["additionals"] = $additionals;

//array_push($rs,$algos,$image,$video,$suggests,$additionals);

header('Content-Type: application/json');

echo json_encode($rs,JSON_PRETTY_PRINT);
