Flickr API scripts
==========

Working with the Flickr API.

## Installation

To get started, create a file called `auth_tokens.php` and put it in the same directory as the `fetch_photos.php` file (from this repository). The contents of `auth_tokens.php` should be:

	<?php

		$api_key = "";
		$user_id = "";
		$auth_token = "";
		$api_sig = "";

	?>

To get these values, we'll use the built-in API explorer on Flickr. That will let us bypass having to create an app, do the OAuth dance, etc.

[Go here](https://www.flickr.com/services/api/explore/flickr.people.getPhotos) while logged-in to your Flickr account. Fill in the arguments as illustrated below:

![Screenshot of Flickr API explorer page](screenshot1.jpg)

Copy your `user_id` from the right-hand side. The `extras` value should be: `original_format,description,date_upload,date_taken,geo`.