<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images extends MY_Controller {

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
		include APPPATH . 'third_party/Dropbox/autoload.php';
		$this->load->helper('url');
	
    } 
	
	//Home Page (Default Function. If no function is called, this function will be called).
	public function index()
	{

		//Latest Quizzes
		$table 							= $this->db->dbprefix('images');
		$images 				= $this->base_model->run_query(
		"select * from ".$table." LIMIT 10"
		);

		$this->data['images'] 	= $images;
		$this->data['active_menu'] 		= 'images';
		$this->data['content'] 			= 'general/images';
		$this->_render_page('temp/template', $this->data);
	}
 }

/* End of file term.php */
/* Location: ./application/controllers/term.php */