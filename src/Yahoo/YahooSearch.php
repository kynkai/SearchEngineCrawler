<?php
namespace SearchEnginePartner\Yahoo;

use Zend\Http\Response;

use SearchEnginePartner\SearchItem;
use SearchEnginePartner\SearchEnginePartnerAbstract;

class YahooSearch extends SearchEnginePartnerAbstract{

    public $host = "https://search.yahoo.com/search";

    public $hostImage = "https://images.search.yahoo.com/search";

    public $hostVideo = "https://video.search.yahoo.com/search";

    public function getQuery(){

        return $this->host."?p={$this->query}&b={$this->first}&pz=0";

    }

    public function getQueryVideo(){

        return "{$this->hostVideo}/video?p={$this->query}&b={$this->first}";

    }

    public function getQueryImage(){

        return $this->hostImage."/images?p={$this->query}&b={$this->first}";

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

    
    public function getListVideo($doc){

        $videos = [];

        $books = $doc->find('li');

        foreach ($books as $book) {

            if($book->parent()->tag == "ol"){

                if($video = $this->getVideoDoc($book)){

                    array_push($videos,$video);

                }

            }

        }

        return $videos;

    }

    public function getImageDoc($doc){

        $a = $doc->find("a")[0];

        $image = $doc->find("img")[0];
      
        $src = $image->getAttribute("data-src");

        return new ImageItem($src,$a->getAttribute("href"),$a->getAttribute("aria-label"));

    }

    public function getVideoDoc($doc){

        //var_dump($doc->outertext());

        $a = $doc->find("a")[0];

        $videoUrl = $a->getAttribute("data-rurl");

        $image = $doc->find("img")[0];
        
        $src = $image->getAttribute("src");

       // $vmeta = $doc->find(".v-meta");

        $h3 = $doc->find("h3")[0];
           
        $imageItem = new ImageItem($src);

        return new VideoItem($videoUrl,$imageItem,$h3->text());

    }

    public function getListImage($doc){

        $images = [];

        $books = $doc->find('#sres')[0]->find("li");

        foreach ($books as $book) {

            if($book->parent()->tag == "ul"){

                if($image = $this->getImageDoc($book)){

                    array_push($images,$image);

                }

            }


        }

        return $images;

    }

    public function getListAdditional($doc){

        $additional = [];

        $books = $doc->find('table')[0]->find('a');

        foreach ($books as $book) {

            if($book){

                $content = $book->text();

                $href = $book->getAttribute("href");

                array_push($additional,new Additional($href,$content));

            };

        }

        return $additional;


    }

    public function getAlgos($doc){

        $a = $doc->find('a');
    
        $p = $doc->find('p');

        if(isset($a[0]) && isset($p[0])){

            $child = [];

            $comlist = $doc->find(".compList");

            if($comlist) {

                $list = $comlist[0]->find('li');
                
                foreach ($list as $key => $value) {

                    array_push($child,$this->getAlgos($value));
                   
                }

            }

            $algo = new Algo($a[0]->text(),$a[0]->getAttribute("href"),$p[0]->text());

            $algo->child = $child;

            return $algo;

        }
    }

    public function getListAlgos($doc){

        $algos= [];

        $books = $doc->find('ol')[2]->find('li');

        foreach ($books as $book) {

            if($book->parent()->tag == "ol"){

                if($book = $this->getAlgos($book)){

                    array_push($algos,$book);
    
                }

            }
            
        }

        return $algos;

    }

}
