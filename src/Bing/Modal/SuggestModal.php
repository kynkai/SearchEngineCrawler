<?php
namespace SearchEnginePartner\Bing\Modal;

use SearchEnginePartner\Modal\SuggestModal as ModalSuggestModal;

class SuggestModal extends ModalSuggestModal implements \JsonSerializable {

        /**
     * @var bool
     */
    private $history;

    public function __construct(string $title,string $link,bool $history = false){

        parent::__construct("",$title,$link);

        $this->history = $history;

    }

    public function jsonSerialize() {
        return $this->toArray();
    }

    public function toArray(){

        return [
            "title" => $this->getTitle(),
            "link" => $this->getLink(),
            "history" =>$this->getHistory(),
        ];

    }

    /**
     * Get the value of history
     *
     * @return  bool
     */ 
    public function getHistory()
    {
        return $this->history;
    }
}