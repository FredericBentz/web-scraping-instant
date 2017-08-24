<?php

require_once('functions/simple-curl-function.php');
require_once('functions/simple-xpath-function.php');
require_once('functions/scrape-between-function.php');

$resultPages = [];
$productPages = [];

$initialResultsPageUrl = "https://www.emag.ro/telefoane-mobile/c";
$resultPages[] = $initialResultsPageUrl;

$initialResultsPageSrc = getRequest($initialResultsPageUrl);

$resultPageXPath = getXpathObject($initialResultsPageSrc);

$resultPageUrls = $resultPageXPath->query('//ul[@class="pagination pagination-sm mrg-sep-none"]/li/a/@href');

if($resultPageUrls->length > 0)
{
	for($i = 0; $i < $resultPageUrls->length; $i++)
	{	
		if(!empty($resultPageUrls->item($i)->nodeValue) && $resultPageUrls->item($i)->nodeValue != 'javascript:void(0)')
		$resultPages[] = 'https://www.emag.ro'.$resultPageUrls->item($i)->nodeValue;
	}
}

$uniqueResultPages = array_values(array_unique($resultPages));

foreach($uniqueResultPages as $resultPage)
{	
	$resultPageSrc = getRequest($resultPage);
	$productPageXPath = getXpathObject($resultPageSrc);

	$productPageUrls = $productPageXPath->query('//h2/a/@href');

	if($productPageUrls->length > 0)
	{	
		for($i = 0; $i < $productPageUrls->length; $i++)
		{
			$productPages[] = $productPageUrls->item($i)->nodeValue;
		}
	}

	$productPageUrls = NULL;
	$productPageXPath = NULL;

	sleep(rand(1, 3));
}

print_r($productPages);