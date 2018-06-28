<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stats extends MY_Model {

	private $localdb;
  private $table = 'stats';
	private $table2 = 'clients';
	private $username = 'bogdan';

	public function __Construct()
	{
		parent::__Construct();
		$this->localdb = $this->load->database($this->localconfig,TRUE);
  	}

  	public function numFissUsers($type) {
  		$ind=0;
  		$this->localdb->where('username', $this->username);
  		$this->localdb->where('user<>', '');
  		if ($type=='current') {
	  		$month=date('Y-m');
  		}
  		else if($type=='last') {
  			$month = date('Y-m', strtotime("-1 month"));
  		}
  		else if ($type=='all') {
  			$ind = 1;
  		}
  		else {
  			$month = date('Y') . '-' . $type;
  		}
  		if ($ind==0) {
  			 $this->localdb->where('substring(exp_date,1,7)',$month);
  		}
  		$this->localdb->select('count(*) as amount,SUM(cvalue) as value, type', FALSE);
  		$this->localdb->group_by('type'); 
  		$this->localdb->order_by('type'); 
  		$query = $this->localdb->get($this->table); 	
  		return $query->result_array();
  	}

  	public function numCredits($type) {
  		$ind = 0;
  		$this->localdb->where('user', '');
  		if ($type=='current') {
	  		$month=date('Y-m');
  		}
  		else if($type=='last') {
  			$month = date('Y-m', strtotime("-1 month"));
  		}
  		else if ($type=='all') {
  			$ind = 1;
  		}
  		else {
  			$month = date('Y') . '-' . $type;
  		}
  		if ($ind==0) {
  			 $this->localdb->where('substring(exp_date,1,7)',$month);
  		}
  		$this->localdb->select('SUM(credits) as amount,SUM(cvalue) as value, type', FALSE);
  		$this->localdb->group_by('type'); 
  		$this->localdb->order_by('type'); 
  		$query = $this->localdb->get($this->table);  	
  		return $query->result_array();	
  	}

    public function appnames()
    {
      $query="select username from clients";
      $query=$this->localdb->query($query);
      return $query->result_array();
    }
    public function addcredits($appname,$credits,$value)
    {
       $datum=date("Y-m-d H:i:s");
       $query1="insert into stats values('$appname',$credits,'manual','','$datum',$value)";
       $this->localdb->query($query1);
       if($this->localdb->affected_rows() == 1)
       {
         $query2="update clients set iptvcredits=iptvcredits+$credits where username='$appname'";
          $this->localdb->query($query2);
          return 1;
        }
       else {return 0;}
    }
    public function numCreditsmanual($type) {
      $ind = 0;
      if ($type=='current') {
        $month=date('Y-m');
      }
      else if($type=='last') {
        $month = date('Y-m', strtotime("-1 month"));
      }
      else if ($type=='all') {
        $ind = 1;
      }
      else {
        $month = date('Y') . '-' . $type;
      }
      if ($ind==0) {
         $this->localdb->where('substring(exp_date,1,7)',$month);
      }
      $this->localdb->select('SUM(credits) as amount,SUM(cvalue) as value, type', FALSE);
      $this->localdb->where('type','manual');
      $this->localdb->group_by('type'); 
      $this->localdb->order_by('type'); 
      $query = $this->localdb->get($this->table);   
      return $query->result_array();  
    }

}