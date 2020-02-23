<?php
namespace SearchEnginePartner\Google\Response;

use SearchEnginePartner\Google\Response;
use SearchEnginePartner\Google\Modal\Algo;
use SearchEnginePartner\Google\Modal\Additional;
use SearchEnginePartner\Google\Modal\GSearchItem;

class HomePage extends Response{

    /**
     * @var Algo[]
     */
    private $algos;

        /**
     * @var GSearchItem[]
     */
    private $gSearchItems;

        /**
     * @var Additional[]
     */
    private $additionals;

    public function init()
    {
        //var_dump($this->getContent());
        
        if($doc = $this->getDoc()){

            $this->algos = $this->getListAlgos($doc);
            $this->additionals = $this->getListAdditional($doc);
            $this->gSearchItem = $this->algos;

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

    public function getListAlgos($doc){

        return $this->getListGSearchItem($doc);

    }

    public function getListAdditional($doc){

        $additional = [];

        $aside = $doc->find('aside');

        if(!$aside) return $additional;

        $ul = $aside[0]->find('ul');

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


    /**
     * Get the value of gSearchItems
     *
     * @return  GSearchItem[]
     */ 
    public function getGSearchItems()
    {
        return $this->gSearchItems;
    }
}