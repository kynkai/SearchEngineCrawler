[![Total Downloads](https://img.shields.io/packagist/dt/kynkai/search-engine-crawler.svg)](https://packagist.org/packages/kynkai/search-engine-crawler)
[![Latest Stable Version](https://img.shields.io/packagist/v/kynkai/search-engine-crawler.svg)](https://packagist.org/packages/kynkai/search-engine-crawler)


SearchEngineCrawler Dump the data from the search engines

-Google
-Yahoo
-Bing
-Yandex

## Installation

Install the latest version with

```bash
$ composer require kynkai/search-engine-crawler
```

## Basic Usage

```php
<?php

use SearchEnginePartner\Modal\Param\SearchParam;
use SearchEnginePartner\Bing\BingSearch;

$rs = [];

$video = $image = $search = $suggests = $algos = $additionals = [];

$param = new SearchParam();

$param->setKeyWord("fa");
$param->setCount(33);
//
$param->setLocation("en-in");
//$param->setLocation("nl-nl");
//$param->setLocation("vi-vn");

$bingSearch = new BingSearch(); $bingSearch->setSearchParam($param);

$imageResponse = $bingSearch->getImage();

$image = $imageResponse->getImageItem();

//var_dump($image);return;

$suggestsResponse = $bingSearch->getSuggests();

$suggests = $suggestsResponse->getSuggestModals();

$homeResponse = $bingSearch->getHomePage();

$search = $homeResponse->getAlgos();

$additionals = $homeResponse->getAdditionals();

$videoResponse = $bingSearch->getVideo();

$video = $videoResponse->getVideoItem();

array_push($rs,$search,$image,$video,$suggests,$additionals);

header('Content-Type: application/json');

echo json_encode($rs,JSON_PRETTY_PRINT);

```

## Documentation

- [Usage Instructions](readme.md)

## About

### Requirements

### Submitting bugs and feature requests

### Framework Integrations

### Author

QuachVanHao - <quachvanhao@cmnd.vn> 

### License

SearchEngineCrawler is licensed under the MIT License - see the `LICENSE` file for details

### Acknowledgements
