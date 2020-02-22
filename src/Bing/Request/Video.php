<?php
namespace SearchEnginePartner\Bing\Request;

use SearchEnginePartner\Bing\Modal\Param\VideoParam;
use SearchEnginePartner\Bing\Request;

class Video extends Request{

    public static function getUriPathRequestVideo($keyword,$first,$count = 0,$location = "vi-vn"){

        return self::URI."/videos/asyncv2?q={$keyword}&async=content&first={$first}&count={$count}&mkt={$location}";

    }

    public function init(){

        $videoParam = $this->getSearchParam();

        $this->setUri(self::getUriPathRequestVideo($videoParam->getKeyWord(),$videoParam->getFirst(),$videoParam->getCount()));

    }

}