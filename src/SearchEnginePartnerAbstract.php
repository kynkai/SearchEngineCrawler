<?php
namespace SearchEnginePartner;

require_once "src/simple_html_dom.php";

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

    private $log;

    public function __construct(){

        $this->request = self::defaultRequest();

        parent::__construct();

        $this->log = StaticRealTime::$LOGGER;

    }

    public function getRequest(){

        return $this->request;

    }

    public abstract function getQuery();

    public abstract function getQueryImage();

    public abstract function getQueryVideo();

    public abstract function getQuerySuggests();

    public function getSearch($option = []){

        $request = self::defaultRequest();

        $query = $this->getQuery();

        $request->setUri($query);

        $response = $this->send(
            $request
        );

        $this->log->debug($query);

        return $response;

    }

    public function getImage($option = []){

        $request = self::defaultRequest();

        $queryImage = $this->getQueryImage();

        $request->setUri($queryImage);

        $response = $this->send(
            $request
        );

        $this->log->debug($queryImage);

        return $response;

    }

    public function getVideo($option = []){

        $request = self::defaultRequest();

        $queryVideo = $this->getQueryVideo();

        $request->setUri($queryVideo);

        $response = $this->send(
            $request
        );

        $this->log->debug($queryVideo);


        return $response;

    }

    public function getSuggests($option = []){

        $request = self::defaultRequest();

        $querySuggests = $this->getQuerySuggests();

        $request->setUri($querySuggests);

        $this->log->warning($querySuggests);

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