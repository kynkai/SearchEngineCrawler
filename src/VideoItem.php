<?php
namespace SearchEnginePartner;

class VideoItem{

    public $title;

    public $link;

    public $image;

    public function __construct($link = null,ImageItem $image = null,$title = null){

        $this->title = $title;
        $this->link = $link;
        $this->image = $image;
    }

}