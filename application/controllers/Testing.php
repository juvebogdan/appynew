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
			$live= "/var/www/appy.zone/public_html/".$_SESSION['username']."/iptv/lists/live/list.txt";
		}
		$data['livelist'] = file($live, FILE_IGNORE_NEW_LINES);
		//print_r($data['livelist']);
		//$this->load->view('sortable', $data);
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
			echo 'ok';
		}
		else {
			echo 'nista';
		}
	}

}