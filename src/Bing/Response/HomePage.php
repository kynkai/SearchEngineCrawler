<?php
namespace SearchEnginePartner\Bing\Response;

use SearchEnginePartner\Bing\Response as _Response;
use SearchEnginePartner\Bing\Modal\Algo;
use SearchEnginePartner\Bing\Modal\Additional;

class HomePage extends _Response{

    /**
     * @var Algo[]
     */
    private $algos;

        /**
     * @var Additional[]
     */
    private $additionals;

    public function init()
    {
        
        if($doc = $this->getDoc()){

            $this->algos = $this->getListAlgos($doc);
            $this->additionals = $this->getListAdditional($doc);

        }
        
    }

    public function getListAlgos($doc){

        $algos= [];

        $books = $doc->find('.b_algo');
    
        foreach ($books as $book) {
    
            array_push($algos,$this->getSearchItemDoc($book));
    
        }

        return $algos;

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


    /**
     * Get the value of algos
     *
     * @return  Algo[]
     */ 
    public function getAlgos()
    {
        return $this->algos;
    }

    /**
     * Get the value of additionals
     *
     * @return  Additional[]
     */ 
    public function getAdditionals()
    {
        return $this->additionals;
    }
}