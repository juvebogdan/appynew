<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."third_party/Imdb.php";

class Imdbjob extends CI_Controller {

	private $job;
	private $quotes = '/(["\'])(?:(?=(\\\\?))\2.)*?\1/';
	private $yearinname = '/\([0-9]*?[A-z]*?\)/';
	private $seriematch = '/S[0-9][0-9].?E[0-9][0-9]/i';
	private $found = 0;
	private $notfound = 0;
	private $notfoundcacheFile;
	private $notfoundcacheseriesFile;
	private $ttl = 10000000000000000000000000000000000000000000000000000000000000000000; //time that cache is saved (infinity)
	private $notfoundarray = array();
	private $notfoundarrayseries = array();
	private $m3u;
	private $basepath = '/var/www/appy.zone/public_html/';

	private $pregmatchseriesarray = array('/S[0-9][0-9].?E[0-9][0-9]/i', '/(\(\d+)x(\d+)\)/','/\((\d+)\)/','/\((Cap.\d+)\)/');

	public function __Construct() {
		parent::__Construct();
		$this->load->model('imdbmodel');
		$this->job = $this->imdbmodel->getJob();
		$this->m3u = $this->imdbmodel->getM3u($this->job['username'])['m3u'];
		if (empty($this->job)) {
			exit('no jobs');
		}
		$this->load->driver('cache', ['adapter' => 'file']);
		$this->notfoundcacheFile = $this->job['username'] . "_notfound";
		$this->notfoundcacheseriesFile = $this->job['username'] . "_seriesnotfound";
	}

	public function runJob() {
		$username = $this->job['username'];
		$this->imdbmodel->setJobRunning($username);
		$num = $this->parse($this->m3u);
		//exit('parse prosao');
		$lines = array();
		if ($username != 'FissNew') {
			if(file_exists("/var/www/appy.zone/public_html/$username/iptv/lists/movies/list.txt")) {
				$lines = file("/var/www/appy.zone/public_html/$username/iptv/lists/movies/list.txt");
			}			
		}
		else {
			if(file_exists("/var/www/appy.zone/public_html/iptv/lists/Movies/list.txt")) {
				$lines = file("/var/www/appy.zone/public_html/iptv/lists/Movies/list.txt");
			}			
		}
		if(empty($lines)) {
			$this->runseriesjob();
			$this->imdbmodel->updateJob($this->job);
			$this->imdbmodel->finishJob($username);
		}
		//exit(print_r($lines));
		$newlines = array();
		$brojac = 0;
		foreach ($lines as $key => $value) {
			if ($key%2==0) {
				$newlines[$brojac]['naziv'] = $value;
				$newlines[$brojac]['link'] = $lines[$key + 1];
				$newlines[$brojac]['released'] = '01-01-1900';
				$brojac++;
			}
		}

		$onlyFoundTitles = array();
		$allmovies = array();
		$hasbeenchanged = 0;

		foreach($newlines as $key => $value)
		{
			preg_match_all($this->quotes, $value['naziv'], $matches, PREG_OFFSET_CAPTURE);
			$moviename = trim(str_replace('"', '', $matches[0][0][0]));
			
			preg_match_all($this->yearinname, $moviename, $matches, PREG_OFFSET_CAPTURE);
			//var_dump(strlen($moviename));
			if (isset($matches[0][0][0])) {
				$origmoviename = trim(substr($moviename, 0, $matches[0][0][1]));
				//echo $origmoviename . PHP_EOL;
				$manualTitles = $this->cache->get($this->job['username'] . "_manualeditmovies");

				if(isset($manualTitles[trim(substr($moviename, 0, $matches[0][0][1]))])) {
					$logo = $manualTitles[trim(substr($moviename, 0, $matches[0][0][1]))]['manualimgurl'];
					$genre = $manualTitles[trim(substr($moviename, 0, $matches[0][0][1]))]['manualgenre'];
					$desc = $manualTitles[trim(substr($moviename, 0, $matches[0][0][1]))]['manualdesc'];
					$moviename = $manualTitles[trim(substr($moviename, 0, $matches[0][0][1]))]['editedtitle'];
						$newlines[$key]['naziv'] = 'tvg-name="' . $moviename . '"' . ' tvg-logo="'  . $logo . '"' . ' group-title="' . $genre .'"' . ' description="' . $desc . '"';
						$onlyFoundTitles[] = $newlines[$key];
						$allmovies[] = array($moviename, $origmoviename);						
				}
				else {

					//get the name without year and check if it exists in cache username_changed and replace it if it exists
					$changedTitles = $this->cache->get($this->job['username'] . "_changed");

					//check if title exists in username_changed cache and replace it if exists
					if(isset($changedTitles[trim(substr($moviename, 0, $matches[0][0][1]))])) {
						$moviename = $changedTitles[trim(substr($moviename, 0, $matches[0][0][1]))][0] . " " . $matches[0][0][0];
						preg_match_all($this->yearinname, $moviename, $matches, PREG_OFFSET_CAPTURE);
						$allmovies[] = array(trim(substr($moviename, 0, $matches[0][0][1])), $origmoviename);
						$hasbeenchanged = 1;
					}

					//year in name is found and its on the end which means thats a movie
					$data = $this->getImdbData(trim(substr($moviename, 0, $matches[0][0][1])));
					if ($data != 'no data') {
					
						$logo = '';
						$genre = '';
						$desc = '';


						if (isset($data->Released))	{
							$releaseDate = date("d-m-Y", strtotime($data->Released));
							$newlines[$key]['released'] = $releaseDate;
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
							$newlines[$key]['naziv'] = 'tvg-name="' . $moviename . '"' . ' tvg-logo="'  . $logo . '"' . ' group-title="' . $genre .'"' . ' description="' . $desc . '"';
							$onlyFoundTitles[] = $newlines[$key];
							if ($hasbeenchanged == 0) {
								$allmovies[] = array($origmoviename, $origmoviename);
							}
						}
						else {
							$this->notfoundarray[] = trim(substr($moviename, 0, $matches[0][0][1]));
							$allmovies[] = array($origmoviename, $origmoviename);	
						}

					}
					else {
						$this->notfoundarray[] = trim(substr($moviename, 0, $matches[0][0][1]));
						//print(trim(substr($moviename, 0, $matches[0][0][1]))) . PHP_EOL;
						$allmovies[] = array($origmoviename, $origmoviename);
					}						
				}
			}
			else {
				$manualTitles = $this->cache->get($this->job['username'] . "_manualeditmovies");
				$origmoviename = $moviename;
				//echo $origmoviename . PHP_EOL;
				if(isset($manualTitles[trim($moviename)])) {
					$logo = $manualTitles[trim($moviename)]['manualimgurl'];
					$genre = $manualTitles[trim($moviename)]['manualgenre'];
					$desc = $manualTitles[trim($moviename)]['manualdesc'];
					$moviename = $manualTitles[trim($moviename)]['editedtitle'];
						$newlines[$key]['naziv'] = 'tvg-name="' . $moviename . '"' . ' tvg-logo="'  . $logo . '"' . ' group-title="' . $genre .'"' . ' description="' . $desc . '"';
						$onlyFoundTitles[] = $newlines[$key];
						//$lines[$key][$released] = '1970-05-05';
						$allmovies[] = array($moviename, $origmoviename);						
				}
				else {
					//Here are all movies that not contain year in title. We use complete title in search
					$changedTitles = $this->cache->get($this->job['username'] . "_changed");
					//check if title exists in username_changed cache and replace it if exists
					if(isset($changedTitles[trim($moviename)])) {
						$moviename = $changedTitles[trim($moviename)][0];
						$allmovies[] = array($moviename, $origmoviename);
					}

					//year in name is found and its on the end which means thats a movie
					$data = $this->getImdbData(trim($moviename));
					if ($data != 'no data') {
					
						$logo = '';
						$genre = '';
						$desc = '';


						if (isset($data->Released))	{
							$releaseDate = date("d-m-Y", strtotime($data->Released));
							$newlines[$key]['released'] = $releaseDate;
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
							$newlines[$key]['naziv'] = 'tvg-name="' . $moviename . '"' . ' tvg-logo="'  . $logo . '"' . ' group-title="' . $genre .'"' . ' description="' . $desc . '"';
							$onlyFoundTitles[] = $newlines[$key];
						}
						else {
							$this->notfoundarray[] = trim($moviename);
							$allmovies[] = array($origmoviename, $origmoviename);	
						}
						//echo $lines[$key] . "\r\n";						
					}
					else {
						$this->notfoundarray[] = trim($moviename);
						$allmovies[] = array($origmoviename, $origmoviename);
						//print(trim(substr($moviename, 0, $matches[0][0][1]))) . PHP_EOL;
					}					
				}					
			}
			$hasbeenchanged = 0;
		}
		//sortiranje po realease date-u
		usort($onlyFoundTitles, array('Imdbjob','date_sort'));
		usort($newlines, array('Imdbjob','alpha'));
		//exit(print_r($newlines));
		$this->cache->save($this->job['username'] . "_allmovies", $allmovies, $this->ttl);

		if ($username != 'FissNew') {
			shell_exec('rm -rf ' . "/var/www/appy.zone/public_html/$username/iptv/lists/movies/list.txt");
			//exit(print_r($lines));
			foreach ($onlyFoundTitles as $key => $value) {
				write_file("/var/www/appy.zone/public_html/$username/iptv/lists/movies/list.txt", trim($value['naziv']) . "\r\n", 'a+');
				write_file("/var/www/appy.zone/public_html/$username/iptv/lists/movies/list.txt", trim($value['link']) . "\r\n", 'a+');
			}
			foreach ($newlines as $key => $value) {
				write_file("/var/www/appy.zone/public_html/$username/iptv/lists/movies/templist.txt", trim($value['naziv']) . "\r\n", 'a+');
				write_file("/var/www/appy.zone/public_html/$username/iptv/lists/movies/templist.txt", trim($value['link']) . "\r\n", 'a+');
			}			
		}
		else {
			shell_exec('rm -rf ' . "/var/www/appy.zone/public_html/iptv/lists/Movies/list.txt");

			foreach ($onlyFoundTitles as $key => $value) {
				write_file("/var/www/appy.zone/public_html/iptv/lists/Movies/list.txt", trim($value['naziv']) . "\r\n", 'a+');
				write_file("/var/www/appy.zone/public_html/iptv/lists/Movies/list.txt", trim($value['link']) . "\r\n", 'a+');
			}
			foreach ($newlines as $key => $value) {
				write_file("/var/www/appy.zone/public_html/iptv/lists/Movies/templist.txt", trim($value['naziv']) . "\r\n", 'a+');
				write_file("/var/www/appy.zone/public_html/iptv/lists/Movies/templist.txt", trim($value['link']) . "\r\n", 'a+');
			}						
		}


		$this->cache->save($this->notfoundcacheFile, $this->notfoundarray, $this->ttl);
		chown("/var/www/appy.zone/public_html/appynew/application/cache/" . $this->job['username'] . "_notfound","apache");
		chown("/var/www/appy.zone/public_html/appynew/application/cache/" . $this->job['username'] . "_allmovies","apache");
		$this->runseriesjob();
		$this->imdbmodel->updateJob($this->job);
		$this->imdbmodel->finishJob($username);
		echo "ok";
	}

	public function runseriesjob() {
		$username = $this->job['username'];
		if ($username != 'FissNew') {
			shell_exec('rm -rf ' . "/var/www/appy.zone/public_html/$username/iptv/lists/series/list.txt");
			shell_exec('rm -rf ' . "/var/www/appy.zone/public_html/$username/iptv/lists/series/templist.txt");
		}
		else {
			shell_exec('rm -rf ' . "/var/www/appy.zone/public_html/iptv/lists/Series/list.txt");
			shell_exec('rm -rf ' . "/var/www/appy.zone/public_html/iptv/lists/Series/templist.txt");
		}

		$url = $this->imdbmodel->getM3uandEpg($username)['m3u'];
		$filename="$url";
		$file_headers = @get_headers($filename);
		$quotes = '/(["\'])(?:(?=(\\\\?))\2.)*?\1/';
		$seriematch = '/S[0-9][0-9].?E[0-9][0-9]/i';
		if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') 
		{
			echo $url;
			exit();
		}

		$lines = file($filename);
		//$lines=file("");
		array_splice($lines, 0, 1);
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

		//print_r($niz);
		// foreach($niz as $broj=>$pod)
		// {
		// 	$movie = substr($pod['naslov'], strpos($pod['naslov'], 'tvg-name') - 1);
		// 	preg_match_all('/(\(\d+)x?(\d+)\)/', $movie, $matches, PREG_OFFSET_CAPTURE);
		// 	print_r($matches);
		// }

		$series = array();
		foreach($niz as $broj=>$pod)
		{
			if(isset(explode('/', $pod['link'])[3]) && (explode('/', $pod['link'])[3])=='series') {
				$movie = substr($pod['naslov'], strpos($pod['naslov'], 'tvg-name') - 1);
				//search for - SX which indicates a series
				preg_match_all($seriematch, $movie, $matches, PREG_OFFSET_CAPTURE);
				if (isset($matches[0][0][0])) {
					//echo 'serija';
					$actualname = substr($movie, 0, $matches[0][0][1]);		
					//preg_match_all($quotes, $movie, $matchesname, PREG_OFFSET_CAPTURE);
					$strippedname = trim(str_replace('-', '', trim(substr($actualname, 11))));
					// $seriename = trim(explode("-", $strippedname)[0]);
					$episode = $matches[0][0][0];
					if($episode[3]!=' ') {
						$episode = strtoupper($episode[0]) . $episode[1] . $episode[2] . " " . strtoupper($episode[3]) . $episode[4] . $episode[5];
					}
					$strippedname = trim(str_replace('"', '', $strippedname));
					$series[$strippedname][$episode]['name'] = trim($movie);
					$series[$strippedname][$episode]['stripped'] = $strippedname;
					$series[$strippedname][$episode]['link'] = trim(substr($pod['link'], strrpos($pod['link'], '/', -1) + 1));
				}
			}
			else if (isset(explode('/', $pod['link'])[3]) && (explode('/', $pod['link'])[3])=='movie') {

				$movie = substr($pod['naslov'], strpos($pod['naslov'], 'tvg-name') - 1);
				//ovdje radim ovo jer adults nazivi imaju (234235) sto bi se tretiralo kao serija a ne treba
				preg_match_all($quotes, $movie, $matchesquotes, PREG_OFFSET_CAPTURE);

				if (!(strtolower($matchesquotes[0][2][0]) == '"for adults"')) {

					//search for 3x01 pattern
					//mora x postojati
					preg_match_all('/(\(\d+)x(\d+)\)/', $movie, $matches, PREG_OFFSET_CAPTURE);


					if (isset($matches[0][0][0])) {
						// if ($matches[0][0][1] == 'S03 E0625') {
						// 	echo $pod['naslov'] . PHP_EOL;
						// }
						$actualname = substr($movie, 0, $matches[0][0][1]);	
						//echo $movie . PHP_EOL;	
						
						$strippedname = trim(str_replace('-', '', trim(substr($actualname, 11))));
						//echo $strippedname . PHP_EOL;

						$episode = $matches[0][0][0];

						//removing ( from start and ) from end of string
						$episode = substr($episode, 0, -1);
						$episode = substr($episode, 1);

						$episode = explode('x', $episode);
						if (count($episode) > 1) {
							$season = $episode[0];
							if (strlen($season) == 1) {
								$season = '0' . $season;
							}
							$episode = 'S' . $season . ' ' . 'E' . $episode[1];
						}
						else if (count($episode) == 1 && strlen($episode[0]) == 3) {
							//ovaj else tretira naslove koje nemaju 'x' u broju i imaju tacno 4 karaktera. npr. 301
							$episode = 'S0' . $episode[0][0] . ' ' . 'E' . $episode[0][1] . $episode[0][2];
							//echo $episode;
						}
						$strippedname = trim(str_replace('"', '', $strippedname));
						$series[$strippedname][$episode]['name'] = trim($movie);
						$series[$strippedname][$episode]['stripped'] = $strippedname;
						$series[$strippedname][$episode]['link'] = trim(substr($pod['link'], strrpos($pod['link'], '/', -1) + 1));
					}
					else {
						//search for (S01E03)
						preg_match_all('/\(S[0-9][0-9].?E[0-9][0-9]\)/i', $movie, $matches, PREG_OFFSET_CAPTURE);					
						if (isset($matches[0][0][0])) {
							// if ($matches[0][0][1] == 'S03 E0625') {
							// 	echo $pod['naslov'] . PHP_EOL;
							// }
							$actualname = substr($movie, 0, $matches[0][0][1]);	
							//echo $movie . PHP_EOL;	
							
							$strippedname = trim(str_replace('-', '', trim(substr($actualname, 11))));
							//echo $strippedname . PHP_EOL;

							$episode = $matches[0][0][0];

							//removing ( from start and ) from end of string
							$episode = substr($episode, 0, -1);
							$episode = substr($episode, 1);
							
							if($episode[3]!=' ') {
								$episode = strtoupper($episode[0]) . $episode[1] . $episode[2] . " " . strtoupper($episode[3]) . $episode[4] . $episode[5];
							}

							$strippedname = trim(str_replace('"', '', $strippedname));
							$series[$strippedname][$episode]['name'] = trim($movie);
							$series[$strippedname][$episode]['stripped'] = $strippedname;
							$series[$strippedname][$episode]['link'] = trim(substr($pod['link'], strrpos($pod['link'], '/', -1) + 1));
						}
					}
				}
			}
		}
		ksort($series);
		foreach ($series as $key => $value) {
			if(is_array($value)) {
				ksort($value);
				//exit(print_r($value));
				$series[$key] = $value;
			}
		}

		$allseriesarray = array();

		$manualTitles = $this->cache->get($this->job['username'] . "_manualeditseries");
		$changedTitles = $this->cache->get($this->job['username'] . "_serieschanged");

		foreach ($series as $serie => $episodes) {

			if (isset($manualTitles[$serie])) {
				$allseriesarray[] = array($manualTitles[$serie]['editedtitle'], $serie);
			}
			else if (isset($changedTitles[$serie])) {
				$allseriesarray[] = array($changedTitles[$serie][0], $serie);
			}
			else {
				$allseriesarray[] = array($serie, $serie);
			}

		}
		$this->cache->save($this->job['username'] . "_allseries", $allseriesarray, $this->ttl);	

		foreach ($series as $serie => $episodes) {
			$i = 0;
			$found = 0;
			foreach ($series[$serie] as $episode => $metadata) {

				if(isset($manualTitles[$serie])) {
					$found = 1;
					$logo = $manualTitles[$serie]['manualimgurl'];
					$genre = $manualTitles[$serie]['manualgenre'];
					$desc = $manualTitles[$serie]['manualdesc'];
					$moviename = $manualTitles[$serie]['editedtitle'];
					if ($i==0) {
						$completeName = $moviename . " - " . $episode;
						$towrite = 'tvg-name="' . $completeName . '"' . ' tvg-logo="'  . $logo . '"' . ' group-title="' . $genre .'"' . ' description="' . $desc . '"';
						//echo $towrite . PHP_EOL;
						if ($username != 'FissNew') {
							write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/list.txt", trim($towrite) . "\r\n", 'a+');					
							write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/list.txt", trim($metadata['link']) . "\r\n", 'a+');
							write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/templist.txt", trim($towrite) . "\r\n", 'a+');					
							write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/templist.txt", trim($metadata['link']) . "\r\n", 'a+');							
						}
						else {
							write_file("/var/www/appy.zone/public_html/iptv/lists/Series/list.txt", trim($towrite) . "\r\n", 'a+');					
							write_file("/var/www/appy.zone/public_html/iptv/lists/Series/list.txt", trim($metadata['link']) . "\r\n", 'a+');
							write_file("/var/www/appy.zone/public_html/iptv/lists/Series/templist.txt", trim($towrite) . "\r\n", 'a+');					
							write_file("/var/www/appy.zone/public_html/iptv/lists/Series/templist.txt", trim($metadata['link']) . "\r\n", 'a+');														
						}	
					}
					else {
						$completeName = $moviename . " - " . $episode;
						$towrite = 'tvg-name="' . $completeName . '"' . ' tvg-logo=""' . ' group-title=""' . ' description=""';
						if ($username != 'FissNew') {
							write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/list.txt", $towrite . "\r\n", 'a+');
							write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/list.txt", trim($metadata['link']) . "\r\n", 'a+');
							write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/templist.txt", $towrite . "\r\n", 'a+');
							write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/templist.txt", trim($metadata['link']) . "\r\n", 'a+');							
						}
						else {
							write_file("/var/www/appy.zone/public_html/iptv/lists/Series/list.txt", $towrite . "\r\n", 'a+');
							write_file("/var/www/appy.zone/public_html/iptv/lists/Series/list.txt", trim($metadata['link']) . "\r\n", 'a+');
							write_file("/var/www/appy.zone/public_html/iptv/lists/Series/templist.txt", $towrite . "\r\n", 'a+');
							write_file("/var/www/appy.zone/public_html/iptv/lists/Series/templist.txt", trim($metadata['link']) . "\r\n", 'a+');														
						}						
					}
					$i++;						
				}
				else {
					//ako ga ima u changed treba da trazi po tome imenu

					//get the name from username_serieschanged
					//$changedTitles = $this->cache->get($this->job['username'] . "_serieschanged");
					//check if title exists in username_changed cache and replace it if exists
					if(isset($changedTitles[$serie])) {
						$serie = $changedTitles[$serie][0];
					}
					if ($i == 0) {

						$data = $this->getImdbData(str_replace('&', '%26', $serie));
						if ($data != 'no data') {
						
							$logo = '';
							$genre = '';
							$desc = '';


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
								$found = 1;
								$completeName = $serie . " - " . $episode;
								$towrite = 'tvg-name="' . $completeName . '"' . ' tvg-logo="'  . $logo . '"' . ' group-title="' . $genre .'"' . ' description="' . $desc . '"';	
								if ($username != 'FissNew') {
									write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/list.txt", trim($towrite) . "\r\n", 'a+');					
									write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/list.txt", trim($metadata['link']) . "\r\n", 'a+');
									write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/templist.txt", trim($towrite) . "\r\n", 'a+');					
									write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/templist.txt", trim($metadata['link']) . "\r\n", 'a+');										
								}
								else {
									write_file("/var/www/appy.zone/public_html/iptv/lists/Series/list.txt", trim($towrite) . "\r\n", 'a+');					
									write_file("/var/www/appy.zone/public_html/iptv/lists/Series/list.txt", trim($metadata['link']) . "\r\n", 'a+');
									write_file("/var/www/appy.zone/public_html/iptv/lists/Series/templist.txt", trim($towrite) . "\r\n", 'a+');					
									write_file("/var/www/appy.zone/public_html/iptv/lists/Series/templist.txt", trim($metadata['link']) . "\r\n", 'a+');																		
								}
							}	
							else {
								$this->notfoundarrayseries[]=trim($serie);
							}								
						}
						else {
							$this->notfoundarrayseries[]=trim($serie);
							if ($username != 'FissNew') {
								write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/templist.txt", trim($metadata['name']) . "\r\n", 'a+');
								write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/templist.txt", trim($metadata['link']) . "\r\n", 'a+');
							}
							else {
								write_file("/var/www/appy.zone/public_html/iptv/lists/Series/templist.txt", trim($metadata['name']) . "\r\n", 'a+');
								write_file("/var/www/appy.zone/public_html/iptv/lists/Series/templist.txt", trim($metadata['link']) . "\r\n", 'a+');								
							}						
						}					
					}
					else {
						$completeName = $serie . " - " . $episode;
						$towrite = 'tvg-name="' . $completeName . '"' . ' tvg-logo=""' . ' group-title=""' . ' description=""';	
						if ($username != 'FissNew') {
							write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/templist.txt", $towrite . "\r\n", 'a+');
							write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/templist.txt", trim($metadata['link']) . "\r\n", 'a+');
							if ($found == 1) {
								write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/list.txt", $towrite . "\r\n", 'a+');
								write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/list.txt", trim($metadata['link']) . "\r\n", 'a+');
							}
						}
						else {
							write_file("/var/www/appy.zone/public_html/iptv/lists/Series/templist.txt", $towrite . "\r\n", 'a+');
							write_file("/var/www/appy.zone/public_html/iptv/lists/Series/templist.txt", trim($metadata['link']) . "\r\n", 'a+');
							if ($found == 1) {
								write_file("/var/www/appy.zone/public_html/iptv/lists/Series/list.txt", $towrite . "\r\n", 'a+');
								write_file("/var/www/appy.zone/public_html/iptv/lists/Series/list.txt", trim($metadata['link']) . "\r\n", 'a+');
							} 							
						}	
					}
					$i++;
				}
			}

			if ($username != 'FissNew') {
				write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/templist.txt", "" . "\r\n", 'a+');
				if ($found == 1) {
					write_file("/var/www/appy.zone/public_html/$username/iptv/lists/series/list.txt", "" . "\r\n", 'a+');
				}
			}
			else {
				write_file("/var/www/appy.zone/public_html/iptv/lists/Series/templist.txt", "" . "\r\n", 'a+');	
				if ($found == 1) {
					write_file("/var/www/appy.zone/public_html/iptv/lists/Series/list.txt", "" . "\r\n", 'a+');
				}			
			}
			$found = 0;
		}
		$this->cache->save($this->notfoundcacheseriesFile, $this->notfoundarrayseries, $this->ttl);
		chown("/var/www/appy.zone/public_html/appynew/application/cache/" . $this->job['username'] . "_seriesnotfound","apache");
		chown("/var/www/appy.zone/public_html/appynew/application/cache/" . $this->job['username'] . "_allseries","apache");	
		return;		
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

	private function parse($url)
	{
		//$filename="http://root-hosting.ddns.net:254461/get.php?username=appyv5&password=2201&type=m3u_plus&output=ts";
		$filename="$url";
		$file_headers = @get_headers($filename);
		if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') 
		{
    		$num['group_titles']=array();
    		$num['live_group_titles']=array();	
			$this->cache->save($this->job['username'], $num, $this->ttl);
			$this->imdbmodel->updateJob($this->job);
			return $num;
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
			}
			else
			{
				$niz[$i]['link']=$pod;	
			}
		}
		$live=0;
		$movie=0;
		$tv_show=0;
		if ($this->job['username'] != 'FissNew') {
			shell_exec('rm -rf ' . $this->basepath . $this->job['username'] . '/iptv/lists/movies/list.txt');
			shell_exec('rm -rf ' . $this->basepath . $this->job['username'] . '/iptv/lists/movies/templist.txt');
		}
		else {
			shell_exec('rm -rf ' . $this->basepath . '/iptv/lists/Movies/list.txt');
			shell_exec('rm -rf ' . $this->basepath . '/iptv/lists/Movies/templist.txt');
		}

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
			else if(isset(explode('/', $pod['link'])[3]) && (explode('/', $pod['link'])[3])=='movie')
			{
				//echo 'film je';
				//get rid of #EXTINF:-1 tvg-ID="" part of line
				$movie = substr($pod['naslov'], strpos($pod['naslov'], 'tvg-name') - 1);

				//find all instances of name,logo and group title				
				preg_match_all($this->quotes, $movie, $matches, PREG_OFFSET_CAPTURE);

				//get name of movie or serie
				$moviename = trim(str_replace('"', '', $matches[0][0][0]));

				$isserie = 0;
				foreach ($this->pregmatchseriesarray as $key => $value) {
					preg_match_all($value, $movie, $matchesserie, PREG_OFFSET_CAPTURE);
					if ($key != 2) {
						if (isset($matchesserie[0][0][0])) {
							$isserie = 1;
							break;
						}
					}
					else {
						if(isset($matchesserie[0][0][0]) && $matchesserie[1][0]>2019 && $matchesserie[1][0]<1900) {
							$isserie = 1;
							break;
						}
					}
				}


				if (!$isserie) {
					//don't touch group title for adults
					if (strtolower($matches[0][2][0]) == '"for adults"') {
						$movie = "tvg-name=" . $matches[0][0][0] . ' tvg-logo=""' . ' group-title="FOR ADULTS"';
					}
					else {
						$movie = "tvg-name=" . $matches[0][0][0] . ' tvg-logo=""' . ' group-title=""';
						//add description at the end
						$movie = trim($movie . ' description=""');
						//write in file
						//echo 'write';
						if ($this->job['username'] != 'FissNew') {
							//echo "writting";
							write_file($this->basepath . $this->job['username'] . '/iptv/lists/movies/list.txt', $movie . "\r\n", 'a+');
							write_file($this->basepath . $this->job['username'] . '/iptv/lists/movies/list.txt', trim(substr($pod['link'], strrpos($pod['link'], '/', -1) + 1)) . "\r\n", 'a+');
						}
						else {
							//echo 'pisi fajl';
							write_file($this->basepath . '/iptv/lists/Movies/list.txt', $movie . "\r\n", 'a+');
							write_file($this->basepath . '/iptv/lists/Movies/list.txt', trim(substr($pod['link'], strrpos($pod['link'], '/', -1) + 1)) . "\r\n", 'a+');
						}

					}
				}
				$isserie = 0;
			}
		}

		$num['live_group_titles'] = isset($live_group_titles) ? $live_group_titles : array();
		$this->cache->save($this->job['username'], $num, $this->ttl);

		if (file_exists($this->basepath . $this->job['username'] . '/iptv/lists/movies/list.txt')) {
			$this->load->model('imdbmodel');
			$this->imdbmodel->insertJob($this->job['username']);
		}
		//exit(print_r($num));
		return $num;
	}

	public function fix() {

		$user = 'bogdan';

		shell_exec('rm -rf ' . $this->basepath . "$user/iptv/lists/live/list.txt");
		shell_exec('rm -rf ' . $this->basepath . "$user/iptv/lists/247/list.txt");
		shell_exec('rm -rf ' . $this->basepath . "$user/iptv/lists/sports/list.txt");
		//exit();
		$flames = $this->cache->get("$user")['live_group_titles'];
		$ls24 = file($this->basepath . "$user/iptv/247.txt");
		$sports = file($this->basepath . "$user/iptv/sports.txt");
		$lineslive = array();
		$lines247 = array();
		$linessports = array();
		foreach ($ls24 as $key => $value) {
			$ls24[$key] = trim($value);
		}
		foreach ($sports as $key => $value) {
			$sports[$key] = trim($value);
		}		
		foreach ($flames as $group => $value) {
			$grouptitle = trim(preg_replace('/[\'^£$%&*\/()}{@#~?><>,|=_+¬-]/','',$group));
			$grouptitle = str_replace(' ', '', $grouptitle);
			if (file_exists($this->basepath . "$user/iptv/images/live/" . $grouptitle . '.png')) {
				$towrite = $this->basepath . "$user/iptv/images/live/" . $grouptitle . '.png;' . $group;
				$towrite = str_replace('/var/www/appy.zone/public_html/', 'http://appy.zone/', trim($towrite));				
				if (in_array($group, $ls24)) {
					//$lines247[] = $towrite;
				}
				else if (in_array($group, $sports)) {
					//echo $key . ' ' . $value . PHP_EOL;
					$linessports[] = $towrite;
				}
				else {
					//echo $group . ' ' . $value . PHP_EOL; 
					$lineslive[] = $towrite;
				}
				//echo $towrite . PHP_EOL;
			}
			foreach ($value as $key => $value) {
				$imagetitle = trim(preg_replace('/[\'^£$%&*\/()}{@#~?><>,|=_+¬-]/','',$value['name']));
				$imagetitle = str_replace(' ', '', $imagetitle);
				if (file_exists($this->basepath . "$user/iptv/images/live/" . $imagetitle . '.png')) {

					if (in_array($group, $ls24)) {
						$towrite = 'name="'.$value['name'].'" tvg-logo="http://appy.zone/'.$user.'/iptv/images/live/'.$imagetitle.'.png" group-title="' . $group  . '"';						
						$lines247[] = $towrite;
						$lines247[] = $value['link'];
					}
				}
			}
		}
		//exit();
		//exit(print_r($lines247));
		foreach ($lineslive as $key => $value) {
			//echo $value . PHP_EOL;
			write_file($this->basepath . "$user/iptv/lists/live/list.txt", trim($value) . "\r\n", 'a+');
		}
		foreach ($lines247 as $key => $value) {
			//echo $value . PHP_EOL;
			write_file($this->basepath . "$user/iptv/lists/247/list.txt", trim($value) . "\r\n", 'a+');
		}
		foreach ($linessports as $key => $value) {
			//echo $value . PHP_EOL;
			write_file($this->basepath . "$user/iptv/lists/sports/list.txt", trim($value) . "\r\n", 'a+');
		}
		chown($this->basepath . "$user/iptv/lists/live/list.txt","apache");
		chown($this->basepath . "$user/iptv/lists/247/list.txt","apache");
		chown($this->basepath . "$user/iptv/lists/sports/list.txt","apache");		
		
	}

	private static function date_sort($a, $b) {
	    return strtotime($b['released']) - strtotime($a['released']);
	}

	private static function alpha($a, $b) {
	    return strcmp($a['naziv'], $b['naziv']);
	}

}