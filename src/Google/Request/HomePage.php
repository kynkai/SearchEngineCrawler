<?php
namespace SearchEnginePartner\Google\Request;

use SearchEnginePartner\Google\Modal\Param\HomePageParam;
use SearchEnginePartner\Google\Request;
use Zend\Http\Cookies;
use Zend\Http\Header\SetCookie;

class HomePage extends Request{

    public static function getUriPathRequestHomePage($keyword,$first,$location = "vi-vn"){

        return self::URI."/search?q={$keyword}&start={$first}";

    }

    public function init(){

        $param = $this->getSearchParam();

        $this->setUri(self::getUriPathRequestHomePage($param->getKeyWord(),$param->getFirst(),$param->getLocation()));

        $this->setLocation($param->getLocation());

        $this->setLanguage($param->getLanguage());

    }

}