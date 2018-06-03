<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vpnmodel extends CI_Model {

  private $db;
  private $vpndb;
  private $vpndb2;
  private $table = 'users';
  private $table2 = 'clients';
  private $vpnconfig;
  private $vpnconfig2;
  private $config;

  public function __Construct()
  {
    parent::__Construct();
    date_default_timezone_set('Europe/London');
    //vpn7
    $this->vpnconfig['hostname'] = '165.227.38.2';
    $this->vpnconfig['username'] = 'appyzone';
    $this->vpnconfig['password'] = 'appyzone';
    $this->vpnconfig['database'] = 'VPN';
    $this->vpnconfig['dbdriver'] = 'mysqli';
    $this->vpnconfig['dbprefix'] = '';
    $this->vpnconfig['pconnect'] = FALSE;
    $this->vpnconfig['db_debug'] = TRUE;
    $this->vpnconfig['cache_on'] = FALSE;
    $this->vpnconfig['cachedir'] = '';
    $this->vpnconfig['char_set'] = 'utf8';
    $this->vpnconfig['dbcollat'] = 'utf8_general_ci'; 
    //vpn
    $this->vpnconfig2['hostname'] = '165.227.144.75';
    $this->vpnconfig2['username'] = 'appyzone';
    $this->vpnconfig2['password'] = 'appyzone';
    $this->vpnconfig2['database'] = 'clients';
    $this->vpnconfig2['dbdriver'] = 'mysqli';
    $this->vpnconfig2['dbprefix'] = '';
    $this->vpnconfig2['pconnect'] = FALSE;
    $this->vpnconfig2['db_debug'] = TRUE;
    $this->vpnconfig2['cache_on'] = FALSE;
    $this->vpnconfig2['cachedir'] = '';
    $this->vpnconfig2['char_set'] = 'utf8';
    $this->vpnconfig2['dbcollat'] = 'utf8_general_ci'; 
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
    $this->vpndb = $this->load->database($this->vpnconfig,TRUE);    
    $this->vpndb2 = $this->load->database($this->vpnconfig2,TRUE);    
    }

    public function all_data() {
      $this->vpndb->where('active','1');
      $this->vpndb->order_by('username','asc');
      $query = $this->vpndb->get($this->table);
      return $query->result_array();
    }
    public function client_email() {
      $query = $this->vpndb->get($this->table2);
      return $query->result_array();
    }
    public function uservpn($username) {
      $this->vpndb2->where('username',$username);
      $query = $this->vpndb2->get($this->table);
      return $query->result_array();
    }

    public function get_all_clients($username) {
      $user = $this->uservpn($username);
      if ($user) {
        $this->vpndb2->where('id',$user[0]['id']);
        return $this->vpndb2->get('clients')->result_array();
      }
    }

    public function lookupuser($cusid) {
      $this->vpndb2->where('customerId',$cusid);
      return $this->vpndb2->get('clients')->result_array();
    }
}