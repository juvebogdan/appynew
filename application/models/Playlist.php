<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playlistmodel extends CI_Model
{

	public function insertM3u($username,$m3u)
	{
  		$data = array(
        'm3u' => $m3u
      );
      $this->db->where('username',$username);
  		$query = $this->db->update('clients',$data);
      return;
	}

}