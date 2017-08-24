<?php

require_once('functions/simple-curl-function.php');
require_once('functions/scrape-between-function.php');

$url = 'http://testing-ground.scraping.pro';


$page = getRequest($url);
$googleAnalyticsId = scrapeBetweenStrings($page, "(['_setAccount', '", "'])");

echo $googleAnalyticsId;
