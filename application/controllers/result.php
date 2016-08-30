<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result extends MY_Controller {

/*
| -----------------------------------------------------
| PRODUCT NAME: 	DIGI ONLINE EXAMINITION SYSTEM (DOES)
| -----------------------------------------------------
| AUTHER:			DIGITAL VIDHYA TEAM
| -----------------------------------------------------
| EMAIL:			digitalvidhya4u@gmail.com
| -----------------------------------------------------
| COPYRIGHTS:		RESERVED BY DIGITAL VIDHYA
| -----------------------------------------------------
| WEBSITE:			http://digitalvidhya.com
|                   http://codecanyon.net/user/digitalvidhya      
| -----------------------------------------------------
|
| MODULE: 			General
| -----------------------------------------------------
| This is general module controller file.
| -----------------------------------------------------
*/

	//Load the Parent Constructor in Welcome Class Constructor and inherit all the properties. And Load any libraries in this Constructor.
	function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url');
    } 
	
	//Home Page (Default Function. If no function is called, this function will be called).
	public function index()
	{
		$language = $this->session->userdata('site_lang');
		$language = $language == ''? 'english' : $language;
		$results  = [];

		$this->data['result'] 	= $results;
		$this->data['active_menu'] 		= 'result';
		$this->data['content'] 			= 'general/result';
		$this->_render_page('temp/template', $this->data);
	}
 }

/* End of file term.php */
/* Location: ./application/controllers/term.php */