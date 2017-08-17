<?php

require_once('simple-curl-request.php');

$data = array();
$url = 'http://testing-ground.scraping.pro';

function getXpathObject($item)
{
	$xmlPageDom = new DomDocument();

	@$xmlPageDom->loadHTML($item);

	$xmlPageXpath = new DOMXPath($xmlPageDom);

	return $xmlPageXpath;
}

$testingPage = getRequest($url);
$testingPageXpath = getXpathObject($testingPage);

$title = $testingPageXpath->query('//div[@id="title"]');

if($title->length > 0)
{
	$data['title'] = $title->item(0)->nodeValue;
}

$blocks = $testingPageXpath->query('//div[@class="caseblock"]/a');
$blockDescriptions = $testingPageXpath->query('//div[@class="caseblock"]/div');

if($blocks->length > 0)
{
	for($i = 0; $i < $blocks->length; $i++)
	{
		$data['blocks'][$i]['title'] = $blocks->item($i)->nodeValue;
		$data['blocks'][$i]['description'] = $blockDescriptions->item($i)->nodeValue;
	}
}

$disabledBlocks = $testingPageXpath->query('//div[@class="caseblock_u"]/a');

if($disabledBlocks->length > 0)
{
	for($i = 0; $i < $disabledBlocks->length; $i++)
	{
		$data['disabled_blocks'][$i]['title'] = $disabledBlocks->item($i)->nodeValue;
	}
}

echo "<pre>";
print_r($data);
echo "</pre>";