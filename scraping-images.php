<?php

require_once('functions/simple-curl-function.php');
require_once('functions/simple-xpath-function.php');

$url = 'https://www.w3schools.com/css/css_image_gallery.asp';
$imagesPath = 'https://www.w3schools.com/css/';

$page = getRequest($url);

$xpathPage = getXpathObject($page);

$logo = $xpathPage->query('//img/@src');

if($logo->length > 0)
{	
	$logoSrc = $logo->item(0)->nodeValue;
	$logoName = end(explode("/", $logoSrc));
	$logoAbsPath = $imagesPath.$logoSrc;

	if(getimagesize($logoAbsPath))
	{
		$logoFile = getRequest($logoAbsPath);

		$file = fopen("tmp/".$logoName, 'w');
		fwrite($file, $logoFile);
		fclose($file); 

		echo "File saved.";
	}else
	{
		echo "Image is not valid!";
	}
}
else
	echo "No image found!";