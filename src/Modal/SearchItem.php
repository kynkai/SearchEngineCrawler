<?php
namespace SearchEnginePartner\Modal;

use JsonSerializable;

class SearchItem implements JsonSerializable{

    private $additional;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     */
    private $content;

    public function __construct(string $title,string $link,string $content,$additional = null){

        $this->title = $title;
        $this->link = $link;
        $this->content = $content;
        $this->additional = $additional;
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

    /**
     * Get the value of link
     *
     * @return  string
     */ 
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set the value of link
     *
     * @param  string  $link
     *
     * @return  self
     */ 
    public function setLink(string $link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get the value of content
     *
     * @return  string
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param  string  $content
     *
     * @return  self
     */ 
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    public function jsonSerialize() {
        return $this->toArray();
    }

    public function toArray(){
        return [
            "link" => $this->getLink(),
            "title" =>$this->getTitle(),
            "content" =>$this->getContent(),
        ];

    }
}