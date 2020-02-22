<?php
namespace SearchEnginePartner\Bing\Request;

use SearchEnginePartner\Bing\Modal\Param\HomePageParam;
use SearchEnginePartner\Bing\Request;
use Zend\Http\Cookies;
use Zend\Http\Header\SetCookie;

class HomePage extends Request{

    public static function getUriPathRequestHomePage($keyword,$first,$location = "vi-vn"){

        return self::URI."search?q={$keyword}&first={$first}&mkt={$location}";

    }

    public function init(){

        $param = $this->getSearchParam();

        $this->setUri(self::getUriPathRequestHomePage($param->getKeyWord(),$param->getFirst(),$param->getLocation()));

        $this->setLocation($param->getLocation());

        $this->setLanguage($param->getLanguage());

    }

}