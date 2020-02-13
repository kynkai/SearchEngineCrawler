<?php
namespace SearchEnginePartner;

trait DiaryRecordTrait{

    /**
     * @var string[]
     */
    private $records = [];

    protected function addRecord(string $record){

        return array_push($this->records,$record);

    }

    /**
     * Get the value of records
     *
     * @return  string[]
     */ 
    public function getRecords()
    {
        return $this->records;
    }
}