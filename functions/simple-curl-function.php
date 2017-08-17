<?php

function getRequest($url)
{

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_URL, $url);

	$results = curl_exec($ch);

	curl_close($ch);


	return $results;
}

