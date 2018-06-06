<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."third_party/Imdb.php";

class Testing extends MY_Controller {

	public function proba()
	{
		//$filename="http://root-hosting.ddns.net:254461/get.php?username=appyv5&password=2201&type=m3u_plus&output=ts";
		$filename="http://p2.iptvprivateserver.tv:80/get.php?username=D27512G4168Z&password=D27512G4168Z&type=m3u_plus&output=ts";
		$file_headers = @get_headers($filename);
		if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') 
		{
		}
		//
		$lines = file($filename);
		//$lines=file("");
		array_splice($lines, 0, 1);
		//exit(print_r($lines));
		$i=0;
		foreach($lines as $broj=>$pod)
		{
			if($broj%2==0)
			{
				$i++;
				$niz[$i]['naslov']=$pod;
				preg_match_all('/"(.*?)"/', $pod, $matches, PREG_OFFSET_CAPTURE);
				$imena[]=$matches[1][1][0];
			}
			else
			{
				$niz[$i]['link']=$pod;	
			}
		}
		//print_r($imena);
		foreach ($imena as $broj=>$ime)
		{
			preg_match_all('/S[0-9][0-9].?E[0-9][0-9]/i', $ime, $rezultati, PREG_OFFSET_CAPTURE);
			//print_r($rezultati);
			if(isset($rezultati[0][0][0]))
				echo "$ime - serija <br>";
			else
			{
				preg_match_all('/(\(\d+)x(\d+)\)/', $ime, $rezultati);
				if(isset($rezultati[0][0][0]))
					echo "$ime - serija <br>";
				else
				{
					preg_match_all('/\((\d+)\)/', $ime, $rezultati);
					if(isset($rezultati[1][0]) && ($rezultati[1][0]>2018 || $rezultati[1][0]<1990))
					{echo "$ime - serija <br>";}
					else
					{
						echo "$ime <br>";
					}	
				}
			}
		}
	}
	public function rename_images($username)
	{
		$dir = "/var/www/appy.zone/public_html/$username/iptv/images/live/";
		$all = $this->cache->get($username);
		// if ($handle = opendir($dir)) 
		// {
	 //    	while (false !== ($file = readdir($handle))) 
	 //    	{
	 //        	if ($file != "." && $file != "..") 
	 //        	{
	 //            	$files[] = $file;
	 //        	}
	 //    	}
	 //    	closedir($handle);
		// }
		// foreach($files as $broj=>$file)
		// {
		// 	$newname=preg_replace($this->imagenotallowedchars,'',$file);
		// 	rename ($dir."/".$file, $dir."/".$newname);
		// 	echo "preimenovano $newname <br>";
		// }
		print_r($all);
		// $br= 0;
		// //rename($dir . "247:BugsBunnyClassics.png", $dir . "247BugsBunnyClassics.png");
		// foreach($all as $broj=>$niz)
		// {
		// 	foreach($niz as $broj2=>$niz2)
		// 	{
		// 		foreach($niz2 as $broj3=>$niz3)
		// 		{
		// 			$originalName = trim(str_replace(' ', '', $niz3['name']));
		// 			$sanitized = $this->_CI->security->sanitize_filename($originalName);
		// 			$sanitized = trim(str_replace(' ', '', $sanitized));
		// 			$originalName = trim(preg_replace($this->imagenotallowedchars,'',$originalName));
		// 			if (file_exists($dir . $sanitized . ".png")) {
		// 				echo $sanitized . " ----- " . $originalName .  "</br>";
		// 				rename($dir . $sanitized . ".png", $dir . $originalName . ".png");
		// 				$br++;
		// 			}
		// 		}
		// 	}
		// }
		// echo $br;
	}

	public function sorting() {
		if ($_SESSION['username'] == 'FissNew') {
			$live= "/var/www/appy.zone/public_html/iptv/lists/Live/list.txt";
		}
		else {
			$live= "/var/www/appy.zone/public_html/".$_SESSION['username']."/iptv/lists/247/list.txt";
		}
		$data['livelist'] = file($live, FILE_IGNORE_NEW_LINES);

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
		////////////////

		//print_r($data['livelist']);
		//var_dump($data['livelist'][1]);
		$this->load->view('sortable', $data);
	}

	public function sortlist() {
		if ($_SESSION['username'] == 'FissNew') {
			$live= "/var/www/appy.zone/public_html/iptv/lists/Live/list.txt";
		}
		else {
			$live= "/var/www/appy.zone/public_html/".$_SESSION['username']."/iptv/lists/live/list.txt";
		}
		$currentlist = file($live, FILE_IGNORE_NEW_LINES);
		$newlist = $this->input->post('item');
		$diff = is_array($newlist) ? array_diff($currentlist, $newlist) : array('t');
		if (empty($diff)) {
			shell_exec("rm -rf " . $live);
			for ($i=0; $i < count($newlist); $i++) {
				write_file($live, $newlist[$i] . "\r\n", "a+");
			}
			echo 'success';
		}
		else {
			echo 'error';
		}
	}

	public function sortlist247() {
		if ($_SESSION['username'] == 'FissNew') {
			$live= "/var/www/appy.zone/public_html/iptv/lists/247/list.txt";
		}
		else {
			$live= "/var/www/appy.zone/public_html/".$_SESSION['username']."/iptv/lists/247/list.txt";
		}	
		$currentlist = file($live, FILE_IGNORE_NEW_LINES);

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
		$currentlist = $niz;
		exit(print_r($currentlist));
	}	

	public function parse()
	{
		//$filename="http://root-hosting.ddns.net:254461/get.php?username=appyv5&password=2201&type=m3u_plus&output=ts";
		$filename="";
		$pozicija = strrpos('', '/');
		$link = substr('', $pozicija + 1);
		exit($link);
		$file_headers = @get_headers($filename);
		if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') 
		{
    		$num['group_titles']=array();
    		$num['live_group_titles']=array();	
			//$this->cache->save($this->username, $num, $this->ttl);
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

			if(isset(explode('/', $pod['link'])[6]) && (explode('/', $pod['link'])[3])=='live')
			{
				$live+=1;
				$live_group_titles[substr($pod['naslov'],strpos($pod['naslov'],'group-title="')+strlen('group-title="'),strpos($pod['naslov'],'"',strpos($pod['naslov'],'group-title="')+strlen('group-title="'))-(strpos($pod['naslov'],'group-title="')+strlen('group-title="')))][]=array('name' => trim(substr($pod['naslov'],strrpos($pod['naslov'],'"')+2,strlen($pod['naslov'])-strrpos($pod['naslov'],'"')+2)), 'link' => trim((explode('/', $pod['link'])[6])));
			}
		}

		$num['live_group_titles'] = isset($live_group_titles) ? $live_group_titles : array();
		//$this->cache->save($this->username, $num, $this->ttl);
		// if (file_exists($this->basepath . $this->username . '/iptv/lists/movies/list.txt')) {
		// 	$this->load->model('imdbmodel');
		// 	$this->imdbmodel->insertJob($this->username);
		// }
		print_r($num);
	}
	

}