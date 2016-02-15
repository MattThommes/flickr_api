<?php

	require "vendor/autoload.php";
	use MattThommes\Debug;
	use MattThommes\Backend\Mysql;
	$debug = new Debug;

	function dbg($x, $continue = 0) {
		return $GLOBALS["debug"]->dbg($x, $continue);
	}

	$datestamp = date("Ymd", strtotime("now")); // date the backup is performed.
	$photos_perpage = 25;

	//include "db_connect.php";
	require_once("flickr_config.php");
	require_once("aws_config.php");

	echo "<p><a href='" . $flickr->authorize_url . "'>Authorize access to your Flickr account</a> | <a href='fetch_photos.php'>Start over</a></p>";

exit;

	$local_dir = "/path/to/flickr/photos/";

	// create backup folder on S3.
	$r = $s3->s3_upload($s3_bucket, $s3_dir, "", "public-read");

	// Get collections.
	$r = file_get_contents($collections_getTree_url);
	$r = json_decode($r);
//$debug->dbg($r,1);

	// loop through each collection.
	foreach ($r->collections->collection as $c) {
		// create collection folder.
		//mkdir($local_dir . $c->title, 0777);
		$r = $s3->s3_upload($s3_bucket, $s3_dir . $c->title . "/", "", "public-read");
		// loop through photosets in this collection.
		foreach ($c->set as $s) {
			// create photoset folder.
			$r = $s3->s3_upload($s3_bucket, $s3_dir . $c->title . "/" . $s->title . "/", "", "public-read");
		}
	}
exit;
	// Get photosets.
	$r = file_get_contents($photosets_getList_url);
	$r = json_decode($r);
//$debug->dbg($r);

	foreach ($r->photosets->photoset as $s) {
		$r = $s3->s3_upload($s3_bucket, $s3_dir . $s->title->_content . "/", "", "public-read");
		$photosets_getPhotos_url .= "&photoset_id=" . $s->id;
$debug->dbg($photosets_getPhotos_url);
exit;
	}




	// Get photos.
	$content = file_get_contents($people_getPhotos_url);
	$content = json_decode($content);
//$debug->dbg($content);

	while ($content->photos->page < $content->photos->pages) {
		foreach ($content->photos->photo as $photo) {
			$photo_original_url = "http://farm" . $photo->farm . ".static.flickr.com/" . $photo->server . "/" . $photo->id . "_" . $photo->originalsecret . "_o." . $photo->originalformat;
			$data = file_get_contents($photo_original_url);
			// replace "-" and ":" with nothing. IE: "2014-09-22 08:00:33".
			$datetaken = preg_replace("/[\-:]/", "", $photo->datetaken);
			// replace spaces with a dash. IE: "20140922 080033".
			$datetaken = preg_replace("/[\s]/", "-", $datetaken);
			$filename = $datetaken . "_" . $photo->id . "." . $photo->originalformat;
			$file = fopen($local_dir . $filename, "w+");
			fputs($file, $data);
			fclose($file);
			$r = $s3->s3_upload($s3_bucket, $s3_dir . $s3_dir . $filename, $data, "public-read");
exit; // testing just one file.
		}
		// fetch next page.
		$page++;
		$content = file_get_contents($people_getPhotos_url);
		$content = json_decode($content);
	}

?>