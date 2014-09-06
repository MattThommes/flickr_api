<?php

	require "vendor/autoload.php";
	use MattThommes\Debug;
	use MattThommes\Backend\Mysql;
	use MattThommes\Rest\Http;
	$debug = new Debug;
	$http = new Http;

	include "db_connect.php";
	require_once("auth_tokens.php");

	if (isset($_GET["frob"]) && $_GET["frob"]) {
		// GET TOKEN.
		$method = "flickr.auth.getToken";
		$string = $consumer_secret . "api_key" . $consumer_key . "frob" . $_GET["frob"];
		$string .= "method" . $method;
		$url = "http://www.flickr.com/services/rest/";
		$url .= "?method=" . $method;
		$url .= "&api_key=" . $api_key;
		$url .= "&frob=" . $_GET["frob"];
		$url .= "&api_sig=" . $string;
		$token = $http->curl($url);
		$token = (array)$token->auth;
		$token = $token["token"];
	} else {
		// OTHERWISE PROVIDE LOGIN LINK.
		$login_link = "http://flickr.com/services/auth/";
		$login_link .= "?api_key=" . $consumer_key;
		$login_link .= "&perms=read";
		$login_link .= "&api_sig=" . md5($consumer_secret . "api_key" . $consumer_key . "permsread");
		echo "Login to Flickr and authorize";
	}

?>