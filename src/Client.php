<?php
namespace SearchEnginePartner;

use Laminas\Http\Client as HttpClient;
use Laminas\Session\Config\StandardConfig;
use Laminas\Session\SessionManager;
use Laminas\Http\Cookies;
use Laminas\Http\Request;

class Client extends HttpClient implements DiaryRecordInterface{

    use DiaryRecordTrait;

        /**
     * @var SessionManager
     */
    private $sessionManager;

    public function __construct(SessionManager $sessionManager = null)
    {
        parent::__construct(null,$this::defaultOptions());

        $this->setHeaders($this::defaultHeaders());

        $this->sessionManager = $sessionManager?: $this->defaultSessionManager();
        
        $this->getSessionManager()->start();

    }

    public function defaultSessionManager(){

        $config = new StandardConfig();
        $config->setOptions([
            'remember_me_seconds' => 1800,
            'name'                => 'laminas',
        ]);
        $manager = new SessionManager($config);
        return $manager;
    }

    public function mergeCookiesFromRequest(Request $request){

        $headers = $request->getHeaders();

        if($headers instanceof Cookies){

            $cookies = $headers->getMatchingCookies($request->getUri());

            foreach ($cookies as $key => $value) {
                $this->addCookie($value);
            }

        }

        return $request;

    }

    /**
     * Send HTTP request
     *
     * @param  Request|null $request
     * @return Response
     * @throws Laminas\Http\Exception\RuntimeException
     * @throws Laminas\Http\Client\Exception\RuntimeException
     */
    function send(?\Laminas\Http\Request $request = null)
    {
        $this->addRecord($request->toString());

        $this->mergeCookiesFromRequest($request);

        $storage = $this->getSessionManager()->getStorage();

        if(($cookieJar = $storage['cookiejar']) && $storage['cookiejar'] instanceof Cookies){

            $cookie = $cookieJar->getMatchingCookies($request->getUri());
        }

        try {

            $response = parent::send($request);

            $cookieJar = Cookies::fromResponse($response,$this->getUri());

            $storage['cookiejar'] = $cookieJar;

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


    /**
     * Get the value of sessionManager
     *
     * @return  SessionManager
     */ 
    public function getSessionManager()
    {
        return $this->sessionManager;
    }
}