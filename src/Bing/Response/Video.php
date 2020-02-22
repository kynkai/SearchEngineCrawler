<?php
namespace SearchEnginePartner\Bing\Response;

use SearchEnginePartner\Bing\Response as _Response;
use SearchEnginePartner\Bing\Modal\ImageItem;
use SearchEnginePartner\Bing\Modal\VideoItem;

class Video extends _Response{

    /**
     * @var VideoItem[]
     */
    private $videoItem;

    public function init()
    {
        
        if($doc = $this->getDoc()){

            $this->videoItem = $this->getListVideo($doc);

        }
    
    }

    public function getListVideo($doc){

        $videos = [];

        $books = $doc->find('.mc_vtvc_link');

        foreach ($books as $book) {

            array_push($videos,$this->getVideoDoc($book));

        }

        return $videos;

    }

    public function getVideoDoc($doc){

        $image = $doc->find('img');

        $vrdata = $doc->find('.vrhdata')[0];

       // var_dump($vrdata->outerText());

        $imageItem  = null;

        if(isset($image[0])){

            $image = $image[0];

            $imageItem = new ImageItem($image->getAttribute("src"));

        }

        $href = $doc->getAttribute("href");

        $vrdata = $vrdata->getAttribute('vrhm');

        return new VideoItem($href,$imageItem,$doc->text(),$vrdata);
    }

    /**
     * Get the value of videoItem
     *
     * @return  VideoItem[]
     */ 
    public function getVideoItem()
    {
        return $this->videoItem;
    }
}