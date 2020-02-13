<?php
namespace SearchEnginePartner;

class ImageItem implements \JsonSerializable{

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
    private $src;

    /**
     * @var string
     */
    private $cite;

    public function __construct(string $src,string $link = null,string $title = null,string $cite = null){

        $this->title = $title;
        $this->link = $link;
        $this->src = $src;
        $this->cite = $cite;

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
     * Get the value of src
     *
     * @return  string
     */ 
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Set the value of src
     *
     * @param  string  $src
     *
     * @return  self
     */ 
    public function setSrc(string $src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Get the value of cite
     *
     * @return  string
     */ 
    public function getCite()
    {
        return $this->cite;
    }

    /**
     * Set the value of cite
     *
     * @param  string  $cite
     *
     * @return  self
     */ 
    public function setCite(string $cite)
    {
        $this->cite = $cite;

        return $this;
    }

    public function jsonSerialize() {
        return $this->toArray();
    }

    public function toArray(){

        return [
            "title" => $this->getTitle(),
            "link" => $this->getLink(),
            "src" =>$this->getSrc(),
            "cite" =>$this->getCite(),
        ];

    }
}