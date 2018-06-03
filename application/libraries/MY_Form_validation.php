<?php
class MY_Form_validation extends CI_Form_validation{ 

    public function alpha_dash_space($str)
	{
	    return ( ! preg_match("/^([-a-z0-9_\s.\/\/\:])+$/i", $str)) ? FALSE : TRUE;
	} 
	public function hexcheck($str) {
		return ( ! preg_match("/^[0-9A-F]{6}$/i", $str)) ? FALSE : TRUE;		
	}
	public function mandatory($str) {
		if ($str=="") {
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
}