<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImageCodeGaming extends MY_Model {

	private $db;

	public function __Construct()
	{
		parent::__Construct();
		$this->db = $this->load->database('default',TRUE);
  	}

	public function createCode() {
		//create a random key
		$this->load->library('randomnd');
		$pin = 	$this->randomnd->randnd();
		
		$this->db->where('imagecode', $pin);
		$query = $this->db->get('imageCodes');
		if ($query->num_rows()!=0) {
			return $this->createCode();
		}	
		else {
			$data = array(
				'imagecode' => $pin
			);
			$this->db->insert('imageCodes',$data);
			return $pin;
		}
	}	

}