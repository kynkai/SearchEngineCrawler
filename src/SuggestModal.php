<?php
namespace SearchEnginePartner;

class SuggestModal{

        /**
     * @var string
     */
    private $title;

    public function __construct(string $title = null){

        $this->title = $title;

    }

    /**
     * Get the value of title
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }
}