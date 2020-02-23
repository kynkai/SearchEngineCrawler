<?php
namespace SearchEnginePartner\Google\Response;

use SearchEnginePartner\Google\Response as _Response;
use SearchEnginePartner\Google\Modal\ImageItem;
use SearchEnginePartner\Modal\NTL;

class Image extends _Response{

        /**
     * @var ImageItem[]
     */
    private $imageItem;

    public function init()
    {
        var_dump($this->getContent());
        
        if($doc = $this->getDoc()){

            $this->imageItem = $this->getListImage($doc);

        }
    
    }

    public function getListImage($doc){

        $images = [];

        $rg_s = $doc->find('#rg_s')[0];

        $books = $rg_s->childNodes();

        foreach ($books as $book) {

            if($book->parent()->tag == "div"){

                if($image = $this->getImageDoc($book)){

                    array_push($images,$image);

                }

            }


        }

        return $images;

    }

    public function getImageDoc($doc){

        $a = $doc->find("a");

        $img = $doc->find("img");

        $span = $doc->find("span");


        if(
            isset($a[1])
        ){

            $src = $img[0]->getAttribute("src");

            return new ImageItem($src,$a[0]->getAttribute("href"),$a[1]->text(),$span[0]->text());
    
        }

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