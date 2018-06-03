<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kodihub extends CI_Controller {

	private $basepath = '/var/www/appy.zone/public_html/';

	public function __Construct()
	{
		date_default_timezone_set('Europe/London');
		parent::__Construct();
	}

	//sync with kodihub and pass 5 categories into local database
	public function runAutoCompleteSync($user='',$pass='') {
		if ($user=='kodihub' && $pass=='kodihub') {
			$this->sync();
		}
		else {
			echo 'wrong credentials';
		}
	}

	private function sync() {
		$this->load->model('kodihubmodel');
		$most_downloaded = $this->makekodibuildline($this->kodihubmodel->most_downloaded());
		$recently_updated = $this->makekodibuildline($this->kodihubmodel->recently_updated());
		$most_popular = $this->makekodibuildline($this->kodihubmodel->most_popular());
		$new_arrivals = $this->makekodibuildline($this->kodihubmodel->new_arrivals());
		$smallest = $this->makekodibuildline(array_reverse($this->kodihubmodel->smallest_builds()));

		$this->kodihubmodel->insertData($most_downloaded,'Most_downloaded');
		$this->kodihubmodel->insertData($recently_updated,'Recently_updated');
		$this->kodihubmodel->insertData($most_popular,'Most_popular');
		$this->kodihubmodel->insertData($new_arrivals,'New_arrivals');
		$this->kodihubmodel->insertData($smallest,'Smallest_builds');
		$this->syncUsersWithData();

		exit('Success');
	}

	private function makekodibuildline($data) {
		$details = array();
		foreach($data as $build) {
			$buildsize = (int) $build['size']*1048576;
			array_push($details,"https://kodihub.net/" . $build['username'] . "/" . $build['title'] . "/tile.png;" . $build['title'] . ";" . "https://kodihub.net/" . $build['unique_chars'] . ";" . $buildsize . ";" . $build['genre']);	
		}
		$result = array();
		for($i=0;$i<count($details); $i++) {
			if(trim($details[$i])!='') {
				$result[] = trim($details[$i]);
			}
		}
		return $result;		
	}	

	private function makeBuildstxt() {
		$this->load->model('kodihubmodel');
		$all = $this->kodihubmodel->getall();
		$alldata = $this->makekodibuildline($all);
		for ($i=0; $i<count($alldata); $i++) {
			write_file("/var/www/html/proba/builds.txt", $alldata[$i] . "\r\n", 'a+');
		}
	}

	private function syncUsersWithData() {

		$this->load->model('kodihubmodel');

		$most_downloaded = $this->kodihubmodel->getBuilds('Most_downloaded');
		$recently_updated = $this->kodihubmodel->getBuilds('Recently_updated');
		$most_popular = $this->kodihubmodel->getBuilds('Most_popular');
		$new_arrivals = $this->kodihubmodel->getBuilds('New_arrivals');
		$smallest = $this->kodihubmodel->getBuilds('Smallest_builds');									
		$titles = 'Most Downloaded' . "\r\n" . 'Recently Updated' . "\r\n" . 'Most Popular' . "\r\n" . 'New Arrivals' . "\r\n" . 'Smallest Builds';

		$users = $this->kodihubmodel->getAutocompleteUsers();

		foreach ($users as $user) {
			$username = $user['username'] == 'FissNew' ? 'appy' : $user['username'];
			write_file($this->basepath . $username . '/V5/kodi/title.txt', $titles, 'w+');
			write_file($this->basepath . $username . '/V5/kodi/row1.txt', implode("\r\n",$most_downloaded), 'w+');
			write_file($this->basepath . $username . '/V5/kodi/row2.txt', implode("\r\n",$recently_updated), 'w+');
			write_file($this->basepath . $username . '/V5/kodi/row3.txt', implode("\r\n",$most_popular), 'w+');
			write_file($this->basepath . $username . '/V5/kodi/row4.txt', implode("\r\n",$new_arrivals), 'w+');
			write_file($this->basepath . $username . '/V5/kodi/row5.txt', implode("\r\n",$smallest), 'w+');
			write_file($this->basepath . $username . '/V5/kodi/rows.txt', '5', 'w+');
			chown($this->basepath . $username . '/V5/kodi/title.txt', 'apache');
			chown($this->basepath . $username . '/V5/kodi/row1.txt', 'apache');
			chown($this->basepath . $username . '/V5/kodi/row2.txt', 'apache');
			chown($this->basepath . $username . '/V5/kodi/row3.txt', 'apache');
			chown($this->basepath . $username . '/V5/kodi/row4.txt', 'apache');
			chown($this->basepath . $username . '/V5/kodi/row5.txt', 'apache');
			chown($this->basepath . $username . '/V5/kodi/rows.txt', 'apache');
		}	
	}
	
}