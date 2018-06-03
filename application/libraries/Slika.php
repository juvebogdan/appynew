<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."third_party/imageLib.php";

class Slika extends imageLib {

	private $parametri;

	public function __construct($params) {
		$this->parametri = $params;
		parent::__construct($params["putanja"]);
	}

	function obradiSliku() {
		$this->resizeImage($this->parametri['width'], $this->parametri['height']);
		$this->saveImage($this->parametri['savepath'], $this->parametri['type']=="png" ? 0 : 1);
	}

}