<?php

namespace App\Http\Controllers;

class InstagramController extends Controller {
	public function index() {
		$profile = \Dymantic\InstagramFeed\Profile::where('username', 'yjb')->first();
		$feed = $profile->refreshFeed(1000);
		return $feed;
	}
}
