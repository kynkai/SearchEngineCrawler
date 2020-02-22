<?php
namespace SearchEnginePartner;

use Zend\Http\PhpEnvironment\Request;
use SearchEnginePartner\Modal\Param\SearchParam;

require_once "simple_html_dom.php";

abstract class SearchEnginePartnerAbstract extends Client implements DiaryRecordInterface{

    /**
     * @var SearchParam
     */
    private $searchParam;

    public function __construct(SearchParam $searchParam = null)
    {
        $this->searchParam = $searchParam;
        
        parent::__construct();

    }

    public abstract function getRequestHomePage();

    public abstract function getRequestImage();

    public abstract function getRequestVideo();

    public abstract function getRequestSuggests();

    public abstract function getResponseHomePage();

    public abstract function getResponseImage();

    public abstract function getResponseVideo();

    public abstract function getResponseSuggests();

    public function responseCover(Response $response){

        return $response;

    }

    public function getHomePage(){

        return responseCover($this->send($this->getRequestHomePage()),$this->getResponseHomePage());

    }

    public function getImage(){

        return responseCover($this->send($this->getRequestImage()),$this->getResponseImage());

    }

    public function getVideo(){

        return responseCover($this->send($this->getRequestVideo()),$this->getResponseVideo());

    }

    public function getSuggests(){

        return responseCover($this->send($this->getRequestSuggests()),$this->getResponseSuggests());

    }

    /**
     * Get the value of searchParam
     *
     * @return  SearchParam
     */ 
    public function getSearchParam()
    {
        return $this->searchParam;
    }

    /**
     * Set the value of searchParam
     *
     * @param  SearchParam  $searchParam
     *
     * @return  self
     */ 
    public function setSearchParam(SearchParam $searchParam)
    {
        $this->searchParam = $searchParam;

        return $this;
    }
}