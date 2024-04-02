<?php

// Enable error reporting for development (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// User input from query parameters (sanitize this input)
$k = filter_input(INPUT_GET, 'k', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';

// Construct the URL
$url = 'https://www.amazon.co.jp/s?k=' . urlencode($k) . '&rh=n%3A2250738051%2Cp_n_feature_nineteen_browse-bin%3A3169286051&ref=sr_nr_p_n_feature_nineteen_0';

// Use cURL for HTTP GET
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_ENCODING, ""); // Accepts all encodings and decodes them automatically
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
curl_setopt($ch, CURLOPT_ENCODING, ""); // Accepts all encodings and decodes them automatically

$html = curl_exec($ch);
curl_close($ch);

 //Check if HTML was returned
if (!$html) {
    die('Error fetching the webpage');
}

// Use DOMDocument to parse the HTML
$dom = new DOMDocument();
@$dom->loadHTML($html);
$xpath = new DOMXPath($dom);

// Fetch the containers for all items. Assuming each item is in a div with a specific class:
$containers = $xpath->query("//div[@class='sg-col-20-of-24 s-result-item s-asin sg-col-0-of-12 sg-col-16-of-20 sg-col s-widget-spacing-small sg-col-12-of-16']");

$items = [];

foreach ($containers as $index => $container) {
    // Within each container, fetch item details
    $name = $xpath->evaluate(".//h2//a/span", $container)->item(0)->nodeValue;
    $link = "https://www.amazon.co.jp" . $xpath->evaluate(".//h2//a[@class='a-link-normal s-underline-text s-underline-link-text s-link-style a-text-normal']/@href", $container)->item(0)->nodeValue;
    $imgSrc = $xpath->evaluate(".//img[@class='s-image']/@src", $container)->item(0)->nodeValue;

    if ($name) {
        $items[] = [
            'name' => $name,
            'link' => $link,
            'imgsrc' => $imgSrc
        ];
    }
}
?>
