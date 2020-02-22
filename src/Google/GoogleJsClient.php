<?php
namespace SearchEnginePartner\Google;
use Laminas\Http\Request;

class GoogleJsClient extends GoogleClient{

    public $name;

    public $require;

    public const REGEX1 = '#(try)(.|\n)*?(\}catch\(e\)\{_DumpException\(e\)\})#';

    public static $URI = "https://www.google.com/xjs/_/js/k=xjs.s.vi._QB-X9BcoJY.O/ck=xjs.s.0rfo-iBRJeg.L.F4.O/am=AAAAAIsAZt0AQP4PAgAAQB0DAAAC2gQbFgiGhAyiwgQCEA/d=1/dg=2/ct=zgms/rs=ACT90oFMYVFIaB9i7e4ziUuHXgvgb-t_Bg/exm=quantum/";

    public function __construct($name)
    {
        parent::__construct();

        $this->name = $name;
        
    }

    public function getModuleUri($name){

        return $this::$URI."m={$name}";

    }

    public function send(Request $request = null){

        $uri = $this->getModuleUri($this->name);

        $this->setUri($uri);

        $content = parent::send($request);

        //echo $content;

        preg_match_all(self::REGEX1, $content, $matches);

        return ($matches[0]);

    }

}