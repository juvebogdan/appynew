<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lodimodel extends CI_Model {

	private $lodibdb;
	private $lodiconfig;
  private $hitsbdb;
  private $hitsconfig;  

	public function __Construct()
	{
		parent::__Construct();
		date_default_timezone_set('Europe/London');
		//lodi connection
		$this->lodiconfig['hostname'] = '46.101.90.250';
		$this->lodiconfig['username'] = 'appy';
		$this->lodiconfig['password'] = 'appy';
		$this->lodiconfig['database'] = 'phptest';
		$this->lodiconfig['dbdriver'] = 'mysqli';
		$this->lodiconfig['dbprefix'] = '';
		$this->lodiconfig['pconnect'] = FALSE;
		$this->lodiconfig['db_debug'] = TRUE;
		$this->lodiconfig['cache_on'] = FALSE;
		$this->lodiconfig['cachedir'] = '';
		$this->lodiconfig['char_set'] = 'utf8';
		$this->lodiconfig['dbcollat'] = 'utf8_general_ci';
	    //lodibuilder_table connection
	    $this->hitsconfig['hostname'] = '160.153.162.18';
	    $this->hitsconfig['username'] = 'fisstops';
	    $this->hitsconfig['password'] = 'FissTopham@2016';
	    $this->hitsconfig['database'] = 'lodibuilder';
	    $this->hitsconfig['dbdriver'] = 'mysqli';
	    $this->hitsconfig['dbprefix'] = '';
	    $this->hitsconfig['pconnect'] = FALSE;
	    $this->hitsconfig['db_debug'] = TRUE;
	    $this->hitsconfig['cache_on'] = FALSE;
	    $this->hitsconfig['cachedir'] = '';
	    $this->hitsconfig['char_set'] = 'utf8';
	    $this->hitsconfig['dbcollat'] = 'utf8_general_ci';      	

		$this->lodidb = $this->load->database($this->lodiconfig,TRUE);	
    	$this->hitsdb = $this->load->database($this->hitsconfig,TRUE);	
  	}

  	public function getUsers() {
  		$this->lodidb->order_by('username','asc');
  		$query = $this->lodidb->get('users');
  		return $query->result_array();
  	}

  	public function getNumberOfUsers($range) {
  		$apknumber = $this->getArray($range,'APK_Compile');
  		$kryptonmultinumber = $this->getArray($range,'kryptonmulti');
  		$mygicamultiumber = $this->getArray($range,'mygicamulti');
	    $array = array_unique (array_merge ($apknumber, $kryptonmultinumber, $mygicamultiumber));
	    return count($array);
  	}

  	private function getArray($range,$table) {
  		switch($range){
  			case 'today':
  				$today = date('Y-m-d');
  				$this->lodidb->distinct();
  				$this->lodidb->select('email');
  				$query = $this->lodidb->like('Date_Of_Purchase',$today,'after')->get($table);
  				$result = $query->result_array();
  				$final = array();
  				foreach ($result as $key=>$value) {
  					$final[] = $value['email'];		
  				}
  				return $final;
  				break;
  			case 'thismonth':
  				$month = date('Y-m');
  				$this->lodidb->distinct();
  				$this->lodidb->select('email');
  				$query = $this->lodidb->like('Date_Of_Purchase',$month,'after')->get($table);
  				$result = $query->result_array();
  				$final = array();
  				foreach ($result as $key=>$value) {
  					$final[] = $value['email'];		
  				}
  				return $final;
  				break;
  			case 'thisweek':
				$today=date('Y-m-d');
				$day2=(date('D')=='Mon')?date('Y-m-d'):date('Y-m-d',strtotime("previous monday"));
  				$this->lodidb->distinct();
  				$this->lodidb->select('email');
          		$this->lodidb->where('Date_Of_Purchase>=',$day2);
          		$this->lodidb->where('Date_Of_Purchase<=',$today);
  				$query = $this->lodidb->get($table);
  				$result = $query->result_array();
  				$final = array();
  				foreach ($result as $key=>$value) {
  					$final[] = $value['email'];		
  				}
  				return $final;
  				break; 
	        case 'all':
	          $this->lodidb->distinct();
	          $this->lodidb->select('email');
	          //$this->lodidb->where('Date_Of_Purchase>=','2016-01-01');
	          $this->lodidb->where('Date_Of_Purchase IS NOT NULL', null, false);
	          $query = $this->lodidb->get($table);
	          $result = $query->result_array();
	          $final = array();
	          foreach ($result as $key=>$value) {
	            $final[] = $value['email'];   
	          }
	          return $final;
	          break;             				  				
	  		}
  	}

    public function lookupUser($user) {
      $this->lodidb->where('username',$user);
      return $this->lodidb->get('users')->result_array()[0];
    }

    public function numOfBuilds($user) {
        return $this->numBuilds($user,'APK_Compile') + $this->numBuilds($user,'kryptonmulti') + $this->numBuilds($user,'mygicamulti');
    }

    private function numBuilds($user,$table) {
      $this->lodidb->where('email',$user);
      return $this->lodidb->get($table)->num_rows();
    }

    public function numberOfHits($user) {
      $this->hitsdb->where('email',$user);
      $this->hitsdb->select('SUM(number_of_hits) as hits');
      $this->hitsdb->group_by('email');
      return $this->hitsdb->get('lodibuilder_table')->result_array()[0];
    }


}