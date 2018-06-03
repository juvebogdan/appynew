<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imdbmodel extends CI_Model
{

  private $table = 'Imdbjobs';
  private $config;

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

  public function insertJob($username) {
    if($this->checkIfJobExists($username)) {
      $data = array(
        'username' => $username,
        'next_update' => date('Y-m-d H:i:s', strtotime("-1 hour"))
      );
      $query = $this->db->insert($this->table,$data);
      return;
    }
    else {
      return;
    }

  }

  private function checkIfJobExists($username) {
    $this->db->where('username',$username);
    $query = $this->db->get($this->table);
    if ($query->num_rows() == 0) {
      return TRUE;
    } 
    else {
      return FALSE;
    }    
  }

  public function getJob() {
    $current_date = date('Y-m-d H:i:s', strtotime("-1 hour"));
    $this->db->where('next_update <=', $current_date);
    $this->db->where('running', '0');
    $this->db->limit(1);
    $query = $this->db->get($this->table);
    $result = $query->result_array();
    if(!empty($result)) {
      return $result[0];
    }
    else {
      return array();
    }
  }

  public function updateJob($job) {
    $next = date('Y-m-d H:i:s', strtotime("+1 days"));
    $data = array(
      'next_update' => $next
    );
    $this->db->where('username',$job['username']);
    $this->db->update($this->table, $data);   
  }

  public function resetJob($job) {
    $next = date('Y-m-d H:i:s', strtotime("-65 minutes"));
    $data = array(
      'next_update' => $next
    );
    $this->db->where('username',$job['username']);
    $this->db->update($this->table, $data);     
  }

  public function setJobRunning($user) {
    $data = array(
      'running' => '1'
    );    
    $this->db->where('username',$user);
    $this->db->update($this->table, $data);     
  }

  public function finishJob($user) {
    $data = array(
      'running' => '0'
    );    
    $this->db->where('username',$user);
    $this->db->update($this->table, $data);     
  }  

  public function getM3uandEpg($username) {
    $this->db->where('username',$username);
    return $this->db->get('clients')->result_array()[0];
  }

  public function getM3u($username) {
    $this->db->where('username',$username);
    return $this->db->get('clients')->result_array()[0];
  }    

}