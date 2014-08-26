<?php

$url = $argv[1];

$url = str_replace('http://fonts.googleapis.com/css?', '', $url);

parse_str($url);

$families = explode('|', $family);

$parsed = array();

foreach ($families as $family) {
	$font = explode(':', $family);
	$name = $font[0];
	$styles = explode(',', $font[1]);
	foreach ($styles as $style) {
		$parsed[] = $name . ':' . $style;
	}
}

$parsedString = implode(',', $parsed);

var_dump($parsed);

$md5 = md5($parsedString);

$dir = __DIR__;
mkdir($md5);
chdir($md5);

$cmd = "{$dir}/download-webfont.sh {$parsedString}";

echo "\n$cmd\n";
passthru($cmd);
