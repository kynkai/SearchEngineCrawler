<?php
namespace SearchEnginePartner\Google\Request;

use SearchEnginePartner\Google\Request;

class Image extends Request{

    public static function getUriPathRequestImage($keyword,$first,$count = 0,$location = "vi-Vn"){

        return self::URI_IMAGE."&q={$keyword}&start={$first}";

    }

    public function init(){

        $imageParam = $this->getSearchParam();

        $this->setUri(self::getUriPathRequestImage($imageParam->getKeyWord(),$imageParam->getFirst(),$imageParam->getCount(),$imageParam->getLocation()));

    }

}