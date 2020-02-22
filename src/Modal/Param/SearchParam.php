<?php
namespace SearchEnginePartner\Modal\Param;

class SearchParam{

    /**
     * @var string
     */
    private $keyWord;

    /**
     * @var int
     */
    private $first = 0;

    /**
     * @var int
     */
    private $count = 0;

    /**
     * @var string
     */
    private $location;

        /**
     * @var string
     */
    private $language;

        /**
     * Get the value of first
     *
     * @return  int
     */ 
    public function getFirst()
    {
        return $this->first;
    }

    /**
     * Set the value of first
     *
     * @param  int  $first
     *
     * @return  self
     */ 
    public function setFirst(int $first)
    {
        $this->first = $first;

        return $this;
    }

    /**
     * Get the value of count
     *
     * @return  int
     */ 
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set the value of count
     *
     * @param  int  $count
     *
     * @return  self
     */ 
    public function setCount(int $count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get the value of location
     *
     * @return  string
     */ 
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @param  string  $location
     *
     * @return  self
     */ 
    public function setLocation(string $location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get the value of keyWord
     *
     * @return  string
     */ 
    public function getKeyWord()
    {
        return $this->keyWord;
    }

    /**
     * Set the value of keyWord
     *
     * @param  string  $keyWord
     *
     * @return  self
     */ 
    public function setKeyWord(string $keyWord)
    {
        $this->keyWord = $keyWord;

        return $this;
    }

    /**
     * Get the value of language
     *
     * @return  string
     */ 
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set the value of language
     *
     * @param  string  $language
     *
     * @return  self
     */ 
    public function setLanguage(string $language)
    {
        $this->language = $language;

        return $this;
    }
}