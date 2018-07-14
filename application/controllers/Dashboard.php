<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	private $username;

	public function __Construct()
	{
		parent::__Construct();
		if ($_SESSION['username']=='Rooty') {
			redirect('http://appy.zone','refresh');
		}		
		$this->username = $_SESSION['username'] == 'FissNew' ? 'appy' : $_SESSION['username'];
	}

	public function lodi() {
		$this->load->model('lodimodel');
		$data['today'] = $this->lodimodel->getNumberOfUsers('today');
		$data['thismonth'] = $this->lodimodel->getNumberOfUsers('thismonth');
		$data['thisweek'] = $this->lodimodel->getNumberOfUsers('thisweek');
		$data['numall'] = $this->lodimodel->getNumberOfUsers('all');
		$data['users'] = $this->lodimodel->getUsers();
		$this->load->view('dashboard/lodi',$data);
	}

	public function vpn() {
		$this->load->model('vpnmodel');
		$data['podaci']=$this->vpnmodel->all_data();
		$this->load->view('dashboard/vpn',$data);
	}

	public function kodihub() {
		$this->load->model('kodihubmodel');
		$data['numclients'] = $this->kodihubmodel->getNumOfUsers();
		$data['numbuilds'] = $this->kodihubmodel->getNumOfBuilds();
		$data['numdownloads'] = $this->kodihubmodel->getNumOfDownloads();
		$data['users'] = $this->kodihubmodel->getUsers();
		$this->load->view('dashboard/kodihub',$data);
	}

	public function appy() {
		$oldtypearray = array('basicmulti','basicsingle','gateway','gatewaymulti','gatewaysingle','muvi');
		$this->load->model('appymodel');
		$plans=$this->appymodel->bussiness_stat();
		foreach($plans as $a=>$b)
		{
			$plan1[$b['type']]=$b['broj'];
		}
		$sum = 0;
		foreach ($plan1 as $key => $value) {
			if (in_array($key, $oldtypearray)) {
				$sum = $sum + $value;
			}
		}
		//print_r($plan1);
		$data['plans']=$plan1;
		$data['oldnumber'] = $sum;
		$data['all']=$this->appymodel->all_users();
		$this->load->view('dashboard/appyzone',$data);
	}
	//maci komentare ujutru
	public function userlookup() {

		$this->form_validation->set_rules('user','User','trim|required');

		if($this->form_validation->run()==FALSE){
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 0, 'error' => validation_errors())));			
		}	
		else {
			$this->load->model('lodimodel');
			$user = $this->lodimodel->lookupUser($this->input->post('user'));
			$numofbuilds = $this->lodimodel->numOfBuilds($this->input->post('user'));
			$numofhits = $this->lodimodel->numberOfHits($this->input->post('user'));
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 1, 'users' => $user, 'builds' => $numofbuilds, 'hits' => $numofhits)));
		}		
	}

	public function lodicsv() {
		$conn=mysqli_connect('46.101.90.250','appy','appy','phptest');if(!$conn){exit;};
		$sql=sprintf('select * from users');
		$result=mysqli_query($conn,$sql);

		$export = array();
		while($res=mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
		$arr = array();
		$arr[] = $res['username'];
		$arr[] = $res['password'];
		$arr[] = $res['confirmed'];
		$export[]=$arr;
		}
		echo json_encode($export);
		mysqli_close($conn);				
	}

	public function kodicsv() {
		$conn=mysqli_connect('165.227.152.79','kodihub','kodihub','lodihub');if(!$conn){exit;};
		$sql=sprintf('select * from users');
		$result=mysqli_query($conn,$sql);

		$export = array();
		while($res=mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
		$arr = array();
		$arr[] = $res['email'];
		$arr[] = $res['password'];
		$arr[] = $res['active'];
		$export[]=$arr;
		}
		echo json_encode($export);
		mysqli_close($conn);				
	}	

	public function kodiuserlookup() {

		$this->form_validation->set_rules('user','User','trim|required');

		if($this->form_validation->run()==FALSE){
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 0, 'error' => validation_errors())));			
		}	
		else {
			$this->load->model('kodihubmodel');
			$pass = $this->kodihubmodel->lookupUser($this->input->post('user'));
			$builds = $this->kodihubmodel->getBuildsforUser($this->input->post('user'));
			if (!empty($builds)) {
				$this->output->set_content_type('application/json')->set_output(json_encode(array(
					'status' => 1,
					'password' => $pass,
					'builds' => $builds)));
			}
			else {
				$this->output->set_content_type('application/json')->set_output(json_encode(array(
					'status' => 1,
					'password' => $pass,
					'builds' => 'nobuilds')));				
			}
		}		
	}
	public function rmuser()
	{
		$user=$this->input->get('u');
		$this->load->model('appymodel');
		$broj=$this->appymodel->rm_clients($user);
		$this->appymodel->rm_pendings($user);
		if($broj==1)
		{
			shell_exec("rm -rf /var/www/appy.zone/public_html/$user");
			$this->load->helper('url');
			redirect('/dashboard/appy', 'refresh');
		}

	}
	public function client_users()
	{
		$a['code']='';
		$res=array();
		$user=$this->input->post('name');
		$versionc=file_get_contents("/var/www/appy.zone/public_html/$user/VersionCode.txt");
		$a['code']=$versionc;
		$this->load->model('appymodel');
		$podaci=$this->appymodel->num_user_client($user);
		if($podaci[0]['ipaddress']=='')
		{
			$res['broj']='';
			
		}
		else
		{
			$conn=  mysqli_connect($podaci[0]['ipaddress'],$podaci[0]['dbusername'],$podaci[0]['dbpassword'],$podaci[0]['dbname']);if(!$conn){exit('Connection failed');};
			$sql=sprintf('select count(*) as broj from DeviceIDTable');
			$result=mysqli_query($conn,$sql);
			$res=mysqli_fetch_array($result,MYSQLI_ASSOC);
			$this->load->model('vpnmodel');
			$vpnpod=$this->vpnmodel->uservpn($user);
			if(isset($vpnpod[0]['saldo']))
			{
				$a['saldo']=$vpnpod[0]['saldo'];
			}
			else
			{
				$a['saldo']='';
			}
			$a['broj']=$res['broj'];
		}
		
		//exit($vpnpod[0]['saldo']);
		$this->output->set_content_type('application/json')->set_output(json_encode($a));
	}
	public function ch_vc()
	{
		$user=$this->input->post('name');
		$text=$this->input->post('code');
		file_put_contents("/var/www/appy.zone/public_html/$user/VersionCode.txt", $text);
	}
	public function downloadfile()
	{
		$user=$this->input->get('u');
		$this->load->helper('download');
		$text=file_get_contents("http://165.227.38.2/users/$user/info.txt");
		force_download('job.txt', $text);
	}
	public function downloadfile2()
	{
		$starter='';
		$bussiness='';
		$ultimate='';
		$other='';
		$type=$this->input->get('u');
		$this->load->model('appymodel');
		$this->load->helper('download');
		$emails=$this->appymodel->all_users();
		foreach($emails as $a=>$b)
		{
			if($b['type']=='starter')
			{
				$starter.=$b['email']."\t".$b['type']."\n";
			}
			else if($b['type']=='appy')
			{
				$bussiness.=$b['email']."\t".$b['type']."\n";	
			}
			else if($b['type']=='ultimate')
			{
				$ultimate.=$b['email']."\t".$b['type']."\n";	
			}
			else
			{
				$other.=$b['email']."\t".$b['type']."\n";
			}
		}
		if($type=='starter')
			{force_download('emails.csv', $starter);}
		else if($type=='appy')
			{force_download('emails.csv', $bussiness);}
		else if($type=='ultimate')
			{force_download('emails.csv', $ultimate);}
		else
			{force_download('emails.csv', $other);}
	}
	public function downloadclientemails()
	{
		$mails="";
		$this->load->model('vpnmodel');
		$this->load->helper('download');
		$emails=$this->vpnmodel->client_email();
		foreach($emails as $a=>$b)
		{
			$mails.=$b['email']." \n";
		}
		force_download('emails.csv', $mails);
	}	

	public function buildData() {
		$this->form_validation->set_rules('code','Build','trim|required');

		if($this->form_validation->run()==FALSE){
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 0, 'error' => validation_errors())));			
		}	
		else {
			$this->load->model('kodihubmodel');
			$data = $this->kodihubmodel->getBuildData($this->input->post('code'));
			$this->output->set_content_type('application/json')->set_output(json_encode(array(
				'status' => 1,
				'buildData' => $data)));
		}		
	}

	public function removebuild() {
			$this->form_validation->set_rules('buildname','Build Name','required|trim');

			if($this->form_validation->run()==FALSE){
				exit(validation_errors());
			}
			else {
				$this->load->model('kodihubmodel');
				$details = $this->kodihubmodel->getDetailsFromCode($this->input->post('buildname'));
				$this->kodihubmodel->deleteBuild($this->input->post('buildname'));
				$this->deleteBuildAPI($details[0]['username'],$details[0]['title']);

				$oldbuild = "https://kodihub.net/" . $details[0]['username'] . "/" . $details[0]['title'] . "/tile.png" . ";" . $details[0]['title'] . ';https://kodihub.net/' . $details[0]['unique_chars'] . ";" . $details[0]['size']*1048576 . ";" . $details[0]['genre'];

				$this->removeMasterBuildAppyAPI($oldbuild);

				$this->output->set_content_type('application/json')->set_output(json_encode(array(
					'status' => 1,
					'result' => 'Build deleted')));							
			}
	}

	public function removeuser() {
			$this->form_validation->set_rules('user','User','required|trim');

			if($this->form_validation->run()==FALSE){
				exit(validation_errors());
			}
			else {
				$this->load->model('kodihubmodel');
				$builds = $this->kodihubmodel->getBuildsforUser($this->input->post('user'));
				$username = $this->kodihubmodel->getUsername($this->input->post('user'));
				foreach ($builds as $build) {
					$this->removeBuildProcedure($build);
				}
				$this->kodihubmodel->deleteUser($this->input->post('user'));
				$this->removeUserFolderAPI($username);
				$this->output->set_content_type('application/json')->set_output(json_encode(array(
					'status' => 1,
					'result' => 'User deleted')));							
			}
	}	

	private function deleteBuildAPI($user,$buildname) {
	    $username = 'kodihub';
	    $password = 'fisstops';
	     
	    // Alternative JSON version
	    // $url = 'http://twitter.com/statuses/update.json';
	    // Set up and execute the curl process
	    $curl_handle = curl_init();
	    curl_setopt($curl_handle, CURLOPT_URL, 'https://kodihub.net/kodihubapi/KodihubAPI/');
	    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl_handle, CURLOPT_POST, 1);
	    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
	        'username' => $user,
	        'buildname' => $buildname
	    ));
	     
	    // Optional, delete this line if your API is open
	    curl_setopt($curl_handle, CURLOPT_USERPWD, $username . ':' . $password);
	     
	    $buffer = curl_exec($curl_handle);
	    curl_close($curl_handle);
	     
	    $result = json_decode($buffer);	

	    return $result;		
	}

	public function removeMasterBuildAppyAPI($old) {
	    $username = 'appy';
	    $password = 'fisstops';
	     
	    // Alternative JSON version
	    // $url = 'http://twitter.com/statuses/update.json';
	    // Set up and execute the curl process
	    $curl_handle = curl_init();
	    curl_setopt($curl_handle, CURLOPT_URL, 'http://appy.zone/rest/AppyAPI/removeBuild');
	    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl_handle, CURLOPT_POST, 1);
	    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
	        'completebuild' => $old,
	    ));
	     
	    // Optional, delete this line if your API is open
	    curl_setopt($curl_handle, CURLOPT_USERPWD, $username . ':' . $password);
	     
	    $buffer = curl_exec($curl_handle);
	    curl_close($curl_handle);
	     
	    $result = json_decode($buffer);	

	   //print_r($result);	
	}	

	private function removeBuildProcedure($build) {		
		$this->deleteBuildAPI($build['username'],$build['title']);
		$this->load->model('kodihubmodel');
		$this->kodihubmodel->deleteBuild($build['code']);
		$oldbuild = "https://kodihub.net/" . $build['username'] . "/" . $build['title'] . "/tile.png" . ";" . $build['title'] . ';https://kodihub.net/' . $build['unique_chars'] . ";" . $build['size']*1048576 . ";" . $build['genre'];

		$this->removeMasterBuildAppyAPI($oldbuild);
	}	

	private function removeUserFolderAPI($user) {
	    $username = 'kodihub';
	    $password = 'fisstops';
	     
	    // Alternative JSON version
	    // $url = 'http://twitter.com/statuses/update.json';
	    // Set up and execute the curl process
	    $curl_handle = curl_init();
	    curl_setopt($curl_handle, CURLOPT_URL, 'https://kodihub.net/kodihubapi/KodihubAPI/deleteuser');
	    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl_handle, CURLOPT_POST, 1);
	    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
	        'username' => $user,
	    ));
	     
	    // Optional, delete this line if your API is open
	    curl_setopt($curl_handle, CURLOPT_USERPWD, $username . ':' . $password);
	     
	    $buffer = curl_exec($curl_handle);
	    curl_close($curl_handle);
	     
	    $result = json_decode($buffer);	

	    return $result;			
	} 	

}