<?php

require './vendor/autoload.php';

$html = file_get_contents('https://www.amazon.co.jp/s?k=%E6%8A%80%E8%A1%93%E6%9B%B8&rh=n%3A2250738051%2Cp_n_feature_nineteen_browse-bin%3A3169286051&ref=sr_nr_p_n_feature_nineteen_0');

$value = phpQuery::newDocument($html)->find("h2")->find("a")->find("span")->text();

preg_match("/^(?:.*+\n?){0,3}+/", $value, $matches);

