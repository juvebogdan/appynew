<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devices extends MY_Model {

	private $db;
  private $vpndb;
	private $table = 'DeviceIDTable';
  private $vpnusers = 'users';

	public function __Construct()
	{
		parent::__Construct();
		$this->db = $this->load->database($this->config,TRUE);
    $this->vpndb = $this->load->database($this->vpnconfig,TRUE);
  }

  	public function numallusers() {
  		$query = $this->db->get($this->table);
  		return $query->num_rows();
  	}

  	public function numthismonth() {
  		$month=date('Y-m');
  		$this->db->where('substring(RegDate,1,7)',$month);
  		$query = $this->db->get($this->table);
  		return $query->num_rows();  		
  	}

  	public function numthisweek() {
		$today=date('Y-m-d');
		$day2=(date('D')=='Mon')?date('Y-m-d'):date('Y-m-d',strtotime("previous monday"));
  		$this->db->where("substring(RegDate,1,10) >=",$day2);
  		$this->db->where("substring(RegDate,1,10) <=",$today);
  		$query = $this->db->get($this->table);
  		return $query->num_rows();  		
  	} 

  	public function numtoday() {
		$today=date('Y-m-d');
  		$this->db->where("substring(RegDate,1,10)",$today);
  		$query = $this->db->get($this->table);
  		return $query->num_rows();  		
  	}   	 	

  	public function lookupemail() {
  		$this->db->where('email',$this->input->post('user'));
  		$query = $this->db->get($this->table);
  		return $query->result_array();
  	}	

    public function lookupip() {
      $this->db->where('IPAddress',$this->input->post('user'));
      $query = $this->db->get($this->table);
      return $query->result_array();
    }    

    public function lookupemailorip() {
      $this->db->where('Email',$this->input->post('user'));
      $this->db->or_where('IPAddress',$this->input->post('user'));
      $query = $this->db->get($this->table);
      return $query->result_array();
    }    

  	public function updaterow($id,$column,$value) {
  		if ($id!='') {
	  		$this->db->set($column,$value);
	  		$this->db->where('ID',$id);
	  		$this->db->update($this->table);
  		}
  	}

  	public function updatenewusers() {
		$datum = date('Y-m-d');
    	$time = strtotime($datum . ' -30 days');
    	$date = date("Y-m-d", $time);  		
  		$this->db->set('message','1');
  		$this->db->where('RegDate>=',$date);
  		$this->db->update($this->table);
  	}

  	public function updateallusers() {
  		$this->db->set('message','1');
  		$this->db->update($this->table);
  	}

  	public function updateiptvusers() {
  		$this->db->set('message','1');
  		$this->db->where('Username<>','');
  		$this->db->where('Password<>','');
  		$this->db->update($this->table);  		
  	}

  	public function checkstatus() {
  		$this->db->select('Kill');
  		$this->db->where('Email',$this->input->post('email'));
  		$query = $this->db->get($this->table);
  		$result = $query->result_array();
  		return isset($result[0]['Kill']) ? $result[0]['Kill'] : 2;
  	}

  	public function ban() {
  		$this->db->where('Email',$this->input->post('email'));
  		$this->db->set('Kill','1');
  		$this->db->update($this->table);
  	}

  	public function unban() {
  		$this->db->where('Email',$this->input->post('email'));
  		$this->db->set('Kill','0');
  		$this->db->update($this->table);
  	} 

	public function grant($id) {
  		$this->db->where('ID',$id);
  		$this->db->set('Paid','1');
  		$this->db->update($this->table);		
	}	

  	public function grantiptv($id,$username,$password,$endaccess) {
  		if ($id!='') {
	  		$this->db->set('Username',$username);
	  		$this->db->set('Password',$password);
        $this->db->set('AccessDuration',$endaccess);
	  		$this->db->where('ID',$id);
	  		$this->db->update($this->table);
  		}
  	}

  public function getuserdata($id) {
      if ($id!='') {
        $this->db->where('ID',$id);
        $query = $this->db->get($this->table);
        return $query->result_array()[0];
      }    
  }

	public function userdetails($id) {
		$this->db->select('Paid, pinPassed,substring(EndTrial,1,10) as trial,IPAddress as ip,LastOnline,AccessDuration,Email');
		$this->db->where('ID',$id);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}	

	public function getall() {
		$this->db->limit(10, 0);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function swappaid($id) {
		$user = $this->userdetails($id);
		if ($user[0]['Paid'] == '1') {
	  		$this->db->set('Paid','0');
	  		$this->db->where('ID',$id);
	  		$this->db->update($this->table);
	  		return '0';			
		}
		else {
	  		$this->db->set('Paid','1');
	  		$this->db->where('ID',$id);
	  		$this->db->update($this->table);
	  		return '1';			
		}
	}

	public function edittrial($id,$date) {
	  	$this->db->set('EndTrial',$date . " 00:00:00");
	  	$this->db->where('ID',$id);
	  	$this->db->update($this->table);
	  	return $date;
	}

  public function editend($id,$date) {
      $this->db->set('AccessDuration',$date);
      $this->db->where('ID',$id);
      $this->db->update($this->table);
      return $date;
  }

  public function deleteuser($id) {
      $this->db->where('ID',$id);
      $this->db->delete($this->table);
  }  

  public function getVpnUsersCredits($username) {
      $this->vpndb->where('username',$username);
      $query = $this->vpndb->get($this->vpnusers);
      return $query->result_array();    
  } 

  public function getemail($emailorip) 
  {
      $this->db->where("Email='$emailorip' or IPAddress='$emailorip'",NULL,FALSE);
      $query=$this->db->get($this->table);
      $data['num']=$query->num_rows();
      if($data['num']!=0)
      {
        $pom=$query->result_array();
        $data['email']=$pom[0]['Email'];
      }
      return $data;      
  }

}