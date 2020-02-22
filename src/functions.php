<?php
namespace SearchEnginePartner;

use Laminas\Http\Response as HttpResponse;

function responseCover(HttpResponse $response,Response $responseLast){

    $responseLast->ResponseTo($response);

    return $responseLast;

}