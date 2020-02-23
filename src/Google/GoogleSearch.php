<?php
namespace SearchEnginePartner\Google;

use SearchEnginePartner\SearchEnginePartnerAbstract;

class GoogleSearch extends SearchEnginePartnerAbstract{

    public function getRequestHomePage(){
        
        return new Request\HomePage($this->getSearchParam());

    }

    public function getRequestVideo(){

        return new Request\Video($this->getSearchParam());

    }

    public function getRequestImage(){

        return new Request\Image($this->getSearchParam());

    }

    public function getRequestSuggests(){

        return new Request\Suggest($this->getSearchParam());

    }

    public function getResponseImage(){

        return new Response\Image();

    }

    public function getResponseVideo(){

        return new Response\Video();
    }

    public function getResponseHomePage(){

        return new Response\HomePage();

    }

    public function getResponseSuggests(){

        return new Response\Suggest();

    }

    /**
     * 
     *
     * @throws 
     * @param 
     * @return Response\HomePage
     */
    public function getHomePage(){ return parent::getHomePage(); }


        /**
     * 
     *
     * @throws 
     * @param 
     * @return Response\Image
     */
    public function getImage(){ return parent::getImage(); }


        /**
     * 
     *
     * @throws 
     * @param 
     * @return Response\Video
     */
    public function getVideo(){ return parent::getVideo(); }

            /**
     * 
     *
     * @throws 
     * @param 
     * @return Response\Suggest
     */
    public function getSuggests(){ return parent::getSuggests(); }

    public function filler($myXmlString){

        $myXmlString = substr($myXmlString,strpos($myXmlString,"<body"),strpos($myXmlString,"</body>"));

        return $myXmlString;

    }

}