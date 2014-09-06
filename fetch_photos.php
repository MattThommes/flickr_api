<?php

	require "vendor/autoload.php";
	use MattThommes\Debug;
	use MattThommes\Backend\Mysql;
	$debug = new Debug;

	include "db_connect.php";
	require_once("auth_tokens.php");

?>