<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iptvcontrol extends MY_Controller {

	private $username;
	private $populatevalues = ['all','current','last','01','02','03','04','05','06','07','08','09','10','11','12'];

	public function __Construct()
	{
		parent::__Construct();
		$this->username = $_SESSION['username'];
		if ($this->username != 'FissNew') {
			redirect('http://appy.zone/appynew','refresh');
		}
	}

	public function review() {
		$data = $this->getAllData('all');
		$this->load->view('incomereview', $data);
	}

	public function populatedata() {
		if (!in_array($this->input->post('type'), $this->populatevalues)) {
        	$this->output->set_content_type('application/json')->set_output(json_encode(array('success' => 0, 'error' => 'Wrong input')));			
		}
		else if ($this->input->post('type') != 'all' && $this->input->post('type') != 'current' && $this->input->post('type') != 'last' && $this->input->post('type') > date('m')) {
        	$this->output->set_content_type('application/json')->set_output(json_encode(array('success' => 0, 'error' => 'Wrong input')));
		}
		else {
			$this->load->model('stats');
			$data = $this->getAllData($this->input->post('type'));
        	$this->output->set_content_type('application/json')->set_output(json_encode(array('success' => 1, 'data' => $data)));

		}

  	}

  	private function getAllData($type) {

  		$num['numCreditsStripe'] = 0;
  		$num['valueCreditsStripe'] = 0;
  		$num['numCreditsPaypal'] = 0;
  		$num['valueCreditsPaypal'] = 0;
  		$num['numCreditsManual'] = 0;
  		$num['valueCreditsManual'] = 0;

  		$num['numUsersStripe'] = 0;
  		$num['valueUsersStripe'] = 0;
  		$num['numUsersPaypal'] = 0;
  		$num['valueUsersPaypal'] = 0;  		

  		$this->load->model('stats');
		$credits = $this->stats->numCredits($type);
		$users = $this->stats->numFissUsers($type);

		foreach ($credits as $value) {
			if ($value['type']=='credits:stripe') {
				$num['numCreditsStripe'] += $value['amount'];
				$num['valueCreditsStripe'] += $value['value'];
			}
			else if ($value['type']=='credits:paypal') {
				$num['numCreditsPaypal'] += $value['amount'];
				$num['valueCreditsPaypal'] += $value['value'];
			}
			else if ($value['type']=='manual') {
				$num['numCreditsManual'] += $value['amount'];
				$num['valueCreditsManual'] += $value['value'];
			}
		}

		foreach ($users as $value) {
			if ($value['type']=='stripe') {
				$num['numUsersStripe'] += $value['amount'];
				$num['valueUsersStripe'] += $value['value'];
			}
			else if ($value['type']=='paypal') {
				$num['numUsersPaypal'] += $value['amount'];
				$num['valueUsersPaypal'] += $value['value'];
			}
		}  

		$data['numcredits'] = $num['numCreditsStripe'] + $num['numCreditsPaypal'] + $num['numCreditsManual'];
		$data['valuecredits'] = $num['valueCreditsStripe'] + $num['valueCreditsPaypal'] + $num['valueCreditsManual'];
		$data['numusers'] = $num['numUsersStripe'] + $num['numUsersPaypal'];
		$data['valueusers'] = $num['valueUsersStripe'] + $num['valueUsersPaypal'];
		$y = 0.8 * ($num['valueUsersStripe'] + $num['valueCreditsStripe']);
		$z = $y * 1.4 / 100;
		$data['stripefees'] = round(($num['valueUsersStripe'] + $num['valueCreditsStripe']) - ($y-$z),2);
		$y = 0.8 * ($num['valueUsersPaypal'] + $num['valueCreditsPaypal']);
		$z = $y * 3.4 / 100;		
		$data['paypalfees'] = round(($num['valueUsersPaypal'] + $num['valueCreditsPaypal']) - ($y-$z),2);
		$data['partnerfees'] = round(($data['valueusers'] + $data['valuecredits'] - $data['stripefees'] - $data['paypalfees']) * 0.6,2);
		$data['total'] = round(($data['valueusers'] + $data['valuecredits'] - $data['stripefees'] - $data['paypalfees']) * 0.4,2);

		return $data;

  	}
  	public function manualedit()
  	{
  		$this->load->model('stats');
  		$data['appnames']=$this->stats->appnames();
  		$this->load->view('manualcredits',$data);
  	}
  	public function addcredits()
  	{
  		$appname=$this->input->post('appname');
  		$credits=$this->input->post('credits');
  		$value=$this->input->post('value');
  		$this->load->model('stats');
  		$num=$this->stats->addcredits($appname,$credits,$value);
  		if($num==1)
  		   	$this->output->set_content_type('application/json')->set_output(json_encode(array('success' => 1)));
  	 	else
  	    	$this->output->set_content_type('application/json')->set_output(json_encode(array('success' => 0)));
  	}

  	public function populatedatamanual() {
		if (!in_array($this->input->post('type'), $this->populatevalues)) {
        	$this->output->set_content_type('application/json')->set_output(json_encode(array('success' => 0, 'error' => 'Wrong input')));			
		}
		else if ($this->input->post('type') != 'all' && $this->input->post('type') != 'current' && $this->input->post('type') != 'last' && $this->input->post('type') > date('m')) {
        	$this->output->set_content_type('application/json')->set_output(json_encode(array('success' => 0, 'error' => 'Wrong input')));
		}
		else {
			$this->load->model('stats');
			$data = $this->stats->numCreditsmanual($this->input->post('type'));
        	$this->output->set_content_type('application/json')->set_output(json_encode(array('success' => 1, 'data' => $data)));

		}

  	}
  	public function iptvaccess()
  	{
  		$this->load->view('iptvaccess2');
  	} 

}