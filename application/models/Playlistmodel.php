<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playlistmodel extends MY_Model
{

  public function __Construct()
  {
    parent::__Construct();
    date_default_timezone_set('Europe/London');
    //local connection
    $this->config['hostname'] = 'localhost';
    $this->config['username'] = 'root';
    $this->config['password'] = '';
    $this->config['database'] = 'appy';
    $this->config['dbdriver'] = 'mysqli';
    $this->config['dbprefix'] = '';
    $this->config['pconnect'] = FALSE;
    $this->config['db_debug'] = TRUE;
    $this->config['cache_on'] = FALSE;
    $this->config['cachedir'] = '';
    $this->config['char_set'] = 'utf8';
    $this->config['dbcollat'] = 'utf8_general_ci';  
    $this->db = $this->load->database($this->config,TRUE);  
  }


	public function insertM3u($username,$m3u)
	{
  		$data = array(
        'm3u' => $m3u
      );
      $this->db->where('username',$username);
  		$query = $this->db->update('clients',$data);
	}

  public function insertEpg($username,$epg)
  {
      $data = array(
        'epg' => $epg
      );
      $this->db->where('username',$username);
      $query = $this->db->update('clients',$data);
  }

  public function getM3uandEpg($username) {
    $this->db->where('username',$username);
    return $this->db->get('clients')->result_array()[0];
  } 

  public function getUnlockStatus($username) {
    $this->db->where('username',$username);
    return $this->db->get('clients')->result_array()[0]['iptvunlock'];    
  }

  public function unlockIPTV($username) {
      $data = array(
        'iptvunlock' => '1'
      );
      $this->db->where('username',$username);
      $query = $this->db->update('clients',$data);    
  }

  public function getAppName($username) {
      $this->db->where('username',$username);
      return $this->db->get('clients')->result_array()[0]['Appname'];    
  }

}