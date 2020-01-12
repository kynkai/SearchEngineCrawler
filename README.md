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

use SearchEnginePartner\Bing\BingSearch;
use SearchEnginePartner\Yahoo\YahooSearch;
use SearchEnginePartner\Google\GoogleSearch;


$result = [];

$search = new BingSearch();

//$search = new YahooSearch();

$search = new GoogleSearch();

$search->query = "kynkai";
$search->count = 20;
$search->location = "en_ES";

for ($i=0; $i < 5 ; $i++) { 

    $default = $search->getSearch();

    $image = $search->getImage();

    $video = $search->getVideo();

    array_push($result,$image,$default,$video);

    $search->first = $i*10;

}

print_r($result);
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
