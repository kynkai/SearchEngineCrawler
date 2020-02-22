<?php
namespace SearchEnginePartner\Google;

use SearchEnginePartner\Client;

use Laminas\Http\Request;

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
        parent::__construct();

        $this->setUri($this::$URI);
        
    }

    public static function defaultRequest(){

        $request = new Request();

        return $request;
    }

    public function send(Request $request = null)
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