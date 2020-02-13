<?php
namespace SearchEnginePartner;

use Zend\Http\PhpEnvironment\Request;
use Zend\Uri\Uri;

require_once "simple_html_dom.php";

abstract class SearchEnginePartnerAbstract extends Client implements DiaryRecordInterface{

    /**
     * @var Uri
     */
    protected $host;

    /**
     * @var string
     */
    private $keyWord;

    /**
     * @var int
     */
    private $first = 0;

    /**
     * @var int
     */
    private $count = 0;

    /**
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $body;

    public function __construct(){

        parent::__construct();

        if(is_string($this->host)){
            $this->host = new Uri($this->host);
        }

    }

    public function getDefaultRequest(){

        $request = new Request();

        $request->getHeaders()->addHeaderLine("Host",$this->getHost()->getHost());

        return $request;
    }

    public abstract function getRequestHomePage();

    public abstract function getRequestImage();

    public abstract function getRequestVideo();

    public abstract function getRequestSuggests();

    public abstract function getHomePageResultObject();

    public abstract function getImageResultObject();

    public abstract function getVideoResultObject();

    public abstract function getSuggestsResultObject();

    public function getResponseHomePage(){

        return $this->send($this->getRequestHomePage());

    }

    public function getResponseImage(){

        return $this->send($this->getRequestImage());

    }

    public function getResponseVideo(){

        return $this->send($this->getRequestVideo());

    }

    public function getResponseSuggests(){

        return $this->send($this->getRequestSuggests());

    }

    /**
     * Get the value of host
     *
     * @return  Uri
     */ 
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Get the value of first
     *
     * @return  int
     */ 
    public function getFirst()
    {
        return $this->first;
    }

    /**
     * Set the value of first
     *
     * @param  int  $first
     *
     * @return  self
     */ 
    public function setFirst(int $first)
    {
        $this->first = $first;

        return $this;
    }

    /**
     * Get the value of count
     *
     * @return  int
     */ 
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set the value of count
     *
     * @param  int  $count
     *
     * @return  self
     */ 
    public function setCount(int $count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get the value of location
     *
     * @return  string
     */ 
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @param  string  $location
     *
     * @return  self
     */ 
    public function setLocation(string $location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get the value of keyWord
     *
     * @return  string
     */ 
    public function getKeyWord()
    {
        return $this->keyWord;
    }

    /**
     * Set the value of keyWord
     *
     * @param  string  $keyWord
     *
     * @return  self
     */ 
    public function setKeyWord(string $keyWord)
    {
        $this->keyWord = $keyWord;

        return $this;
    }
}