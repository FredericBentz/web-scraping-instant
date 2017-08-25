<?php

require_once('functions/scraper-class.php');

$product = new Scraper("https://www.emag.ro/telefon-mobil-samsung-galaxy-s7-32gb-4g-black-sm-g930fzkarom/pd/DJXR03BBM/");

$product->name = $product->xPathObj->query("//h1")->item(0)->nodeValue;

$product->code = $product->xPathObj->query('//span[@class="product-code-display pull-left"]')->item(0)->nodeValue;

$product->discount = $product->xPathObj->query('//div[@class="jewel-text"]')->item(0)->nodeValue;

$product->status = $product->xPathObj->query('//span[@class="label label-in_stock"]')->item(0)->nodeValue;

$product->code = $product->xPathObj->query('//span[@class="product-code-display pull-left"]')->item(0)->nodeValue;

$price = $product->xPathObj->query('//p[@class="product-new-price"]/node()[not(self::sup)][not(self::span)]')->item(0)->nodeValue;
$price = str_replace(".", "", $price);
$product->price = $price;
$product->priceSup = $product->xPathObj->query('//p[@class="product-new-price"]/sup')->item(0)->nodeValue;


echo "Nume: ".$product->name."<br/>";
echo $product->code."<br/>";	
echo "Discount: ".$product->discount."<br/>";	
echo "Status: ".$product->status."<br/>";
echo "Pret: ".$product->price.".".$product->priceSup." Lei<br/>";