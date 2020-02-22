<?php
namespace SearchEnginePartner;

use Zend\Http\Header\Cookie;
use Laminas\Http\Request as PhpEnvironmentRequest;
use Laminas\Http\Cookies;
use SearchEnginePartner\Modal\Param\SearchParam;

class Request extends PhpEnvironmentRequest{

    /**
     * @var SearchParam
     */
    private $searchParam;

    public function __construct(SearchParam $searchParam)
    {

        $this->searchParam = $searchParam;

        $this->setHeaders(new Cookies());

        $this->init();

    }

    public function init(){}

    public function dumpHeaders(){

        $headers = $this->getHeaders();

        if($headers instanceof Cookies){

            $this->getHeaders()->addHeaderLine("Cookie","_EDGE_S=en-in");

        }

    }

    /**
     * Set the URI/URL for this request, this can be a string or an instance of Zend\Uri\Http
     *
     * @throws Exception\InvalidArgumentException
     * @param string|HttpUri $uri
     * @return $this
     */
    public function setUri($uri)
    {
        $that = parent::setUri($uri);

        if($that){

            $this->getHeaders()->addHeaderLine("Host",$this->getUri()->getHost());

        };

        return $that;

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