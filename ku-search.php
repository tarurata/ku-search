<?php

require_once "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$host = 'ecs.amazonaws.jp';
$path = '/onca/xml';

$accessKey = getenv('ACCESSKEY');
$secretKey = getenv('SECRETKEY');
$associateTag = getenv('ASSOCIATETAG');

$params = array(
    'AWSAccessKeyId' => $accessKey,
    'AssociateTag' => $associateTag,
    'Service' => 'AWSECommerceService',
    'Operation' => 'ItemLookup',
    //'ItemId' => 'B00008OE6I',
    'ResponseGroup' => 'Small,Images',
    'Timestamp' => gmdate('Y-m-d\TH:i:s\Z')
);

ksort($params);

$parameter = '';
foreach ($params as $key => $value){
    $parameter .= $key . '=' . rawurlencode($value) . '&';
}

$parameter = rtrim($parameter, '&');

$signature = "GET\n" . $host . "\n" . $path . "\n" . $parameter;
$signature = hash_hmac('sha256', $signature, $secretKey, true);
$signature = rawurlencode(base64_encode($signature));

$requestUrl = 'http://' . $host . $path . '?' . $parameter . '&Signature=' . $signature;

echo $requestUrl;

$xml = simplexml_load_file($requestUrl);

echo $xml;

//$item = $xml->Items->Item;
//$pageUrl = $item->DetailPageURL;
//$attributes = $item->MediumImage->URL;
//$title = $attributes->Title;

?>

