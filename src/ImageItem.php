<?php
namespace SearchEnginePartner;

class ImageItem{

    public $title;

    public $link;

    public $src;

    public $cite;

    public function __construct($src,$link = null,$title = null,$cite = null){

        $this->title = $title;
        $this->link = $link;
        $this->src = $src;
        $this->cite = $cite;
    }

}