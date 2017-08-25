<?php

require_once('functions/simple-curl-function.php');
require_once('functions/simple-xpath-function.php');

$categoryPageUrl = 'https://www.emag.ro/telefoane-mobile/p{page_id}/c';
$products = [];
$productsPerPage = 60;

function calculateProductIndex($page_id, $product_index)
{
	global $productsPerPage;
	return ($productsPerPage * ($page_id - 1)) + $product_index;
}


// loop all category pages
for($i=1; $i<=3; $i++)
{
	$categoryUrl = str_replace("{page_id}", $i, $categoryPageUrl);
	$pageSrc = getRequest($categoryUrl);
	$pageXPath = getXpathObject($pageSrc);

	// get product title
	$titleXpath = $pageXPath->query('//h2/a');

	for($j = 0; $j < $titleXpath->length; $j++)
	{	
		$position = calculateProductIndex($i, $j);
		$title = $titleXpath->item($j)->nodeValue;
		$products[$position]['title'] = $title;
	}

	// get product url
	$urlXpath = $pageXPath->query('//div[@class="card-section-top"]//div[@class="thumbnail-wrapper"]//a/@href');
	for($j = 0; $j < $urlXpath->length; $j++)
	{	
		$position = calculateProductIndex($i, $j);
		$url = $urlXpath->item($j)->nodeValue;
		$products[$position]['url'] = $url;
	}

	// get product image
	$imageXpath = $pageXPath->query('//div[@class="card-section-top"]//img');
	
	for($j = 0; $j < $imageXpath->length; $j++)
	{	
		$position = calculateProductIndex($i, $j);
		$image = $imageXpath->item($j)->attributes->item(0)->value;
		$products[$position]['image'] = $image;
	}

	// get product price
	$priceXpath = $pageXPath->query('//div[@class="page-container"]//p[@class="product-new-price"]/node()[not(self::sup)][not(self::span)]');
	$priceSupXpath = $pageXPath->query('//div[@class="page-container"]//p[@class="product-new-price"]/sup');

	for($j = 0; $j < $priceXpath->length; $j++)
	{	
		$position = calculateProductIndex($i, $j);
		$price = $priceXpath->item($j)->nodeValue;
		$priceSup = $priceSupXpath->item($j)->nodeValue;
		$price = str_replace(".", "", $price);

		$products[$position]['price'] = $price.",".$priceSup;
	}
	

}  

print_r($products);