<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	    $this->load->helper('json_output');
		$this->load->view('welcome_message');
	}
		public function deneme()
	{
	    $this->load->helper('json_output');
	    $db_obj=$CI->load->database($config, TRUE);
if($db_obj->conn_id) {
    echo "Hello World";
} else {
    echo 'Unable to connect with database with given db details.';
}
	}
}
