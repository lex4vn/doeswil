<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guess extends MY_Controller {

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
		$guess  = [];

		$this->data['result'] 	= $guess;
		$this->data['active_menu'] 		= 'guess';
		$this->data['content'] 			= 'general/guess';
		$this->_render_page('temp/template', $this->data);
	}
 }

/* End of file term.php */
/* Location: ./application/controllers/term.php */