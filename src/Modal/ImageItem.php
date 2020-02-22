<?php
namespace SearchEnginePartner\Modal;

class ImageItem extends NTL implements \JsonSerializable{

    /**
     * @var string
     */
    private $src;

    /**
     * @var NTL
     */
    private $host;

    /**
     * @var string
     */
    private $cite;

    public function __construct(string $src,string $link = null,string $title = null,string $cite = null,NTL $host = null){

        parent::__construct("",$title,$link);

        $this->src = $src;
        $this->cite = $cite;
        $this->host = $host;

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
            "host" =>$this->getHost(),
        ];

    }

    /**
     * Get the value of host
     *
     * @return  NTL
     */ 
    public function getHost()
    {
        return $this->host;
    }
}