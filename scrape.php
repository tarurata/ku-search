<?php
$k = filter_input(INPUT_GET, 'k', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
$url = 'https://www.amazon.co.jp/s?k=' . urlencode($k) . '&rh=n%3A2250738051%2Cp_n_feature_nineteen_browse-bin%3A3169286051&ref=sr_nr_p_n_feature_nineteen_0';
$ch = curl_init();
$headers = [
    'Accept-Encoding: gzip, deflate',
    'Accept-Language: en-US,en;q=0.9',
    'Cache-Control: no-cache',
    'Pragma: no-cache',
    'User-Agent: Mozilla/5.0 (compatible; your-custom-user-agent)',
];

curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Timeout in seconds. Without this, the script does not wait the scraping result in koyeb environment.
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // Same to above
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_ENCODING, "");
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
curl_setopt($ch, CURLOPT_ENCODING, "");

$html = curl_exec($ch);
curl_close($ch);

 //Check if HTML was returned
if (!$html) {
    die('Error fetching the webpage');
}
$dom = new DOMDocument();
@$dom->loadHTML($html);
$xpath = new DOMXPath($dom);

$containers = $xpath->query("//div[@class='sg-col-20-of-24 s-result-item s-asin sg-col-0-of-12 sg-col-16-of-20 sg-col s-widget-spacing-small sg-col-12-of-16']");

$items = [];
foreach ($containers as $index => $container) {
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
