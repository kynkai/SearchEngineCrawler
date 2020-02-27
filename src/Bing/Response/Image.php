<?php
namespace SearchEnginePartner\Bing\Response;

use SearchEnginePartner\Bing\Response as _Response;
use SearchEnginePartner\Bing\Modal\ImageItem;
use SearchEnginePartner\Modal\NTL;

class Image extends _Response{

        /**
     * @var ImageItem[]
     */
    private $imageItem;

    public function init()
    {
        
        if($doc = $this->getDoc()){

            $this->imageItem = $this->getListImage($doc);

        }
    
    }

    public function getListImage($doc){

        $image = [];

        $list = $doc->find('.imgpt');

        foreach ($list as $itemDoc) {

            array_push($image,$this->getImageDoc($itemDoc));

        }

        return $image;

    }

    public function getImageDoc($doc){

        //var_dump($doc->outerText());

        $as = $doc->find("a");

        $span = $doc->find("span")[0];

        if(isset($as[1])){ 
            $host = $this->getNtlDoc($as[1]);
        }

        $img = $doc->find("img")[0];

        $src = $img->getAttribute("src");

        return new ImageItem($src,$as[0]->getAttribute("href"),$span->text(),null,$host);

    }

    private function getNtlDoc($doc){

        return new NTL($doc->text(),$doc->getAttribute("title"),$doc->getAttribute("href"));

    }


    /**
     * Get the value of imageItem
     *
     * @return  ImageItem[]
     */ 
    public function getImageItem()
    {
        return $this->imageItem;
    }
}