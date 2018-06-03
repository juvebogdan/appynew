	<?php	
		$filename="";
		$file_headers = @get_headers($filename);
		$re = '/group-title="(?s).*",/';
		$quotes = '/(["\'])(?:(?=(\\\\?))\2.)*?\1/';
		$seriematch = '/- S[0-9]./';
		$yearinname = '/\([0-9]*?\)/';
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
		$series = array();
		foreach($niz as $broj=>$pod)
		{
			// $group_titles[substr($pod['naslov'],strpos($pod['naslov'],'group-title="')+strlen('group-title="'),strpos($pod['naslov'],'"',strpos($pod['naslov'],'group-title="')+strlen('group-title="'))-(strpos($pod['naslov'],'group-title="')+strlen('group-title="')))][]=substr($pod['naslov'],strrpos($pod['naslov'],'"')+2,strlen($pod['naslov'])-strrpos($pod['naslov'],'"')+2);
			//echo $pod['link'] . '</br>';
			if((explode('/', $pod['link'])[3])=='movie')
			{
				//get rid of #EXTINF:-1 tvg-ID="" part of line
				$movie = substr($pod['naslov'], strpos($pod['naslov'], 'tvg-name') - 1);

				//find all instances of name,logo and group title				
				preg_match_all($quotes, $movie, $matches, PREG_OFFSET_CAPTURE);

				//get name of movie or serie
				$moviename = trim(str_replace('"', '', $matches[0][0][0]));
				//check for year in name
				preg_match_all($yearinname, $moviename, $matchesyear, PREG_OFFSET_CAPTURE);

				//insert only movies in file
				if (isset($matchesyear[0][0][0])) {
					//don't touch group title for adults
					if ($matches[0][2][0]=='"FOR ADULTS"') {
						$movie = "tvg-name=" . $matches[0][0][0] . ' tvg-logo=""' . ' group-title="FOR ADULTS"';
					}
					else {
						$movie = "tvg-name=" . $matches[0][0][0] . ' tvg-logo=""' . ' group-title=""';
					}
					//add description at the end
					$movie = trim($movie . ' description=""');
					//write in file
					echo $movie;
					//write_file($this->basepath . $this->username . '/iptv/lists/movies/list.txt', $movie . "\r\n", 'a+');
					//write_file($this->basepath . $this->username . '/iptv/lists/movies/list.txt', trim(substr($pod['link'], strrpos($pod['link'], '/', -1) + 1)) . "\r\n", 'a+');
				}
			}
		}

?>