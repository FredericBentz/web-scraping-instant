<?php

function getXpathObject($item)
{
	$xmlPageDom = new DomDocument();

	@$xmlPageDom->loadHTML($item);

	$xmlPageXpath = new DOMXPath($xmlPageDom);

	return $xmlPageXpath;
}