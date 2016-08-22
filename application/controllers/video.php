<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends MY_Controller {

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
	    $this->data['message'] 			= (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] 	= array(
				'name' 					=> 'identity',
				'id' 					=> 'identity',
				'class'					=> 'form-control',
				'placeholder'			=> 'User Email',
				'type' 					=> 'text',
				'required'				=> 'true',
				'value' 				=> $this->form_validation->set_value('identity'),
			);
			$this->data['password'] 	= array(
				'name' 					=> 'password',
				'id' 					=> 'password',
				'class' 				=> 'form-control',
				'placeholder' 			=> 'Password',
				'type' 					=> 'password',
				'required' 				=> 'true'
			);
	
		//Latest Quizzes
		$table 							= $this->db->dbprefix('quiz');
		$latest_quizzes 				= $this->base_model->run_query(
		"select quizid,quiztype,name,difficultylevel,deauration,
		startdate,enddate from ".$table." where status='Active' and 
		enddate>='".date('Y-m-d')."' ORDER BY quizid DESC LIMIT 10"
		);
		
		//Notifications
		$table 							= $this->db->dbprefix('notifications');
		$notifications 					= $this->base_model->run_query("select * from "
		.$table." where status = 'Active' and last_date>='"
		.date('Y-m-d')."' ORDER BY nid DESC LIMIT 10"
		);
		
		//Testimonials
		$table 							= $this->db->dbprefix('testimonials');
		$testimonials 					= $this->base_model->run_query("select * from "
		.$table." where status = 'Active' ORDER BY tid DESC"
		);
		
		$this->data['channelId'] 	= $this->base_model->getOption('video_channelId');
		$this->data['maxResults'] 	= $this->base_model->getOption('video_maxResults');
		$this->data['API_key'] 		= $this->base_model->getOption('video_API');
		
		$this->data['latest_quizzes'] 	= $latest_quizzes;
		$this->data['notifications'] 	= $notifications;
		$this->data['testimonials'] 	= $testimonials;
		$this->data['active_menu'] 		= 'home';
		$this->data['content'] 			= 'general/video';
		$this->_render_page('temp/template', $this->data);
	}
 }

/* End of file term.php */
/* Location: ./application/controllers/term.php */