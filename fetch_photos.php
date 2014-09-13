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
//$debug->dbg($content);

	while ($content->photos->page < $content->photos->pages) {
		foreach ($content->photos->photo as $photo) {
			$photo_original_url = "http://farm" . $photo->farm . ".static.flickr.com/" . $photo->server . "/" . $photo->id . "_" . $photo->originalsecret . "_o." . $photo->originalformat;
			$copy_dir = "/var/www/lighttpd/admin/flickr_api/photos/";
			$data = file_get_contents($photo_original_url);
			// replace "-" and ":" with nothing. IE: "2014-09-22 08:00:33".
			$datetaken = preg_replace("/[\-:]/", "", $photo->datetaken);
			// replace spaces with a dash. IE: "20140922 080033".
			$datetaken = preg_replace("/[\s]/", "-", $datetaken);
			$filename = $datetaken . "_" . $photo->id . "." . $photo->originalformat;
			$file = fopen($copy_dir . $filename, "w+");
			fputs($file, $data);
			fclose($file);
exit; // testing one file.
		}
		// fetch next page.
		$page++;
		$content = file_get_contents($people_getPhotos_url);
		$content = json_decode($content);
	}

?>