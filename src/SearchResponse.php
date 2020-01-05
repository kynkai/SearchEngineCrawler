<?php
namespace SearchEnginePartner;

class SearchResponse{

    public $searchItems;

    public $images;

    public $videos;

    public function __construct($searchItems,$images = null ,$videos = null){

        $this->searchItems = $searchItems;
        $this->images = $images;
        $this->videos = $videos;
    }

}