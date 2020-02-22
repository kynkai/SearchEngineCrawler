<?php
namespace SearchEnginePartner\Modal;

use JsonSerializable;

class VideoItem implements JsonSerializable{

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $link;

    /**
     * @var ImageItem
     */
    private $image;

    /**
     * @var string
     */
    private $data;

    public function __construct(string $link = null,ImageItem $image = null,string $title = null,string $data = null){

        $this->title = $title;
        $this->link = $link;
        $this->image = $image;
        $this->data = $data;
        
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
     * Get the value of image
     *
     * @return  ImageItem
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @param  ImageItem  $image
     *
     * @return  self
     */ 
    public function setImage(ImageItem $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of data
     *
     * @return  string
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @param  string  $data
     *
     * @return  self
     */ 
    public function setData(string $data)
    {
        $this->data = $data;

        return $this;
    }

    public function jsonSerialize() {
        return $this->toArray();
    }

    public function toArray(){

        return [
            "title" => $this->getTitle(),
            "link" => $this->getLink(),
            "image" =>$this->getImage()->toArray(),
            "data" =>$this->getData(),
        ];

    }
}