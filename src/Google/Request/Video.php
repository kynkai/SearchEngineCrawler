<?php
namespace SearchEnginePartner\Google\Request;

use SearchEnginePartner\Google\Request;

class Video extends Request{

    public static function getUriPathRequestVideo($keyword,$first,$count = 0,$location = "vi-vn"){

        return self::URI_VIDEO."&q={$keyword}&start={$first}";

    }

    public function init(){

        $videoParam = $this->getSearchParam();

        $this->setUri(self::getUriPathRequestVideo($videoParam->getKeyWord(),$videoParam->getFirst(),$videoParam->getCount()));

    }

}