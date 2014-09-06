<?php

	require "vendor/autoload.php";
	use MattThommes\Debug;
	use MattThommes\Backend\Mysql;
	use MattThommes\Rest\Http;
	$debug = new Debug;
	$http = new Http;

	include "db_connect.php";
	require_once("auth_tokens.php");

	$people_getPhotos_url = "https://api.flickr.com/services/rest/?method=flickr.people.getPhotos&api_key={$api_key}&user_id={$user_id}&extras=original_format%2Cdescription%2Cdate_upload%2Cdate_taken%2Cgeo&format=json&nojsoncallback=1&auth_token={$auth_token}&api_sig={$api_sig}";
$debug->dbg($people_getPhotos_url);

?>