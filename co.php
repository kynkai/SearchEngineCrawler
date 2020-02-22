<?php
require_once "vendor/autoload.php";

use Laminas\Http\Client;
use Laminas\Http\Cookies;
use Laminas\Http\Request;
use Laminas\Http\Header\SetCookie;
use SearchEnginePartner\Client as CClient;

$cookies = new Cookies();

$_EDGE_S = new SetCookie("_EDGE_S","mkt=nl-nl",null,'/','bing.com',false,true);

$cookies->addCookie($_EDGE_S);

//$_EDGE_S = new SetCookie("ggg","mkt=nl-nl",null,'/','localhost',false,true);$cookies->addCookie($_EDGE_S);

$requestL = new Request();

$requestL->setUri("https://www.bing.com/account/action?scope=web&setmkt=en-in");

$request = new Request();

$request->setUri('https://www.bing.com/search?q=fa');

//$request->setUri('http://localhost:9999/la.php');

$client = new Client(null,["maxredirects"=>0]);

$client->setOptions(CClient::defaultOptions());

//$client->setHeaders()

//$client->setAdapter(new Proxy);

//$client->setCookies($cookies->getMatchingCookies($request->getUri()));

$requestL->getHeaders()->addHeaderLine("Host",$requestL->getUri()->getHost());

//var_dump($requestL);

var_dump($client);

$res = $client->send($requestL);

var_dump($client->getCookies());

foreach ($client->getCookies() as $key => $value) {
    
    //$value->setDomain(null);

    $value->setHttpOnly(false);

}

$res2 = $client->send($request);

//$client->clearCookies();

var_dump($res2);

echo gzdecode($res2->getContent()); 

var_dump($client->getCookies());

//echo $res;
