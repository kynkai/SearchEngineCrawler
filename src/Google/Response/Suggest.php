<?php
namespace SearchEnginePartner\Google\Response;

use SearchEnginePartner\Google\Response;
use SearchEnginePartner\Google\Modal\SuggestModal;

class Suggest extends Response{

    /**
     * @var SuggestModal[]
     */
    private $suggestModals;

    public function init()
    {
        
        if($doc = $this->getDoc()){

            $this->suggestModals = $this->getListSuggests($doc);

        }
    
    }

    public function getListSuggests($json){

        $json = str_replace(")]}'","",$json);

        $json = json_decode($json,true);

        $ar = [];

        foreach($json[0] as $key => $value) {

            //var_dump($value);
            
            array_push($ar,new SuggestModal($value[0],""));

        };

        return $ar;

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