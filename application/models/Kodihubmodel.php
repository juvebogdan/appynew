<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kodihubmodel extends CI_Model {

	private $db;
	private $kodihubdb;
	private $table = 'urls';
	private $kodihubconfig;
	private $config;

	public function __Construct()
	{
		parent::__Construct();
		date_default_timezone_set('Europe/London');
		//kodihub connection
		$this->kodihubconfig['hostname'] = '165.227.152.79';
		$this->kodihubconfig['username'] = 'kodihub';
		$this->kodihubconfig['password'] = 'kodihub';
		$this->kodihubconfig['database'] = 'lodihub';
		$this->kodihubconfig['dbdriver'] = 'mysqli';
		$this->kodihubconfig['dbprefix'] = '';
		$this->kodihubconfig['pconnect'] = FALSE;
		$this->kodihubconfig['db_debug'] = TRUE;
		$this->kodihubconfig['cache_on'] = FALSE;
		$this->kodihubconfig['cachedir'] = '';
		$this->kodihubconfig['char_set'] = 'utf8';
		$this->kodihubconfig['dbcollat'] = 'utf8_general_ci';	
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
		$this->kodihubdb = $this->load->database($this->kodihubconfig,TRUE);		
  	}

  	public function most_downloaded() {
  		$this->kodihubdb->order_by('clicks','desc');
  		$this->kodihubdb->limit(10);
  		$query = $this->kodihubdb->get($this->table);
  		return $query->result_array();
  	}

   	public function recently_updated() {
  		$this->kodihubdb->order_by('updated_at','desc');
  		$this->kodihubdb->limit(10);
  		$query = $this->kodihubdb->get($this->table);
  		return $query->result_array();
  	} 	

  	public function most_popular() {
    	$datum = date('Y-m-d H:i:s', strtotime("-1 week"));
  		$this->kodihubdb->select('id, COUNT(id) as total');
  		$this->kodihubdb->where('date_time >',$datum);
  		$this->kodihubdb->group_by('id'); 
  		$this->kodihubdb->order_by('total', 'desc'); 
  		$this->kodihubdb->limit(10);
  		$query = $this->kodihubdb->get('downloads');  
      $downloads =  $query->result_array();    
  		$data = $this->getbuildsWithIds($downloads);

      $final_data = array();

      for($i=0;$i<count($downloads);$i++) {
          for($j=0;$j<count($data);$j++) {
              if($downloads[$i]['id']==$data[$j]['id']) {
                  $final_data[] = $data[$j];
              }
          }
      }

  		return $final_data;		
  	}

  	private function getbuildsWithIds($data) {
  		$ids = array();
  		for($i=0; $i<=9; $i++) {
  			$ids[] = $data[$i]['id'];
  		}
  		//print_r($ids);
  		$this->kodihubdb->where_in('id',$ids);
  		$query = $this->kodihubdb->get($this->table);
  		return $query->result_array();
  	}

   	public function new_arrivals() {
  		$this->kodihubdb->order_by('created_at','desc');
  		$this->kodihubdb->limit(10);
  		$query = $this->kodihubdb->get($this->table);
  		return $query->result_array();
  	} 

   	public function smallest_builds() {
  		$this->kodihubdb->order_by('size','asc');
  		$this->kodihubdb->limit(10);
  		$query = $this->kodihubdb->get($this->table);
  		return $query->result_array();
  	} 

  	public function getall() {
  		$query = $this->kodihubdb->get($this->table);
  		return $query->result_array();
  	} 

  	public function insertData($data,$table) {
  		$batch = array();
  		for($i=0; $i<count($data); $i++) {
  			$batch[] = array(
  				'id' => $i+1,
  				'build' => $data[$i]
  			);
  		}
  		$this->db->empty_table($table);
  		$this->db->insert_batch($table,$batch);
  	}


    public function getBuilds($table) {
        $query = $this->db->get($table);
        $data = $query->result_array();
        $result = array();
        foreach ($data as $value) {
          $result[] = $value['build'];
        }
        return $result;
    } 

    public function autocomplete($user,$value) {
      $data = array(
        'autocomplete' => $value
      );
      if ($user=='appy') {
        $this->db->where('username','FissNew');
      }
      else {
        $this->db->where('username',$user);
      }
      $this->db->update('clients',$data);
    }	

    public function getAutocomplete($user) {
      $this->db->where('username',$user);
      $query = $this->db->get('clients');
      $data = $query->result_array();
      return $data[0]['autocomplete'];
    }

    public function getAutocompleteUsers() {
      $this->db->where('autocomplete',1);
      $query = $this->db->get('clients');
      return $query->result_array();      
    }

  	public function getNumOfUsers() {
      return $this->kodihubdb->get('users')->num_rows();
    }	

    public function getNumOfBuilds() {
      return $this->kodihubdb->get($this->table)->num_rows();
    }

    public function getNumOfDownloads() {
      $this->kodihubdb->select('SUM(clicks) as downloads');
      return $this->kodihubdb->get($this->table)->result_array()[0]['downloads'];
    }

    public function getUsers() {
      $this->kodihubdb->order_by('email','asc');
      return $this->kodihubdb->get('users')->result_array();
    }

    public function lookupUser($user) {
      $this->kodihubdb->where('email',$user);
      return $this->kodihubdb->get('users')->result_array()[0]['password'];
    }

    public function getBuildsforUser($user) {
      $username = $this->getUsername($user);
      if ($this->checkIfUsernameHasBuilds($username)) {
          $this->kodihubdb->where('username',$username);
          return $this->kodihubdb->get($this->table)->result_array();
      }
      else {
        return array();
      }
    }

    public function getUsername($user) {
      $this->kodihubdb->where('email',$user);
      return $this->kodihubdb->get('users')->result_array()[0]['username'];      
    }

    private function checkIfUsernameHasBuilds($username) {
      $this->kodihubdb->where('username',$username);
      return $this->kodihubdb->get($this->table)->num_rows();
    }

    public function getBuildData($code) {
      $this->kodihubdb->where('code',$code);
      return $this->kodihubdb->get($this->table)->result_array()[0];
    }

    public function getDetailsFromCode($code) {
        $this->kodihubdb->where('code',$code);
        return $this->kodihubdb->get($this->table)->result_array();
    }

    public function deleteBuild($code) {
        $this->kodihubdb->where('code',$code);
        $this->kodihubdb->delete($this->table);
    }

    public function deleteUser($user) {
        $this->kodihubdb->where('email',$user);
        $this->kodihubdb->delete('users');      
    }


}