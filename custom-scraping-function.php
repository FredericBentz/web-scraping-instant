<?php

require_once('functions/simple-curl-function.php');

$url = 'http://testing-ground.scraping.pro';

function scrapeBetweenStrings($item, $start, $end)
{
	if(($startPos = stripos($item, $start)) === false)
		return false;
	elseif (($endPos = stripos($item, $end)) === false)
		return false;
	else
	{
		$substrStart = $startPos + strlen($start);

		return substr($item, $substrStart, $endPos-$substrStart);
	}
}

$page = getRequest($url);
$googleAnalyticsId = scrapeBetweenStrings($page, "(['_setAccount', '", "'])");

echo $googleAnalyticsId;
