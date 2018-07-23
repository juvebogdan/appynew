<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Imdb {

	private $movie;
	private $apikey = 'd0af5e7a';

	public function __construct($movie) {
		$this->movie = $movie;
	}

	function getData() {
		$apikey = $this->apikey;
		$name = str_replace('&', '%26', $this->movie);

		$url = str_replace(' ', '%20', "http://private.omdbapi.com/?t=$name&apikey=$apikey");
		//$url = str_replace('&', '%26', "http://www.omdbapi.com/?t=$name&apikey=$apikey");

		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => $url,
		    CURLOPT_TIMEOUT => 5
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
		curl_close($curl);

		return $resp;
	}

	function getDataByLink() {
		$apikey = $this->apikey;
		$name = str_replace('&', '%26', $this->movie);

		$url = str_replace(' ', '%20', "http://private.omdbapi.com/?i=$name&apikey=$apikey");
		//$url = str_replace('&', '%26', "http://www.omdbapi.com/?t=$name&apikey=$apikey");

		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => $url,
		    CURLOPT_TIMEOUT => 5
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
		curl_close($curl);

		return $resp;
	}	

}