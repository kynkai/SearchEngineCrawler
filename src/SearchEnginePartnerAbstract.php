<?php
namespace SearchEnginePartner;

use Zend\Http\Response;


abstract class SearchEnginePartnerAbstract extends Client{

    public $host;

    public $request;

    public $query;

    public $first = 0;

    public $count = 0;

    public $location;

    public $body;

    public $response;

    public function __construct(){

        $this->request = self::defaultRequest();

        parent::__construct();

    }

    public function getRequest(){

        return $this->request;

    }

    public abstract function getQuery();

    public abstract function getQueryImage();

    public abstract function getQueryVideo();

    public function getSearch($option = []){

        $request = self::defaultRequest();

        $query = $this->getQuery();

        $request->setUri($query);

        $response = $this->send(
            $request
        );

        return $response;

    }

    public function getImage($option = []){

        $request = self::defaultRequest();

        $queryImage = $this->getQueryImage();

        $request->setUri($queryImage);

        $response = $this->send(
            $request
        );

        return $response;

    }

    public function getVideo($option = []){

        $request = self::defaultRequest();

        $queryVideo = $this->getQueryVideo();

        $request->setUri($queryVideo);

        $response = $this->send(
            $request
        );

        return $response;

    }

    public function logDom($dom){

        foreach ($dom as $key => $value) {
          
           echo $value->text();

           var_dump($value->getAllAttributes());

        }

    }

}