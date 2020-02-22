<?php
namespace SearchEnginePartner\Modal;

class Additional implements \JsonSerializable{

        /**
     * @var string
     */
    private $link;

        /**
     * @var string
     */
    private $name;

    public function __construct(string $link,string $name){

        $this->link = $link;

        $this->name = $name;

    }

    public function jsonSerialize() {
        return $this->toArray();
    }

    public function toArray(){
        return [
            "link" => $this->getLink(),
            "name" =>$this->getName(),
        ];

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
}
