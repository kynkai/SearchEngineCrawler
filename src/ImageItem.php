<?php
namespace SearchEnginePartner;

class ImageItem{

    public $title;

    public $link;

    public $src;

    public function __construct($src,$link = null,$title = null){

        $this->title = $title;
        $this->link = $link;
        $this->src = $src;
    }

}