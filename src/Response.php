<?php
namespace SearchEnginePartner;

use Laminas\Http\Response as HttpResponse;

class Response extends HttpResponse{

    private $doc;

    public function init(){}

    public function ResponseTo(HttpResponse $response){

        $this->setContent(gzdecode($response->getContent()));
        
        $this->doc = str_get_html($this->getContent());

        $this->init();
    }
    
    /**
     * Get the value of doc
     */ 
    public function getDoc()
    {
        return $this->doc;
    }
}