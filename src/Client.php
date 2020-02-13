<?php
namespace SearchEnginePartner;

use Zend\Http\Client as _Client;
use Zend\Http\PhpEnvironment\Request;
use Zend\Http\PhpEnvironment\Response;


class Client extends _Client implements DiaryRecordInterface{

    use DiaryRecordTrait;

    public function __construct()
    {
        parent::__construct(null,$this::defaultOptions());

        $this->setHeaders($this::defaultHeaders());
        
    }

    /**
     * Send HTTP request
     *
     * @param  Request|null $request
     * @return Response
     * @throws Zend\Http\Exception\RuntimeException
     * @throws Zend\Http\Client\Exception\RuntimeException
     */
    function send(?\Zend\Http\Request $request = null)
    {
        $this->addRecord($request->toString());

        try {

            $response = parent::send($request);

            return $response;

        } catch (\Exception $ex) {
            
            $this->addRecord($ex->getMessage());
            
        }
        
    }

    public static function defaultRequest(){

        $request = new Request();

        return $request;
    }


    public static function defaultOptions(){

        return [
            'adapter' => 'Zend\Http\Client\Adapter\Curl',
            'host' => 'www.bing.com',
            "useragent" =>"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.14; rv:72.0) Gecko/20100101 Firefox/72.0"//"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0"
        ];
        
    }

    public static function defaultHeaders(){

        return [
            ['Accept-Encoding' => 'gzip'],
        ];

    }

}