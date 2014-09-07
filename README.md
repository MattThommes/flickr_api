Flickr API scripts
==========

Working with the Flickr API.

## Installation

To get started, create a file called `api_url.php` and put it in the same directory as the `fetch_photos.php` file (from this repository). The contents of `api_url.php` should be:

	<?php

		$url = "";

	?>

To get this value, we'll use the built-in API explorer on Flickr. This will let us bypass having to create an app, do the OAuth dance, etc.

[Go here](https://www.flickr.com/services/api/explore/flickr.people.getPhotos) while logged-in to your Flickr account. Fill in the arguments as illustrated below:

![Screenshot of Flickr API explorer page](screenshot1.jpg)

Copy your `user_id` from the right-hand side. The `extras` value should be:

`original_format,description,date_upload,date_taken,geo`

When you click "Call Method..." it will load the data into the textbox and generate the API URL:

![Screenshot of Flickr API explorer page](screenshot2.jpg)

We'll use this URL to read the Flickr data. Populate the value in `api_url.php` with the **full URL**.

**NOTE: The `api_key`, `auth_token`, and `api_sig` might expire quickly, so you'll have to regenerate the URL frequently.**

