<?php
namespace SearchEnginePartner\Modal;

class NTL implements \JsonSerializable{

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     */
    private $title;

    public function __construct(string $name,string $title = null,string $link = null)
    {

        $this->name = $name;
        $this->title = $title;
        $this->link = $link;
        
    }

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

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

    public function jsonSerialize() {
        return $this->toArray();
    }

    public function toArray(){

        return [
            "title" => $this->getTitle(),
            "link" => $this->getLink(),
            "name" =>$this->getName(),
        ];

    }
}