<?php

require_once('functions/simple-curl-function.php');
require_once('functions/simple-xpath-function.php');

$url = "https://www.emag.ro/telefon-mobil-samsung-galaxy-s8-64gb-4g-midnight-black-sm-g950fzkarom/pd/D1XVG7BBM/";

$pageSrc = getRequest($url);
$pageXPath = getXpathObject($pageSrc);

$result = [];

// get product title
$titleXpath = $pageXPath->query('//h1');
$title = $titleXpath->item(0)->nodeValue;
$result['title'] = $title;

// get product code
$codeXpath = $pageXPath->query('//span[@class="product-code-display pull-left"]');
$codeFull = $codeXpath->item(0)->nodeValue;
$codeArr = explode(": ", $codeFull);
$code = $codeArr[1];
$result['code'] = $code;

// get price
$priceXpath = $pageXPath->query('//p[@class="product-new-price"]');
$price = $priceXpath->item(0)->nodeValue;

$priceSupXpath = $pageXPath->query('//p[@class="product-new-price"]/sup');
$priceSup = $priceSupXpath->item(0)->nodeValue;
$result['price'] = $price;

$stockXpath = $pageXPath->query('//span[@class="label label-in_stock"]');
$stock = $stockXpath->item(0)->nodeValue;

$result['stock'] = $stock;

print_r($result);