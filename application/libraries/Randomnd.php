<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Randomnd
{
	private $broj;
	
	function __construct()
	{
		$this->broj=mt_rand(10000,99999);
	}
	public function randnd()
	{
		return $this->broj;
	}
}