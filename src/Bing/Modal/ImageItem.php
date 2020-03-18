<?php
namespace SearchEnginePartner\Bing\Modal;

use SearchEnginePartner\Modal\ImageItem as ModalImageItem;

class ImageItem extends ModalImageItem{

    /**
     * @var object
     */
    private $data;

    public function toArray(){

        return array_merge(parent::toArray(),[
            "data" => $this->getData(),
        ]);

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
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}
