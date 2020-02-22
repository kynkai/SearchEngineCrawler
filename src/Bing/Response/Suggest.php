<?php
namespace SearchEnginePartner\Bing\Response;

use SearchEnginePartner\Bing\Response as _Response;
use SearchEnginePartner\Bing\Modal\SuggestModal;

class Suggest extends _Response{

    /**
     * @var SuggestModal[]
     */
    private $suggestModals;

    public function init()
    {
        
        if($doc = $this->getDoc()){

            $this->suggestModals = $this->getListSuggest($doc);

        }
    
    }

    public function getListSuggest($doc){

        $suggests = [];

        $list = $doc->find('li');

        foreach ($list as $docItem) {

            array_push($suggests,$this->getSuggestDoc($docItem));

        }

        return $suggests;

    }

    public function getSuggestDoc($doc){

        $span = $doc->find('span')[0];

        $url = $doc->getAttribute("url");

        $a = $doc->find('a');

        return new SuggestModal($span->text(),$url,count($a) > 0);

    }


    /**
     * Get the value of suggestModal
     *
     * @return  SuggestModal[]
     */ 
    public function getSuggestModals()
    {
        return $this->suggestModals;
    }
}