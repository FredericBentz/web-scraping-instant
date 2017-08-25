<?php

require_once('db/config.php');
require_once('emag-scraping-multiple-products.php');


$insertProduct = $db->prepare("INSERT INTO emag_products (name, price, url, image) VALUES (:name, :price, :url, :image)");


foreach($products as $product)
{
	$insertProduct->execute([
		':name' => $product['name'],
		':price' => $product['price'],
		':url' => $product['url'],
		':image' => $product['image']
	]);
}