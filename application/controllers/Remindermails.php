<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remindermails extends CI_Controller {

	public function __Construct()
	{
		date_default_timezone_set('Europe/London');
		parent::__Construct();
	}

	public function remind() {
		$this->load->model('appymodel');
		$clients = $this->appymodel->get_all_clients();


		foreach ($clients as $value) {
			if ($value['ipaddress'] != '' && $value['dbname'] != '' && $value['dbusername']!='' && $value['dbpassword']!='' && $value['dbname']!='') {
				$conn=mysqli_connect($value['ipaddress'],$value['dbusername'],$value['dbpassword'],$value['dbname']);if(!$conn){exit;};

				$sql = sprintf('select * from DeviceIDTable where AccessDuration<>"%s" and reminder_email_sent=0','0000-00-00 00:00:00');

				$result=mysqli_query($conn,$sql);

				while($row = $result->fetch_assoc()) {

					if (isset($row['AccessDuration']) && $row['AccessDuration'] != '') {
						$datum1 = strtotime($row['AccessDuration']);
						$datum2 = strtotime(date('Y-m-d H:i:s', time()));

						$diff = $datum1 - $datum2;

						if ($diff < 10800 && $diff > 0) {

							$this->sendAccessEmailRemind($row['Email'], $value['email'], $value['Appname']);
						}
					}
				}
				mysqli_close($conn);
			}
		}

	}

	private function sendAccessEmailRemind($useraddress, $clientaddress, $appname) {
	    $username = $this->config->item('emailapi_username');
	    $password = $this->config->item('emailapi_password');
	    //exit('slo');
	    // Alternative JSON version
	    // $url = 'http://twitter.com/statuses/update.json';
	    // Set up and execute the curl process
	    $curl_handle = curl_init();
	    curl_setopt($curl_handle, CURLOPT_URL, $this->config->item('emailapireminder_url'));
	    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl_handle, CURLOPT_POST, 1);
	    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
	    	'useraddress' => $useraddress,
	    	'clientaddress' => $clientaddress,
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