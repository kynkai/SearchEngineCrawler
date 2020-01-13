<?php
namespace SearchEnginePartner;

use Zend\Http\Client as _Client;

class Client extends _Client{

    public function __construct()
    {
        parent::__construct(null,$this::defaultOptions());

        $this->setHeaders($this::defaultHeaders());
        
    }

    public static function defaultRequest(){

        $request = new Request();

        return $request;
    }


    public static function defaultOptions(){

        return [
            'adapter' => 'Zend\Http\Client\Adapter\Curl',
            "useragent" =>"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.14; rv:72.0) Gecko/20100101 Firefox/72.0"//"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0"
        ];
        
    }

    public static function defaultHeaders(){

        return [
            ['Accept-Encoding' => 'gzip'],
        ];

    }

}