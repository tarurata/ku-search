<?php
//namespace Acme\Demo;
require_once "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Operations\Search;
use ApaiIO\ApaiIO;

$conf = new GenericConfiguration();
$client = new \GuzzleHttp\Client();
$request = new \ApaiIO\Request\GuzzleRequest($client);

$accessKey = getenv('ACCESSKEY');
$secretKey = getenv('SECRETKEY');
$associateTag = getenv('ASSOCIATETAG');

echo $accessKey;

$conf
    ->setCountry('co.jp')
    ->setAccessKey($accessKey)
    ->setSecretKey($secretKey)
    ->setAssociateTag($associateTag)
    ->setRequest($request);
$apaiIO = new ApaiIO($conf);

$search = new Search();
//$search->setCategory('DVD');
//$search->setActor('Bruce Willis');
$search->setKeywords('abcd');


$formattedResponse = $apaiIO->runOperation($search);

var_dump($formattedResponse);
