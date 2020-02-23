<?php
namespace SearchEnginePartner\Google;

use SearchEnginePartner\Request as SearchEnginePartnerRequest;
use Laminas\Http\Cookies;
use Laminas\Http\Header\SetCookie;

class Request extends SearchEnginePartnerRequest {

    public const URI = "https://www.google.com/";

    public const URI_IMAGE = "https://www.google.com/search?tbm=isch";

    public const URI_VIDEO = "https://www.google.com/search?tbm=vid";

    public function setLocation($location){

        $headers = $this->getHeaders();

        if($headers instanceof Cookies){

            $_EDGE_S = new SetCookie("_EDGE_S","mkt=".$location,null,'/','bing.com',false,true);

            $_EDGE_S->setEncodeValue(false);

            $headers->addCookie($_EDGE_S);

        }

    }

    public function setLanguage($language){

        $headers = $this->getHeaders();

        if($headers instanceof Cookies){

            //$headers->addCookie(new SetCookie("_EDGE_SLang",$language,null,'/','bing.com'));

        }

    }

}