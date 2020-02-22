<?php
namespace SearchEnginePartner\Bing\Request;

use SearchEnginePartner\Bing\Request;

class Suggest extends Request{

    public static function getUriPathRequestSuggest($keyword,$location = "vi-vn",$count = 0){

        return self::URI."/AS/Suggestions?pt=page.home&mkt={$location}&qry={$keyword}&cvid=1";

    }

    public function init(){

        $param = $this->getSearchParam();

        $this->setUri(self::getUriPathRequestSuggest($param->getKeyWord(),$param->getLocation(),$param->getCount()));

    }

}