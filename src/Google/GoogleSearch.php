<?php
namespace SearchEnginePartner\Google;

use SearchEnginePartner\SearchEnginePartnerAbstract;
use SearchEnginePartner\SuggestModal;

class GoogleSearch extends SearchEnginePartnerAbstract{

    public $host = "https://www.google.com";

    public $hostImage = "https://www.google.com/search?tbm=isch";

    public $hostVideo = "https://www.google.com/search?tbm=vid";

    public function getQuery(){

        return $this->host."/search?q={$this->query}&start={$this->first}";

    }

    public function getQueryVideo(){

        return "{$this->hostVideo}&q={$this->query}&start={$this->first}";

    }

    public function getQueryImage(){

        return "{$this->hostImage}&q={$this->query}&start={$this->first}";

    }

    public function getQuerySuggests(){

        return "{$this->host}/complete/search?q={$this->query}&cp=3&client=mobile-gws-wiz-hp&xssi=t&hl=vi";


    }

    public function getSearch($option = []){

        $response = parent::getSearch();

        $myXmlString =  gzdecode($response->getContent());
        
        $doc = str_get_html($myXmlString);

        $algos = $this->getListGSearchItem($doc);

       // $additional = $this->getListAdditional($doc);

        return $algos;
  
    }

    public function getVideo($option = []){

        $response = parent::getVideo();

        $myXmlString = gzdecode($response->getContent());
          
        $doc = str_get_html($myXmlString);

        $videos = $this->getListVideo($doc);

        return $videos;
    }

    public function filler($myXmlString){

        $myXmlString = substr($myXmlString,strpos($myXmlString,"<body"),strpos($myXmlString,"</body>"));

        return $myXmlString;

    }


    public function getImage($option = []){

        $response = parent::getImage();
   
        $myXmlString = gzdecode($response->getContent());

        $myXmlString = $this->filler($myXmlString);

        $doc = str_get_html($myXmlString);

        $image = $this->getListImage($doc);

        return $image;
    }

    public function getSuggests($option = []){

        $response = parent::getSuggests();
   
        $myXmlString = gzdecode($response->getContent());

        $suggests = $this->getListSuggests($myXmlString);

        return $suggests;
    }

    public function getListSuggests($json){

        $json = str_replace(")]}'","",$json);

        $json = json_decode($json,true);

        $ar = [];

        foreach($json[0] as $key => $value) {
            
            array_push($ar,new SuggestModal($value));

        };

        return $ar;

    }

    public function getListImage($doc){

        $images = [];

        $rg_s = $doc->find('#rg_s')[0];


        $books = $rg_s->childNodes();//find("rg_bx");

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

    public function getListGSearchItem($doc){

        $algos= [];

        $books = $doc->find('.srg')[0]->find('.g');

        foreach ($books as $book) {

            if($book->parent()->tag == "div"){

                if($book = $this->getGSearchItem($book)){

                    array_push($algos,$book);
    
                }

            }
            
        }

        return $algos;

    }

    public function getGSearchItem($doc){

        $a = $doc->find('a');

        $cite = $doc->find('cite');

        $span = $doc->find('span');

        if(isset($a[0]) && isset($cite[0]) && isset($span[2])){

            $algo = new GSearchItem($a[0]->text(),$a[0]->getAttribute("href"),$span[2]->text());

            return $algo;

        }
    }

}