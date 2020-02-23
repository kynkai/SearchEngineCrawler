<?php
namespace SearchEnginePartner\Google\Request;

use SearchEnginePartner\Google\Request;

class Suggest extends Request{

    public static function getUriPathRequestSuggest($keyword,$location = "vi-vn",$count = 0){

        return self::URI."/complete/search?q={$keyword}&cp=3&client=mobile-gws-wiz-hp&xssi=t&hl=vi";

    }

    public function init(){

        $param = $this->getSearchParam();

        $this->setUri(self::getUriPathRequestSuggest($param->getKeyWord(),$param->getLocation(),$param->getCount()));

    }

}