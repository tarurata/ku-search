<?php

require './vendor/autoload.php';

$k = $_REQUEST['k'];

$url = 'https://www.amazon.co.jp/s?k=' . urlencode($k) . '&rh=n%3A2250738051%2Cp_n_feature_nineteen_browse-bin%3A3169286051&ref=sr_nr_p_n_feature_nineteen_0';

$html = file_get_contents($url);

for($i=0;$i<16;$i++){
    $items[] = [
                'name'=>phpQuery::newDocument($html)->find("h2")->find("a")->find("span:eq($i)")->text(),
                'link'=>"https://www.amazon.co.jp" . phpQuery::newDocument($html)->find("h2")->find("a.a-link-normal:eq($i)")->attr('href'),
                'imgsrc'=>phpQuery::newDocument($html)->find("img.s-image:eq($i)")->attr('src')
               ];
}
