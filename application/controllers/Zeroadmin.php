<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include('Appy.php');

class Zeroadmin extends Appy {

	public function __Construct()
	{
		parent::__Construct();
		if ($_SESSION['username']=='Rooty') {
			redirect('http://appy.zone','refresh');
		}		
		$this->username = $_SESSION['username'] == 'FissNew' ? 'appy' : $_SESSION['username'];
		$this->userkodiLocation = $this->basepath . $this->username . '/V5/kodi/builds.txt';
		if ($this->username != 'appy') {
			$this->userappsLocation = $this->basepath . $this->username . '/V5/apps/apps.txt';
		}
		else {
			$this->userappsLocation = $this->masterappsLocation;
			//$this->masterappsLocation = '/var/www/appy.zone/public_html/';
		}
		if (!is_dir($this->basepath . $this->username . '/V5')) {
			mkdir($this->basepath . $this->username . '/V5',0777,true);
		}
	}

	public function mainmenuupload() {

		$this->form_validation->set_rules('title1','IPTV Menu Title','trim|alpha_dash_space');	

		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else {
			$this->load->library('upload');
			$error = array();
			$files = $_FILES;
			if (isset($files['files']['name'][0])) 
			{

				$_FILES['files']['name'] = $files['files']['name'][0];
				$_FILES['files']['type'] = $files['files']['type'][0];
				$_FILES['files']['tmp_name'] = $files['files']['tmp_name'][0];
				$_FILES['files']['error'] = $files['files']['error'][0];
				$_FILES['files']['size'] = $files['files']['size'][0];	

				$config['upload_path'] = $this->basepath . $this->username . "/V5";
				$config['allowed_types'] = 'png';
				$config['max_size'] = '5120';
				$config['max_widht'] = '1920';
				$config['max_height'] = '1080';
				$config['overwrite'] = TRUE;
				$config['remove_spaces'] = TRUE;
				$config['file_name'] = "bg.png";

				$this->upload->initialize($config);

				if(!$this->upload->do_upload('files')) {
					$error['error'] = $this->upload->display_errors();		
				}
				else {

				}
			}
			elseif(!isset($files['files']['name'][0]) && !file_exists('/var/www/appy.zone/public_html/' . $this->username . "/V5/bg.png"))
			{
				exit("Please upload background image");
			}	
			if(!empty($error)) {
				exit($error['error']);					
			}
			else{
				$this->formatImage($this->basepath . $this->username . "/V5/bg.png",1920,1080,"png",$this->basepath . $this->username . "/V5/bg.png");


				if (!is_dir($this->basepath . $this->username . '/V5/menu')) {
					mkdir($this->basepath . $this->username . '/V5/menu',0777,true);
				}

				write_file($this->basepath . $this->username . '/V5/menu/title.txt', $this->titles(1), 'w+');
				write_file($this->basepath . $this->username . '/V5/menu/action.txt', $this->actions(1), 'w+');

				exit("success");
			}					
					
		}				
	}

	public function homeupload() {
		$this->form_validation->set_rules('hexcolor','Color','trim|hexcheck');
		$this->form_validation->set_rules('title1','Title1','trim|alpha_dash_space');
		$this->form_validation->set_rules('title2','Title2','trim|alpha_dash_space');

		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}	
		else {

			$this->createFolder('home');
			if (!is_dir($this->basepath . $this->username . '/V5/home/banner')) {
				mkdir($this->basepath . $this->username . '/V5/home/banner',0777,true);				
			}

			$this->load->library('upload');
			$error = array();
			$files = $_FILES;


			if (isset($files['files']['name'][0])) 
			{			
				$_FILES['files']['name'] = $files['files']['name'][0];
				$_FILES['files']['type'] = $files['files']['type'][0];
				$_FILES['files']['tmp_name'] = $files['files']['tmp_name'][0];
				$_FILES['files']['error'] = $files['files']['error'][0];
				$_FILES['files']['size'] = $files['files']['size'][0];	

				$config['upload_path'] = $this->basepath . $this->username . "/V5/home/banner";
				$config['allowed_types'] = 'png';
				$config['max_size'] = '5120';
				$config['max_widht'] = '1920';
				$config['max_height'] = '1080';
				$config['overwrite'] = TRUE;
				$config['remove_spaces'] = TRUE;
				$config['file_name'] = "image.png";

				$this->upload->initialize($config);

				if(!$this->upload->do_upload('files')) {
					$error['error'] = $this->upload->display_errors();		
				}
				else {

				}
			}
			elseif(!isset($files['files']['name'][0]) && !file_exists('/var/www/appy.zone/public_html/' . $this->username . "/V5/home/banner/image.png"))
			{
				exit("Please upload banner image");
			}				
			if(!empty($error)) {
				exit($error['error']);					
			}
			else{
				$statusCheck = 0;
				if ($this->input->post('checkstatus')=='true') {
					$statusCheck = 1;
				}
				$this->formatImage($this->basepath . $this->username . "/V5/home/banner/image.png",1920,350,"png",$this->basepath . $this->username . "/V5/home/banner/image.png");

				write_file($this->basepath . $this->username . '/V5/home/title.txt', $this->titles($this->input->post('rows')), 'w+');
				write_file($this->basepath . $this->username . '/V5/home/action.txt', $this->actions($this->input->post('rows')), 'w+');
				write_file($this->basepath . $this->username . '/V5/home/banner/button.txt', $statusCheck, 'w+');
				write_file($this->basepath . $this->username . '/V5/home/banner/action.txt', $this->input->post('action')=='' ? 0 : $this->input->post('action'), 'w+');
				if ($this->input->post('action')==3) {
					write_file($this->basepath . $this->username . '/V5/home/banner/web.txt', $this->input->post('url'), 'w+');		
				}
				else if($this->input->post('action')==2) {
					write_file($this->basepath . $this->username . '/V5/home/banner/url.txt', $this->input->post('url'), 'w+');	
					write_file($this->basepath . $this->username . '/V5/home/banner/package.txt', $this->input->post('package'), 'w+');						
				}
				write_file($this->basepath . $this->username . '/V5/home/rows.txt', $this->input->post('rows'), 'w+');
				write_file($this->basepath . $this->username . '/V5/home/font.txt', $this->input->post('hexcolor'), 'w+');							
				exit("success");
			}					
					
		}					
	}				

}	