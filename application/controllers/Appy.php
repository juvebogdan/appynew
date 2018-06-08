<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appy extends MY_Controller {

	private $basepath = '/var/www/appy.zone/public_html/';
	private $basepath2 = '/var/www/html/Edits/';
	private $basepath3 = '/var/www/html/TempEdits/';
	private $username;
	private $masterkodiLocation = '/var/www/appy.zone/public_html/appy/V5/master/kodi/builds.txt';
	private $masterappsLocation = '/var/www/appy.zone/public_html/appy/V5/master/apps/apps.txt';
	private $userkodiLocation;
	private $userappsLocation;
	private $admin = 'appy';

	public function __Construct()
	{
		parent::__Construct();
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

	
	private function formatImage($putanja,$width,$height,$type,$savepath)
	{
		$params = array(
				"putanja" => $putanja,
				"width" => $width,
				"height" => $height,
				"type" => $type,
				"savepath" => $savepath
			);

		$this->load->library('slika',$params);
		$this->slika->obradiSliku();
	}

	public function index() {
		$data['user'] = $this->username;
		if ($this->username != 'guest') {
			$this->load->view('ultimatehome',$data);
		} 
		else {
			$this->load->view('fake',$data);
		}
	}

	public function menu() {
		if (file_exists($this->basepath . $this->username . '/V5/menu/title.txt')) {
			$data['titles'] = file($this->basepath . $this->username . '/V5/menu/title.txt');
		}
		else {
			$data['titles'] = $this->emptyArray(4);
		}
		if (file_exists($this->basepath . $this->username . '/V5/menu/action.txt')) {
			$data['actions'] = file($this->basepath . $this->username . '/V5/menu/action.txt');
		}
		else {
			$data['actions'] = $this->emptyArray(4);
		}
		if ($this->username != 'guest') {
			$this->load->view('mainmenu',$data);
		} 						
	}

	public function home() {

		if (file_exists($this->basepath . $this->username . '/V5/home/banner/action.txt')) {
			$data['banneraction'] = file($this->basepath . $this->username . '/V5/home/banner/action.txt');
		}
		else {
			$data['banneraction'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/home/banner/url.txt')) {
			$data['url'] = file($this->basepath . $this->username . '/V5/home/banner/url.txt');
		}
		else {
			$data['url'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/home/banner/web.txt')) {
			$data['weburl'] = file($this->basepath . $this->username . '/V5/home/banner/web.txt');
		}
		else {
			$data['weburl'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/home/banner/package.txt')) {
			$data['package'] = file($this->basepath . $this->username . '/V5/home/banner/package.txt');
		}
		else {
			$data['package'] = $this->emptyArray(1);
		}								
		if (file_exists($this->basepath . $this->username . '/V5/home/title.txt')) {
			$data['titles'] = file($this->basepath . $this->username . '/V5/home/title.txt');
		}
		else {
			$data['titles'] = $this->emptyArray(5);
		}
		if (file_exists($this->basepath . $this->username . '/V5/home/action.txt')) {
			$data['actions'] = file($this->basepath . $this->username . '/V5/home/action.txt');
		}
		else {
			$data['actions'] = $this->emptyArray(5);
		}
		if (file_exists($this->basepath . $this->username . '/V5/home/font.txt')) {
			$data['font'] = file($this->basepath . $this->username . '/V5/home/font.txt');
		}
		else {
			$data['font'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/home/banner/button.txt')) {
			$data['checkboxstate'] = file($this->basepath . $this->username . '/V5/home/banner/button.txt');
		}
		else {
			$data['checkboxstate'] = 0;
		}
		if (file_exists($this->basepath . $this->username . '/V5/home/rows.txt')) {
			$data['rows'] = file($this->basepath . $this->username . '/V5/home/rows.txt');
		}
		else {
			$data['rows'] = 1;
		}								
		if ($this->username != 'guest') {
			$this->load->view('home',$data);
		}
	}

	public function iptv() {
		if (file_exists($this->basepath . $this->username . '/V5/iptv/banner/action.txt')) {
			$data['banneraction'] = file($this->basepath . $this->username . '/V5/iptv/banner/action.txt');
		}
		else {
			$data['banneraction'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/iptv/banner/url.txt')) {
			$data['url'] = file($this->basepath . $this->username . '/V5/iptv/banner/url.txt');
		}
		else {
			$data['url'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/iptv/banner/web.txt')) {
			$data['weburl'] = file($this->basepath . $this->username . '/V5/iptv/banner/web.txt');
		}
		else {
			$data['weburl'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/iptv/banner/package.txt')) {
			$data['package'] = file($this->basepath . $this->username . '/V5/iptv/banner/package.txt');
		}
		else {
			$data['package'] = $this->emptyArray(1);
		}								
		if (file_exists($this->basepath . $this->username . '/V5/iptv/title.txt')) {
			$data['titles'] = file($this->basepath . $this->username . '/V5/iptv/title.txt');
		}
		else {
			$data['titles'] = $this->emptyArray(5);
		}
		if (file_exists($this->basepath . $this->username . '/V5/iptv/action.txt')) {
			$data['actions'] = file($this->basepath . $this->username . '/V5/iptv/action.txt');
		}
		else {
			$data['actions'] = $this->emptyArray(5);
		}
		if (file_exists($this->basepath . $this->username . '/V5/iptv/font.txt')) {
			$data['font'] = file($this->basepath . $this->username . '/V5/iptv/font.txt');
		}
		else {
			$data['font'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/iptv/banner/button.txt')) {
			$data['checkboxstate'] = file($this->basepath . $this->username . '/V5/iptv/banner/button.txt');
		}
		else {
			$data['checkboxstate'] = 0;
		}
		if (file_exists($this->basepath . $this->username . '/V5/iptv/rows.txt')) {
			$data['rows'] = file($this->basepath . $this->username . '/V5/iptv/rows.txt');
		}
		else {
			$data['rows'] = 1;
		}								
		if ($this->username != 'guest') {
			$this->load->view('iptv',$data);
		}
	}

	public function kodibuilds() {
		
		$this->load->model('kodihubmodel');
		if($this->username=='appy') {
			$data['autocomplete'] = $this->kodihubmodel->getAutocomplete('FissNew');			
		}
		else {
			$data['autocomplete'] = $this->kodihubmodel->getAutocomplete($this->username);
		}

		if (file_exists($this->basepath . $this->username . '/V5/kodi/banner/action.txt')) {
			$data['banneraction'] = file($this->basepath . $this->username . '/V5/kodi/banner/action.txt');
		}
		else {
			$data['banneraction'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/kodi/banner/url.txt')) {
			$data['url'] = file($this->basepath . $this->username . '/V5/kodi/banner/url.txt');
		}
		else {
			$data['url'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/kodi/banner/web.txt')) {
			$data['weburl'] = file($this->basepath . $this->username . '/V5/kodi/banner/web.txt');
		}
		else {
			$data['weburl'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/kodi/banner/package.txt')) {
			$data['package'] = file($this->basepath . $this->username . '/V5/kodi/banner/package.txt');
		}
		else {
			$data['package'] = $this->emptyArray(1);
		}								
		if (file_exists($this->basepath . $this->username . '/V5/kodi/title.txt')) {
			$data['titles'] = file($this->basepath . $this->username . '/V5/kodi/title.txt');
		}
		else {
			$data['titles'] = $this->emptyArray(5);
		}
		if (file_exists($this->basepath . $this->username . '/V5/kodi/font.txt')) {
			$data['font'] = file($this->basepath . $this->username . '/V5/kodi/font.txt');
		}
		else {
			$data['font'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/kodi/banner/button.txt')) {
			$data['checkboxstate'] = file($this->basepath . $this->username . '/V5/kodi/banner/button.txt');
		}
		else {
			$data['checkboxstate'] = 0;
		}
		if (file_exists($this->basepath . $this->username . '/V5/kodi/rows.txt')) {
			$data['rows'] = file($this->basepath . $this->username . '/V5/kodi/rows.txt');
		}
		else {
			$data['rows'] = 1;
		}	
		if (file_exists($this->masterkodiLocation) && !file_exists($this->userkodiLocation)) {
			$data['builds'] = file($this->masterkodiLocation);
			$builds = $data['builds'];
			$data['buildimages'] = array();
			$data['buildtitles'] = array();
			$data['buildsizes'] = array();
			for ($i=0; $i < count($builds); $i++) {
				$parsedBuild = explode(';',$builds[$i]);
				array_push($data['buildimages'],$parsedBuild[0]);
				array_push($data['buildtitles'],$parsedBuild[1]);
				array_push($data['buildsizes'],round($parsedBuild[3]*9.5367431640625/10000000),1);
			}
		}
		else if (!file_exists($this->masterkodiLocation) && file_exists($this->userkodiLocation)) {
			$data['builds'] = file($this->userkodiLocation);
			$builds = $data['builds'];
			$data['buildimages'] = array();
			$data['buildtitles'] = array();
			$data['buildsizes'] = array();
			for ($i=0; $i < count($builds); $i++) {
				$parsedBuild = explode(';',$builds[$i]);
				array_push($data['buildimages'],$parsedBuild[0]);
				array_push($data['buildtitles'],$parsedBuild[1]);
				array_push($data['buildsizes'],round($parsedBuild[3]*9.5367431640625/10000000),1);
			}
		}
		else if (file_exists($this->masterkodiLocation) && file_exists($this->userkodiLocation)) {
			$masterbuilds = file($this->masterkodiLocation);
			$userbuilds = file($this->userkodiLocation);
			$data['builds'] = array_merge($masterbuilds,$userbuilds);
			$builds = $data['builds'];
			$data['buildimages'] = array();
			$data['buildtitles'] = array();
			$data['buildsizes'] = array();
			for ($i=0; $i < count($builds); $i++) {
				$parsedBuild = explode(';',$builds[$i]);
				array_push($data['buildimages'],$parsedBuild[0]);
				array_push($data['buildtitles'],$parsedBuild[1]);
				array_push($data['buildsizes'],round($parsedBuild[3]*9.5367431640625/10000000),1);
			}
		}							
		if ($this->username != 'guest') {
			$this->load->view('kodibuilds',$data);
		}
	}

	public function apps() {
		if (file_exists($this->basepath . $this->username . '/V5/apps/banner/action.txt')) {
			$data['banneraction'] = file($this->basepath . $this->username . '/V5/apps/banner/action.txt');
		}	
		else {
			$data['banneraction'] = $this->emptyArray(1);
		}			
		if (file_exists($this->basepath . $this->username . '/V5/apps/banner/url.txt')) {
			$data['url'] = file($this->basepath . $this->username . '/V5/apps/banner/url.txt');
		}
		else {
			$data['url'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/apps/banner/web.txt')) {
			$data['weburl'] = file($this->basepath . $this->username . '/V5/apps/banner/web.txt');
		}
		else {
			$data['weburl'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/apps/banner/package.txt')) {
			$data['package'] = file($this->basepath . $this->username . '/V5/apps/banner/package.txt');
		}
		else {
			$data['package'] = $this->emptyArray(1);
		}								
		if (file_exists($this->basepath . $this->username . '/V5/apps/title.txt')) {
			$data['titles'] = file($this->basepath . $this->username . '/V5/apps/title.txt');
		}
		else {
			$data['titles'] = $this->emptyArray(5);
		}
		if (file_exists($this->basepath . $this->username . '/V5/apps/font.txt')) {
			$data['font'] = file($this->basepath . $this->username . '/V5/apps/font.txt');
		}
		else {
			$data['font'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/apps/banner/button.txt')) {
			$data['checkboxstate'] = file($this->basepath . $this->username . '/V5/apps/banner/button.txt');
		}
		else {
			$data['checkboxstate'] = 0;
		}
		if (file_exists($this->basepath . $this->username . '/V5/apps/rows.txt')) {
			$data['rows'] = file($this->basepath . $this->username . '/V5/apps/rows.txt');
		}
		else {
			$data['rows'] = 1;
		}	
		if (file_exists($this->masterappsLocation) && !file_exists($this->userappsLocation)) {
			$data['builds'] = file($this->masterappsLocation);
			$builds = $data['builds'];
			$data['buildimages'] = array();
			$data['buildtitles'] = array();
			$data['buildsizes'] = array();
			for ($i=0; $i < count($builds); $i++) {
				$parsedBuild = explode(';',$builds[$i]);
				array_push($data['buildimages'],$parsedBuild[0]);
				array_push($data['buildtitles'],$parsedBuild[1]);
				array_push($data['buildsizes'],round($parsedBuild[3]*9.5367431640625/10000000),1);
			}
		}
		else if (!file_exists($this->masterappsLocation) && file_exists($this->userappsLocation)) {
			$data['builds'] = file($this->userappsLocation);
			$builds = $data['builds'];
			$data['buildimages'] = array();
			$data['buildtitles'] = array();
			$data['buildsizes'] = array();
			for ($i=0; $i < count($builds); $i++) {
				$parsedBuild = explode(';',$builds[$i]);
				array_push($data['buildimages'],$parsedBuild[0]);
				array_push($data['buildtitles'],$parsedBuild[1]);
				array_push($data['buildsizes'],round($parsedBuild[3]*9.5367431640625/10000000),1);
			}
		}
		else if (file_exists($this->masterappsLocation) && file_exists($this->userappsLocation) && $this->username!='appy') {
			$masterbuilds = file($this->masterappsLocation);
			$userbuilds = file($this->userappsLocation);
			$data['builds'] = array_merge($masterbuilds,$userbuilds);
			$builds = $data['builds'];
			$data['buildimages'] = array();
			$data['buildtitles'] = array();
			$data['buildsizes'] = array();
			for ($i=0; $i < count($builds); $i++) {
				$parsedBuild = explode(';',$builds[$i]);
				array_push($data['buildimages'],$parsedBuild[0]);
				array_push($data['buildtitles'],$parsedBuild[1]);
				array_push($data['buildsizes'],round($parsedBuild[3]*9.5367431640625/10000000),1);
			}
		}
		else {
			$data['builds'] = file($this->userappsLocation);
			$builds = $data['builds'];
			$data['buildimages'] = array();
			$data['buildtitles'] = array();
			$data['buildsizes'] = array();
			for ($i=0; $i < count($builds); $i++) {
				$parsedBuild = explode(';',$builds[$i]);
				array_push($data['buildimages'],$parsedBuild[0]);
				array_push($data['buildtitles'],$parsedBuild[1]);
				array_push($data['buildsizes'],round($parsedBuild[3]*9.5367431640625/10000000),1);
			}
		}
		//exit(print_r($data['builds']));	
		$data['username'] = $this->username;
		if ($this->username != 'guest') {
			$this->load->view('apps',$data);
		}
		//print_r($data);
	}

	public function gaming() {
		if (file_exists($this->basepath . $this->username . '/V5/gaming/banner/action.txt')) {
			$data['banneraction'] = file($this->basepath . $this->username . '/V5/gaming/banner/action.txt');
		}
		else {
			$data['banneraction'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/gaming/banner/url.txt')) {
			$data['url'] = file($this->basepath . $this->username . '/V5/gaming/banner/url.txt');
		}
		else {
			$data['url'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/gaming/banner/web.txt')) {
			$data['weburl'] = file($this->basepath . $this->username . '/V5/gaming/banner/web.txt');
		}
		else {
			$data['weburl'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/gaming/banner/package.txt')) {
			$data['package'] = file($this->basepath . $this->username . '/V5/gaming/banner/package.txt');
		}
		else {
			$data['package'] = $this->emptyArray(1);
		}								
		if (file_exists($this->basepath . $this->username . '/V5/gaming/banner/button.txt')) {
			$data['checkboxstate'] = file($this->basepath . $this->username . '/V5/gaming/banner/button.txt');
		}
		else {
			$data['checkboxstate'] = 0;
		}								
		if ($this->username != 'guest') {
			$this->load->view('gaming',$data);
		}
	}

	public function gaminguploads() {
		if ($this->username != 'guest') {
			$this->load->view('gaminguploads');
		}
	}

	public function kodiuploads() {
		if (file_exists($this->basepath . $this->username . '/V5/kodi/builds.txt')) {
			$data['builds'] = file($this->basepath . $this->username . '/V5/kodi/builds.txt');
		}
		else {
			$data['builds'] = $this->emptyArray(1);
		}
		if (file_exists($this->basepath . $this->username . '/V5/kodi/splash.png')) {
			$data['imgsplash'] = 'http://appy.zone/' . $this->username . '/V5/kodi/splash.png';
		}				
		if ($this->username != 'guest') {
			$this->load->view('kodiuploads',$data);
		}
	}

	public function appsupload() {
		if (file_exists($this->userappsLocation)) {
			$data['builds'] = file($this->userappsLocation);
		}
		else {
			$data['builds'] = $this->emptyArray(1);
		}		
		if ($this->username != 'guest') {
			$this->load->view('appsupload',$data);
		}
	}

	public function buyiptv() {
		if ($this->username != 'guest') {
			$this->load->view('buyiptv');
		}
	}

	public function buyvpncredits() {
		$this->load->model('devices');
		$credits = $this->devices->getVpnUsersCredits($this->username);
		$data = array();
		if (!empty($credits)) {
			$data['creditStatus'] = $credits[0]['saldo'];
		}
		if ($this->username != 'guest') {
			$this->load->view('buyvpncredits',$data);
		}		
	}	

	public function appedit() {
		if ($this->username != 'guest') {
			$this->load->view('appedit');
		}			
	}

	public function messageuser() {	
		if ($this->username != 'guest') {
			$this->load->view('messageuser');
		}		
	}

	public function ban() {
		if ($this->username != 'guest') {
			$this->load->view('ban');
		}			
	}

	public function stats() {
		//$this->output->enable_profiler(TRUE);
		$this->load->model('devices');
		$data['allusers'] = $this->devices->numallusers();
		$data['thismonth'] = $this->devices->numthismonth();
		$data['thisweek'] = $this->devices->numthisweek();
		$data['today'] = $this->devices->numtoday();
		if ($this->username != 'guest') {
			$this->load->view('stats',$data);
		}		
	}

	public function iptvaccess() {
		if ($this->username != 'guest') {
			$this->load->view('iptvaccess');
		}		
	}

	public function appupdate() {
		if ($this->username != 'guest') {
			$this->load->view('appupdate');
		}		
	}

	public function mainmenuupload() {

		$this->form_validation->set_rules('title1','Title1','trim|alpha_dash_space');
		$this->form_validation->set_rules('title2','Title2','trim|alpha_dash_space');
		$this->form_validation->set_rules('title3','Title3','trim|alpha_dash_space');
		$this->form_validation->set_rules('title4','Title4','trim|alpha_dash_space');
		$this->form_validation->set_rules('title5','Title5','trim|alpha_dash_space');	

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

				write_file($this->basepath . $this->username . '/V5/menu/title.txt', $this->titles(5), 'w+');
				write_file($this->basepath . $this->username . '/V5/menu/action.txt', $this->actions(5), 'w+');

				exit("success");
			}					
					
		}		
		
	}

	private function titles($num) {
		$str = trim($this->input->post('title1')) . "\r\n";
		for ($i=2;$i<=$num;$i++) {
			$str .= trim($this->input->post('title' . $i)) . "\r\n";
		}
		return $str;
	}

	private function actions($num) {
		$str = trim($this->input->post('action1')) . "\r\n";
		for ($i=2;$i<=$num;$i++) {
			$str .= trim($this->input->post('action' . $i)) . "\r\n";
		}
		return $str;
	}

	private function emptyArray($num) {
		$x = array();
		for ($i=1; $i<=$num; $i++) {
			array_push($x,"");
		}
		return $x;
	}

	public function homeupload() {
		$this->form_validation->set_rules('hexcolor','Color','trim|hexcheck');
		$this->form_validation->set_rules('title1','Title1','trim|alpha_dash_space');
		$this->form_validation->set_rules('title2','Title2','trim|alpha_dash_space');
		$this->form_validation->set_rules('title3','Title3','trim|alpha_dash_space');
		$this->form_validation->set_rules('title4','Title4','trim|alpha_dash_space');
		$this->form_validation->set_rules('title5','Title5','trim|alpha_dash_space');

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

	public function iptvupload() {
		$this->form_validation->set_rules('hexcolor','Color','trim|hexcheck');
		$this->form_validation->set_rules('title1','Title1','trim|alpha_dash_space');
		$this->form_validation->set_rules('title2','Title2','trim|alpha_dash_space');
		$this->form_validation->set_rules('title3','Title3','trim|alpha_dash_space');
		$this->form_validation->set_rules('title4','Title4','trim|alpha_dash_space');
		$this->form_validation->set_rules('title5','Title5','trim|alpha_dash_space');

		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}	
		else {

			$this->createFolder('iptv');
			if (!is_dir($this->basepath . $this->username . '/V5/iptv/banner')) {
				mkdir($this->basepath . $this->username . '/V5/iptv/banner',0777,true);				
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

				$config['upload_path'] = $this->basepath . $this->username . "/V5/iptv/banner";
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
			elseif(!isset($files['files']['name'][0]) && !file_exists('/var/www/appy.zone/public_html/' . $this->username . '/V5/iptv/banner/image.png'))
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
				$this->formatImage($this->basepath . $this->username . "/V5/iptv/banner/image.png",1920,350,"png",$this->basepath . $this->username . "/V5/iptv/banner/image.png");

				write_file($this->basepath . $this->username . '/V5/iptv/title.txt', $this->titles($this->input->post('rows')), 'w+');
				write_file($this->basepath . $this->username . '/V5/iptv/action.txt', $this->actions($this->input->post('rows')), 'w+');
				write_file($this->basepath . $this->username . '/V5/iptv/banner/button.txt', $statusCheck, 'w+');
				write_file($this->basepath . $this->username . '/V5/iptv/banner/action.txt', $this->input->post('action')=='' ? 0 : $this->input->post('action'), 'w+');
				if ($this->input->post('action')==3) {
					write_file($this->basepath . $this->username . '/V5/iptv/banner/web.txt', $this->input->post('url'), 'w+');		
				}
				else if($this->input->post('action')==2) {
					write_file($this->basepath . $this->username . '/V5/iptv/banner/url.txt', $this->input->post('url'), 'w+');	
					write_file($this->basepath . $this->username . '/V5/iptv/banner/package.txt', $this->input->post('package'), 'w+');						
				}
				write_file($this->basepath . $this->username . '/V5/iptv/rows.txt', $this->input->post('rows'), 'w+');
				write_file($this->basepath . $this->username . '/V5/iptv/font.txt', $this->input->post('hexcolor'), 'w+');							
				exit("success");
			}					
					
		}					
	}

	public function kodibuildsupload() {
		$this->form_validation->set_rules('hexcolor','Color','trim|hexcheck');
		$this->form_validation->set_rules('title1','Title1','trim|alpha_dash_space');
		$this->form_validation->set_rules('title2','Title2','trim|alpha_dash_space');
		$this->form_validation->set_rules('title3','Title3','trim|alpha_dash_space');
		$this->form_validation->set_rules('title4','Title4','trim|alpha_dash_space');
		$this->form_validation->set_rules('title5','Title5','trim|alpha_dash_space');

		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}	
		else {				
			$this->createFolder('kodi');
			if (!is_dir($this->basepath . $this->username . '/V5/kodi/banner')) {
				mkdir($this->basepath . $this->username . '/V5/kodi/banner',0777,true);				
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

				$config['upload_path'] = $this->basepath . $this->username . "/V5/kodi/banner";
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
			else if(!isset($files['files']['name'][0]) && !file_exists('/var/www/appy.zone/public_html/' . $this->username . '/V5/kodi/banner/image.png'))
			{
				exit("Please upload banner image");
			}	
			if(!empty($error)) {
				exit($error['error']);					
			}
			else{
				if ($this->input->post('autocomplete')=='false') {
					$statusCheck = 0;
					if ($this->input->post('checkstatus')=='true') {
						$statusCheck = 1;
					}
					$this->formatImage($this->basepath . $this->username . "/V5/kodi/banner/image.png",1920,350,"png",$this->basepath . $this->username . "/V5/kodi/banner/image.png");

					write_file($this->basepath . $this->username . '/V5/kodi/title.txt', $this->titles($this->input->post('rows')), 'w+');
					write_file($this->basepath . $this->username . '/V5/kodi/banner/button.txt', $statusCheck, 'w+');
					write_file($this->basepath . $this->username . '/V5/kodi/banner/action.txt', $this->input->post('action')=='' ? 0 : $this->input->post('action'), 'w+');
					if ($this->input->post('action')==3) {
						write_file($this->basepath . $this->username . '/V5/kodi/banner/web.txt', $this->input->post('url'), 'w+');		
					}
					else if($this->input->post('action')==2) {
						write_file($this->basepath . $this->username . '/V5/kodi/banner/url.txt', $this->input->post('url'), 'w+');	
						write_file($this->basepath . $this->username . '/V5/kodi/banner/package.txt', $this->input->post('package'), 'w+');						
					}
					write_file($this->basepath . $this->username . '/V5/kodi/rows.txt', $this->input->post('rows'), 'w+');
					write_file($this->basepath . $this->username . '/V5/kodi/font.txt', $this->input->post('hexcolor'), 'w+');	

					for ($i=1; $i<=5; $i++) {
						write_file($this->basepath . $this->username . '/V5/kodi/row' . $i . '.txt', $this->kodibuildsrows($i), 'w+');
					}
					$this->load->model('kodihubmodel');
					$this->kodihubmodel->autocomplete($this->username,0);
					exit('success');
				}
				else {
					$statusCheck = 0;
					if ($this->input->post('checkstatus')=='true') {
						$statusCheck = 1;
					}
					$this->formatImage($this->basepath . $this->username . "/V5/kodi/banner/image.png",1920,350,"png",$this->basepath . $this->username . "/V5/kodi/banner/image.png");	
					write_file($this->basepath . $this->username . '/V5/kodi/banner/button.txt', $statusCheck, 'w+');
					write_file($this->basepath . $this->username . '/V5/kodi/banner/action.txt', $this->input->post('action')=='' ? 0 : $this->input->post('action'), 'w+');
					if ($this->input->post('action')==3) {
						write_file($this->basepath . $this->username . '/V5/kodi/banner/web.txt', $this->input->post('url'), 'w+');		
					}
					else if($this->input->post('action')==2) {
						write_file($this->basepath . $this->username . '/V5/kodi/banner/url.txt', $this->input->post('url'), 'w+');	
						write_file($this->basepath . $this->username . '/V5/kodi/banner/package.txt', $this->input->post('package'), 'w+');						
					}
					write_file($this->basepath . $this->username . '/V5/kodi/rows.txt', '5', 'w+');
					write_file($this->basepath . $this->username . '/V5/kodi/font.txt', $this->input->post('hexcolor'), 'w+');
					$this->load->model('kodihubmodel');
					$most_downloaded = $this->kodihubmodel->getBuilds('Most_downloaded');
					$recently_updated = $this->kodihubmodel->getBuilds('Recently_updated');
					$most_popular = $this->kodihubmodel->getBuilds('Most_popular');
					$new_arrivals = $this->kodihubmodel->getBuilds('New_arrivals');
					$smallest = $this->kodihubmodel->getBuilds('Smallest_builds');									
					$titles = 'Most Downloaded' . "\r\n" . 'Recently Updated' . "\r\n" . 'Most Popular' . "\r\n" . 'New Arrivals' . "\r\n" . 'Smallest Builds';
					write_file($this->basepath . $this->username . '/V5/kodi/title.txt', $titles, 'w+');
					write_file($this->basepath . $this->username . '/V5/kodi/row1.txt', implode("\r\n",$most_downloaded), 'w+');
					write_file($this->basepath . $this->username . '/V5/kodi/row2.txt', implode("\r\n",$recently_updated), 'w+');
					write_file($this->basepath . $this->username . '/V5/kodi/row3.txt', implode("\r\n",$most_popular), 'w+');
					write_file($this->basepath . $this->username . '/V5/kodi/row4.txt', implode("\r\n",$new_arrivals), 'w+');
					write_file($this->basepath . $this->username . '/V5/kodi/row5.txt', implode("\r\n",$smallest), 'w+');
					$this->kodihubmodel->autocomplete($this->username,1);
					exit('Success');					
				}
			}		
		}		
	}

	private function kodibuildsrows($num) {
		$str = "";
		for ($i=1; $i<=$this->input->post('buildcount'); $i++) {
			if ($this->input->post('kodi' . $num . "build" . $i) !== NULL) {
				$str .= $this->input->post('kodi' . $num . "build" . $i) . "\n";
			}
		}
		return $str;
	}

	public function appsbuildsupload() {
		$this->form_validation->set_rules('hexcolor','Color','trim|hexcheck');
		$this->form_validation->set_rules('title1','Title1','trim|alpha_dash_space');
		$this->form_validation->set_rules('title2','Title2','trim|alpha_dash_space');
		$this->form_validation->set_rules('title3','Title3','trim|alpha_dash_space');
		$this->form_validation->set_rules('title4','Title4','trim|alpha_dash_space');
		$this->form_validation->set_rules('title5','Title5','trim|alpha_dash_space');

		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}	
		else {

			$this->createFolder('apps');
			if (!is_dir($this->basepath . $this->username . '/V5/apps/banner')) {
				mkdir($this->basepath . $this->username . '/V5/apps/banner',0777,true);				
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

				$config['upload_path'] = $this->basepath . $this->username . "/V5/apps/banner";
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
			elseif(!isset($files['files']['name'][0]) && !file_exists('/var/www/appy.zone/public_html/' . $this->username . '/V5/apps/banner/image.png'))
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
				$this->formatImage($this->basepath . $this->username . "/V5/apps/banner/image.png",1920,350,"png",$this->basepath . $this->username . "/V5/apps/banner/image.png");

				write_file($this->basepath . $this->username . '/V5/apps/title.txt', $this->titles($this->input->post('rows')), 'w+');
				write_file($this->basepath . $this->username . '/V5/apps/banner/button.txt', $statusCheck, 'w+');
				write_file($this->basepath . $this->username . '/V5/apps/banner/action.txt', $this->input->post('action')=='' ? 0 : $this->input->post('action'), 'w+');
				if ($this->input->post('action')==3) {
					write_file($this->basepath . $this->username . '/V5/apps/banner/web.txt', $this->input->post('url'), 'w+');		
				}
				else if($this->input->post('action')==2) {
					write_file($this->basepath . $this->username . '/V5/apps/banner/url.txt', $this->input->post('url'), 'w+');	
					write_file($this->basepath . $this->username . '/V5/apps/banner/package.txt', $this->input->post('package'), 'w+');						
				}
				write_file($this->basepath . $this->username . '/V5/apps/rows.txt', $this->input->post('rows'), 'w+');
				write_file($this->basepath . $this->username . '/V5/apps/font.txt', $this->input->post('hexcolor'), 'w+');	

				for ($i=1; $i<=5; $i++) {
					write_file($this->basepath . $this->username . '/V5/apps/row' . $i . '.txt', $this->kodibuildsrows($i), 'w+');
				}
				exit('success');
			}					
					
		}		
	}	

	public function gamingsubmit() {	

		$this->createFolder('gaming');
		if (!is_dir($this->basepath . $this->username . '/V5/gaming/banner')) {
			mkdir($this->basepath . $this->username . '/V5/gaming/banner',0777,true);			
		}
		$this->load->library('upload');
		$error = array();
		$files = $_FILES;

		$_FILES['files']['name'] = $files['files']['name'][0];
		$_FILES['files']['type'] = $files['files']['type'][0];
		$_FILES['files']['tmp_name'] = $files['files']['tmp_name'][0];
		$_FILES['files']['error'] = $files['files']['error'][0];
		$_FILES['files']['size'] = $files['files']['size'][0];	

		$config['upload_path'] = $this->basepath . $this->username . "/V5/gaming/banner";
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
		if(!empty($error)) {
			exit($error['error']);					
		}
		else{
			$statusCheck = 0;
			if ($this->input->post('checkstatus')=='true') {
				$statusCheck = 1;
			}
			$this->formatImage($this->basepath . $this->username . "/V5/gaming/banner/image.png",1920,350,"png",$this->basepath . $this->username . "/V5/gaming/banner/image.png");

			write_file($this->basepath . $this->username . '/V5/gaming/banner/button.txt', $statusCheck, 'w+');
			write_file($this->basepath . $this->username . '/V5/gaming/banner/action.txt', $this->input->post('action')=='' ? 0 : $this->input->post('action'), 'w+');

			if ($this->input->post('action')==3) {
				write_file($this->basepath . $this->username . '/V5/gaming/banner/web.txt', $this->input->post('url'), 'w+');		
			}
			else if($this->input->post('action')==2) {
				write_file($this->basepath . $this->username . '/V5/gaming/banner/url.txt', $this->input->post('url'), 'w+');	
				write_file($this->basepath . $this->username . '/V5/gaming/banner/package.txt', $this->input->post('package'), 'w+');						
			}
			exit('success');
		}							
	}	

	public function gaminguploadsubmit() {

		$this->form_validation->set_rules('gamename','Game Name','required|trim|alpha_dash_space|mandatory');
		$this->form_validation->set_rules('url','Download Url','trim|required|mandatory');
		$this->form_validation->set_rules('console','Console','trim|alpha_dash_space|required|mandatory');
		$this->form_validation->set_rules('genre','Genre','trim|alpha_dash_space|required|mandatory');

		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}	
		else {

			$this->createFolder('games');
			if (!is_dir($this->basepath . $this->admin . '/games/' . $this->input->post('console'))) {
				mkdir($this->basepath . $this->admin . '/games/' . $this->input->post('console'),0777,true);
			}
			if (!is_dir($this->basepath . $this->admin . '/games/' . $this->input->post('console') . "/" . $this->input->post('genre'))) {
					mkdir($this->basepath . $this->admin . '/games/' . $this->input->post('console') . "/" . $this->input->post('genre'),0777,true);
			}						
			$this->load->library('upload');
			$this->load->model('ImageCodeGaming');
			$code = $this->ImageCodeGaming->createCode();
			$error = array();
			$files = $_FILES;

			$_FILES['files']['name'] = $files['files']['name'][0];
			$_FILES['files']['type'] = $files['files']['type'][0];
			$_FILES['files']['tmp_name'] = $files['files']['tmp_name'][0];
			$_FILES['files']['error'] = $files['files']['error'][0];
			$_FILES['files']['size'] = $files['files']['size'][0];	

			$config['upload_path'] = $this->basepath . $this->admin . "/games/" . $this->input->post('console') . "/" . $this->input->post('genre');
			$config['allowed_types'] = 'png';
			$config['max_size'] = '5120';
			$config['max_widht'] = '1920';
			$config['max_height'] = '1080';
			$config['overwrite'] = TRUE;
			$config['remove_spaces'] = TRUE;
			$config['file_name'] = "image" . $code . ".png";

			$this->upload->initialize($config);

			if(!$this->upload->do_upload('files')) {
				$error['error'] = $this->upload->display_errors();		
			}
			else {

			}	
			if(!empty($error)) {
				exit($error['error']);					
			}
			else{
				$this->formatImage($this->basepath . $this->admin . "/games/" . $this->input->post('console') . "/" . $this->input->post('genre') . "/image" . $code . ".png",360,563,"png",$this->basepath . $this->admin . "/games/" . $this->input->post('console') . "/" . $this->input->post('genre') . "/image" . $code . ".png");
				$filetext = $this->makegameline($code);
				if (file_exists($this->basepath . $this->admin . "/games/" . $this->input->post('console') . "/" . $this->input->post('genre') . "/details.txt")) {
					unlink($this->basepath . $this->admin . "/games/" . $this->input->post('console') . "/" . $this->input->post('genre') . "/details.txt");
				}				
				for ($i=0; $i<count($filetext); $i++) {
					write_file($this->basepath . $this->admin . "/games/" . $this->input->post('console') . "/" . $this->input->post('genre') . "/details.txt", $filetext[$i] . "\r\n", 'a+');
				}
				exit('success');
			}					
					
		}							
	}

	private function makegameline($code) {
		$details = array();
		if (file_exists($this->basepath . $this->admin . "/games/" . $this->input->post('console') . "/" . $this->input->post('genre') . "/details.txt")) {
			$details = file($this->basepath . $this->admin . "/games/" . $this->input->post('console') . "/" . $this->input->post('genre') . "/details.txt");
		}
		array_push($details,$this->input->post('gamename') . ";" . $this->input->post('url') . ";" . "http://appy.zone/appy" . "/games/" . $this->input->post('console') . "/" . $this->input->post('genre') . "/image" . $code . ".png");
		sort($details);
		$result = array();
		for($i=0;$i<count($details); $i++) {
			if(trim($details[$i])!='') {
				$result[] = trim($details[$i]);
			}
		}
		return $result;
	}

	public function kodibuildtxt() {

		$this->form_validation->set_rules('buildname','Build Name','required|trim|alpha_dash_space|mandatory');
		$this->form_validation->set_rules('url','Download Url','trim|required|mandatory');
		$this->form_validation->set_rules('genre','Genre','trim|alpha_dash_space|required|mandatory');
		$this->form_validation->set_rules('size','Size in MB','trim|alpha_dash_space|required|mandatory');

		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}	
		else {

			$this->createFolder('kodi');						
			$this->load->library('upload');
			$this->load->model('ImageCodeGaming');
			$code = $this->ImageCodeGaming->createCode();
			$error = array();
			$files = $_FILES;

			$_FILES['files']['name'] = $files['files']['name'][0];
			$_FILES['files']['type'] = $files['files']['type'][0];
			$_FILES['files']['tmp_name'] = $files['files']['tmp_name'][0];
			$_FILES['files']['error'] = $files['files']['error'][0];
			$_FILES['files']['size'] = $files['files']['size'][0];	

			$config['upload_path'] = $this->basepath . $this->username . "/V5/kodi";
			$config['allowed_types'] = 'png';
			$config['max_size'] = '5120';
			$config['max_width'] = '1920';
			$config['max_height'] = '1080';
			$config['overwrite'] = TRUE;
			$config['remove_spaces'] = TRUE;
			$config['file_name'] = "image" . $code . ".png";

			$this->upload->initialize($config);

			if(!$this->upload->do_upload('files')) {
				$error['error'] = $this->upload->display_errors();		
			}
			else {

			}	
			if(!empty($error)) {
				exit($error['error']);					
			}
			else{
				$this->formatImage($this->basepath . $this->username . "/V5/kodi" . "/image" . $code . ".png",351,201,"png",$this->basepath . $this->username . "/V5/kodi" . "/image" . $code . ".png");
				$filetext = $this->makekodibuildline($code);
				if (file_exists($this->basepath . $this->username . "/V5/kodi/builds.txt")) {
					unlink($this->basepath . $this->username . "/V5/kodi/builds.txt");
				}				
				for ($i=0; $i<count($filetext); $i++) {
					write_file($this->basepath . $this->username . "/V5/kodi/builds.txt", $filetext[$i] . "\r\n", 'a+');
				}
				exit('success');
			}					
					
		}							
	}

	private function makekodibuildline($code) {
		$details = array();
		if (file_exists($this->basepath . $this->username . "/V5/kodi/builds.txt")) {
			$details = file($this->basepath . $this->username . "/V5/kodi/builds.txt");
		}
		$buildsize = (int) $this->input->post('size')*1048576;
		array_push($details,"http://appy.zone/" . $this->username . "/V5/kodi/image" . $code . ".png;" . $this->input->post('buildname') . ";" . $this->input->post('url') . ";" . $buildsize . ";" . $this->input->post('genre'));
		$result = array();
		for($i=0;$i<count($details); $i++) {
			if(trim($details[$i])!='') {
				$result[] = trim($details[$i]);
			}
		}
		return $result;		
	}

	public function editkodibuild() {
		$this->form_validation->set_rules('editbuildname','Build Name','required|trim|alpha_dash_space|mandatory');
		$this->form_validation->set_rules('editurl','Download Url','trim|required|mandatory');
		$this->form_validation->set_rules('editgenre','Download Url','trim|alpha_dash_space|required|mandatory');
		$this->form_validation->set_rules('editsize','Size in MB','trim|alpha_dash_space|required|mandatory');
		$this->form_validation->set_rules('completebuild','Build','trim|required|mandatory');

		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else {
			$currentbuild = explode(';',$this->input->post('completebuild'));
			if (file_exists($this->basepath . $this->username . "/V5/kodi/builds.txt")) {
				$details = file($this->basepath . $this->username . "/V5/kodi/builds.txt");
				for($i=0; $i<count($details); $i++) {
					$details[$i] = trim($details[$i]);
				}
			}
			else {
				exit('Build is not editable or does not exist');
			}			
			if (isset($_FILES['files'])) {
				$this->load->library('upload');
				$this->load->model('ImageCodeGaming');
				$code = $this->ImageCodeGaming->createCode();
				$error = array();
				$files = $_FILES;

				$_FILES['files']['name'] = $files['files']['name'][0];
				$_FILES['files']['type'] = $files['files']['type'][0];
				$_FILES['files']['tmp_name'] = $files['files']['tmp_name'][0];
				$_FILES['files']['error'] = $files['files']['error'][0];
				$_FILES['files']['size'] = $files['files']['size'][0];	

				$config['upload_path'] = $this->basepath . $this->username . "/V5/kodi";
				$config['allowed_types'] = 'png';
				$config['max_size'] = '5120';
				$config['max_widht'] = '1920';
				$config['max_height'] = '1080';
				$config['overwrite'] = TRUE;
				$config['remove_spaces'] = TRUE;
				$config['file_name'] = "image" . $code . ".png";

				$this->upload->initialize($config);

				if(!$this->upload->do_upload('files')) {
					$error['error'] = $this->upload->display_errors();		
				}
				else {

				}	
				if(!empty($error)) {
					exit($error['error']);					
				}
				else{
					$this->formatImage($this->basepath . $this->username . "/V5/kodi" . "/image" . $code . ".png",351,201,"png",$this->basepath . $this->username . "/V5/kodi" . "/image" . $code . ".png");
					$index = array_search((string)$this->input->post('completebuild'),$details);
					$buildsize = (int) $this->input->post('editsize')*1048576;
					$details[$index] = "http://appy.zone/" . $this->username . "/V5/kodi/image" . $code . ".png;" . $this->input->post('editbuildname') . ";" . $this->input->post('editurl') . ";" . $buildsize . ";" . $this->input->post('editgenre');
					$result = array();
					for($i=0;$i<count($details); $i++) {
						if(trim($details[$i])!='') {
							$result[] = trim($details[$i]);
						}
					}					
					if (file_exists($this->basepath . $this->username . "/V5/kodi/builds.txt")) {
						unlink($this->basepath . $this->username . "/V5/kodi/builds.txt");
					}				
					for ($i=0; $i<count($result); $i++) {
						write_file($this->basepath . $this->username . "/V5/kodi/builds.txt", $result[$i] . "\r\n", 'a+');
					}
					exit('success');
				}												
			}	
			else {
				$index = array_search((string)$this->input->post('completebuild'),$details);
				$buildsize = (int) $this->input->post('editsize')*1048576;
				$details[$index] = $currentbuild[0] . ";" . $this->input->post('editbuildname') . ";" . $this->input->post('editurl') . ";" . $buildsize . ";" . $this->input->post('editgenre');
				$result = array();
				for($i=0;$i<count($details); $i++) {
					if(trim($details[$i])!='') {
						$result[] = trim($details[$i]);
					}
				}			
				if (file_exists($this->basepath . $this->username . "/V5/kodi/builds.txt")) {
					unlink($this->basepath . $this->username . "/V5/kodi/builds.txt");
				}				
				for ($i=0; $i<count($result); $i++) {
					write_file($this->basepath . $this->username . "/V5/kodi/builds.txt", $result[$i] . "\r\n", 'a+');
				}
				exit('success');
			}		
		}		
	}

	public function appbuildtxt() {

		$this->form_validation->set_rules('buildname','Build Name','required|trim|alpha_dash_space|mandatory');
		$this->form_validation->set_rules('url','Download Url','trim|required|mandatory');
		$this->form_validation->set_rules('genre','Genre','trim|alpha_dash_space|required|mandatory');
		$this->form_validation->set_rules('package','Package name','trim|alpha_dash_space|required|mandatory');

		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}	
		else {

			$this->createFolder('apps');						
			$this->load->library('upload');
			$this->load->model('ImageCodeGaming');
			$code = $this->ImageCodeGaming->createCode();
			$error = array();
			$files = $_FILES;

			$_FILES['files']['name'] = $files['files']['name'][0];
			$_FILES['files']['type'] = $files['files']['type'][0];
			$_FILES['files']['tmp_name'] = $files['files']['tmp_name'][0];
			$_FILES['files']['error'] = $files['files']['error'][0];
			$_FILES['files']['size'] = $files['files']['size'][0];	

			$config['upload_path'] = $this->basepath . $this->username . "/V5/apps";
			$config['allowed_types'] = 'png';
			$config['max_size'] = '5120';
			$config['max_widht'] = '1920';
			$config['max_height'] = '1080';
			$config['overwrite'] = TRUE;
			$config['remove_spaces'] = TRUE;
			$config['file_name'] = "image" . $code . ".png";

			$this->upload->initialize($config);

			if(!$this->upload->do_upload('files')) {
				$error['error'] = $this->upload->display_errors();		
			}
			else {

			}	
			if(!empty($error)) {
				exit($error['error']);					
			}
			else{
				$this->formatImage($this->basepath . $this->username . "/V5/apps" . "/image" . $code . ".png",351,201,"png",$this->basepath . $this->username . "/V5/apps" . "/image" . $code . ".png");
				$filetext = $this->makeappsbuildline($code);
				if (file_exists($this->userappsLocation)) {
					unlink($this->userappsLocation);
				}				
				for ($i=0; $i<count($filetext); $i++) {
					write_file($this->userappsLocation, $filetext[$i] . "\r\n", 'a+');
				}
				exit('success');
			}					
					
		}							
	}

	private function makeappsbuildline($code) {
		$details = array();
		if (file_exists($this->userappsLocation)) {
			$details = file($this->userappsLocation);
		}
		array_push($details,"http://appy.zone/" . $this->username . "/V5/apps/image" . $code . ".png;" . $this->input->post('buildname') . ";" . $this->input->post('url') . ";" . $this->input->post('package') . ";" . $this->input->post('genre'));
		$result = array();
		for($i=0;$i<count($details); $i++) {
			if(trim($details[$i])!='') {
				$result[] = trim($details[$i]);
			}
		}
		return $result;		
	}

	public function editappsbuild() {
		$this->form_validation->set_rules('editbuildname','Build Name','required|trim|alpha_dash_space|mandatory');
		$this->form_validation->set_rules('editurl','Download Url','trim|required|mandatory');
		$this->form_validation->set_rules('editgenre','Genre','trim|alpha_dash_space|required|mandatory');
		$this->form_validation->set_rules('editpackage','Size in MB','trim|alpha_dash_space|required|mandatory');
		$this->form_validation->set_rules('completebuild','Build','trim|required|mandatory');

		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else {
			$currentbuild = explode(';',$this->input->post('completebuild'));
			if (file_exists($this->userappsLocation)) {
				$details = file($this->userappsLocation);
				for($i=0; $i<count($details); $i++) {
					$details[$i] = trim($details[$i]);
				}
			}
			else {
				exit('Build is not editable or does not exist');
			}			
			if (isset($_FILES['files'])) {
				$this->load->library('upload');
				$this->load->model('ImageCodeGaming');
				$code = $this->ImageCodeGaming->createCode();
				$error = array();
				$files = $_FILES;

				$_FILES['files']['name'] = $files['files']['name'][0];
				$_FILES['files']['type'] = $files['files']['type'][0];
				$_FILES['files']['tmp_name'] = $files['files']['tmp_name'][0];
				$_FILES['files']['error'] = $files['files']['error'][0];
				$_FILES['files']['size'] = $files['files']['size'][0];	

				$config['upload_path'] = $this->basepath . $this->username . "/V5/apps";
				$config['allowed_types'] = 'png';
				$config['max_size'] = '5120';
				$config['max_widht'] = '1920';
				$config['max_height'] = '1080';
				$config['overwrite'] = TRUE;
				$config['remove_spaces'] = TRUE;
				$config['file_name'] = "image" . $code . ".png";

				$this->upload->initialize($config);

				if(!$this->upload->do_upload('files')) {
					$error['error'] = $this->upload->display_errors();		
				}
				else {

				}	
				if(!empty($error)) {
					exit($error['error']);					
				}
				else{
					$this->formatImage($this->basepath . $this->username . "/V5/apps" . "/image" . $code . ".png",351,201,"png",$this->basepath . $this->username . "/V5/apps" . "/image" . $code . ".png");
					$index = array_search((string)$this->input->post('completebuild'),$details);
					$details[$index] = "http://appy.zone/" . $this->username . "/V5/apps/image" . $code . ".png;" . $this->input->post('editbuildname') . ";" . $this->input->post('editurl') . ";" . $this->input->post('editpackage') . ";" . $this->input->post('editgenre');
					$result = array();
					for($i=0;$i<count($details); $i++) {
						if(trim($details[$i])!='') {
							$result[] = trim($details[$i]);
						}
					}					
					if (file_exists($this->userappsLocation)) {
						unlink($this->userappsLocation);
					}				
					for ($i=0; $i<count($result); $i++) {
						write_file($this->userappsLocation, $result[$i] . "\r\n", 'a+');
					}
					exit('success');
				}												
			}	
			else {
				$index = array_search((string)$this->input->post('completebuild'),$details);
				$details[$index] = $currentbuild[0] . ";" . $this->input->post('editbuildname') . ";" . $this->input->post('editurl') . ";" . $this->input->post('editpackage') . ";" . $this->input->post('editgenre');
				$result = array();
				for($i=0;$i<count($details); $i++) {
					if(trim($details[$i])!='') {
						$result[] = trim($details[$i]);
					}
				}			
				if (file_exists($this->userappsLocation)) {
					unlink($this->userappsLocation);
				}				
				for ($i=0; $i<count($result); $i++) {
					write_file($this->userappsLocation, $result[$i] . "\r\n", 'a+');
				}
				exit('success');
			}		
		}		
	}	


	public function test() {
		exit(print_r($this->input->post()));
	}

	public function lookupuser() {
		$this->form_validation->set_rules('user','E-Mail','required|trim|mandatory|valid_email');
		if($this->form_validation->run()==FALSE){
			$this->output->set_content_type('application/json')->set_output(json_encode(array("status" => 0,'error' => validation_errors())));
		}
		else {
			$this->load->model('devices');
			$users = $this->devices->lookupemail();
			if (count($users)>0) {
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 1, 'users' => $users)));				
			}
			else {
				$this->output->set_content_type('application/json')->set_output(json_encode(array("status" => 0,'error' => 'No users found with that email')));				
			}
		}
	}

	public function lookupuserip() {
		$this->form_validation->set_rules('user','IP Address','required|trim|mandatory');
		if($this->form_validation->run()==FALSE){
			$this->output->set_content_type('application/json')->set_output(json_encode(array("status" => 0,'error' => validation_errors())));
		}
		else {
			$this->load->model('devices');
			$users = $this->devices->lookupip();
			if (count($users)>0) {
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 1, 'users' => $users)));				
			}
			else {
				$this->output->set_content_type('application/json')->set_output(json_encode(array("status" => 0,'error' => 'No users found with that ip address')));				
			}
		}
	}	

	public function lookupuseremailip() {
		$this->form_validation->set_rules('user','E-Mail or IP address','required|trim|mandatory');
		if($this->form_validation->run()==FALSE){
			$this->output->set_content_type('application/json')->set_output(json_encode(array("status" => 0,'error' => validation_errors())));
		}
		else {
			$this->load->model('devices');
			$users = $this->devices->lookupemailorip();
			if (count($users)>0) {
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 1, 'users' => $users)));				
			}
			else {
				$this->output->set_content_type('application/json')->set_output(json_encode(array("status" => 0,'error' => 'No users found with that email or ip address')));				
			}
		}
	}	

	public function sendtomany() {
		$this->form_validation->set_rules('message','Message','required|trim|mandatory|alpha_dash_space');
		$this->form_validation->set_rules('number','Number','required|trim|mandatory|numeric');
		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else {
			$this->load->model('devices');
			for ($i=0; $i < $this->input->post('number'); $i++) {
				$this->devices->updaterow($this->input->post('user'. $i),'message','1');
			}
			write_file($this->basepath . $this->username . "/V5/message.txt", $this->input->post('message') . "\r\n", 'w+');
			exit('success');			
		}		
	}

	public function sendmessage () {
		$this->form_validation->set_rules('message','Message','required|trim|mandatory|alpha_dash_space');
		$this->form_validation->set_rules('group','Group','required|trim|mandatory');
		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else {
			$this->load->model('devices');
			write_file($this->basepath . $this->username . "/V5/message.txt", $this->input->post('message') . "\r\n", 'w+');
			switch ($this->input->post('group')) {
				case 'all':
					$this->devices->updateallusers();
					exit('success');
					break;
				case 'new':
					$this->devices->updatenewusers();
					exit('success');
					break;
				case 'iptv':
					$this->devices->updateiptvusers();
					exit('success');
					break;
				default:
					exit('Failed');
					break;
			}
		}		
	}

	public function banunban() {
		$this->form_validation->set_rules('email','E-Mail','required|trim|mandatory|valid_email');
		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else {
			$this->load->model('devices');
			switch ($this->devices->checkstatus()) {
				case 0:
					$this->devices->ban();
					exit('The user has been banned');
					break;
				case 1:
					$this->devices->unban();
					exit('The user has been unbanned');
					break;
				case 2:
					exit('No users found with that email');
					break;
				default:
					exit('An error occured');
					break;
			}
		}		
	}

	public function grant() {
		$this->form_validation->set_rules('number','User','required|trim|mandatory|numeric');
		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else {
			$this->load->model('devices');
			for ($i=0; $i < $this->input->post('number'); $i++) {
				$this->devices->grant($this->input->post('user'. $i));
			}
			exit('Access Granted');			
		}		
	}

	public function grantiptv() {
		$this->form_validation->set_rules('number','User','required|trim|mandatory|numeric');
		$this->form_validation->set_rules('username','Username','required|trim|mandatory');
		$this->form_validation->set_rules('password','Password','required|trim|mandatory');
		$this->form_validation->set_rules('accessduration','Access Ends','required|trim|mandatory|alpha_dash_space|max_length[20]');
		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else {
			$this->load->model('devices');
			for ($i=0; $i < $this->input->post('number'); $i++) {
				$this->devices->grantiptv($this->input->post('user'. $i),$this->input->post('username'),$this->input->post('password'),$this->input->post('accessduration'));
			}
			$appname = $_SESSION['appname'];
			$clientaddress = $_SESSION['email'];
			$expirydate = $this->input->post('accessduration');
			$dataforuser = $this->devices->getuserdata($this->input->post('user0'))['Email'];
			if (isset($dataforuser) && $dataforuser != '') {
				$this->sendAccessEmail($dataforuser, $clientaddress, $expirydate, $appname);
			}			
			exit('Success');				
		}		
	}

	public function cancelupdate() {
		if (file_exists($this->basepath . $this->username . '/VersionCode.txt')) {
			$version = file($this->basepath . $this->username . '/VersionCode.txt');
			$version[0] = $version[0] - 1;
			write_file($this->basepath . $this->username . '/VersionCode.txt', $version[0], 'w+');
			exit('Update canceled. Current build number is ' . $version[0]);
		}
		else {
			exit('Something went wrong!');
		}		
	}

	public function pushupdate() {
		$this->form_validation->set_rules('url','APK Url','trim|required|mandatory');
		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else {
			if (file_exists($this->basepath . $this->username . '/VersionLocation.txt')) {
				if (file_exists($this->basepath . $this->username . '/VersionCode.txt')) {
					write_file($this->basepath . $this->username . '/VersionLocation.txt', $this->input->post('url'), 'w+');
					$version = file($this->basepath . $this->username . '/VersionCode.txt');
					$version[0] = $version[0] + 1;
					write_file($this->basepath . $this->username . '/VersionCode.txt', $version[0], 'w+');
					exit('APK Url updated. Current build number is ' . $version[0]);
				}
				else {
					exit('Something went wrong!');			
				}
			}
			else {
				exit('Something went wrong!');
			}						
		}		
	}

	public function userdetails() {
		$this->form_validation->set_rules('user','User ID','trim|required|numeric');
		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else {
			$this->load->model('devices');
			$details = $this->devices->userdetails($this->input->post('user'));


			$ch = curl_init('http://www.geoplugin.net/json.gp?ip=' . $details[0]['ip']);

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);

			$result = curl_exec($ch);
			curl_close($ch);
			//exit($result);
			$result = json_decode($result);
			//exit(print_r($result))
			$address = array('country' => $result->geoplugin_countryName);

			$details[] = array('country' => $result->geoplugin_countryName);

			$this->output->set_content_type('application/json')->set_output(json_encode($details));			
		}		
	}

	public function csv() {
		$conn=mysqli_connect($_SESSION['ipaddress'],$_SESSION['dbusername'],$_SESSION['dbpassword'],$_SESSION['dbname']);if(!$conn){exit;};
		$sql=sprintf('select * from DeviceIDTable');
		$result=mysqli_query($conn,$sql);

		$export = array();
		while($res=mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
		$arr = array();
		$arr[] = $res['DeviceID'];
		$arr[] = $res['MacAddress'];
		$arr[] = $res['RegDate'];
		$arr[] = $res['EndTrial'];
		$arr[] = $res['Email'];
		$arr[] = $res['Paid'];
		$arr[] = $res['pinPassed'];
		$arr[] = $res['trial'];
		$arr[] = $res['Kill'];
		$export[]=$arr;
		}
		echo json_encode($export);
		mysqli_close($conn);		
	}
	public function appedits()
	{
		if($this->input->post('type')=="npd")
		{
			$sal=1999;
		}
		else if($this->input->post('type')=="nac")
		{
			$sal=3500;
		}
		else if($this->input->post('type')=="npp")
		{
			$sal=1999;
		}
		else if($this->input->post('type')=="nad")
		{
			$sal=999;
		}
	//--
		$rand = substr(md5(microtime()),rand(0,26),8);
		$stripe=sprintf('<form action="https://www.ammakeup.co.uk/Plans/appedits.php" method="POST">
				  <script
				    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
				    data-key="pk_live_sl2CtqWyBLXj3ePFq9f0Rfdw"
				    data-amount="%s"
				    data-name="Appy"
				    data-description="Edits Pay"
				    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
				    data-locale="auto"
				    data-zip-code="true">
				  </script>
				  <input type="hidden" name="saldop" value="%s"/>
				  <input type="hidden" name="ime" value="%s"/>
				  <input type="hidden" name="username" value="%s"/>
				</form>',$sal,$sal,$rand,$_SESSION['username']);
		if($this->input->post('type')=="other")
		{
			$text=sprintf("///%s/\r\nApp name: %s\r\nEmail: %s\r\n%s\r\nContact Email:%s\r\nDescribe your edit:%s",$_SESSION['username'],$_SESSION['appname'],$_SESSION['email'],"Other",$this->input->post('textfield11'),$this->input->post('textarea'));
			write_file($this->basepath2 . "/$rand.txt", $text, 'w+');
			exit("edit is uploaded");
		}
		else if($this->input->post('type')=="npd")	
		{
			$text=sprintf("///%s/\r\nApp name: %s\r\nEmail: %s\r\n%s\r\n%s-%s-%s",$_SESSION['username'],$_SESSION['appname'],$_SESSION['email'],"New Payment Details",$this->input->post('select2'),$this->input->post('username'),$this->input->post('password'));
			write_file($this->basepath3 . "/$rand.txt", $text, 'w+');
			exit($stripe);
		}
		else if($this->input->post('type')=="nac")
		{
			$text=sprintf("///%s/\r\nApp name: %s\r\nEmail: %s\r\n%s\r\n%s\r\n%s-%s %s\r\n%s-%s %s\r\n%s\r\n%s-%s\r\n%s-%s\r\n%s-%s %s",$_SESSION['username'],$_SESSION['appname'],$_SESSION['email'],"New IPTV/App Charges","New IPTV Charges","Monthly",$this->input->post('monthly'),$this->input->post('textfield7'),"Annual",$this->input->post("annual"),$this->input->post('textfield6'),"New App Charges","New trial period",$this->input->post("trial"),"Payment frequency",$this->input->post("payf"),"Tariff",$this->input->post("tariff"),$this->input->post("tariffv"));
			write_file($this->basepath3 . "/$rand.txt", $text, 'w+');
			exit($stripe);
		}
		else if($this->input->post('type')=="npp")
		{
			$text=sprintf("///%s/\r\nApp name: %s\r\nEmail: %s\r\n%s\r\n%s-%s-%s",$_SESSION['username'],$_SESSION['appname'],$_SESSION['email'],"New Payment Processor",$this->input->post('select3'),$this->input->post('username2'),$this->input->post('password2'));
			write_file($this->basepath3 . "/$rand.txt", $text, 'w+');
			exit($stripe);
		}
		else if($this->input->post('type')=="nad")
		{
			$textneki='';
			if(isset($_FILES['files1']) && isset($_FILES['files2']))
			{
				$textneki="New background and new logo image";
			}
			else if (!isset($_FILES['files1']) && isset($_FILES['files2']))
			{
				$textneki="New logo image";
			}
			else if (isset($_FILES['files1']) && !isset($_FILES['files2'])) 
			{
				$textneki="New background image";
			}
			mkdir($this->basepath3 . "/$rand",0777,true);
			$text=sprintf("///%s/\r\nApp name: %s\r\nEmail: %s\r\n%s\r\nNew app name: %s\r\nNew intro video URL: %s\r\n%s",$_SESSION['username'],$_SESSION['appname'],$_SESSION['email'],"New App Details",$this->input->post('NewAppname'),$this->input->post('NewIntroVideoURL'),$textneki);
			write_file($this->basepath3 . "/$rand.txt", $text, 'w+');
			
			if (isset($_FILES['files1'])) {
				$this->load->library('upload');
				$error = array();
				$files = $_FILES;

				$_FILES['files1']['name'] = $files['files1']['name'][0];
				$_FILES['files1']['type'] = $files['files1']['type'][0];
				$_FILES['files1']['tmp_name'] = $files['files1']['tmp_name'][0];
				$_FILES['files1']['error'] = $files['files1']['error'][0];
				$_FILES['files1']['size'] = $files['files1']['size'][0];	

				$config['upload_path'] = $this->basepath3 . "/$rand";
				$config['allowed_types'] = 'png';
				$config['max_size'] = '5120';
				$config['max_widht'] = '1920';
				$config['max_height'] = '1080';
				$config['overwrite'] = TRUE;
				$config['remove_spaces'] = TRUE;
				$config['file_name'] = "background.png";

				$this->upload->initialize($config);

				if(!$this->upload->do_upload('files1')) {
					$error['error'] = $this->upload->display_errors();		
				}
				else {

				}	
				if(!empty($error)) {
					exit($error['error']);					
				}
				else{
					$this->formatImage($this->basepath3 . "/$rand/background.png",1920,1080,"png",$this->basepath3 . "/$rand/background.png");
				}												
			}
			if (isset($_FILES['files2'])) {
				$this->load->library('upload');
				$error = array();
				$files = $_FILES;

				$_FILES['files2']['name'] = $files['files2']['name'][0];
				$_FILES['files2']['type'] = $files['files2']['type'][0];
				$_FILES['files2']['tmp_name'] = $files['files2']['tmp_name'][0];
				$_FILES['files2']['error'] = $files['files2']['error'][0];
				$_FILES['files2']['size'] = $files['files2']['size'][0];	

				$config['upload_path'] = $this->basepath3 . "/$rand";
				$config['allowed_types'] = 'png';
				$config['max_size'] = '5120';
				$config['max_widht'] = '1920';
				$config['max_height'] = '1080';
				$config['overwrite'] = TRUE;
				$config['remove_spaces'] = TRUE;
				$config['file_name'] = "applogo.png";

				$this->upload->initialize($config);

				if(!$this->upload->do_upload('files2')) {
					$error['error'] = $this->upload->display_errors();		
				}
				else {

				}	
				if(!empty($error)) {
					exit($error['error']);					
				}
				else{
					$this->formatImage($this->basepath3 . "/$rand/applogo.png",1920,1080,"png",$this->basepath3 . "/$rand/applogo.png");
				}												
			
//--
			shell_exec("mkdir " . $this->basepath3 . "/$rand/" . "ic_launcher");
			shell_exec("cd " . $this->basepath3 . "/$rand/" . "ic_launcher;" . " mkdir res; cd res; mkdir mipmap-hdpi; mkdir mipmap-mdpi; mkdir mipmap-xhdpi; mkdir mipmap-xxhdpi; mkdir mipmap-xxxhdpi");
			try {
				$magicianObj1 = new imageLib($this->basepath3 . "/$rand/" . "applogo.png");
				$magicianObj1 -> resizeImage(192, 192);
				$magicianObj1 -> saveImage($this->basepath3 . "/$rand/" . "ic_launcher/res/mipmap-xxxhdpi/ic_launcher.png", 0);
				//shell_exec("cp " . $target_dir . "ic_launcher/res/mipmap-xxxhdpi/ic_launcher.png " . $target_dir . "media2/ic_launcher192.png");

				$magicianObj1 = new imageLib($this->basepath3 . "/$rand/" . "applogo.png");
				$magicianObj1 -> resizeImage(144, 144);
				$magicianObj1 -> saveImage($this->basepath3 . "/$rand/" . "ic_launcher/res/mipmap-xxhdpi/ic_launcher.png", 0);
				//shell_exec("cp " . $target_dir . "ic_launcher/res/mipmap-xxhdpi/ic_launcher.png " . $target_dir . "media1/ic_launcher144.png");
				//shell_exec("cp " . $target_dir . "ic_launcher/res/mipmap-xxhdpi/ic_launcher.png " . $target_dir . "media2/ic_launcher144.png");
				
				$magicianObj1 = new imageLib($this->basepath3 . "/$rand/" . "applogo.png");
				$magicianObj1 -> resizeImage(96, 96);
				$magicianObj1 -> saveImage($this->basepath3 . "/$rand/" . "ic_launcher/res/mipmap-xhdpi/ic_launcher.png", 0);
				//shell_exec("cp " . $target_dir . "ic_launcher/res/mipmap-xhdpi/ic_launcher.png " . $target_dir . "media1/ic_launcher96.png");
				//shell_exec("cp " . $target_dir . "ic_launcher/res/mipmap-xhdpi/ic_launcher.png " . $target_dir . "media2/ic_launcher96.png");

				$magicianObj1 = new imageLib($this->basepath3 . "/$rand/" . "applogo.png");
				$magicianObj1 -> resizeImage(72, 72);
				$magicianObj1 -> saveImage($this->basepath3 . "/$rand/" . "ic_launcher/res/mipmap-hdpi/ic_launcher.png", 0);
				//shell_exec("cp " . $target_dir . "ic_launcher/res/mipmap-hdpi/ic_launcher.png " . $target_dir . "media1/ic_launcher72.png");
				//shell_exec("cp " . $target_dir . "ic_launcher/res/mipmap-hdpi/ic_launcher.png " . $target_dir . "media2/ic_launcher72.png");

				$magicianObj1 = new imageLib($this->basepath3 . "/$rand/" . "applogo.png");
				$magicianObj1 -> resizeImage(48, 48);
				$magicianObj1 -> saveImage($this->basepath3 . "/$rand/" . "ic_launcher/res/mipmap-mdpi/ic_launcher.png", 0);
				//shell_exec("cp " . $target_dir . "ic_launcher/res/mipmap-mdpi/ic_launcher.png " . $target_dir . "media1/ic_launcher48.png");
				//shell_exec("cp " . $target_dir . "ic_launcher/res/mipmap-mdpi/ic_launcher.png " . $target_dir . "media2/ic_launcher48.png");

				/*$magicianObj1 = new imageLib($target_dir . "img1temp.png");
				$magicianObj1 -> resizeImage(36, 36);
				$magicianObj1 -> saveImage($target_dir . "media1/ic_launcher36.png", 0);
				
				$magicianObj1 = new imageLib($target_dir . "img1temp.png");
				$magicianObj1 -> resizeImage(36, 36);
				$magicianObj1 -> saveImage($target_dir . "media2/ic_launcher36.png", 0);	*/			
				
				shell_exec("rm ". $this->basepath3 . "/$rand/" . "applogo.png");
				shell_exec("cd " . $this->basepath3 . "/$rand/" . "; zip -r ic_launcher.zip ic_launcher");
				shell_exec("rm -rf " . $this->basepath3 . "/$rand/" . "ic_launcher");
			}
			catch(Exception $e) {
				//file_put_contents('/var/www/html/upit.txt','greska');
				exit("Unexpected error. Check format of your images");			
			}
			}
//--


			exit($stripe);
		}

	}		 

	public function swappaid() {
		$this->form_validation->set_rules('user','User ID','trim|required|mandatory|numeric');
		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else {
			$this->load->model('devices');
			exit($this->devices->swappaid($this->input->post('user'),$this->input->post('date')));
		}		
	}

	public function edittrial() {
		$this->form_validation->set_rules('user','User ID','trim|required|mandatory|numeric');
		$this->form_validation->set_rules('date','Trial Date','trim|required|mandatory');
		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else {
			$this->load->model('devices');
			exit($this->devices->edittrial($this->input->post('user'),$this->input->post('date')));
		}		
	}

	public function editend() {
		$this->form_validation->set_rules('user','User ID','trim|required|mandatory|numeric');
		$this->form_validation->set_rules('date','IPTV End Date','trim|required|mandatory');
		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else {
			$this->load->model('devices');
			exit($this->devices->editend($this->input->post('user'),$this->input->post('date')));
		}		
	}	

	public function deleteuser() {
		$this->form_validation->set_rules('user','User ID','trim|required|mandatory|numeric');
		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else {
			$this->load->model('devices');
			$this->devices->deleteuser($this->input->post('user'));
			exit('User has been deleted');
		}		
	}	

	public function rssfeed() {
		$this->form_validation->set_rules('message','Message','trim|required|mandatory|alpha_dash_space');
		if($this->form_validation->run()==FALSE){
			exit(validation_errors());
		}
		else {
			$this->createFolder('kodi');			
			$this->rssxml($this->basepath . $this->username . '/V5/kodi/feed.xml',$this->input->post('message'));
			exit('Rss Feed Message saved successfully');
		}		
	}	

	private function rssxml($path,$message) {
		$xml = new SimpleXMLElement('<?xml version="1.0"?><rss></rss>');

		$xml->addAttribute('version', '2.0');

		$channel = $xml->addChild('channel');
		$channel->addChild('title', '*Latest*');
		$channel->addChild('description', ' ');
		$channel->addChild('link', 'http://www.avstream.tv');
		$item = $channel->addChild('item');

		$item->addChild('title', $message);
		$item->addChild('description', 'Android Development and Systems');
		$item->addChild('link', 'http://www.avstream.tv');

		$xml->asXML($path);		
	}

	public function vpn() {
		$this->load->model('vpnmodel');
		$user = $this->username == 'appy' ? 'FissNew' : $this->username;
		$data['clients'] = $this->vpnmodel->get_all_clients($user);
		//exit(print_r($data));
		$this->load->view('vpn',$data);		
	}

	public function vpnuserlookup() {

		$this->form_validation->set_rules('user','User','trim|required');

		if($this->form_validation->run()==FALSE){
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 0, 'error' => validation_errors())));			
		}	
		else {
			$this->load->model('vpnmodel');
			$user = $this->vpnmodel->lookupUser($this->input->post('user'));
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 1, 'users' => $user)));
		}		
	}		

	public function uplsplash() {
		$this->createFolder('kodi');		
		if (isset($_FILES['files'])) {
			$this->load->library('upload');
			$error = array();
			$files = $_FILES;

			$_FILES['files']['name'] = $files['files']['name'][0];
			$_FILES['files']['type'] = $files['files']['type'][0];
			$_FILES['files']['tmp_name'] = $files['files']['tmp_name'][0];
			$_FILES['files']['error'] = $files['files']['error'][0];
			$_FILES['files']['size'] = $files['files']['size'][0];	

			$config['upload_path'] = $this->basepath . $this->username . "/V5/kodi";
			$config['allowed_types'] = 'png';
			$config['max_size'] = '5120';
			$config['max_widht'] = '1920';
			$config['max_height'] = '1080';
			$config['overwrite'] = TRUE;
			$config['remove_spaces'] = TRUE;
			$config['file_name'] = "splash.png";

			$this->upload->initialize($config);

			if(!$this->upload->do_upload('files')) {
				$error['error'] = $this->upload->display_errors();		
			}
			else {

			}	
			if(!empty($error)) {
				exit($error['error']);					
			}
			else{
				$this->formatImage($this->basepath . $this->username . "/V5/kodi" . "/splash.png",1920,1080,"png",$this->basepath . $this->username . "/V5/kodi" . "/splash.png");
				exit('Success');
			}												
		}
		else {
			exit('Please upload splash image');
		}		
	}

	private function createFolder($type) {
		if (!is_dir($this->basepath . $this->username . '/V5/' . $type)) {
			mkdir($this->basepath . $this->username . '/V5/' . $type,0777,true);
		}		
	}

	public function charge() 
	{
		//var_dump(print_r($_POST));
		require_once('../../../stripe-lib/stripe-php-3.14.0/init.php');
		  //require_once('../stripeapp/init.php');
		  $token  = $_POST['stripeToken'];
		  //echo $alo;
		  $email = $_POST['stripeEmail'];
		  $username = $_POST['username'];
		  $amount= 99;
		 \Stripe\Stripe::setApiKey(""); 
		   $customer = \Stripe\Customer::create(array(
		      'email' => $email,
		      'source'  => $token
		  ));
		  //echo $result['customer'];
		  try {
		  \Stripe\Charge::create(array(
		     "amount"   => $amount,
		     "currency" => "gbp",
		     "customer" => $customer->id,
		     "metadata" => array("type" => "appedits", "ime" => $_POST['ime'])
		  ));
		  }
		  catch (\Stripe\Error\ApiConnection $e) {
		    // Network problem, perhaps try again.
		  } catch (\Stripe\Error\InvalidRequest $e) {
		    // You screwed up in your programming. Shouldn't happen!
		  } catch (\Stripe\Error\Api $e) {
		    // Stripe's servers are down!
		  } catch (\Stripe\Error\Card $e) {
		    // Card was declined.
		   $e_json = $e->getJsonBody();
		   $error = $e_json['error'];
		   //echo $error;
		  }
	}

	private function sendAccessEmail($useraddress, $clientaddress, $expiredate, $appname) {
	    $username = $this->config->item('emailapi_username');
	    $password = $this->config->item('emailapi_password');
	    //exit('slo');
	    // Alternative JSON version
	    // $url = 'http://twitter.com/statuses/update.json';
	    // Set up and execute the curl process
	    $curl_handle = curl_init();
	    curl_setopt($curl_handle, CURLOPT_URL, $this->config->item('emailapi_url'));
	    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl_handle, CURLOPT_POST, 1);
	    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
	    	'useraddress' => $useraddress,
	    	'clientaddress' => $clientaddress,
	    	'expiredate' => $expiredate,
	    	'appname' => $appname
	    ));
	     
	    // Optional, delete this line if your API is open
	    curl_setopt($curl_handle, CURLOPT_USERPWD, $username . ':' . $password);
	     
	    $buffer = curl_exec($curl_handle);
	    curl_close($curl_handle);
	     
	    $result = json_decode($buffer);	

	    //print_r($result);		
	}

}