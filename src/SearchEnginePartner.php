<?php
namespace SearchEnginePartner;
use Zend\Http\Response;


class SearchEnginePartner extends SearchEnginePartnerAbstract{

    public $host = "https://www.google.com/";

    public function getQuery(){

        return $this->host."search?q={$this->query}&first={$this->first}";

    }

}