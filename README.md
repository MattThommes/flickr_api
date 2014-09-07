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

To get these values, we'll use the built-in API explorer on Flickr. This will let us bypass having to create an app, do the OAuth dance, etc.

[Go here](https://www.flickr.com/services/api/explore/flickr.people.getPhotos) while logged-in to your Flickr account. Fill in the arguments as illustrated below:

![Screenshot of Flickr API explorer page](screenshot1.jpg)

Copy your `user_id` from the right-hand side. The `extras` value should be:

`original_format,description,date_upload,date_taken,geo`

When you click "Call Method..." it will load the data into the textbox and generate the URL:

![Screenshot of Flickr API explorer page](screenshot2.jpg)

We'll use this URL to read the Flickr data. First, populate the value in `auth_tokens.php` with the values from the URL. For example, you'll see the URL parameters are named the same as the PHP variables. So just copy/paste the values in:

	https://api.flickr.com/services/rest/
	?method=flickr.people.getPhotos
	&api_key={API_KEY_HERE} <---
	&user_id={USER_ID_HERE} <---
	&extras=original_format%2Cdescription%2Cdate_upload%2Cdate_taken%2Cgeo
	&per_page=500
	&page=1
	&format=json
	&nojsoncallback=1
	&auth_token={AUTH_TOKEN_HERE} <---
	&api_sig={API_SIG_HERE} <---

**NOTE: The `api_key`, `auth_token`, and `api_sig` might expire quickly, so you'll have to regenerate the URL frequently.**





