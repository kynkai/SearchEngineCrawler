<?php
namespace SearchEnginePartner;

class SearchItem{

    public $additional;

    public $title;

    public $link;

    public $content;

    public function __construct($title,$link,$content,$additional = null){

        $this->title = $title;
        $this->link = $link;
        $this->content = $content;
        $this->additional = $additional;
    }

    public function setAdditional($additional){

        $this->additional = $additional;

    }

}