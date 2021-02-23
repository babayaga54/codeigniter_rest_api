<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


	public function login()
	{
		error_reporting(E_ALL & ~E_NOTICE);
		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {

			$check_auth_client = $this->MyModel->check_auth_client();
			
			if($check_auth_client == true){
				$params = $_REQUEST;
		        
		        $username = $params['username'];
		        $password = $params['password'];

		        	
		        $response = $this->MyModel->login($username,$password);
				//echo $response;
				//$myJson = json_encode($response);
				json_output($response['status'],$response);
			}
		}
	}

	public function deneme()
	{
		 $y  = $this->db->select('id')->from('users')->where('username','admin')->get()->row();
		 echo 'asd:'.' '.$y->id;
	}

	public function signup()
	{
		error_reporting(E_ALL & ~E_NOTICE);
		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {

			
			
			
				$params = $_REQUEST;
		        
		        $username = $params['username'];
		        $password = $params['password'];

		        	
		        $response = $this->MyModel->signup($username,$password);
				//echo $response;
				json_output($response['status'],$response);
			
		}
	}

	public function logout()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->logout();
				json_output($response['status'],$response);
			}
		}
	}
	
}
