<?php
namespace SearchEnginePartner\Bing;

use SearchEnginePartner\Bing\Response\HomePage;
use SearchEnginePartner\Bing\Response\Image;
use SearchEnginePartner\Bing\Response\Video;
use SearchEnginePartner\Bing\Response\Suggest;
use SearchEnginePartner\Bing\Request;
use SearchEnginePartner\SearchEnginePartnerAbstract;

class BingSearch extends SearchEnginePartnerAbstract{

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

        return new Image();

    }

    public function getResponseVideo(){

        return new Video();
    }

    public function getResponseHomePage(){

        return new HomePage();

    }

    public function getResponseSuggests(){

        return new Suggest();

    }

    /**
     * 
     *
     * @throws 
     * @param 
     * @return HomePage
     */
    public function getHomePage(){ return parent::getHomePage(); }


        /**
     * 
     *
     * @throws 
     * @param 
     * @return Image
     */
    public function getImage(){ return parent::getImage(); }


        /**
     * 
     *
     * @throws 
     * @param 
     * @return Video
     */
    public function getVideo(){ return parent::getVideo(); }

            /**
     * 
     *
     * @throws 
     * @param 
     * @return Suggest
     */
    public function getSuggests(){ return parent::getSuggests(); }

}

