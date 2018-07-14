<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appymodel extends CI_Model {

  private $db;
  private $vpndb;
  private $table = 'clients';
  private $vpnconfig;
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

    public function bussiness_stat() 
    {
      $sql = "select count(*) as broj,a.type as type from clients a,pendingSubs b where a.username=b.username group by a.type ";
      $query=$this->db->query($sql);
      return $query->result_array();
      // $this->db->select('type, COUNT(*) as broj');
      // $this->db->group_by('type');
      // $query = $this->db->get($this->table);
      // return $query->result_array();
    }
    public function all_users()
    {
      $sql = "select * from clients a,pendingSubs b where a.username=b.username order by a.username asc";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    public function rm_clients($user)
    {
      $sql="delete from clients where username='$user'";
      $this->db->query($sql);
      return $this->db->affected_rows();
    }
    public function rm_pendings($user)
    {
      $sql="delete from pendingSubs where username='$user'";
      $this->db->query($sql);
      return $this->db->affected_rows();
    }
    public function num_user_client($user)
    {
      $sql = "select * from clients a,pendingSubs b where a.username=b.username and a.username='$user' ";
      $query=$this->db->query($sql);
      return $query->result_array();
    }

    public function get_all_clients() {
      $query = $this->db->get($this->table);
      return $query->result_array();
    }

    public function get_iptvcredits($user) {
      $this->db->where('username', $user);
      $query = $this->db->get($this->table);
      return $query->result_array()[0]['iptvcredits'];
    }

}