<?php
namespace SearchEnginePartner;

use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Http\Response;


abstract class SearchEnginePartnerAbstract{

    public const QUERY = "QUERY";

    public const IMAGE = "IMAGE";

    public $host;

    public $request;

    public $query;

    public $first = 0;

    public $count = 0;

    public $location;

    public $client;

    public $body;

    public $response;

    public function __construct(Client $client = null){

        $this->client = $client ?: self::defaultClient();
        $this->request = self::defaultRequest();

    }

    public function getRequest(){

        return $this->request;

    }

    public function getClient(){

        return $this->client;

    }

    public function getSearchResponse(Response $response){

        return $response->getContent();

    }

    public abstract function getQuery();

    public abstract function getQueryImage();

    public abstract function getQueryVideo();

    public function getSearch($option = []){

        $request = self::defaultRequest();

        $query = $this->getQuery();

        $request->setUri($query);

        $response = $this->client->send(
            $request
        );

        return $response;

    }

    public function getImage($option = []){

        $request = self::defaultRequest();

        $queryImage = $this->getQueryImage();

        $request->setUri($queryImage);

        $response = $this->client->send(
            $request
        );

        return $response;

    }

    public function getVideo($option = []){

        $request = self::defaultRequest();

        $queryVideo = $this->getQueryVideo();

        $request->setUri($queryVideo);

        $response = $this->client->send(
            $request
        );

        return $response;

    }

    public static function defaultRequest(){

        $request = new Request();

        return $request;
    }

    public static function defaultClient(){

        $client = new Client(null,[
            'adapter' => 'Zend\Http\Client\Adapter\Curl',
            "useragent" =>"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0"
        ]);
        
        $client->setHeaders([
            ['Accept-Encoding' => 'gzip,deflate,br'],
        ]);

        return $client;

    }

    public function logDom($dom){

        foreach ($dom as $key => $value) {
          
           echo $value->text();

           var_dump($value->getAllAttributes());

        }

    }

}