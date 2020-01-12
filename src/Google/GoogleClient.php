<?php
namespace SearchEnginePartner\Google;

use SearchEnginePartner\Client;
use SearchEnginePartner\Request;

function isGzipped($in) {
    if (mb_strpos($in , "\x1f" . "\x8b" . "\x08")===0) {
      return true;
    } else if (@gzuncompress($in)!==false) {
      return true;
    } else if (@gzinflate($in)!==false) {
      return true;
    } else {
      return false;
    }
  }

class GoogleClient extends Client {

    public static $URI = 'https://www.google.com/';

    public function __construct()
    {
        parent::__construct(null,self::defaultOptions());
        $this->setHeaders(self::defaultHeaders());
        $this->setUri($this::$URI);
        
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

    public function send(?\Zend\Http\Request $request = null)
    {
        $response = parent::send($request);

        if ($response->isSuccess()) {

            $content = $response->getContent();

            if(isGzipped($content))

                $content = gzdecode($content);

            return $content;

        }
        
    }

}