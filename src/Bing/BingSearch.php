<?php
namespace SearchEnginePartner\Bing;

use SearchEnginePartner\SearchItem;
use SearchEnginePartner\SearchEnginePartnerAbstract;
use Zend\Http\PhpEnvironment\Request;
use Zend\Uri\Uri;

class BingSearch extends SearchEnginePartnerAbstract{

    protected $host = "https://www.bing.com/";

    public static function getUriPathRequestHomePage($host,$keyword,$first){

        return $host."search?q={$keyword}&first={$first}";

    }

    public static function getUriPathRequestVideo($host,$keyword,$first,$count = 0){

        return "{$host}/videos/asyncv2?q={$keyword}&async=content&first={$first}&count={$count}";

    }

    public static function getUriPathRequestImage($host,$keyword,$first,$count = 0){

        return $host."images/async?q={$keyword}&first={$first}&count={$count}&mmasync=1";

    }

    public function getRequestHomePage(){
        
        return ($this->getDefaultRequest())->setUri(self::getUriPathRequestHomePage($this->getHost(),$this->getKeyWord(),$this->getFirst()));

    }

    public function getRequestVideo(){

        return ($this->getDefaultRequest())->setUri(self::getUriPathRequestVideo($this->getHost(),$this->getKeyWord(),$this->getFirst(),$this->getCount()));

    }

    public function getRequestImage(){

        return ($this->getDefaultRequest())->setUri(self::getUriPathRequestImage($this->getHost(),$this->getKeyWord(),$this->getFirst(),$this->getCount()));

    }

    public function getRequestSuggests(){

        return ($this->getDefaultRequest())->setUri(self::getUriPathRequestImage($this->getHost(),$this->getKeyWord(),$this->getFirst(),$this->getCount()));

    }

    public function getImageResultObject(){

        $response = parent::getResponseImage();
   
        $myXmlString = gzdecode($response->getContent());
          
        $doc = str_get_html($myXmlString);

        $image = $this->getListImage($doc);

        return $image;
    }

    public function getVideoResultObject(){

        $response = parent::getResponseVideo();

        $myXmlString = gzdecode($response->getContent());
          
        $doc = str_get_html($myXmlString);

        $videos = $this->getListVideo($doc);

        return $videos;
    }

    public function getHomePageResultObject(){

        $response = parent::getResponseHomePage();

        $myXmlString = gzdecode($response->getContent());
        
        $doc = str_get_html($myXmlString);
    
        $algos = $this->getListAlgos($doc);

        $additional = $this->getListAdditional($doc);
        
        return [$algos,$additional];
  
    }

    public function getSuggestsResultObject(){}

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

        $ul = $doc->find('aside')[0]->find('ul');

        if(!isset($ul[0])) return $additional;

        $books = $ul[0]->find('li');
        
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

}

