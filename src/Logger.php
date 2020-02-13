<?php
namespace SearchEnginePartner;

use Monolog\Logger as MonologLogger;
use Traversable;

class Logger extends MonologLogger{

    public function logs($level,array $messages,array $context = []){

        foreach ($messages as $message) {

            $this->log($level,$message,$context);
            
        }

    }

}