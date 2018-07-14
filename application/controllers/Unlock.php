<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unlock extends MY_Controller {

	private $username;
	private $apikey = "sk_test_QwPqtekpknfxeIG178lpr3wD";
	private $status;

	public function __Construct()
	{
		parent::__Construct();
		if ($_SESSION['username']=='Rooty') {
			redirect('http://appy.zone','refresh');
		}
		$this->username = $_SESSION['username'] == 'FissNew' ? 'appy' : $_SESSION['username'];
		$this->load->model('playlistmodel');
		$this->status = $this->playlistmodel->getUnlockStatus($this->username);		
	}	

	public function index() {
		if($this->status==0) {
			$data['username'] = $this->username;
			$this->load->view('iptvunlock', $data);
		}
		else {
			redirect('playlist');
		}
	}

	public function devjob() {

		$this->form_validation->set_rules('cost','Monthly IPTV Cost','required|trim');
		$this->form_validation->set_rules('annual','Annual IPTV Cost','required|trim');
		$this->form_validation->set_rules('checkyes','IPTV Free Trial','required');
		$this->form_validation->set_rules('checkno','IPTV Free Trial','required');

		if($this->form_validation->run()==FALSE)
		{
        	$this->output->set_content_type('application/json')//return json array
             ->set_output(json_encode(array('success' => 0, 'error' => 'You must provide all details')));			
		}
		else {
			if ($this->input->post('ppusername') != '' && $this->input->post('pppassword') != '') {
				if ($this->input->post('secret') != '' || $this->input->post('public') != '') {
        			$this->output->set_content_type('application/json')//return json array
             			->set_output(json_encode(array('success' => 0, 'error' => 'You must provide either Stripe or Paypal details')));					
				}
				else {
					$this->makeDevJobFile('paypal');
					$this->load->model('playlistmodel');
					$this->playlistmodel->unlockIPTV($this->username);
					$_SESSION['unlocked'] = 'set';
				    $this->output->set_content_type('application/json')//return json array
				         ->set_output(json_encode(array('success' => 1, 'data' => 'Success')));					
				}
			}
			else if($this->input->post('secret') != '' && $this->input->post('public') != '') {
				if ($this->input->post('ppusername') != '' || $this->input->post('pppassword') != '') {
    					$this->output->set_content_type('application/json')//return json array
         					->set_output(json_encode(array('success' => 0, 'error' => 'You must provide either Stripe or Paypal details')));						
				}
				else {
					$this->makeDevJobFile('stripe');
					$this->load->model('playlistmodel');
					$this->playlistmodel->unlockIPTV($this->username);	
					$_SESSION['unlocked'] = 'set';				
				    $this->output->set_content_type('application/json')//return json array
				         ->set_output(json_encode(array('success' => 1, 'data' => 'Success')));					
				}
			}
			else {
        		$this->output->set_content_type('application/json')//return json array
             		->set_output(json_encode(array('success' => 0, 'error' => 'You must provide either Stripe or Paypal details')));				
			}
		}		
	    // $this->output->set_content_type('application/json')//return json array
	    //      ->set_output(json_encode(array('success' => 1, 'data' => $_POST)));		
	}


	private function makeDevJobFile($type) {

		$this->load->model('playlistmodel');
		$appname = $this->playlistmodel->getAppName($this->username);		
		//Appname: ime appa
		$file="/var/www/html/Jobs/".$this->username."_iptvunlock" . ".txt";
		write_file($file, 'Appy Zone Folder: http://www.appy.zone/'. $this->username . '/iptv' . "\n", "a+");	
		write_file($file, 'App Name: '. $appname . "\n", "a+");
		write_file($file, 'Monthly IPTV Cost: '. $this->input->post('cost') . "\n", "a+");
		write_file($file, 'Annual IPTV Cost: '. $this->input->post('annual') . "\n", "a+");
		if ($this->input->post('checkyes')) {
			write_file($file, 'IPTV Free Trial: Yes'. "\n", "a+");
			write_file($file, 'Free Trial Length: '. $this->input->post('duration') . ' ' . $this->input->post('freetrialtype') . "\n", "a+");			
		}
		else {
			write_file($file, 'IPTV Free Trial: No'. "\n", "a+");
		}	
		if ($type=='paypal') {
			write_file($file, 'Paypal username: '. $this->input->post('ppusername') . "\n", "a+");
			write_file($file, 'Paypal password: '. $this->input->post('pppassword') . "\n", "a+");
		} 
		else {
			write_file($file, 'Stripe secret key: '. $this->input->post('secret') . "\n", "a+");
			write_file($file, 'Stripe public key: '. $this->input->post('public') . "\n", "a+");
		}
		return;				
	}

}