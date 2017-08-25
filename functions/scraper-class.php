<?php

class Scraper{

	public $url;
	public $source;
	public $baseUrl;
	public $xPathObj;
	private $parsedUrl = [];

	function __construct($url)
	{
		$this->url = $url;
		$this->source = $this->getRequest($this->url);
		$this->xPathObj = $this->getXpathObject($this->source);
		$this->parsedUrl = parse_url($this->url);
		$this->baseUrl = $this->parse_url['scheme']."://".$this->parsedUrl['host'];
	}

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

	function getXpathObject($item)
	{
		$xmlPageDom = new DomDocument();

		@$xmlPageDom->loadHTML($item);

		$xmlPageXpath = new DOMXPath($xmlPageDom);

		return $xmlPageXpath;
	}


}