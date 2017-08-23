<?php

function postRequest($url, $fields, $successStr)
{
	$userAgent = "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5;en-US; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3";
	$cookie = 'tmp/cookie.txt';

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_FAILONERROR, true);
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
	curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));

	$results = curl_exec($ch);

	curl_close($ch);

	 if(strpos($results, $successStr))
	 	return $results;
	 else
	 	return false;
}
 
$url = 'http://testing-ground.scraping.pro/login?mode=login';

$fields = [
	'usr' => 'admin',
	'pwd' => '12345'
];

$successStr = 'WELCOME';

$loggedIn = postRequest($url, $fields, $successStr);


print_r($loggedIn);