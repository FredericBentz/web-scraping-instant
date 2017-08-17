<?php

require_once('functions/simple-curl-function.php');

$url = 'http://testing-ground.scraping.pro/';

$page = getRequest($url);

echo $page;