<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."third_party/Imdb.php";

class Playlist extends MY_Controller {

	private $basepath = '/var/www/appy.zone/public_html/';
	private $admin = 'appy';
	private $username;
	private $ttl = 1000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000;
	private $quotes = '/(["\'])(?:(?=(\\\\?))\2.)*?\1/';
	private $seriematch = '/S[0-9][0-9].?E[0-9][0-9]/';
	private $yearinname = '/\([0-9]*?[A-z]*?\)/';
	private $status;
	private $imagenotallowedchars = "/\:|\¬|\||\,|\/|\\//";
	protected $_CI;

	public function __Construct()
	{
		parent::__Construct();
		$this->_CI =& get_instance();
		$this->username = $_SESSION['username'];
		if (!is_dir($this->basepath . $this->username . '/V5')) {
			mkdir($this->basepath . $this->username . '/V5',0777,true);
		}
		$this->load->model('playlistmodel');
		$this->status = $this->playlistmodel->getUnlockStatus($this->username);
		if ($this->username != 'FissNew') {
			if (!is_dir($this->basepath . $this->username . '/iptv')) {
				mkdir($this->basepath . $this->username . '/iptv',0777,true);
				mkdir($this->basepath . $this->username . '/iptv/images/movies',0777,true);
				mkdir($this->basepath . $this->username . '/iptv/images/series',0777,true);
				mkdir($this->basepath . $this->username . '/iptv/images/live',0777,true);
				mkdir($this->basepath . $this->username . '/iptv/images/247',0777,true);
				mkdir($this->basepath . $this->username . '/iptv/images/sports',0777,true);
				mkdir($this->basepath . $this->username . '/iptv/lists/live',0777,true);
				mkdir($this->basepath . $this->username . '/iptv/lists/movies',0777,true);
				mkdir($this->basepath . $this->username . '/iptv/lists/series',0777,true);
				mkdir($this->basepath . $this->username . '/iptv/lists/247',0777,true);
				mkdir($this->basepath . $this->username . '/iptv/lists/sports',0777,true);
			}
			if (!file_exists($this->basepath . $this->username . '/iptv/247.txt')) {
				write_file($this->basepath . $this->username . '/iptv/247.txt', '');
				write_file($this->basepath . $this->username . '/iptv/sports.txt', '');
			}
		}

		$this->load->driver('cache', ['adapter' => 'file']);
	}

	public function index() {
		if ($this->status==1) {
			if ($this->username != 'FissNew') {
				$this->load->model('playlistmodel');
				$res = $this->playlistmodel->getM3uandEpg($this->username);
				$data['m3u'] = $res['m3u'];
				$data['epg'] = $res['epg'];
				$data['live_group_titles'] = $this->cache->get($this->username)['live_group_titles'];
				//
				$l247= "/var/www/appy.zone/public_html/".$this->username."/iptv/247.txt";
				$data['l247'] = file($l247, FILE_IGNORE_NEW_LINES);
				$sport= "/var/www/appy.zone/public_html/".$this->username."/iptv/sports.txt";
				$data['sport'] = file($sport, FILE_IGNORE_NEW_LINES);

				$live= "/var/www/appy.zone/public_html/".$this->username."/iptv/lists/live/list.txt";

				if (file_exists($live)) {
					$data['livelist'] = file($live, FILE_IGNORE_NEW_LINES);
				}
				else {
					$data['livelist'] = array();
				}

				//print_r($data['live_group_titles']);

				$this->load->view('playlist', $data);

			}			
		}
		else if ($this->status==2) {
			$this->load->view('iptvunlockform');
		}
		else {
			redirect('unlock');
		}
	}

	public function movies() {
		if ($this->status == 1) {
			$data['not_found'] = $this->cache->get($this->username . "_notfound");
			$manualTitles = $this->cache->get($this->username . "_manualeditmovies");
			$username = $this->username;

			$data['manual'] = array();
			$data['manual'] = $this->cache->get($username . "_allmovies");
			if (!empty($data['manual'])) {
				usort($data['manual'], array('Playlist','alpha'));
			}

			//print_r($data['manual']);		
			$this->load->view('iptvmovies',$data);
		}
		else if ($this->status==2) {
			$this->load->view('iptvunlockform');
		}		
		else {
			redirect('unlock');
		}
	}

	public function series() {
		if ($this->status==1) {

			$data['not_found'] = $this->cache->get($this->username . "_seriesnotfound");
			//$manualTitles = $this->cache->get($this->username . "_manualeditseries");
			//$changedTitles = $this->cache->get($this->username . "_serieschanged");
			// unset($manualTitles["Navy Seals: America's Secret Warriors"]);
			// $this->cache->save($this->username . "_manualeditseries", $manualTitles, $this->ttl);
			// exit();
			$data['manual'] = array();
			$data['manual'] = $this->cache->get($this->username . "_allseries");
					
			$this->load->view('iptvseries',$data);			
		}
		else if ($this->status==2) {
			$this->load->view('iptvunlockform');
		}		
		else {
			redirect('unlock');
		} 
	}
	public function move()
	{
		//exit($this->input->post('location'));
		$file="/var/www/appy.zone/public_html/".$this->username."/iptv/".$this->input->post('location').".txt";
		write_file($file, $this->input->post('name')."\n", "a+");
		//ovdje dodati shell exec liniju koja prebaca sliku dje treba
		exit('ok');
	}
	public function ls247() {
		if ($this->status==1) {
			$this->load->model('playlistmodel');
			$res = $this->playlistmodel->getM3uandEpg($this->username);
			$data['m3u'] = $res['m3u'];
			$data['epg'] = $res['epg'];
			$data['live_group_titles'] = $this->cache->get($this->username)['live_group_titles'];
			//
			// if ($this->username == 'bogdan') {
			// 	exit(print_r($data['live_group_titles']));
			// }
			$l247= "/var/www/appy.zone/public_html/".$this->username."/iptv/247.txt";
			$data['l247'] = file($l247, FILE_IGNORE_NEW_LINES);
			$sport= "/var/www/appy.zone/public_html/".$this->username."/iptv/sports.txt";
			$data['sport'] = file($sport, FILE_IGNORE_NEW_LINES);

			$live= "/var/www/appy.zone/public_html/".$this->username."/iptv/lists/247/list.txt";

			if (file_exists($live)) {
				$data['livelist'] = file($live, FILE_IGNORE_NEW_LINES);
			}
			else {
				$data['livelist'] = array();
			}

			//247 part
			$niz = array();
			$i = 0;
			foreach($data['livelist'] as $broj=>$pod)
			{
				if($broj%2==0)
				{
					$i++;
					if($pod!='') {
						$niz[$i]['naslov']=$pod;
					}
				}
				else
				{
					if($pod!='') {
						$niz[$i]['link']=$pod;
					}
				}
			}
			$data['livelist'] = $niz;

			//print_r($data['livelist']);
			$this->load->view('iptvloops',$data);			
		}
		else if ($this->status==2) {
			$this->load->view('iptvunlockform');
		}		
		else {
			redirect('unlock');
		}
	}
	public function sports() {
		if ($this->status==1) {
			$this->load->model('playlistmodel');
			$res = $this->playlistmodel->getM3uandEpg($this->username);
			$data['m3u'] = $res['m3u'];
			$data['epg'] = $res['epg'];
			$data['live_group_titles'] = $this->cache->get($this->username)['live_group_titles'];
			//
			$l247= "/var/www/appy.zone/public_html/".$this->username."/iptv/247.txt";
			$data['l247'] = file($l247, FILE_IGNORE_NEW_LINES);
			$sport= "/var/www/appy.zone/public_html/".$this->username."/iptv/sports.txt";
			$data['sport'] = file($sport, FILE_IGNORE_NEW_LINES);

			$sports= "/var/www/appy.zone/public_html/".$this->username."/iptv/lists/sports/list.txt";

			if (file_exists($sports)) {
				$data['livelist'] = file($sports, FILE_IGNORE_NEW_LINES);
			}
			else {
				$data['livelist'] = array();
			}

			//
			$this->load->view('iptvsports',$data);
		}
		else if ($this->status==2) {
			$this->load->view('iptvunlockform');
		}		
		else {
			redirect('unlock');
		}
	}

	public function m3u() {
		if ($this->status==1) {
			$this->form_validation->set_rules('m3u','M3U Playlist Url','required|trim|min_length[6]');
			if($this->form_validation->run()==FALSE)
			{
	        	$this->output->set_content_type('application/json')//return json array
	             ->set_output(json_encode(array('success' => 0, 'error' => validation_errors())));			
			}
			else
			{			
				$this->load->model('playlistmodel');
				$this->playlistmodel->insertM3u($this->username,$this->input->post('m3u'));
				$num = $this->parse($this->input->post('m3u'));
				//reset imdb job api 
				$this->load->model('imdbmodel');
				$this->imdbmodel->resetJob(array('username' => $this->username));

				$this->writeToFile($this->username,$this->input->post('m3u'),'m3u');
	        	$this->output->set_content_type('application/json')//return json array
	             ->set_output(json_encode(array('success' => 1, 'data' => $num['live_group_titles'])));			
			}			
		}
		else if ($this->status==2) {
			$this->load->view('iptvunlockform');
		}		
		else {
			redirect('unlock');
		} 
	}


	public function epg() {
		$this->form_validation->set_rules('epg','EPG Url','required|trim|min_length[6]');
		if($this->form_validation->run()==FALSE)
		{
        	$this->output->set_content_type('application/json')//return json array
             ->set_output(json_encode(array('success' => 0, 'error' => validation_errors())));			
		}
		else
		{			
			$this->load->model('playlistmodel');
			$this->playlistmodel->insertEpg($this->username,$this->input->post('epg'));
			$this->writeToFile($this->username, $this->input->post('epg'), 'epg');
        	$this->output->set_content_type('application/json')//return json array
             ->set_output(json_encode(array('success' => 1)));			
		}
	}	


	private function parse($url)
	{
		//$filename="http://root-hosting.ddns.net:254461/get.php?username=appyv5&password=2201&type=m3u_plus&output=ts";
		$filename="$url";
		$file_headers = @get_headers($filename);
		if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') 
		{
    		$num['group_titles']=array();
    		$num['live_group_titles']=array();	
			$this->cache->save($this->username, $num, $this->ttl);
			return $num;
		}
		//
		$lines = file($filename);
		//$lines=file("");
		array_splice($lines, 0, 1);
		//exit(print_r(expression));
		$i=0;
		foreach($lines as $broj=>$pod)
		{
			if($broj%2==0)
			{
				$i++;
				$niz[$i]['naslov']=$pod;
			}
			else
			{
				$niz[$i]['link']=$pod;	
			}
		}
		$live=0;
		$movie=0;
		$tv_show=0;

		shell_exec('rm -rf ' . $this->basepath . $this->username . '/iptv/lists/movies/list.txt');
		foreach($niz as $broj=>$pod)
		{
			// $group_titles[substr($pod['naslov'],strpos($pod['naslov'],'group-title="')+strlen('group-title="'),strpos($pod['naslov'],'"',strpos($pod['naslov'],'group-title="')+strlen('group-title="'))-(strpos($pod['naslov'],'group-title="')+strlen('group-title="')))][]=substr($pod['naslov'],strrpos($pod['naslov'],'"')+2,strlen($pod['naslov'])-strrpos($pod['naslov'],'"')+2);

			if(strrpos($pod['link'], '/live/') != FALSE)
			{
				$live+=1;
				$pozicija = strrpos($pod['link'], '/') + 1;
				$link = substr($pod['link'], $pozicija);
				$live_group_titles[substr($pod['naslov'],strpos($pod['naslov'],'group-title="')+strlen('group-title="'),strpos($pod['naslov'],'"',strpos($pod['naslov'],'group-title="')+strlen('group-title="'))-(strpos($pod['naslov'],'group-title="')+strlen('group-title="')))][]=array('name' => trim(substr($pod['naslov'],strrpos($pod['naslov'],'"')+2,strlen($pod['naslov'])-strrpos($pod['naslov'],'"')+2)), 'link' => $link);
			}
		}

		$num['live_group_titles'] = isset($live_group_titles) ? $live_group_titles : array();
		$this->cache->save($this->username, $num, $this->ttl);
		if (!file_exists($this->basepath . $this->username . '/iptv/lists/movies/list.txt')) {
			$this->load->model('imdbmodel');
			$this->imdbmodel->insertJob($this->username);
		}
		return $num;
	}

	public function writeToFile($username, $data, $location) {
		require(APPPATH . '/third_party/utils.php');
		$position = strposOffset('/', $data, 3);
		if ($position && $location=='m3u') {
			write_file($this->basepath . $this->username . '/iptv/server.txt', substr($data, 0, $position+1) . "\r\n", 'w+');
		}
		else if ($location=='epg') {
			write_file($this->basepath . $this->username . '/iptv/epg.txt', $data . "\r\n", 'w+');
		}
		return;
	}

	public function uploadimage($type)
	{
		//exit('yo');
		$this->load->library('upload');
		$error = array();
		$files = $_FILES;
		//$imagetitle=str_replace(' ', '-', $imagetitle);
		$imagetitle = trim(preg_replace($this->imagenotallowedchars,'',$this->input->post('title')));
		//$imagetitle = $this->input->post('title');
		//exit($imagetitle);
		if ($type=='movie') {
			if ($this->username != 'FissNew') {
				$path = $this->basepath . $this->username . '/iptv/images/movies';
			}
			else {
				$path = $this->basepath . '/iptv/images/movies';
			}
		}
		else if($type=='series')
		{
			if ($this->username != 'FissNew') {
				$path = $this->basepath . $this->username . '/iptv/images/series';
			}
			else {
				$path = $this->basepath . '/iptv/images/series';
			}
		}
		else if($type=='sports')
		{
			$path = $this->basepath . $this->username . '/iptv/images/sports' ;
		}
		else if($type=='sportchannel')
		{
			$path = $this->basepath . $this->username . '/iptv/images/live' ;
		}
		else if($type=='ls247channel')
		{
			$path = $this->basepath . $this->username . '/iptv/images/247' ;
		}		
		else {
			$path = $this->basepath . $this->username . '/iptv/images/live' ;
		}
		$listpath = $this->basepath . $this->username . '/iptv/lists/live/list.txt';
			$_FILES['files']['name'] = $files['files']['name'][0];
			$_FILES['files']['type'] = $files['files']['type'][0];
			$_FILES['files']['tmp_name'] = $files['files']['tmp_name'][0];
			$_FILES['files']['error'] = $files['files']['error'][0];
			$_FILES['files']['size'] = $files['files']['size'][0];	
			$config['upload_path'] = $path;
			$config['allowed_types'] = "png";
			$config['max_size'] ="10240";
			$config['max_widht'] = '1920';
			$config['max_height'] = '1080';
			$config['overwrite'] = TRUE;
			$config['remove_spaces'] = FALSE;
			$config['file_name'] = $imagetitle . '.png';
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('files')) {
				$error['error'] = $this->upload->display_errors();		
			}	
			//exit($path . '/' . $imagetitle . '.png');

		if(!empty($error)) {
			exit($error['error']);					
		}
		else 
		{
			if ($type=='title') {
				$this->formatImage($path . '/' . $imagetitle . '.png',340,200,"png",$path . '/' . $imagetitle . '.png');
				$list = file($listpath);
				if(!in_array($this->createListLine($imagetitle,$this->input->post('fulltitle')),$list)) {
					write_file($listpath, $this->createListLine($imagetitle,$this->input->post('fulltitle')), 'a+');
				}				
			}
			else if($type=='channel'){
				$this->formatImage($path . '/' . $imagetitle . '.png',550,502,"png",$path . '/' . $imagetitle . '.png');
				//exit($imagetitle);
				// $file = $this->basepath . $this->username . '/iptv/lists/live/list.txt';
				// $contents = 'http://appy.zone/'.$_SESSION['username'].'/iptv/images/live/'.$imagetitle.'.png;'.$this->input->post('fulltitle');
				// if(!is_file($file))
				// {
				//     file_put_contents($file, $contents);
				// }
				// else
				// {
				// 	$linije=file($file, FILE_IGNORE_NEW_LINES);
				// 	if(!in_array($contents, $linije))
				// 	{
				// 		write_file($file,"\n".$contents, "a+");
				// 	}

				// }				
			}
			else if($type=='sports')
			{
				$this->formatImage($path . '/' . $imagetitle . '.png',340,200,"png",$path . '/' . $imagetitle . '.png');
				
				$file = $this->basepath . $this->username . '/iptv/lists/sports/list.txt';
				$contents = 'http://appy.zone/'.$_SESSION['username'].'/iptv/images/sports/'.$imagetitle.'.png;'.$this->input->post('fulltitle');
				if(!is_file($file))
				{
				    file_put_contents($file, $contents);
				}
				else
				{
					$linije=file($file, FILE_IGNORE_NEW_LINES);
					if(!in_array($contents, $linije))
					{
						$linije[] = $contents;
						shell_exec('rm -rf ' . $file);
						for($i=0; $i<count($linije);$i++) {
							if($linije[$i]!='') {
								write_file($file,$linije[$i] . "\r\n", "a+");
							}
						}
					}
					else {
						shell_exec('rm -rf ' . $file);
						//write_file($file,$contents . "\r\n", "a+");
						for($i=0; $i<count($linije);$i++) {
							if($linije[$i]!='') {
								write_file($file,$linije[$i] . "\r\n", "a+");
							}
						}						
					}

				}
			}
			else if($type=='sportchannel')
			{
				$this->formatImage($path . '/' . $imagetitle . '.png',550,502,"png",$path . '/' . $imagetitle . '.png');
				// $file = $this->basepath . $this->username . '/iptv/lists/live/list.txt';
				// $contents = 'http://appy.zone/'.$_SESSION['username'].'/iptv/images/live/'.$imagetitle.'.png;'.$this->input->post('fulltitle');
				// if(!is_file($file))
				// {
				//     file_put_contents($file, $contents);
				// }
				// else
				// {
				// 	$linije=file($file, FILE_IGNORE_NEW_LINES);
				// 	if(!in_array($contents, $linije))
				// 	{
				// 		write_file($file,"\n".$contents, "a+");
				// 	}

				// }				
			}
			else if($type=='ls247channel')
			{
				$this->formatImage($path . '/' . $imagetitle . '.png',340,200,"png",$path . '/' . $imagetitle . '.png');
				$file = $this->basepath . $this->username . '/iptv/lists/247/list.txt';
				$contents = 'name="'.$this->input->post('fulltitle').'" tvg-logo="http://appy.zone/'.$_SESSION['username'].'/iptv/images/247/'.$imagetitle.'.png" group-title="' . $this->input->post('grouptitle')  . '"'         ."\n".$this->input->post('link');
				$checkforexist = 'name="'.$this->input->post('fulltitle').'" tvg-logo="http://appy.zone/'.$_SESSION['username'].'/iptv/images/247/'.$imagetitle.'.png" group-title="' . $this->input->post('grouptitle')  . '"';
				if(!is_file($file))
				{
				    file_put_contents($file, $contents);
				}
				else
				{
					$linije=file($file, FILE_IGNORE_NEW_LINES);
					//shell_exec('rm -rf ' . $file);
					if(!in_array($checkforexist, $linije))
					{
						$linije[] = $checkforexist;
						$linije[] = $this->input->post('link');
						shell_exec('rm -rf ' . $file);
						//write_file($file,$contents . "\r\n", "a+");
						for($i=0; $i<count($linije);$i++) {
							if($linije[$i]!='') {
								write_file($file,$linije[$i] . "\r\n", "a+");
							}
						}						
					}
					else {
						shell_exec('rm -rf ' . $file);
						//write_file($file,$contents . "\r\n", "a+");
						for($i=0; $i<count($linije);$i++) {
							if($linije[$i]!='') {
								write_file($file,$linije[$i] . "\r\n", "a+");
							}
						}
					}

				}				
			}			
			else {
				$this->formatImage($path . '/' . $imagetitle . '.png',340,200,"png",$path . '/' . $imagetitle . '.png');
			}		

			exit('ok');
		}
	}

	private function createListLine($title,$fulltitle) {
		return "http://appy.zone/" . $this->username . '/iptv/images/live/' . $title . '.png;' . $fulltitle . "\r\n";
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

	public function imagepath($type) {
		$imagetitle = trim(preg_replace($this->imagenotallowedchars,'',$this->input->post('title')));
		if ($type=='movie') {
			if ($this->username != 'FissNew') {
				$path = $this->basepath . $this->username . '/iptv/images/movies';
			}
			else {
				$path = $this->basepath . '/iptv/images/movies';
			}
		}
		else {
			$path =$this->basepath . $this->username . '/iptv/images/live';
		}
		if (file_exists($path . '/' . $imagetitle . '.png')) {
			if ($type=='movie') {
				if ($this->username != 'FissNew') {
					exit('http://appy.zone/' . $this->username . '/iptv/images/movies/' . $imagetitle . '.png');
				}
				else {
					exit('http://appy.zone/iptv/images/movies/' . $imagetitle . '.png');
				}				
			}
			else {
				exit('http://appy.zone/' . $this->username . '/iptv/images/live/' . $imagetitle . '.png');
			}
		}	
		else {
			exit('none');
		}
	}

	public function imdb($type) {
		$this->form_validation->set_rules('title','Title','required|trim');
		$this->form_validation->set_rules('edittitle','Edited Title','required|trim');
		$this->form_validation->set_rules('titlelink','Link','trim');
		if($this->form_validation->run()==FALSE)
		{
        	$this->output->set_content_type('application/json')//return json array
             ->set_output(json_encode(array('success' => 0)));	
		}
		else {
			require_once APPPATH."third_party/Imdb.php";
			if ($this->input->post('titlelink')=='') {
				$imdb = new Imdb($this->input->post('edittitle'));
				$data = json_decode($imdb->getData());
			}
			else {
				$link = explode('/', $this->input->post('titlelink'))[4];				
				$imdb = new Imdb($link);
				$data = json_decode($imdb->getDataByLink());				
			}

			if (isset($data->Error) ||  (isset($data->Plot) && strtolower(trim($data->Plot)) == 'n/a')) {
	        	$this->output->set_content_type('application/json')//return json array
	             ->set_output(json_encode(array('success' => 0)));
			}
			else {
				if ($type=='submit') {
					//load all changed
					$changedTitles = $this->cache->get($this->username . "_changed");	
					//load all notfound
					$notfound = $this->cache->get($this->username . "_notfound");
					//remove from notfound newly added one
					if (($key = array_search($this->input->post('title'), $notfound)) !== false) {
					    unset($notfound[$key]);
					}			
					$changedTitles[$this->input->post('title')][] = $data->Title;
					//save both caches
					$this->cache->save($this->username . "_changed", $changedTitles, $this->ttl);	
					$this->cache->save($this->username . "_notfound", $notfound, $this->ttl);
					//reset job	
					$this->load->model('imdbmodel');
					$this->imdbmodel->resetJob(array('username' => $this->username));

	        		$this->output->set_content_type('application/json')//return json array
	                   ->set_output(json_encode(array('success' => 1, 'data' => $notfound)));							
				}
				else if($type=='submitseries')
				{
					//load all changed
					$changedTitles = $this->cache->get($this->username . "_serieschanged");	
					//load all notfound
					$notfound = $this->cache->get($this->username . "_seriesnotfound");
					//remove from notfound newly added one
					if (($key = array_search($this->input->post('title'), $notfound)) !== false) {
					    unset($notfound[$key]);
					}			
					$changedTitles[$this->input->post('title')][] = $data->Title;
					//save both caches
					$this->cache->save($this->username . "_serieschanged", $changedTitles, $this->ttl);	
					$this->cache->save($this->username . "_seriesnotfound", $notfound, $this->ttl);
					//reset job	
					$this->load->model('imdbmodel');
					$this->imdbmodel->resetJob(array('username' => $this->username));

	        		$this->output->set_content_type('application/json')//return json array
	                   ->set_output(json_encode(array('success' => 1, 'data' => $notfound)));	
				}
				else {
		        	$this->output->set_content_type('application/json')//return json array
		             ->set_output(json_encode(array('success' => 1, 'data' => $data)));
				}
			}			
		}
	}

	public function manualedit($type) {

		$this->form_validation->set_rules('manualtitle','Title','required|trim');
		$this->form_validation->set_rules('manualedittitle','Edited Title','required|trim');
		$this->form_validation->set_rules('manualdesc','Description','required|trim');
		$this->form_validation->set_rules('manualimgurl','Image Url','required|trim');
		$this->form_validation->set_rules('manualgenre','Genre','required|trim');

		if($this->form_validation->run()==FALSE)
		{
        	$this->output->set_content_type('application/json')//return json array
             ->set_output(json_encode(array('success' => 0, 'error' => validation_errors())));	
		}
		else {

			$manualTitles = $this->cache->get($this->username . "_manualedit" . $type);
			$manualedited = 0;
			if(!empty($manualTitles)) {
				foreach ($manualTitles as $key => $value) {				
					if($value['editedtitle'] == $this->input->post('manualedittitle')) {
						if($key != $this->input->post('manualtitle')) {
							$manualedited = 1;
						}
					}
				}
			}
			if ($manualedited==0) {

				$stringtitle = trim(preg_replace('/\s+/', ' ', $this->input->post('manualedittitle')));
				$stringdesc = trim(preg_replace('/\s+/', ' ', $this->input->post('manualdesc')));
				$stringimg = trim(preg_replace('/\s+/', ' ', $this->input->post('manualimgurl')));
				$stringgenre = trim(preg_replace('/\s+/', ' ', $this->input->post('manualgenre')));

				$manualTitles[$this->input->post('manualtitle')]['editedtitle'] = $stringtitle;
				$manualTitles[$this->input->post('manualtitle')]['manualdesc'] = $stringdesc ;
				$manualTitles[$this->input->post('manualtitle')]['manualimgurl'] = $stringimg;
				$manualTitles[$this->input->post('manualtitle')]['manualgenre'] = $stringgenre;

				$notfound = $type=='movies' ? $this->cache->get($this->username . "_notfound") : $this->cache->get($this->username . "_seriesnotfound");
				//remove from notfound newly edited one if it exists
				if (($key = array_search($this->input->post('manualtitle'), $notfound)) !== false) {
				    unset($notfound[$key]);
				}

				//save both caches
				$this->cache->save($this->username . "_manualedit" . $type, $manualTitles, $this->ttl);
				if ($type=='movies') {
					$this->cache->save($this->username . "_notfound", $notfound, $this->ttl);
				}
				else {
					$this->cache->save($this->username . "_seriesnotfound", $notfound, $this->ttl);
				}

				//reset job	
				$this->load->model('imdbmodel');
				$this->imdbmodel->resetJob(array('username' => $this->username));	
				//return changed notfound array
	    		$this->output->set_content_type('application/json')//return json array
	               ->set_output(json_encode(array('success' => 1, 'data' => $notfound)));
			}
			else {
	        	$this->output->set_content_type('application/json')//return json array
	             ->set_output(json_encode(array('success' => 0, 'error' => 'This title was already used')));				
			}
		}		
	}
	public function populate($type)
	{	
		$this->form_validation->set_rules('manualtitle','Title','required|trim');

		if($this->form_validation->run()==FALSE)
		{
        	$this->output->set_content_type('application/json')//return json array
             ->set_output(json_encode(array('success' => 0, 'error' => validation_errors())));	
		}
		else {
			if ($type=='movies') {
				$manualTitles = $this->cache->get($this->username . "_manualeditmovies");
				$changedTitles = $this->cache->get($this->username . "_changed");
				$notfound = $this->cache->get($this->username . "_notfound");
			}
			else if ($type=='series') {
				$manualTitles = $this->cache->get($this->username . "_manualeditseries");
				$changedTitles = $this->cache->get($this->username . "_serieschanged");
				$notfound = $this->cache->get($this->username . "_seriesnotfound");
			}

			if (isset($manualTitles[$this->input->post('manualtitle')])) {
				$this->output->set_content_type('application/json')//return json array
		             ->set_output(json_encode($manualTitles[$this->input->post('manualtitle')]));
			}
			else if (isset($changedTitles[$this->input->post('manualtitle')])) {
				$data = $this->getImdbData(str_replace('&', '%26', $changedTitles[$this->input->post('manualtitle')][0]));				
				if ($data != 'no data') {
				
					$logo = '';
					$genre = '';
					$desc = '';
					$result = array();
					if (isset($data->Released))	{
						$releaseDate = date("d-m-Y", strtotime($data->Released));
						if(isset($data->Genre)) {
							if (strtotime($releaseDate) > strtotime(date("d-m-Y", strtotime("-6 months")))) {
								$genre = "Latest";
							}
							else {
								$genre = explode(",", $data->Genre)[0];
							}
						}
					}
					else {
						if(isset($data->Genre)) {
							$genre = explode(",", $data->Genre)[0];
						}
					}

					if (isset($data->Plot)) {
						$desc = $data->Plot;
					}
					if (isset($data->Poster)) {
						$logo = $data->Poster;
					}
					if (isset($data->Plot) && strtolower($data->Plot) != 'n/a') {
						$result['editedtitle'] = $changedTitles[$this->input->post('manualtitle')][0];
						$result['manualgenre'] = $genre;
						$result['manualdesc'] = $desc;
						$result['manualimgurl'] = $logo;
						//exit(print_r($result));
						$this->output->set_content_type('application/json')//return json array
				             ->set_output(json_encode($result));						
					}
					else {
			        	$this->output->set_content_type('application/json')//return json array
			             ->set_output(json_encode(array('success' => 0, 'error' => 'Not found')));							
					}								
				}				
			}		
			else {
				if (in_array($this->input->post('manualtitle'), $notfound)) {
		        	$this->output->set_content_type('application/json')//return json array
		             ->set_output(json_encode(array('success' => 0, 'error' => 'Not found')));					
				}
				else {
					$data = $this->getImdbData(str_replace('&', '%26', $this->input->post('manualtitle')));		

					if ($data != 'no data') {
					
						$logo = '';
						$genre = '';
						$desc = '';
						$result = array();
						if (isset($data->Released))	{
							$releaseDate = date("d-m-Y", strtotime($data->Released));
							if(isset($data->Genre)) {
								if (strtotime($releaseDate) > strtotime(date("d-m-Y", strtotime("-6 months")))) {
									$genre = "Latest";
								}
								else {
									$genre = explode(",", $data->Genre)[0];
								}
							}
						}
						else {
							if(isset($data->Genre)) {
								$genre = explode(",", $data->Genre)[0];
							}
						}

						if (isset($data->Plot)) {
							$desc = $data->Plot;
						}
						if (isset($data->Poster)) {
							$logo = $data->Poster;
						}
						if (isset($data->Plot) && strtolower($data->Plot) != 'n/a') {
							$result['editedtitle'] = $this->input->post('manualtitle');
							$result['manualgenre'] = $genre;
							$result['manualdesc'] = $desc;
							$result['manualimgurl'] = $logo;
							//exit(print_r($result));
							$this->output->set_content_type('application/json')//return json array
					             ->set_output(json_encode($result));						
						}
						else {
				        	$this->output->set_content_type('application/json')//return json array
				             ->set_output(json_encode(array('success' => 0, 'error' => 'Not found')));							
						}								
					}					
				}				
			}	
		}

	}

	private function getImdbData($moviename) {
		$imdb = new Imdb($moviename);
		$data = json_decode($imdb->getData());
		if (isset($data->Error)) {
			return "no data";
		}
		else {
			return $data;
		}
	}

	private static function alpha($a, $b) {
	    return strcmp($a[0], $b[0]);
	}

	public function sortlist($type) {
		$live= "/var/www/appy.zone/public_html/".$this->username."/iptv/lists/" . $type . "/list.txt";

		$currentlist = file($live, FILE_IGNORE_NEW_LINES);
		$newlist = $this->input->post('item');
		//$diff = is_array($newlist) ? array_diff($currentlist, $newlist) : array('t');

		//exit(print_r($newlist));
		shell_exec("rm -rf " . $live);
		for ($i=0; $i < count($newlist); $i++) {
			write_file($live, $currentlist[$newlist[$i]] . "\r\n", "a+");
		}
		echo 'success';
	}

	public function sortlist247() {

		$live= "/var/www/appy.zone/public_html/".$this->username."/iptv/lists/247/list.txt";

		$currentlist = file($live, FILE_IGNORE_NEW_LINES);
		$newlist = $this->input->post('item');

		$finallist = array();

		$niz = array();
		$i = 0;
		foreach($currentlist as $broj=>$pod)
		{
			if($broj%2==0)
			{
				$i++;
				if($pod!='') {
					$niz[$i]['naslov']=$pod;
				}
			}
			else
			{
				if($pod!='') {
					$niz[$i]['link']=$pod;
				}
			}
		}

		shell_exec("rm -rf " . $live);
		for ($i=0; $i < count($niz); $i++) {
			write_file($live, $niz[$newlist[$i]]['naslov'] . "\r\n", "a+");
			write_file($live, $niz[$newlist[$i]]['link'] . "\r\n", "a+");
		}
		echo 'success';	

	}	

	public function groupremove($type) {
		$imagetitle = trim(preg_replace($this->imagenotallowedchars,'',$this->input->post('title')));

		if ($type=='live') {
			$line = $this->createListLine($imagetitle,$this->input->post('fulltitle'));
		}
		else if ($type=='sports'){
			$line = 'http://appy.zone/'.$_SESSION['username'].'/iptv/images/sports/'.$imagetitle.'.png;'.$this->input->post('fulltitle');
		}

		$live= "/var/www/appy.zone/public_html/".$this->username."/iptv/lists/" . $type . "/list.txt";

		$currentlist = file($live, FILE_IGNORE_NEW_LINES);	
		$ind = 0;
		shell_exec("rm -rf " . $live);
		for ($i=0; $i < count($currentlist); $i++) {
			if(trim($currentlist[$i]) == trim($line)) {
				$ind = 1;
			}
			else {
				write_file($live, $currentlist[$i] . "\r\n", "a+");
			}
		}

		if ($ind==1) {
			exit('Group title removed');
		}
		else {
			exit('Selected group title is not in the current list');
		}
	}

	public function groupremove247() {

		$live= "/var/www/appy.zone/public_html/".$this->username."/iptv/lists/247/list.txt";

		$currentlist = file($live, FILE_IGNORE_NEW_LINES);

		$brojac = 0;

		$niz = array();

		for ($i=0; $i<count($currentlist); $i++) {
			if ($brojac%2 == 0) {
				preg_match_all('/(["\'])(?:(?=(\\\\?))\2.)*?\1/', $currentlist[$i], $matches, PREG_OFFSET_CAPTURE);
				if ($this->input->post('fulltitle') != str_replace('"', '', $matches[0][0][0])) {
					$niz[] = $currentlist[$i];
					$niz[] = $currentlist[$i+1];
				}
			}
			$brojac++;
		}
		shell_exec("rm -rf " . $live);
		for ($i=0; $i<count($niz); $i++) {
			write_file($live, $niz[$i] . "\r\n", "a+");
		}	
		exit('Channel removed from list');	
	}				

}