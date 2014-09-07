<?php

	require "vendor/autoload.php";
	use MattThommes\Debug;
	use MattThommes\Backend\Mysql;
	use MattThommes\Rest\Http;
	$debug = new Debug;
	$http = new Http;

	include "db_connect.php";
	require_once("auth_tokens.php");

	$per_page = 500;
	$page = 1;

	$people_getPhotos_url = "https://api.flickr.com/services/rest/?method=flickr.people.getPhotos&api_key={$api_key}&user_id={$user_id}&extras=original_format%2Cdescription%2Cdate_upload%2Cdate_taken%2Cgeo&per_page={$per_page}&page={$page}&format=json&nojsoncallback=1&auth_token={$auth_token}&api_sig={$api_sig}";
$debug->dbg($people_getPhotos_url,1);

	$content = file_get_contents($people_getPhotos_url);
	$content = json_decode($content);

	while ($content->photos->page < $content->photos->pages) {
		foreach ($content->photos->photo as $photo) {
			$photo_original_url = "http://farm" . $photo->farm . ".static.flickr.com/" . $photo->server . "/" . $photo->id . "_" . $photo->originalsecret . "_o." . $photo->originalformat;
$debug->dbg($photo_original_url);
		}
		// fetch next page.
		$page++;
		$content = file_get_contents($people_getPhotos_url);
		$content = json_decode($content);
	}

?>