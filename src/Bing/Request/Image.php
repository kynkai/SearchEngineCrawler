<?php
namespace SearchEnginePartner\Bing\Request;

use SearchEnginePartner\Bing\Modal\Param\ImageParam;
use SearchEnginePartner\Bing\Request;

class Image extends Request{

    public static function getUriPathRequestImage($keyword,$first,$count = 0,$location = "vi-Vn"){

        return self::URI."images/async?q={$keyword}&first={$first}&count={$count}&mmasync=1&mkt={$location}";

    }

    public function init(){

        $imageParam = $this->getSearchParam();

        $this->setUri(self::getUriPathRequestImage($imageParam->getKeyWord(),$imageParam->getFirst(),$imageParam->getCount(),$imageParam->getLocation()));

    }

}