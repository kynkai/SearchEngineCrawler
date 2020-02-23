<?php
namespace SearchEnginePartner\Google\Response;

use SearchEnginePartner\Google\Response as _Response;
use SearchEnginePartner\Google\Modal\ImageItem;
use SearchEnginePartner\Google\Modal\VideoItem;

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

        $books = $doc->find('.srg')[0]->find('.g');

        foreach ($books as $book) {

            if($book->parent()->tag == "div"){

                if($video = $this->getVideoDoc($book)){

                    array_push($videos,$video);

                }

            }

        }

        return $videos;

    }

    public function getVideoDoc($doc){

        $a = $doc->find('a');

        $cite = $doc->find('cite');

        $span = $doc->find('span');

        $h3 = $doc->find('h3');

        $img = $doc->find('img');

        if(isset($a[0]) && isset($cite[0])){
            
            $src = $img[0]->getAttribute("src");
               
            $imageItem = new ImageItem($src);
    
            return new VideoItem($a[0]->getAttribute("href"),$imageItem,$h3[0]->text());
        
        }


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