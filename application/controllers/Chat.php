<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {
  
	public function __construct()
    {
        parent::__construct();
        /*
        $check_auth_client = $this->MyModel->check_auth_client();
		if($check_auth_client != true){
			die($this->output->get_output());
		}
		*/
    }

 

    

	public function index()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->MyModel->book_all_data();
		        	$oldu = array('oldu' => 'oldu' );
	    			json_output($response['status'],$oldu);
		        }
			}
		}
	}

//////////////////////////////////////4dec2020/////////////////////////////////////////////////////
	public function start_chat()
	{
		$obj1 = file_get_contents('php://input');
		$obj2 = stripcslashes($obj1);
		$obj3 = json_decode($obj2);

		$sender_id = $obj3->sender_id;
		$receiver_id = $obj3->receiver_id;
		$message = $obj3->message;
		$date = $obj3->date;

		$data_chat = array('creatorId' => $sender_id,
						  'visitorId' => $receiver_id,
						  'lastMessage' => $message,
						  'notificationCount' => 1,	
					 );
		
		$data_message = array('senderId' => $sender_id,
					  'receiverId' => $receiver_id,
					  'message' => $message,
					  'date' => $date,	


					 );
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        if($response['status'] == 200){
		        	$resp2 = $this->ChatModel->start_chat($data_chat);
		        	$resp = $this->ChatModel->send_message($data_message);
		        	$resp3 = array('data_chat' => $resp2, 
		        				   'data_message' => $resp, 
		        		);
		        	
		        	//echo json_encode($geneljson);
	    			json_output(200,$resp3);
	    			//var_dump($resp);
		        }
			}
		}
	}



	public function get_user_chats_by_user_id()
	  {
		$obj1 = file_get_contents('php://input');
		$obj2 = stripcslashes($obj1);
		$obj3 = json_decode($obj2);

		$sender_id = $obj3->sender_id;
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->ChatModel->get_chats($sender_id);
		        	$chats = array('chats' => $resp);
		        	
		        	//echo json_encode($geneljson);
	    			json_output(200,$chats);
	    			//var_dump($resp);
		        }
			}
		}
	}


	public function get_messages_by_id_both()
	{
		$obj1 = file_get_contents('php://input');
		$obj2 = stripcslashes($obj1);
		$obj3 = json_decode($obj2);

		$sender_id = $obj3->sender_id;
		$receiver_id = $obj3->receiver_id;
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->ChatModel->get_messages_by_id($sender_id,$receiver_id);
		        	$messages = array('messages' => $resp);
		        	
		        	//echo json_encode($geneljson);
	    			json_output(200,$messages);
	    			//var_dump($resp);
		        }
			}
		}
	}

	

	public function send_message()
	{
		$obj1 = file_get_contents('php://input');
		$obj2 = stripcslashes($obj1);
		$obj3 = json_decode($obj2);

		$sender_id = $obj3->sender_id;
		$receiver_id = $obj3->receiver_id;
		$message = $obj3->message;
		$date = $obj3->date;
		
		$data = array('senderId' => $sender_id,
					  'receiverId' => $receiver_id,
					  'message' => $message,
					  'date' => $date,	


					 );
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->ChatModel->send_message($data);
		        	
		        	
		        	//echo json_encode($geneljson);
	    			json_output(200,$resp);
	    			//var_dump($resp);
		        }
			}
		}
	}

	public function delete_message()
	{
		$obj1 = file_get_contents('php://input');
		$obj2 = stripcslashes($obj1);
		$obj3 = json_decode($obj2);

		$message_id = $obj3->message_id;
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->ChatModel->delete_message($message_id);
		        	
		        	
		        	//echo json_encode($geneljson);
	    			json_output(200,$resp);
	    			//var_dump($resp);
		        }
			}
		}
	}


	public function get_messages_by_chat_id()
	{
		$obj1 = file_get_contents('php://input');
		$obj2 = stripcslashes($obj1);
		$obj3 = json_decode($obj2);

		$sender_id = $obj3->sender_id;
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->ChatModel->get_sender_messages_by_id($sender_id);
		        	
		        	
		        	//echo json_encode($geneljson);
	    			json_output(200,$resp);
	    			//var_dump($resp);
		        }
			}
		}
	}
//////////////////////////////////////4dec2020/////////////////////////////////////////////////////
	
	/*	public function get_messages_by_id()
	{
		$obj1 = file_get_contents('php://input');
		$obj2 = stripcslashes($obj1);
		$obj3 = json_decode($obj2);

		$sender_id = $obj3->sender_id;
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->auth();
		        if($response['status'] == 200){
		        	$resp = $this->ChatModel->get_sender_messages_by_id($sender_id);
		        	
		        	
		        	//echo json_encode($geneljson);
	    			json_output(200,$resp);
	    			//var_dump($resp);
		        }
			}
		}
	} */

}
