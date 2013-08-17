<?php

if (!isset($_GET['url'])) die();
$url = urldecode($_GET['url']);
$url = 'http://' . str_replace('http://', '', $url);
$parsed = parse_url($_SERVER['QUERY_STRING']);
$url = str_replace('url=', '', $parsed['path']);
//$query = $parsed['query'];

$x = http_build_url($url);
var_dump($x);
exit;

//echo file_get_contents($url . "&" . $query);
//exit;
//


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url . "?" . $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3');
$result = curl_exec($ch);
curl_close($ch);

echo ($result);