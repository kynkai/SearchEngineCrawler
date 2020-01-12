<?php
namespace SearchEnginePartner\Google;

class GoogleQuantumJsClient extends GoogleClient{

    public const REGEX = '#(?<=_ModuleManager_initialize\()(.|\n)*?(?=\))#';

    public static $URI = 'https://www.google.com/xjs/_/js/k=xjs.s.vi._QB-X9BcoJY.O/ck=xjs.s.0rfo-iBRJeg.L.F4.O/m=quantum/exm=/am=AAAAAIsAZt0AQP4PAgAAQB0DAAAC2gQbFgiGhAyiwgQCEA/d=1/dg=2/ct=zgms/rs=ACT90oFMYVFIaB9i7e4ziUuHXgvgb-t_Bg';

    public function __construct()
    {
        parent::__construct();
        
    }

    public function getModuleQuantum(){

        $content = parent::send();
    
        preg_match(self::REGEX, $content, $matches);

        return explode("/",(trim($matches[0],"',[]")));
        
    }

}