<?php

	require "vendor/autoload.php";
	use MattThommes\Debug;
	use MattThommes\Backend\Mysql;
	use MattThommes\Rest\Http;
	$debug = new Debug;
	$http = new Http;

	include "db_connect.php";
	require_once("api_url.php");

	$content = file_get_contents($url);
	$content = json_decode($content);
$debug->dbg($content);

	while ($content->photos->page < $content->photos->pages) {
		foreach ($content->photos->photo as $photo) {
			$photo_original_url = "http://farm" . $photo->farm . ".static.flickr.com/" . $photo->server . "/" . $photo->id . "_" . $photo->originalsecret . "_o." . $photo->originalformat;
			$copy_dir = "/path/to/html/images/directory/";
			$data = file_get_contents($photo_original_url);
			$file = fopen($copy_dir . $photo->id . "." . $photo->originalformat, "w+");
			fputs($file, $data);
			fclose($file);
			exit;
		}
		// fetch next page.
		$page++;
		$content = file_get_contents($people_getPhotos_url);
		$content = json_decode($content);
	}

?>