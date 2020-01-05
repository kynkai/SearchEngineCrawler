<?php
namespace SearchEnginePartner\Bing;

use Zend\Http\Response;

use SearchEnginePartner\SearchItem;
use SearchEnginePartner\SearchEnginePartnerAbstract;

class BingSearch extends SearchEnginePartnerAbstract{

    public $host = "https://www.bing.com/";

    public function getQuery(){

        return $this->host."search?q={$this->query}&first={$this->first}";

    }

    public function getQueryVideo(){

        return "{$this->host}/videos/asyncv2?q={$this->query}&async=content&first={$this->first}&count={$this->count}";

    }

    public function getQueryImage(){

        return $this->host."images/async?q={$this->query}&first={$this->first}&count={$this->count}&mmasync=1";

    }

    public function getImage($option = []){

        $response = parent::getImage();
   
        $myXmlString = gzdecode($response->getContent());
          
        $doc = str_get_html($myXmlString);

        $image = $this->getListImage($doc);

        return $image;
    }

    public function getVideo($option = []){

        $response = parent::getVideo();

        $myXmlString = gzdecode($response->getContent());
          
        $doc = str_get_html($myXmlString);

        $videos = $this->getListVideo($doc);

        return $videos;
    }

    public function getSearch($option = []){

        $response = parent::getSearch();

        $myXmlString =  gzdecode($response->getContent());
        
        $doc = str_get_html($myXmlString);
    
        $algos = $this->getListAlgos($doc);

        $additional = $this->getListAdditional($doc);

        return [$algos,$additional];
  
    }


    public function getListAlgos($doc){

        $algos= [];

        $books = $doc->find('.b_algo');
    
        foreach ($books as $book) {
    
            array_push($algos,$this->getSearchItemDoc($book));
    
        }

        return $algos;

    }

    
    public function getListVideo($doc){

        $videos = [];

        $books = $doc->find('.mc_vtvc_link');

        foreach ($books as $book) {

            array_push($videos,$this->getVideoDoc($book));

        }

        return $videos;

    }

    public function getListImage($doc){

        $image = [];

        $books = $doc->find('img');

        foreach ($books as $book) {

            array_push($image,$this->getImageDoc($book));

        }

        return $image;

    }

    public function getListAdditional($doc){

        $additional = [];

        $books = $doc->find('aside')[0]->find('ul')[0]->find('li');

        foreach ($books as $book) {

            $a = $book->find('a');

            if(isset($a[0])){

                $a = $a[0];

                $content = $a->text();

                $href = $a->getAttribute("href");

                array_push($additional,new Additional($href,$content));

            };


        }

        return $additional;


    }

    public function getSearchItemDoc($doc){

        $h2 = $doc->find('h2');
    
        $cite = $doc->find('cite');

        $p = $doc->find('p');

        if(isset($h2[0]) && isset($cite[0]) && isset($p[0])){

            $li = $doc->getElementsByTagName('li');

            return new Algo($h2[0]->text(),$cite[0]->text(),$p[0]->text());

        }

    }


    public function getImageDoc($doc){

        $src = $doc->getAttribute("src");

        return new ImageItem($src,null,null);
    }

    public function getVideoDoc($doc){

        $image = $doc->find('img');

        $imageItem  = null;

        if(isset($image[0])){

            $image = $image[0];

            $imageItem = new ImageItem($image->getAttribute("src"));

        }

        $href = $doc->getAttribute("href");

        return new VideoItem($href,$imageItem,$doc->text());
    }

}

