<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

/*
| -----------------------------------------------------
| PRODUCT NAME: 	Wilmar CLV Awards
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
| MODULE: 			Admin
| -----------------------------------------------------
| This is admin module controller file.
| -----------------------------------------------------
*/

	/***Authenticate Admin for each function by calling the Parent Method 
	validate_admin() in Constructor***/
	function __construct()
    {
        parent::__construct();
		
		$this->load->library('form_validation');
		//require_once APPPATH.'third_party/PHPExcel';
	}
	
	/***Admin Dashboard (Default Function. If no function is called, this function
	 will be called)***/
	public function index()
	{
		redirect('admin/dashboard');
	}

	/***Admin Dashboard***/
	function dashboard()
	{
		$this->validate_admin();
		
		$table = $this->db->dbprefix('users');
		
		//Records of Latest Users
		$latestUsers = $this->base_model->run_query(
		"SELECT u.* FROM users u, users_groups g WHERE u.id=g.user_id
		and g.group_id=2 and u.id!=1 ORDER BY u.id desc LIMIT 5"
		);
		
		//Records of Users who has taken quizzes recently
		$recentUserQuizzes = $this->base_model->run_query(
		"SELECT * FROM(SELECT qh.*,q.name,u.image FROM "
		.$this->db->dbprefix('user_quiz_results_history')." qh,"
		.$this->db->dbprefix('quiz')." q, "
		.$this->db->dbprefix('users')." u where q.quizid=qh.quiz_id and 
		u.id=qh.userid ORDER BY qh.dateoftest DESC ) as recent 
		GROUP BY quiz_id  LIMIT 6"
		);
		
		//Records of Top Rankers
		$topRankers = $this->base_model->run_query(
		"select qr.*,u.image,q.name from "
		.$this->db->dbprefix('user_quiz_results')." qr,"
		.$this->db->dbprefix('users')." u,"
		.$this->db->dbprefix('quiz')." q where u.id=qr.userid and 
		q.quizid=qr.quiz_id ORDER BY (qr.score*100/qr.total_questions) DESC LIMIT 6"
		);
		
		//Data For Chart
		$activeUsers = $this->base_model->run_query(
		"select * from ".$table." where id!=1 and active=1 
		ORDER BY date_of_registration"
		);
		
		$inactiveUsers = $this->base_model->run_query(
		"select * from ".$table." where id!=1 and active=0 
		ORDER BY date_of_registration"
		);
		
		$this->data['activeUsersCount'] 	= count($activeUsers);
		$this->data['inactiveUsersCount'] 	= count($inactiveUsers);
		
		
		$this->data['exam_data'] = $this->base_model->run_query(
		"SELECT q.name, r.total_attempts as cnt FROM "
		.$this->db->dbprefix('user_quiz_results')." r, "
		.$this->db->dbprefix('quiz')." q where q.quizid=r.quiz_id 
		group by quiz_id order by cnt desc limit 5"
		);
		
		$this->data['payments_data'] = $this->base_model->run_query(
		"SELECT s.quizid,q.name,count(*) as cnt FROM  "
		.$this->db->dbprefix('quizsubscriptions')." s, "
		.$this->db->dbprefix('quiz')." q where s.quizid=q.quizid 
		group by s.quizid"
		);
		
		$this->data['latestUsers'] 			= $latestUsers;
		$this->data['recentUserQuizzes'] 	= $recentUserQuizzes;
		$this->data['topRankers'] 			= $topRankers;
		$this->data['title'] 				= 'Admin Dashboard';
		$this->data['active_menu'] 			= 'dashboard';
		$this->data['content'] 				= 'admin/index';
		$this->_render_page('temp/admintemplate', $this->data);
	
	}
	
	//View All Users
	function viewAllUsers()
	{
		$this->validate_admin();

		$allUsers 	= $this->base_model->run_query(
		"SELECT u.* FROM users u, users_groups g WHERE u.id=g.user_id
		and g.group_id=2 and u.id!=1 ORDER BY u.id desc "
		);
		$this->data['allUsers'] 	= $allUsers;
		$this->data['title'] 		= 'General Users';
		$this->data['active_menu'] 	= 'users';
		$this->data['content'] 		= 'admin/view_all_users';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	//Delete User
	function deleteUser()
	{
		$this->validate_admin();
	
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('users'), 
			$where
			);
			$this->prepare_flashmessage("Record Deleted Successfully", 0);
			if($this->uri->segment(4) != '' && $this->uri->segment(4) == 'admin')
				redirect('admin/admins');
			elseif($this->uri->segment(4) != '' && $this->uri->segment(4) == 'moderator')
				redirect('admin/moderators');
			else
				redirect('admin/viewAllUsers');
		}
	
	}
	
	
	//View All Admins
	function moderators()
	{
		$this->validate_admin();
		
		$moderators =	$this->base_model->run_query("SELECT u.* FROM users u, users_groups g WHERE u.id=g.user_id and g.group_id=4 ORDER BY u.id desc ");
		$this->data['users'] = $moderators;
		
		$this->data['active_menu']='users';
		$this->data['title'] = 'Moderators - Super Admin Dashboard';
		$this->data['heading'] = 'Moderators';
		
		$this->data['content'] = 'admin/moderators';
		$this->data['user_type'] = 'moderator';
		
		$this->_render_page('temp/admintemplate',$this->data);
	}
	
	
	public function _image_check($image = '', $param2 = '')
	{
		
		$name = explode('.',$param2);
		
		if(count($name)>2 || count($name)<= 0) {
           $this->form_validation->set_message('_image_check', 'Only jpg / jpeg / png images are accepted.');
            return FALSE;
        }
		
		$ext = $name[1];
		
		$allowed_types = array('jpg','jpeg','png');
		
		if (!in_array($ext, $allowed_types)) {			
			$this->form_validation->set_message('_image_check', 'Only jpg / jpeg / png images are accepted.');
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
	
	
	//Create User
	function register($user_type = '')
	{
		$this->validate_admin();
		
		$this->data['title'] = "Create User";
	
		//$this->load->config('ion_auth');
		$this->config->load('ion_auth', TRUE);
		$tables = $this->config->item('tables','ion_auth');
		
		if($this->input->post('submit')!='') {
			//validate form input
			$this->form_validation->set_rules('first_name', $this->lang->line('register_validation_fname_label'), 'required|xss_clean');
			$this->form_validation->set_rules('last_name', $this->lang->line('register_validation_lname_label'), 'required|xss_clean');
			$this->form_validation->set_rules('email', $this->lang->line('register_validation_email_label'), 'required|valid_email|is_unique['.$tables['users'].'.email]');
			$this->form_validation->set_rules('phone', $this->lang->line('register_validation_phone_label'), 'required|xss_clean|integer');

			$this->form_validation->set_rules('password', $this->lang->line('register_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
			$this->form_validation->set_rules('password_confirm', $this->lang->line('register_validation_password_confirm_label'), 'required');			
			
			if(!empty($_FILES['image']['name'])) {
			
				$this->form_validation->set_rules('image',"Image", 'callback__image_check['.$_FILES['image']['name'].']');			
			
			}

			if ($this->form_validation->run() == true)
			{
				$username = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
				$email    = strtolower($this->input->post('email'));
				$password = $this->input->post('password');
				$image = $_FILES['image']['name'];

				$additional_data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'phone'      => $this->input->post('phone'),
					'date_of_registration'      => date('Y-m-d')
				);
				
				if(!empty($image))
					$additional_data['image'] = $image;
				
				$id = $this->ion_auth->register($username, $password, $email, $additional_data);
				
				if($this->input->post('user_type') == "admin") {
					$empdata['group_id'] = "3";
					$redirect_path = "admin/admins";
				}
				else {
					$empdata['group_id'] = "4";
					$redirect_path = "admin/moderators";
				}
				
				$this->db->where('user_id', $id);
				if($this->db->update('users_groups',$empdata)) {
				
					$this->prepare_flashmessage($this->ion_auth->messages(),2);
					redirect($redirect_path, 'refresh');
				
				}
			}
			else
			{
				//display the create user form
				//set the flash data error message if there is one
				$this->prepare_flashmessage((validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'))),1);
				redirect("admin/register", 'refresh');
				
			}
		}

			$this->data['first_name'] = array(
				'name'  => 'first_name',
				'class'=>'form-control',
				'placeholder'=>'First Name',
				'id'    => 'first_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('first_name'),
			);
			$this->data['last_name'] = array(
				'name'  => 'last_name',
				'class'=>'form-control',
				'placeholder'=>'Last Name',
				'id'    => 'last_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('last_name'),
			);
			$this->data['email'] = array(
				'name'  => 'email',
				'class'=>'form-control',
				'placeholder'=>'User Email',
				'id'    => 'email',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['company'] = array(
				'name'  => 'company',
				'class'=>'form-control',
				'placeholder'=>'Company',
				'id'    => 'company',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('company'),
			);
			$this->data['phone'] = array(
				'name'  => 'phone',
				'class'=>'form-control',
				'placeholder'=>'Phone',
				'id'    => 'phone',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('phone'),
			);
			$this->data['password'] = array(
				'name'  => 'password',
				'class'=>'form-control',
				'placeholder'=>'Password',
				'id'    => 'password',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password'),
			);
			$this->data['password_confirm'] = array(
				'name'  => 'password_confirm',
				'class'=>'form-control',
				'placeholder'=>'Confirm Password',
				'id'    => 'password_confirm',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
			);
			
			$this->data['user_type'] = $user_type;
			
			$this->data['content'] = 'admin/register';
			$this->_render_page('temp/admintemplate', $this->data);
	}

	//edit a user
	function edit_user($id = '', $user_type = '')
	{
		$this->validate_admin();
		
		$this->data['title'] = "Edit User";

		if($id == "") {
		
			$id = $this->input->post('id');
		
		}
		
		if(!is_numeric($id)){
		return;
		}
		
		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		//validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required|xss_clean');
		
		if(!empty($_FILES['image']['name'])) {
			
			$this->form_validation->set_rules('image',"Image", 'callback__image_check['.$_FILES['image']['name'].']');			
		
		}

		if (isset($_POST) && !empty($_POST))
		{
			$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'company'    => $this->input->post('company'),
				'phone'      => $this->input->post('phone'),
				'username'      => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
			);
			
			$image = $_FILES['image']['name'];
			
			//update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');

				$data['password'] = $this->input->post('password');
			}

			if ($this->form_validation->run() === TRUE)
			{
				
				if(!empty($image)) {
				
					if (file_exists('assets/uploads/images/'. $user->image)) {
						unlink('assets/uploads/images/'. $user->image);
					}
					if(file_exists('assets/uploads/images(200x200)/'. $user->image)) {
						unlink('assets/uploads/images(200x200)/'. $user->image);
					}
						
					if(file_exists('assets/uploads/images(50x50)/'. $user->image)) {
						unlink('assets/uploads/images(50x50)/'. $user->image);
					}
					
					$ext = explode('.', $image);
					
					if(count($ext)>2 || count($ext)<= 0) {
					   $this->form_validation->set_message('_image_check', 'Only jpg / jpeg / png images are accepted.');
						return FALSE;
					}
					
					$img = $ext[0]."_".$user->id.".".$ext[1];
					
					$data['image'] = $img;
				
				}
				
				$this->ion_auth->update($user->id, $data);

				if($this->input->post('user_type') == "admin") {
					$redirect_path = "admin/admins";
				}
				else {
					$redirect_path = "admin/moderators";
				}
				
				$this->prepare_flashmessage('User Updated Successfully.', 0);
				redirect($redirect_path, 'refresh');
			}
		}

		//display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		//set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'class'=>'form-control',
			'placeholder'=>'First Name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'class'=>'form-control',
			'placeholder'=>'Last Name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		);
		$this->data['company'] = array(
			'name'  => 'company',
			'class'=>'form-control',
			'placeholder'=>'Company',
			'id'    => 'company',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('company', $user->company),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'class'=>'form-control',
			'placeholder'=>'Phone',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		);
		$this->data['email'] = array(
			'name'  => 'email',
			'class'=>'form-control',
			'placeholder'=>'User Email',
			'id'    => 'email',
			'type'  => 'text',
			'readonly'  => 'readonly',
			'value' => $this->form_validation->set_value('email', $user->email),
		);
		$this->data['password'] = array(
			'name' => 'password',
			'class'=>'form-control',
			'placeholder'=>'Password',
			'id'   => 'password',
			'type' => 'password'
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'class'=>'form-control',
			'placeholder'=>'Confirm Password',
			'id'   => 'password_confirm',
			'type' => 'password'
		);
		
			$this->data['user_type'] = $user_type;
			$this->data['content']='admin/edit_user';
			$this->_render_page('temp/admintemplate',$this->data);
		//$this->_render_page('auth/edit_user', $this->data);
	}
	
	
	//Admin Profile
	function profile()
	{
		$this->validate_admin();
		
		$userid = $this->session->userdata('user_id');
		if (isset($userid) && $userid != '' && is_numeric($userid)) {
			$table = $this->db->dbprefix('users');
			$condition['id'] = $userid;
			$records = $this->base_model->fetch_records_from(
			$table, 
			$condition,
			$select = 'id, username, first_name, last_name, email, phone, 
			image, active', 
			$order_by = '' 
			);
			$this->data['details'] 	= $records;
			$this->data['content'] 	= 'admin/profile';
			$this->data['title'] 	= 'Admin Profile';
			$this->_render_page('temp/admintemplate', $this->data);
		}
		else {
			$this->prepare_flashmessage('Session Expired!', 2);
			redirect('auth/login', 'refresh');
		}
	}
	
	//View User Profile
	function viewUserProfile()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$userid 				= $this->uri->segment(3);
			$table 					= $this->db->dbprefix('users');
			$condition['id'] 		= $userid;
			$records 				= $this->base_model->fetch_records_from(
			$table, 
			$condition,
			$select 				= 'id, username, email, phone, image, active', 
			$order_by = '' 
			);
			$this->data['details'] 	= $records;
			$this->data['content'] 	= 'admin/view_user_profile';
			$this->data['title'] 	= 'User Profile';
			$this->_render_page('temp/admintemplate', $this->data);
		}
		else {
			redirect('admin', 'refresh');
		}
	}
	
	
	//View User Quiz History
	function userQuizHistory()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$userid 						= $this->uri->segment(3);
			$records 						= $this->base_model->run_query(
			"select qr.*,q.* from ".$this->db->dbprefix('user_quiz_results')
			." qr,".$this->db->dbprefix('quiz')
			." q where q.quizid=qr.quiz_id and qr.userid=".$userid
			);
			if (count($records)>0) {
				$this->data['quiz_history'] = $records;
				$this->data['username'] 	= $records[0]->username;
				$this->data['title'] 		= 'User Quiz History';
				$this->data['content'] 		= 'admin/user_quiz_history';
				$this->_render_page('temp/admintemplate', $this->data);
			}
			else {
				$this->prepare_flashmessage(
				"No Quiz History Available, Since the User hasn't 
				taken any Exam/Quiz.", 2
				);
				redirect('admin/viewAllUsers', 'refresh');
			}
		}
		else {
			$this->prepare_flashmessage(
			"No Quiz History Available, Since the User hasn't 
			taken any Exam/Quiz.", 2
			);
			redirect('admin/viewAllUsers', 'refresh');
		}
	}
	
	//View Performance of User Quiz
	function userQuizPerformance()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(4) && is_numeric($this->uri->segment(4))) {
			$quizId 					= $this->uri->segment(4);
			
			if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
				$userId 				= $this->uri->segment(3);
				$records 				= $this->base_model->run_query(
				"select qh.*,q.* from "
				.$this->db->dbprefix('user_quiz_results_history')
				." qh,".$this->db->dbprefix('quiz')
				." q where q.quizid=qh.quiz_id and qh.userid = "
				.$userId." and qh.score > 0 and qh.quiz_id = "
				.$quizId." ORDER BY dateoftest DESC LIMIT 10"
				);
				
				if (count($records)>0) {
					$this->data['info'] = "Performance Report of "
					.$records[0]->username." in ".$records[0]->name;
					$result 			= array( );
					$temp 				= array();
					array_push($temp, "Date","Score","Total Questions");
					array_push($result, $temp);
					
					foreach ($records as $d) {
						$temp 			= array();
						array_push(
						$temp,$d->dateoftest, 
						$d->score,$d->total_questions
						);
						array_push($result, $temp);
					}
					
				
					$str = "";
					$cnt = 0;
					foreach ($result as $r) {
						if ($cnt++ == 0){
							$str = $str . "['".$r[0]."','".$r[1]."','".$r[2]."'],";
						}
						else{
							$str = $str . "['".$r[0]."',".$r[1].",".$r[2]."],";
						}
					}
							
					$this->data['result'] 	= $str;
					$this->data['title'] 	= "User's Quiz Performance";
					$this->load->view('user/exam/performance', $this->data);
				}
				else {
					$this->prepare_flashmessage(
					"No Quiz History Available, Since the User hasn't 
					taken any Exam/Quiz.", 2
					);
					redirect('admin/viewAllUsers', 'refresh');
				}
			}
			else {
				$this->prepare_flashmessage(
				"No Quiz History Available, Since the User hasn't 
				taken any Exam/Quiz.", 2
				);
				redirect('admin/viewAllUsers', 'refresh');
			}
		}
		elseif ($this->uri->segment(3)) {
			redirect('admin/userQuizHistory/'.$this->uri->segment(3), 'refresh');
		}
		else {
			$this->prepare_flashmessage(
			"No Quiz History Available, Since the User hasn't 
			taken any Exam/Quiz.", 2
			);
			redirect('admin/viewAllUsers', 'refresh');
		}
	}
	
	
	//Update Admin Profile
	function updateProfile()
	{
		$this->validate_admin();
		
		$this->form_validation->set_rules('first_name', 'First Name', 
		'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 
		'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 
		'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 
		'required|xss_clean|integer');
		
		if(!empty($_FILES['image']['name'])) {

			$this->form_validation->set_rules('image',"Image", 'callback__image_check['.$_FILES['image']['name'].']');			

		}
		
		if ($this->form_validation->run() == true) {
			$userid = $this->input->post('user');
			if ($this->input->post('submit')!='' && isset($userid) && $userid!='') {
				$data['first_name'] 	= $this->input->post('first_name');
				$data['last_name'] 		= $this->input->post('last_name');
				$data['username'] 		= $this->input->post('first_name')
				." ".$this->input->post('last_name');
				$data['phone'] 			= $this->input->post('phone');
				$data['email'] 			= $this->input->post('email');
				
				//Unset User Name
				$this->session->unset_userdata('username');
				//Set User Name
				$this->session->set_userdata('username',$data['username']);
				
				$image = $_FILES['image']['name'];
				
				//Upload User Photo
				if (!empty($image)) {	
					$r = $this->base_model->run_query(
					'select image from '.$this->db->dbprefix('users')
					.' where image != "" and id = '.$userid
					);
					if (count($r) > 0) {
					
						if (file_exists('assets/uploads/images/'.$r[0]->image)) {
							unlink('assets/uploads/images/'.$r[0]->image);
						}
						if(file_exists('assets/uploads/images(200x200)/'
						.$r[0]->image)) {
							unlink('assets/uploads/images(200x200)/'.$r[0]->image);
						}
							
						if(file_exists('assets/uploads/images(50x50)/'
						.$r[0]->image)) {
							unlink('assets/uploads/images(50x50)/'.$r[0]->image);
						}
					}
					
					//Unset User Image 
					$this->session->unset_userdata('image');
					
					$ext = explode('.',$image);
					
					$img = $ext[0]."_".$userid.".".$ext[1];
					
					$data['image'] = $img;
					move_uploaded_file(
					$_FILES['image']['tmp_name'], 
					'assets/uploads/images/'.$img
					);
					$this->create_thumbnail(
					'assets/uploads/images/'. $img, 
					'assets/uploads/images(200x200)/'. $img,200,200
					);
					$this->create_thumbnail(
					'assets/uploads/images/'. $img, 
					'assets/uploads/images(50x50)/'. $img,
					50,50
					);
					
					//Set User Image
					$this->session->set_userdata('image',$img);
					
				}
				
				$table 					= $this->db->dbprefix('users');
				$where['id'] 			= $userid;
				$this->base_model->update_operation($data, $table, $where);
				
				$this->prepare_flashmessage(
				'Your profile has been successfully updated.', 0
				);
				redirect('admin/profile', 'refresh');
			}
			else {
				$this->prepare_flashmessage('Session Expired!', 2);
				redirect('auth/login', 'refresh');
			}
		}
		else {
			$this->prepare_flashmessage(validation_errors(), 1);
			redirect('admin/profile', 'refresh');
		}
	}
	
	
	//Block User
	function blockUser()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$userid 					= $this->uri->segment(3);
			$table 						= $this->db->dbprefix('users');
			$data['active'] 			= 0;
			$where['id'] 				= $userid;
			if ($this->base_model->update_operation($data, $table, $where)) {
				$this->prepare_flashmessage("User has been blocked.", 2);
				if($this->uri->segment(4) != '' && $this->uri->segment(4) == 'admin')
					redirect('admin/admins', 'refresh');
				elseif($this->uri->segment(4) != '' && $this->uri->segment(4) == 'moderator')
					redirect('admin/moderators', 'refresh');
				else
					redirect('admin/viewUserProfile/'.$userid, 'refresh');
			}
		}
		else {
			redirect('admin', 'refresh');
		}
	}
		
	
	//Activate User
	function activateUser()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$userid 					= $this->uri->segment(3);
			$table 						= $this->db->dbprefix('users');
			$data['active'] 			= 1;
			$where['id'] 				= $userid;
			if ($this->base_model->update_operation($data, $table, $where)) {
				$this->prepare_flashmessage("User has been activated.", 2);
				if($this->uri->segment(4) != '' && $this->uri->segment(4) == 'admin')
					redirect('admin/admins', 'refresh');
				elseif($this->uri->segment(4) != '' && $this->uri->segment(4) == 'moderator')
					redirect('admin/moderators', 'refresh');
				else
					redirect('admin/viewUserProfile/'.$userid, 'refresh');
			}
		}
		else {
			redirect('admin', 'refresh');
		}
	}

	function viewQuizResults()
	{
		$this->validate_admin();

		if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$userid 					= $this->uri->segment(3);
			$table 						= $this->db->dbprefix('session');
			$where['id'] 				= $userid;
			$results = $this->base_model->run_query(
				"select * from ".$table
				." where userid=".$this->uri->segment(3)." order by id desc"
			);
			//var_dump($results);die();
			$result = $results[0];
		//	$this->data['questions'] = $result['questions'];
			$quizinfo 						=  unserialize($result->quiz_info);
			$totalQuestions 				=  $result->totalQuestions;
			$quizRecords 					=  unserialize($result->quizRecords);
			$questions 						= unserialize($result->questions);
			$answers 						= unserialize($result->answers);
			$score 							= 0;
			$not_attempted 					= 0;
			$this->data['quiz_info'] 		= $quizinfo;
			$this->data['totalQuestions'] 	= $totalQuestions;
			$this->data['quizRecords'] 		= $quizRecords;
			$this->data['answers'] 			= $answers;
			$this->data['questions'] 		= $questions;
			$this->data['user_options']= unserialize($result->user_options);
			$this->data['content'] 			= 'admin/view_quiz_results';
			$this->_render_page('temp/admintemplate', $this->data);
		}
		else {
			redirect('admin', 'refresh');
		}
	}
	//CRUD Operations for Categories
	function categories()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['catid'] 			= $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('categories'), 
			$where
			);
			$this->prepare_flashmessage("Record Deleted Successfully", 0);
			redirect('admin/categories', 'refresh');		
		}
		$this->data['title'] 			= 'Categories';
		$this->data['active_menu'] 		= 'categories';
		$this->data['records'] 			= $this->base_model->fetch_records_from(
		$this->db->dbprefix('categories')
		);
		$this->data['content'] 			= 'admin/categories/categories';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	function addeditCategories()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules(
		'name', 
		'Category Name', 
		'trim|required'
		);
		
		if ($this->form_validation->run() == true) {
			$inputdata['name'] 			= $this->input->post('name');
			$inputdata['status'] 		= $this->input->post('status');
			
			if ($this->input->post('id') == '' ) {
				$this->base_model->insert_operation(
				$inputdata,
				$this->db->dbprefix('categories')
				);
				$msg = "Record Added Successfully";
			}
			else {
				$where['catid'] 		= $this->input->post('id');
				$this->base_model->update_operation(
				$inputdata,
				$this->db->dbprefix('categories'), 
				$where
				);
				$msg = "Record Updated Successfully";
			}
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/categories', 'refresh');
		}
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$this->data['data'] = $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('categories')
			." where catid=".$this->uri->segment(3)
			);
			$this->data['id'] 		= $this->uri->segment(3);
			$this->data['title'] 	= 'Update Category';
		}
		else {
			$this->data['data']		= array();
			$this->data['id']		= '';
			$this->data['title']	= 'Add Category';
		}
		$Options['Active'] 			= 'Active';
		$Options['Inactive'] 		= 'Inactive';
		$this->data['element'] 		= $Options;
		$this->data['active_menu'] 	= 'categories';
		$this->data['content'] 		= 'admin/categories/addeditCategories';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	//CRUD Operations for Sub Categories
	function subcategories()
	{
	    $this->validate_admin();
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['subcatid'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('subcategories'), 
			$where
			);
			$this->prepare_flashmessage("Record Deleted Successfully", 0);
			redirect('admin/subcategories', 'refresh');		
		}
		$this->data['title'] 		= 'Sub Categories';
		$this->data['active_menu'] 	= 'subcategories';
		$this->data['records'] 		= $this->base_model->run_query(
		"select s.*,c.name as catname from "
		.$this->db->dbprefix('subcategories')." s,"
		.$this->db->dbprefix('categories')." c where c.catid=s.catid"
		);
		$this->data['content']		='admin/categories/subcategories';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	function addeditSubCategories()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('catid', 'Category Name', 'trim|required');
		$this->form_validation->set_rules(
		'name', 
		'Sub Category Name', 
		'trim|required'
		);
		
		if ($this->form_validation->run() == true) {
			$inputdata['catid'] 	= $this->input->post('catid');
			$inputdata['name'] 		= $this->input->post('name');
			$inputdata['status'] 	= $this->input->post('status');
			if ($this->input->post('id') == '' ) {
				$this->base_model->insert_operation(
				$inputdata,
				$this->db->dbprefix('subcategories')
				);
				$msg = "Record Added Successfully.";
			}
			else {
				$where['subcatid'] = $this->input->post('id');
				$this->base_model->update_operation(
				$inputdata, 
				$this->db->dbprefix('subcategories'), 
				$where );
				$msg = "Record Updated Successfully.";
			}
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/subcategories', 'refresh');
		}
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$this->data['data'] 	= $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('subcategories')
			." where subcatid=".$this->uri->segment(3)
			);
			$this->data['id'] 		= $this->uri->segment(3);
			$this->data['title'] 	= 'Update Sub Category';
		}
		else {
			$this->data['data'] 	= array();
			$this->data['id'] 		= '';
			$this->data['title'] 	= 'Add Sub Category';
		}
		
		$Options['Active'] 			= 'Active';
		$Options['Inactive'] 		= 'Inactive';
		$this->data['element'] 		= $Options;
		$catOptions[''] 			= 'Select Category';
		$catRecords = $this->base_model->fetch_records_from(
		$this->db->dbprefix('categories')
		);
		foreach ($catRecords as $key => $val) {
		    $catOptions[$val->catid]=$val->name;	
		}
		$this->data['categories'] 	= $catOptions;
		$this->data['active_menu'] 	= 'subcategories';
		$this->data['content'] 		= 'admin/categories/addeditSubCategories';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	//CRUD Operations for Subjects
	function subjects()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['subjectid'] 	= $this->uri->segment(3);
			$this->base_model->delete_record($this->db->dbprefix('subjects'), $where);
			$this->prepare_flashmessage("Record Deleted Successfully", 0);
			redirect('admin/subjects');		
		}
				
		$this->data['title'] 		= 'Subjects';
		$this->data['active_menu'] 	= 'subjects';
		$this->data['records'] 		= $this->base_model->fetch_records_from(
		$this->db->dbprefix('subjects')
		);
		$this->data['content'] 		= 'admin/subjects/subjects';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	function addeditSubjects()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Subject Name', 'trim|required');
		if ($this->input->post()) {
			if ($this->form_validation->run() == true) {
				$inputdata['name'] 		= $this->input->post('name');
				$inputdata['status'] 	= $this->input->post('status');
				
				if ($this->input->post('id') == '' ) {
					$this->base_model->insert_operation(
					$inputdata,
					$this->db->dbprefix('subjects')
					);
					
					$msg = "Record Added Successfully";
				}
				else {
					$where['subjectid'] = $this->input->post('id');
					$this->base_model->update_operation(
					$inputdata, 
					$this->db->dbprefix('subjects'), 
					$where
					);
					$msg = "Record Updated Successfully";
				}
				$this->prepare_flashmessage($msg, 0);
				redirect('admin/subjects', 'refresh');
			}
			else {
				$this->prepare_flashmessage(validation_errors(), 1);
				redirect('admin/addeditSubjects', 'refresh');
			}
		}
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$this->data['data'] 	= $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('subjects')
			." where subjectid=".$this->uri->segment(3)
			);
			$this->data['id'] 		= $this->uri->segment(3);
			$this->data['title'] 	= 'Update Subject';
		}
		else {
			$this->data['data'] 	= array();
			$this->data['id'] 		= '';
			$this->data['title'] 	= 'Add Subject';
		}
		$Options['Active'] 			= 'Active';
		$Options['Inactive'] 		= 'Inactive';
		$this->data['element'] 		= $Options;
		$this->data['active_menu'] 	= 'subjects';
		$this->data['content'] 		= 'admin/subjects/addeditSubjects';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	function questionsindex()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		$this->data['title'] 		= 'Questions Index';
		$this->data['active_menu'] 	= 'questions';
		$this->data['records'] 		= $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('subjects')
		);
		$this->data['content'] 		= 'admin/questions/questionsindex';
		if($this->ion_auth->is_moderator())
			$template = "moderatortemplate";
		else
			$template = "admintemplate";
			
		$this->_render_page('temp/'.$template, $this->data);
	}
	
	//CRUD Operations for Questions
	function questions()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		if ($this->uri->segment(3)!='' && is_numeric($this->uri->segment(4))) {
			if ($this->uri->segment(3) == "delete" && $this->uri->segment(4) != '') {
				$where['questionid'] = $this->uri->segment(4);
				$this->base_model->delete_record(
				$this->db->dbprefix('questions'), 
				$where
				);
				$this->prepare_flashmessage("Record Deleted Successfully", 0);
				redirect('admin/questions', 'refresh');
			}
			elseif (
			$this->uri->segment(3) == "subject_wise" && 
			$this->uri->segment(4)!='' &&
			is_numeric($this->uri->segment(4)
			)) {				
				$records = $this->base_model->run_query(
				"select q.*,s.name as subjectname from "
				.$this->db->dbprefix('questions')." q,"
				.$this->db->dbprefix('subjects')." s 
				where s.subjectid=q.subjectid and q.subjectid="
				.$this->uri->segment(4)
				);
				$this->data['subject_name']="";
				$where['subjectid'] = $this->uri->segment(4);
				$subject_details = $this->base_model->fetch_records_from('subjects', $where);
				if (count($subject_details) > 0) {
				    $subject_details 			= $subject_details[0];
					$this->data['subject_name'] = $subject_details->name;
				}
				$this->data['records'] 			= $records;
				$this->data['subject_id'] 		= $this->uri->segment(4);				
			}
			else {
				$this->data['records'] = $this->base_model->run_query(
				"select q.*,s.name as subjectname from "
				.$this->db->dbprefix('questions')." q,"
				.$this->db->dbprefix('subjects')." s where s.subjectid=q.subjectid"
				);
			}
		}
		else {
			$this->data['records'] = $this->base_model->run_query(
			"select q.*,s.name as subjectname from "
			.$this->db->dbprefix('questions')." q,"
			.$this->db->dbprefix('subjects')." s where s.subjectid=q.subjectid"
			);
		}
		$this->data['title'] 		= 'Questions';
		$this->data['active_menu'] 	= 'questions';
		$this->data['content'] 		= 'admin/questions/questions';
		if($this->ion_auth->is_moderator())
			$template = "moderatortemplate";
		else
			$template = "admintemplate";
			
		$this->_render_page('temp/'.$template, $this->data);
	}
	
	function addeditQuestions()
	{	
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('subjectid', 'Subject', 'trim|required');
		$this->form_validation->set_rules(
		'questiontype', 
		'Question Type', 
		'trim|required'
		);
		$this->form_validation->set_rules(
		'totalanswers', 
		'Total Answers', 
		'trim|required'
		);
		$this->form_validation->set_rules('question', 'Question', 'trim|required');
		$this->form_validation->set_rules('answer1', 'Answer1', 'trim|required');
		$this->form_validation->set_rules('answer2', 'Answer2', 'trim|required');
		$this->form_validation->set_rules('answer3', 'Answer3', 'trim|required');
		$this->form_validation->set_rules('answer4', 'Answer4', 'trim|required');
		$this->form_validation->set_rules(
		'correctanswer', 
		'Correct Answer', 
		'trim|required'
		);
		$this->form_validation->set_rules(
		'difficultylevel', 
		'Difficulty Level', 
		'trim|required'
		);
		
		if ($this->input->post()) {
			if ($this->form_validation->run() == true) {
				
				$inputdata['subjectid'] 	= $this->input->post('subjectid');
				$inputdata['questiontype'] 	= $this->input->post('questiontype');
				$inputdata['totalanswers'] 	= $this->input->post('totalanswers');
				$inputdata['question'] 		= $this->input->post('question');
				$inputdata['answer1'] 		= $this->input->post('answer1');
				$inputdata['answer2'] 		= $this->input->post('answer2');
				$inputdata['answer3'] 		= $this->input->post('answer3');
				$inputdata['answer4'] 		= $this->input->post('answer4');
				if($this->input->post('answer5') != ''){
					$inputdata['answer5'] 		= $this->input->post('answer5');
				}
				$inputdata['correctanswer'] = $this->input->post('correctanswer');
				$inputdata['hint'] 			= "";
				$inputdata['difficultylevel'] = $this->input->post('difficultylevel');
				$inputdata['status'] = $this->input->post('status');
				
				if ($this->input->post('id') == '' ) {
					$this->base_model->insert_operation($inputdata, 
					$this->db->dbprefix('questions')
					);
					$msg = "Record Added Successfully.";
				}
				else {
					$where['questionid'] = $this->input->post('id');
					$this->base_model->update_operation(
					$inputdata, 
					$this->db->dbprefix('questions'), 
					$where
					);
					$msg = "Record Updated Successfully.";
				}
				$this->prepare_flashmessage($msg, 0);
				redirect(
				'admin/questions/subject_wise/'.$inputdata['subjectid'], 
				'refresh'
				);
			}
			else {
				$this->prepare_flashmessage(validation_errors(), 1);
				redirect('admin/addeditQuestions');
			}
		}
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			
			$record = $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('questions')
			." where questionid=".$this->uri->segment(3)
			);
			$this->data['data'] 		= $record;
			$this->data['subject_id'] 	= $record[0]->subjectid;
			$this->data['id'] 			= $this->uri->segment(3);
			$this->data['title'] 		= 'Update Question';
		}
		else {
			$this->data['data'] 		= array();
			$this->data['id'] 			= '';
			$this->data['title'] 		= 'Add Question';
		}
		
		//Options for Status
		$Options['Active'] 				= 'Active';
		$Options['Inactive'] 			= 'Inactive';
		$this->data['element'] 			= $Options;
		
		//Options for Total Answers
		$ans['1'] 						= '1';
		$ans['4'] 						= '4';
		$ans['5'] 						= '5';
		$this->data['totans'] 			= $ans;
		
		//Options for Question Types
		$qtype['SingleAnswer'] 			= 'Single Answer';
		$qtype['WriteAnswer'] 			= 'Write Answer';
		$qtype['Write'] 			= 'Write';
		//$qtype['MultiAnswer'] 			= 'Multi Answer';
		$this->data['questtypes'] 		= $qtype;
		
		//Options for Difficulty Level
		$dlevel['Easy'] 				= 'Easy';
		//$dlevel['Medium'] 				= 'Medium';
		//$dlevel['High'] 				= 'High';
		$this->data['difficultylevels'] = $dlevel;
		
		//Options for Subjects
		$subjOptions[''] 				= 'Select Subject';
		$subjRecords 					= $this->base_model->fetch_records_from(
		$this->db->dbprefix('subjects')
		);
		
		foreach ($subjRecords as $key=>$val)
		$subjOptions[$val->subjectid] 	= $val->name;
		$this->data['subjects'] 		= $subjOptions;
		$this->data['active_menu'] 		= 'questions';
		$this->data['content'] 			= 'admin/questions/addeditQuestions';
		if($this->ion_auth->is_moderator())
			$template = "moderatortemplate";
		else
			$template = "admintemplate";
			
		$this->_render_page('temp/'.$template, $this->data);
	}
	
	
	//CRUD Operations for Quiz
	function quiz()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['quizid'] 			= $this->uri->segment(3);
			if ($this->base_model->delete_record(
			$this->db->dbprefix('quiz'), 
			$where)
			)
			{
				$this->base_model->delete_record(
				$this->db->dbprefix('quizquestions'), 
				$where
				);
				$this->prepare_flashmessage("Record Deleted Successfully", 0);
				redirect('admin/quiz');
			}
					
		}				
		$this->data['title'] 			= 'Quizzes';
		$this->data['active_menu'] 		= 'quiz';
		$this->data['records'] 			= $this->base_model->run_query(
		"select q.*,c.name as catname,s.name as subcatname from "
		.$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
		." c,".$this->db->dbprefix('subcategories')." s 
		where c.catid=q.catid and s.subcatid=q.subcatid"
		);
		$this->data['content'] 			= 'admin/quiz/quiz';
		if($this->ion_auth->is_moderator())
			$template = "moderatortemplate";
		else
			$template = "admintemplate";
			
		$this->_render_page('temp/'.$template, $this->data);
	}
	
	
	
	//function to add quiz 
	function addeditQuiz()
	{	
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('catid', 'Category', 'trim|required|xss_clean');
		$this->form_validation->set_rules('subcatid', 'Sub Category', 'trim|required|xss_clean');
		$this->form_validation->set_rules('validityvalue', 'Validity Value', 'trim|required|xss_clean');
		$this->form_validation->set_rules('quizcost', 'Price ', 'trim|required|xss_clean');
		if ($this->input->post('negativemarkstatus') == "Active") {
			$this->form_validation->set_rules(
			'negativemark', 
			'Negative Mark', 
			'trim|required'
			);
		}
		$this->form_validation->set_rules('startdate', 'Start Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('enddate', 'End Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules(
		'deauration', 
		'Duration', 
		'trim|required|integer'
		);
		$this->form_validation->set_rules('qq', 'Subjects', 'trim|required|xss_clean');
		
		
		if ($this->input->post()) {
			if ($this->form_validation->run() == true) {
				
				$inputdata['quiztype'] 			= $this->input->post('quiztype');
				
				$quiz_grp = array();
				if($this->input->post('for_all') == ""){
					$quizgrp = implode(',',$this->input->post('quizfor'));
					$quiz_grp = explode(',',$quizgrp);
					$inputdata['quiz_for'] = "*";
				} else {
					$inputdata['quiz_for'] = 0; 
				}
						
				$inputdata['name'] 				= $this->input->post('name');
				$inputdata['catid'] 			= $this->input->post('catid');
				$inputdata['subcatid'] 			= $this->input->post('subcatid');
				$inputdata['negativemarkstatus'] = $this->input->post('negativemarkstatus');
				$inputdata['negativemark'] 		= "";
				
				if ($this->input->post('negativemarkstatus') == "Active") 
					$inputdata['negativemark'] 	= $this->input->post('negativemark');
				
				$inputdata['difficultylevel'] 	= $this->input->post('difficultylevel');
				$inputdata['hint'] 				= "Inactive";
				$inputdata['startdate'] 		= date(
				'Y-m-d', 
				strtotime($this->input->post('startdate'))
				);
				$inputdata['enddate'] 			= date('Y-m-d', 
				strtotime($this->input->post('enddate'))
				);
				$inputdata['deauration'] 		= $this->input->post('deauration');
				$inputdata['quiztype'] 			= $this->input->post('quiztype');
				$inputdata['validitytype'] 		= $this->input->post('validitytype');
				$inputdata['validityvalue'] 	= $this->input->post('validityvalue');
				$inputdata['quizcost'] 	= $this->input->post('quizcost');
				$inputdata['status'] 		= $this->input->post('status');
				
				if ($this->input->post('id') == '' ) {
					
					$insertid 					= $this->base_model->insert_operation_id(
					$inputdata,$this->db->dbprefix('quiz')
					);
					
					for($i=0;$i<count($quiz_grp);$i++)
					{
						$quiz_for['quizid'] = $insertid;
						$quiz_for['groupid'] = $quiz_grp[$i];
						$this->base_model->insert_operation($quiz_for,$this->db->dbprefix('quiz_for'));
						
					}
					
					$qq 						= $this->input->post('qq');
					$values 					= explode("^", $qq);
					$len 						= count($values);
					$result 					= array_filter($values, 
					 create_function('$a','return preg_match("#\S#", $a);')
					 );
					$i = 0;
					foreach ($result as $v) {
						if ($i++ < $len) {
							$values1 				= explode(",",$v);
							$data['subjectid'] 		= $values1[0];
							$data['totalquestion'] 	= $values1[1];
							$data['quizid'] 		= $insertid;
							$this->base_model->insert_operation(
							$data, 
							$this->db->dbprefix('quizquestions')
							);
						}
					}
					$msg = "Record Added Successfully.";
				}
				else {
					
					$where['quizid'] 			= $this->input->post('id');
					
					
					$updateid = $this->input->post('id');
					
					//step 1
					$this->base_model->delete_record(
					$this->db->dbprefix('quiz_for'), 
					$where);
					
					//step 2
					for($i=0;$i<count($quiz_grp);$i++)
					{
						$quiz_for['quizid'] = $updateid;
						$quiz_for['groupid'] = $quiz_grp[$i];
						$this->base_model->insert_operation($quiz_for,$this->db->dbprefix('quiz_for'));
						
					}
					
					//step 3
					$this->base_model->update_operation(
					$inputdata, 
					$this->db->dbprefix('quiz'), 
					$where
					);
					
					
					
					if (
					$this->base_model->delete_record(
					$this->db->dbprefix('quizquestions'), 
					$where
					)
					) {
						$qq 				= $this->input->post('qq');
						$values 			= explode("^", $qq);
						$len 				= count($values);
						 $result 			= array_filter(
						 $values, 
						 create_function('$a','return preg_match("#\S#", $a);')
						 );
						 
						$i = 0;
						foreach ($result as $v) {
							if ($i++ < $len) {
								$values1 				= explode(",", $v);
								$data['subjectid'] 		= $values1[0];
								$data['totalquestion'] 	= $values1[1];
								$data['quizid'] 		= $where['quizid'];
								$this->base_model->insert_operation(
								$data, 
								$this->db->dbprefix('quizquestions')
								);
							}
						}
						$msg = "Record Updated Successfully.";
					}		
				}
				$this->prepare_flashmessage($msg, 0);
				redirect('admin/quiz','refresh');
			}
			else {
				
				$this->prepare_flashmessage(validation_errors(), 1);
				redirect('admin/addeditQuiz','refresh');
			}
		}
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			
			$this->data['data'] = $this->base_model->run_query(
			"select q.*,c.name as catname,s.name as subcatname from "
			.$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
			." c,".$this->db->dbprefix('subcategories')." s 
			where c.catid=q.catid and s.subcatid=q.subcatid and quizid="
			.$this->uri->segment(3)
			);
			
			$this->data['qqdata'] 		= $this->base_model->run_query(
			"select qq.*,s.name as subjectname from "
			.$this->db->dbprefix('quizquestions')." qq,"
			.$this->db->dbprefix('subjects')." s 
			where s.subjectid=qq.subjectid and qq.quizid="
			.$this->uri->segment(3)
			);
			
			$groups = $this->base_model->run_query("SELECT groupid FROM quiz_for WHERE quizid=".$this->uri->segment(3) );
			
			//echo "<pre>"; print_r($groups); 
			
			$groups_opts = array();$i=-1;
			foreach($groups as $key=>$val)
			{	$i++;
				$groups_opts[$i] = $val->groupid;
				
			}
			
			// echo "<pre>"; print_r($groups_opts); die();
			
			$this->data['groups'] = $groups_opts;
			$this->data['id'] 			= $this->uri->segment(3);
			$this->data['title'] 		= 'Update Quiz';
		}
		else
		{
			$this->data['data'] 		= array();
			$this->data['groups'] 		= array();
			$this->data['qqdata'] 		= array();
			$this->data['id'] 			= '';
			$this->data['title'] 		= 'Add Quiz';
		}
		
		
		
		//Options for Status
		$Options['Active'] 				= 'Active';
		$Options['Inactive'] 			= 'Inactive';
		$this->data['element'] 			= $Options;
		
		//Options for Quiz Type
		$qztype['Free'] 				= 'Free';
		$this->data['quiztypes'] 		= $qztype;
		
		
		//Options for Quiz For
		//$Quizforoptions['0']='All groups'; 
		$Quizforoptions = array(); 
		$QuizforRecords = $this->base_model->fetch_records_from(
		$this->db->dbprefix('group_settings')
		);
		foreach ($QuizforRecords as $key=>$val) {
		    $Quizforoptions[$val->id]	= $val->group_name;	
		}
		$this->data['quizfor'] 		= $Quizforoptions;
		
		
		//Options for Negative Mark Status
		$nmstatus['Active'] 			= 'Active';
		$nmstatus['Inactive'] 			= 'Inactive';
		$this->data['negativemarksstatus'] = $nmstatus;
		
		//Options for Difficulty Level
		$dlevel['Easy'] 				= 'Easy';
		$dlevel['Medium'] 				= 'Medium';
		$dlevel['High'] 				= 'High';
		$this->data['difficultylevels'] = $dlevel;
		
		//Options for Categories
		$catOptions['']='Select Category';
		$catRecords = $this->base_model->fetch_records_from(
		$this->db->dbprefix('categories')
		);
		foreach ($catRecords as $key=>$val) {
		    $catOptions[$val->catid]	= $val->name;	
		}
		$this->data['categories'] 		= $catOptions;
		
		//Options for Subjects
		$subjOptions[''] 				= 'Select Subject';
		$subjRecords 					= $this->base_model->fetch_records_from(
		$this->db->dbprefix('subjects')
		);
		foreach ($subjRecords as $key => $val) {
		    $subjOptions[$val->subjectid] = $val->name;	
		}
		
		$this->data['subjects'] 		= $subjOptions;
		$this->data['active_menu'] 		= 'quiz';
		$this->data['content'] 			= 'admin/quiz/addeditQuiz';
		if($this->ion_auth->is_moderator())
			$template = "moderatortemplate";
		else
			$template = "admintemplate";
			
		$this->_render_page('temp/'.$template, $this->data);
	}
	//function to add quiz END
	
	
	
	
	//Fetch Sub Categories for Category id
	function getSubCategories()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		$id 	= $this->input->post('catid');
		$sub 	= $this->base_model->run_query(
		"select subcatid,name from ".$this->db->dbprefix('subcategories')
		." where catid=".$id
		);
		echo json_encode($sub); 
	}
	
	
	//CRUD Operations for Notifications
	function notifications()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) != '') {
			$where['nid'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('notifications'), 
			$where
			);
			$this->prepare_flashmessage("Record Deleted Successfully", 0);
			redirect('admin/notifications');		
		}
				
		$this->data['title'] 			= 'Notifications';
		$this->data['active_menu'] 		= 'notifications';
		$this->data['records'] 			= $this->base_model->fetch_records_from(
		$this->db->dbprefix('notifications')
		);
		$this->data['content'] 			= 'admin/notifications/notifications';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	function addeditNotifications()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules(
		'description', 
		'Description', 
		'trim|required'
		);
		$this->form_validation->set_rules('post_date', 'Post Date', 'trim|required');
		$this->form_validation->set_rules('last_date', 'Last Date', 'trim|required');
		if($this->input->post()) {
			if ($this->form_validation->run() == true) {
				$inputdata['title'] 		= $this->input->post('title');
				$inputdata['description'] 	= $this->input->post('description');
				$inputdata['post_date'] 	= date(
				'Y-m-d', 
				strtotime($this->input->post('post_date'))
				);
				$inputdata['last_date'] 	= date(
				'Y-m-d', 
				strtotime($this->input->post('last_date'))
				);
				$inputdata['status'] 		= $this->input->post('status');
				
				if ($this->input->post('id') == '') {
					$this->base_model->insert_operation(
					$inputdata, 
					$this->db->dbprefix('notifications')
					);
					
					$msg 					= "Record Added Successfully";
				}
				else {
					$where['nid'] 			= $this->input->post('id');
					$this->base_model->update_operation(
					$inputdata,
					$this->db->dbprefix('notifications'), 
					$where
					);
					$msg 					= "Record Updated Successfully";
				}
				$this->prepare_flashmessage($msg, 0);
				redirect('admin/notifications');
			}
			else {
			$this->prepare_flashmessage(validation_errors(), 1);
				redirect('admin/addeditNotifications');
			}
		}
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$this->data['data'] 		= $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('notifications')
			." where nid=".$this->uri->segment(3)
			);
			$this->data['id'] 			= $this->uri->segment(3);
			$this->data['title'] 		= 'Update Notification';
		}
		else {
			$this->data['data'] 		= array();
			$this->data['id'] 			= '';
			$this->data['title'] 		= 'Add Notification';
		}
				
		$Options['Active'] 				= 'Active';
		$Options['Inactive'] 			= 'Inactive';
		$this->data['element'] 			= $Options;
		
		$this->data['active_menu'] 		= 'notifications';
		$this->data['content'] 			= 'admin/notifications/addeditNotifications';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	//CRUD Operations for Testimonials
	function testimonials()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) != '') {
			$where['tid'] 			= $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('testimonials'), 
			$where
			);
			$this->prepare_flashmessage("Record Deleted Successfully", 0);
			redirect('admin/testimonials');		
		}
				
		$this->data['title'] 			= 'Testimonials';
		$this->data['active_menu'] 		= 'testimonials';
		$this->data['records'] 			= $this->base_model->fetch_records_from(
		$this->db->dbprefix('testimonials')
		);
		$this->data['content'] 			= 'admin/testimonials/testimonials';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	function addeditTestimonials()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('author', 'Author', 'trim|required');
		$this->form_validation->set_rules(
		'description', 
		'Description', 
		'trim|required'
		);
		
		if(!empty($_FILES['author_photo']['name'])) {

			$this->form_validation->set_rules('author_photo',"Author Photo", 'callback__image_check['.$_FILES['author_photo']['name'].']');			

		}
		
		if($this->input->post()) {
			if ($this->form_validation->run() == true) {
				$inputdata['author'] 		= $this->input->post('author');
				$inputdata['description'] 	= $this->input->post('description');			
				$inputdata['status'] 		= $this->input->post('status');
				$inputdata['added_date'] 	= date('Y-m-d');
				$image 						= $_FILES['author_photo']['name'];
				
				//Upload Website Logo
				if (!empty($image)) {

					if($this->input->post('id') != '') {
						$r = $this->base_model->run_query(
						"select author_photo from ".$this->db->dbprefix('testimonials')." 
						where author_photo!='' and status = 'Active' and tid=".$this->input->post('id')
						);
						unlink('assets/uploads/testimony_images/'.$r[0]->author_photo);
					}
					
					$ext = explode('.', $_FILES['author_photo']['name']);
					$inputdata['author_photo'] = $image;
					move_uploaded_file(
					$_FILES['author_photo']['tmp_name'], 
					'assets/uploads/testimony_images/'.$image
					);	
					$this->create_thumbnail(
					'assets/uploads/testimony_images/'. $image, 
					'assets/uploads/testimony_images/images(98x98)/'. $image,98,98);
				}
				
				if ($this->input->post('id') == '') {
					$this->base_model->insert_operation(
					$inputdata, 
					$this->db->dbprefix('testimonials')
					);
					
					$msg="Record Added Successfully";
				}
				else {
					$where['tid'] = $this->input->post('id');
					$this->base_model->update_operation(
					$inputdata,
					$this->db->dbprefix('testimonials'), 
					$where
					);
					$msg = "Record Updated Successfully";
				}
				$this->prepare_flashmessage($msg, 0);
				redirect('admin/testimonials');
			}
			else {
				$this->prepare_flashmessage(validation_errors(), 1);
				redirect('admin/addeditTestimonials','refresh');
			}		
		}
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$this->data['data']=$this->base_model->run_query(
			"select * from ".$this->db->dbprefix('testimonials')
			." where tid=".$this->uri->segment(3)
			);
			$this->data['id'] 			= $this->uri->segment(3);
			$this->data['title'] 		= 'Update Testimonial';
		}
		else {
			$this->data['data'] 		= array();
			$this->data['id'] 			= '';
			$this->data['title'] 		= 'Add Testimonial';
		}
				
		$Options['Active'] 				= 'Active';
		$Options['Inactive'] 			= 'Inactive';
		$this->data['element'] 			= $Options;
		
		$this->data['active_menu'] 		= 'testimonials';
		$this->data['content'] 			= 'admin/testimonials/addeditTestimonials';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	

	//Update General Settings
	function settings()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('site_title', 'Site Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules(
		'site_description', 
		'Site Description', 
		'trim|required'
		);
		$this->form_validation->set_rules(
		'site_keywords', 
		'Site Keywords', 
		'trim|required'
		);
		$this->form_validation->set_rules('site_url', 'Site URL', 'trim|required');
		$this->form_validation->set_rules('copy_right', 'Copy Right', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|integer');
		$this->form_validation->set_rules(
		'passing_score', 
		'Passing Score', 
		'trim|required|integer'
		);
		$this->form_validation->set_rules(
		'contact_email',
		'Contact Email',
		'trim|required|valid_email'
		);
		$this->form_validation->set_rules(
		'google_analytics',
		'Google Analytics',
		'trim|required'
		);
		$this->form_validation->set_rules(
		'certificate_content', 
		'Certificate Content', 
		'trim|required'
		);
		$this->form_validation->set_rules(
		'certificate_sign_text', 
		'Text for Signature', 
		'trim|required'
		);
		
		if(!empty($_FILES['site_logo']['name'])) {

			$this->form_validation->set_rules('site_logo',"Site Logo", 'callback__image_check['.$_FILES['site_logo']['name'].']');			

		}
		if(!empty($_FILES['certificate_logo']['name'])) {

			$this->form_validation->set_rules('certificate_logo',"Certificate Logo", 'callback__image_check['.$_FILES['certificate_logo']['name'].']');			

		}
		if(!empty($_FILES['certificate_sign']['name'])) {

			$this->form_validation->set_rules('certificate_sign',"Certificate Sign", 'callback__image_check['.$_FILES['certificate_sign']['name'].']');			

		}
		
		if ($this->form_validation->run() == true) {
			$image 		= $_FILES['site_logo']['name'];
			$image2 	= $_FILES['certificate_logo']['name'];
			$image3 	= $_FILES['certificate_sign']['name'];
			
			//Upload Website Logo
			if (!empty($image)) {	
				$r = $this->base_model->run_query(
				"select * from ".$this->db->dbprefix('general_settings').""
				);
				unlink('assets/designs/images/'.$r[0]->site_logo);
				unlink('assets/uploads/'.$r[0]->site_logo);
				
				$ext = explode('.', $_FILES['site_logo']['name']);
				$inputdata['site_logo'] = $image;
				move_uploaded_file(
				$_FILES['site_logo']['tmp_name'], 
				'assets/uploads/'.$image
				);	
				$this->create_thumbnail(
				'assets/uploads/'. $image, 
				'assets/designs/images/'. $image,360,64
				);
			}
			//Upload Logo on Certificate
			if (!empty($image2)) {	
				$r = $this->base_model->run_query(
				"select * from ".$this->db->dbprefix('general_settings').""
				);
				unlink('assets/uploads/certificate/'.$r[0]->certificate_logo);
				
				$inputdata['certificate_logo'] = $image2;
				move_uploaded_file(
				$_FILES['certificate_logo']['tmp_name'], 
				'assets/uploads/certificate/'.$image2
				);
			}
			//Upload Signature on Certificate
			if (!empty($image3)) {	
				$r = $this->base_model->run_query(
				"select * from ".$this->db->dbprefix('general_settings').""
				);
				unlink('assets/uploads/certificate/'.$r[0]->certificate_sign);
				$inputdata['certificate_sign'] = $image3;
				move_uploaded_file(
				$_FILES['certificate_sign']['tmp_name'], 
				'assets/uploads/certificate/'.$image3
				);
			}
			
			
			$inputdata['site_title'] 		= $this->input->post('site_title');
			$inputdata['site_description'] 	= $this->input->post('site_description');
			$inputdata['site_keywords'] 	= $this->input->post('site_keywords');
			$inputdata['site_url'] 			= $this->input->post('site_url');
			$inputdata['copy_right'] 		= $this->input->post('copy_right');
			$inputdata['address'] 			= $this->input->post('address');
			$inputdata['phone'] 			= $this->input->post('phone');
			$inputdata['passing_score'] 	= $this->input->post('passing_score');

			$inputdata['is_performance_report_for'] = $this->input->post('is_performance_report_for');
			$inputdata['quizzes_for'] 		= $this->input->post('quizzes_to_display');
			$inputdata['contact_email'] 	= $this->input->post('contact_email');
			$inputdata['google_analytics'] 	= $this->input->post('google_analytics');
			$inputdata['certificate_content'] = trim($this->input->post(
			'certificate_content')
			);
			$inputdata['certificate_sign_text'] = trim($this->input->post(
			'certificate_sign_text')
			);
			
			$inputdata['updated_date'] 		= date('Y-m-d');
			$this->base_model->update_operation(
			$inputdata, 
			$this->db->dbprefix('general_settings')
			);
			$msg = "Record Updated Successfully";
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/settings');
		}
		
		$this->data['data'] 			= $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('general_settings').""
		);
		$this->data['title'] 			= 'Update Settings';
	
		$this->data['active_menu'] 		= 'settings';
		$this->data['content'] 			= 'admin/settings/settings';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	//Update Email Settings
	function emailSettings()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('smtp_host', 'Smtp Host', 'trim|required');
		$this->form_validation->set_rules('smtp_user', 'Smtp User', 'trim|required|xss_clean');
		$this->form_validation->set_rules('smtp_pass', 'Smtp Password', 'trim|required');
		$this->form_validation->set_rules('smtp_port', 'Smtp Port', 'trim|required');
		if($this->input->post()) {
			if ($this->form_validation->run() == true) {
				$inputdata['smtp_host'] 		= $this->input->post('smtp_host');
				$inputdata['smtp_user'] 		= $this->input->post('smtp_user');
				$inputdata['smtp_pass'] 		= $this->input->post('smtp_pass');
				$inputdata['smtp_port'] 		= $this->input->post('smtp_port');
				$this->base_model->update_operation(
				$inputdata, 
				$this->db->dbprefix('email_setting')
				);
				$msg = "Record Updated Successfully";
				$this->prepare_flashmessage($msg, 0);
				redirect('admin/emailSettings');
			}
			else {				
					$this->prepare_flashmessage(validation_errors(), 1);
					redirect('admin/emailSettings');
			}
		}
		$this->data['data'] 			= $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('email_setting').""
		);
		$this->data['title'] 			= 'Email Settings';
	
		$this->data['active_menu'] 		= 'email-settings';
		$this->data['content'] 			= 'admin/settings/email_settings';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	//Load View for Uploading Questions in Excel Format
	function uploadexcel()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		$this->data['title'] 			= 'Upload questions';
		$this->data['active_menu'] 		= 'questions';
		$this->data['content'] 			= 'admin/questions/upload_question_excel';
		if($this->ion_auth->is_moderator())
			$template = "moderatortemplate";
		else
			$template = "admintemplate";
			
		$this->_render_page('temp/'.$template, $this->data);
	}
	
	//Read Excel Format Questions and Insert into DB
	function readquestionexcel()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		include(FCPATH.'/assets/excelassets/PHPExcel/IOFactory.php');
		$inputFileName 					= $_FILES['questionsfile']['tmp_name'];
		$objReader 						= new PHPExcel_Reader_Excel5();
		$objPHPExcel 					= $objReader->load($inputFileName);
		echo '<hr />';
		$sheetData 						= $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		$i								= 0;
		$j 								= 0;
		$data 							= array();
		$valid 							= 1;
		foreach ($sheetData as $r) {
			if ($i++ != 0) {			
			    if ($valid == 1) {
					$data[$j++] = array(
										'subjectid' 	=> $r['A'], 
										'questiontype' 	=> $r['B'],
										'totalanswers' 	=> $r['C'],
										'question' 		=> $r['D'],
										'answer1' 		=> $r['E'], 
										'answer2' 		=> $r['F'],
										'answer3' 		=> $r['G'],
										'answer4' 		=> $r['H'],
										'answer5' 		=> $r['I'],
										'correctanswer' => $r['J'],
										'difficultylevel' => $r['K'],
										'status' 		=> $r['L']
										);
				}
				else {
					break;
				}
			}
		
		}
			if ($valid == 1) {
				$this->db->insert_batch($this->db->dbprefix('questions'), $data);
			}
			else {
				$msg 	= "Invalid Data in excel";
				 $this->prepare_flashmessage($msg, 1);
				 redirect('admin/uploadexcel', 'refresh');
			}
			
			if ($this->db->affected_rows() > 0) {
				$msg = "Questions inserted Successfully";
				$this->prepare_flashmessage($msg, 0);
			}
			else {
				 $msg = "Questions not inserted Successfully";
				 $this->prepare_flashmessage($msg, 1);
			}
				redirect('admin/uploadexcel', 'refresh');
	}
	
	
	//About Us Content Updation
	function aboutus()
	{
		$this->validate_admin();

		$this->load->library('form_validation');
		$this->form_validation->set_rules(
			'bodyvi',
			'Nội dung tiết Việt',
			'trim|required'
		);
		$this->form_validation->set_rules(
			'bodyen',
			'Content for aboutus',
			'trim|required'
		);
		if ($this->form_validation->run() == true) {
			$inputdatavi['title'] = trim($this->input->post('titlevi'));
			$inputdatavi['slug'] = 'aboutus';
			$inputdatavi['body'] = trim($this->input->post('bodyvi'));
			//$inputdata['date_modified'] = date('Y-m-d');
			$where['id'] = trim($this->input->post('idvi'));
			$this->base_model->update_operation($inputdatavi,
				$this->db->dbprefix('pages'),
				$where
			);

			$inputdataen['title'] = trim($this->input->post('titleen'));
			$inputdataen['slug'] = 'aboutus';
			$inputdataen['body'] = trim($this->input->post('bodyen'));
			//$inputdata['date_modified'] = date('Y-m-d');
			$where['id'] = trim($this->input->post('iden'));
			$this->base_model->update_operation($inputdataen,
				$this->db->dbprefix('pages'),
				$where
			);

			$msg = "Record Updated Successfully";
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/aboutus');
		}

		$this->data['datavi'] = $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('pages')." where slug = 'aboutus' and lang='vietnamese'"
		);
		$this->data['dataen'] = $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('pages')." where slug = 'aboutus' and lang='english'"
		);

		$this->data['title'] 			= 'Update Aboutus Content';
		$this->data['active_menu'] 		= 'aboutus';
		$this->data['content'] 			= 'admin/content/aboutus';
		$this->_render_page('temp/admintemplate', $this->data);
	}
//About Us Content Updation
	function aboutprogram()
	{
		$this->validate_admin();

		$this->load->library('form_validation');
		$this->form_validation->set_rules(
			'bodyvi',
			'Nội dung tiết Việt',
			'trim|required'
		);
		$this->form_validation->set_rules(
			'bodyen',
			'Content for about program',
			'trim|required'
		);
		if ($this->form_validation->run() == true) {
			$inputdatavi['title'] = trim($this->input->post('titlevi'));
			$inputdatavi['slug'] = 'aboutprogram';
			$inputdatavi['body'] = trim($this->input->post('bodyvi'));
			//$inputdata['date_modified'] = date('Y-m-d');
			$where['id'] = trim($this->input->post('idvi'));
			$this->base_model->update_operation($inputdatavi,
				$this->db->dbprefix('pages'),
				$where
			);

			$inputdataen['title'] = trim($this->input->post('titleen'));
			$inputdataen['slug'] = 'aboutprogram';
			$inputdataen['body'] = trim($this->input->post('bodyen'));
			//$inputdata['date_modified'] = date('Y-m-d');
			$where['id'] = trim($this->input->post('iden'));
			$this->base_model->update_operation($inputdataen,
				$this->db->dbprefix('pages'),
				$where
			);

			$msg = "Record Updated Successfully";
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/aboutprogram');
		}

		$this->data['datavi'] = $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('pages')." where slug = 'aboutprogram' and lang='vietnamese'"
		);
		$this->data['dataen'] = $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('pages')." where slug = 'aboutprogram' and lang='english'"
		);

		$this->data['title'] 			= 'Update About Program Content';
		$this->data['active_menu'] 		= 'aboutus';
		$this->data['content'] 			= 'admin/content/aboutprogram';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	//Term Content Updation
	function term()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules(
		'bodyvi',
		'Nội dung tiết Việt',
		'trim|required'
		);
		$this->form_validation->set_rules(
			'bodyen',
			'Content for Term',
			'trim|required'
		);
		if ($this->form_validation->run() == true) {
			$inputdatavi['title'] = trim($this->input->post('titlevi'));
			$inputdatavi['slug'] = 'term';
			$inputdatavi['body'] = trim($this->input->post('bodyvi'));
			//$inputdata['date_modified'] = date('Y-m-d');
			$where['id'] = trim($this->input->post('idvi'));
			$this->base_model->update_operation($inputdatavi,
			$this->db->dbprefix('pages'),
				$where
			);

			$inputdataen['title'] = trim($this->input->post('titleen'));
			$inputdataen['slug'] = 'term';
			$inputdataen['body'] = trim($this->input->post('bodyen'));
			//$inputdata['date_modified'] = date('Y-m-d');
			$where['id'] = trim($this->input->post('iden'));
			$this->base_model->update_operation($inputdataen,
				$this->db->dbprefix('pages'),
				$where
			);

			$msg = "Record Updated Successfully";
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/term');
		}
		
		$this->data['datavi'] = $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('pages')." where slug = 'term' and lang='vietnamese'"
		);
		$this->data['dataen'] = $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('pages')." where slug = 'term' and lang='english'"
		);
		$this->data['title'] 			= 'Update Term Content';
		$this->data['active_menu'] 		= 'term';
		$this->data['content'] 			= 'admin/content/term';
		$this->_render_page('temp/admintemplate', $this->data);
	}	
	
	//Contact Us Content Updation
	function contactus()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules(
		'content', 
		'Content for Aboutus', 
		'trim|required'
		);
		
		if ($this->form_validation->run() == true) {		
			$inputdata['content'] = trim($this->input->post('content'));
			$inputdata['date_modified'] = date('Y-m-d');
			$this->base_model->update_operation(
			$inputdata, 
			$this->db->dbprefix('aboutus_content')
			);
			$msg = "Record Updated Successfully";
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/content/contactus');
		}
		
		$this->data['data'] = $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('aboutus_content').""
		);
		$this->data['title'] 			= 'Update Aboutus Content';
		$this->data['active_menu'] 		= 'aboutus_content';
		$this->data['content'] 			= 'admin/aboutus_content';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	//Result Content Updation
	function result()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules(
		'content', 
		'Content for Aboutus', 
		'trim|required'
		);
		
		if ($this->form_validation->run() == true) {		
			$inputdata['content'] = trim($this->input->post('content'));
			$inputdata['date_modified'] = date('Y-m-d');
			$this->base_model->update_operation(
			$inputdata, 
			$this->db->dbprefix('aboutus_content')
			);
			$msg = "Record Updated Successfully";
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/content/contactus');
		}
		
		$this->data['data'] = $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('aboutus_content').""
		);
		$this->data['title'] 			= 'Update Aboutus Content';
		$this->data['active_menu'] 		= 'aboutus_content';
		$this->data['content'] 			= 'admin/aboutus_content';
		$this->_render_page('temp/admintemplate', $this->data);
	}
		
	//Get availabile questions according to subject and difficulty level.
	function get_available_questions()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		$subjectid 						= $this->input->post('subjectid');
		$difficultylevel 				= $this->input->post('difficultylevel');		
		$available_questions_cnt 		= $this->base_model->run_query(
		"select count(*) as cnt from questions where subjectid="
		.$subjectid." and answer1!='' and answer2 != '' and correctanswer!='' "
		);
		echo $available_questions_cnt[0]->cnt;
	}
	
	
	//Validation for checking duplicates when performing add operation
	function check_duplicates()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		$table 							= $this->input->post('table');
		$cond 							= $this->input->post('condition');
		$cond_val 						= $this->input->post('condition_value');
		$condition[$cond] 				= $cond_val;
		if ($this->base_model->check_duplicates($table,$condition)) {
		    echo "false";//No Availability	
		}
		else {
			echo "true";
		}
	}
	
	
	//Validation for checking duplicates when performing update operation. Here will check the availability except with the updating one.
	function check_duplicates_with_not_cond()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		$table 							= $this->input->post('table');
		$cond 							= $this->input->post('condition');
		$cond_val 						= $this->input->post('condition_value');
		$not_cond 						= $this->input->post('not_condition');
		$not_cond_val 					= $this->input->post('not_condition_value');
		$duplicates 					= $this->base_model->run_query(
		"select * from ".$this->db->dbprefix($table)." where "
		.$cond."='".$cond_val."' and ".$not_cond."!=".$not_cond_val
		);
	
		if (count($duplicates)>0) {
			echo "false";//No Availability
		}
		else {
			echo "true";
		}
	}
	
	function paypal_settings()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('paypal_email', 'Paypal Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('currency_code', 'currency_code', 'trim|required|xss_clean');
		
		if ($this->form_validation->run() == true) {
			$inputdata['paypal_email'] 		= $this->input->post('paypal_email');
			$inputdata['currency_code'] 		= $this->input->post('currency_code');
			$inputdata['status'] 			= $this->input->post('status');
			$inputdata['account_type'] 			= $this->input->post('account_type');
			$this->base_model->update_operation(
			$inputdata, 
			$this->db->dbprefix('paypal')
			);
			$msg = "Record Updated Successfully";
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/paypal_settings');
		}
		else
		{
			if(validation_errors())
			$this->prepare_flashmessage(validation_errors(), 1);
		}
		
		$this->data['data'] 			= $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('paypal').""
		);
		
		$Options['Active'] 				= 'Active';
		$Options['Inactive'] 			= 'Inactive';
		$this->data['status'] 			= $Options;
		unset($Options);
		$Options['Sandbox'] 			= 'Sandbox';
		$Options['Production'] 			= 'Production';
		$this->data['account_type'] 	= $Options;
		
		$currency[''] 		= 'Select Currency';
		$cRecords = $this->base_model->fetch_records_from(
		$this->db->dbprefix('currencies')
		);
		foreach ($cRecords as $key=>$val) {
		    $currency[$val->code]=$val->country;	
		}
		$this->data['currency'] 		= $currency;
		
		$this->data['title'] 			= 'Paypal Settings';
	
		$this->data['active_menu'] 		= 'paypal';
		$this->data['content'] 			= 'admin/settings/paypal_settings';
		$this->_render_page('temp/admintemplate', $this->data);
		
	}
	
	//Function for Payments Reports
	function payreport()
	{
		$this->validate_admin();
		
		$this->data['title'] 			= 'Payment Reports';
		$this->data['active_menu'] 		= 'payment_report'; 
		$this->data['records'] 			= $this->base_model->run_query(
		"SELECT s.user_id,s.transaction_id, s.payer_email, s.payer_name, 
		q.name as quizname, q.quizcost as cost, u.username,s.dateofsubscription FROM "
		.$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('quizsubscriptions')
		." s,".$this->db->dbprefix('users')." u  where
		 s.quizid=q.quizid and s.user_id=u.id"
		);
		$this->data['content'] 			= 'admin/reports/payment_reports';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	 
	
	// Function For Logout
	function logout()
	{
		$this->session->sess_destroy();
		$this->prepare_flashmessage("You have successfully logout", 0);
		redirect('info');
	
	}
	// function for Uploading Logo
	function do_upload()
	{
		$this->validate_admin();
		
		$config['upload_path'] 			= './assets/uploads/paypal_logo';
		$config['allowed_types'] 		= 'jpg';
		$config['max_size']				= '1000';
		$config['max_width']  			= '400';
		$config['max_height'] 			= '100';
		$config['file_name'] 			= 'logo.jpg';
		$config['overwrite'] 			= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload())
		{
			$this->prepare_flashmessage($this->upload->display_errors(), 1);
			redirect('admin/paypal_settings');
		}
		else
		{
			$this->prepare_flashmessage("Logo Uploaded Successfully", 0);
			redirect('admin/paypal_settings');
			
		}
	}
	
	function group_settings()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] 	= $this->uri->segment(3);
			$this->base_model->delete_record($this->db->dbprefix('group_settings'), $where);
			$this->prepare_flashmessage("Record Deleted Successfully", 0);
			redirect('admin/group_settings');		
		}
				
		$this->data['title'] 		= 'Group Settings';
		$this->data['active_menu'] 	= '';
		$this->data['records'] 		= $this->base_model->fetch_records_from(
		$this->db->dbprefix('group_settings')
		);
		$this->data['content'] 		= 'admin/settings/group_settings';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	function add_group()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('group_name', 'Group Name', 'trim|required');
		
		if ($this->input->post()) {
			if ($this->form_validation->run() == true) {
				$inputdata['group_name'] 		= $this->input->post('group_name');
				$inputdata['status'] 	= $this->input->post('status');
				
				if ($this->input->post('id') == '') {
					$this->base_model->insert_operation(
					$inputdata,
					$this->db->dbprefix('group_settings')
					);
					
					$msg = "Record Added Successfully";
				}
				else {
					$where['id'] = $this->input->post('id');
					$this->base_model->update_operation(
					$inputdata, 
					$this->db->dbprefix('group_settings'), 
					$where
					);
					$msg = "Record Updated Successfully";
				}
				$this->prepare_flashmessage($msg, 0);
				redirect('admin/group_settings', 'refresh');
			}
			else {
				$this->prepare_flashmessage(validation_errors(), 1);
				redirect('admin/add_group', 'refresh');
			}
		}
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$this->data['data'] 	= $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('group_settings')
			." where id=".$this->uri->segment(3)
			);
			$this->data['id'] 		= $this->uri->segment(3);
			$this->data['title'] 	= 'Update Group';
		}
		else {
			$this->data['data'] 	= array();
			$this->data['id'] 		= '';
			$this->data['title'] 	= 'Add Group';
		}
		$Options['Active'] 			= 'Active';
		$Options['Inactive'] 		= 'Inactive';
		$this->data['element'] 		= $Options;
		$this->data['active_menu'] 	= '';
		$this->data['content'] 		= 'admin/settings/add_group_settings';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	function pages()
	{
		$this->load->model('page_m');
		// Fetch all pages
		$this->data['pages'] = $this->page_m->get_with_parent();
		$this->data['title'] 	= 'Pages';
		// Load view
		$this->data['content'] = 'admin/page/index';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	function editPage ($id = NULL)
	{ 	$this->load->model('page_m');
		// Fetch a page or set a new one
		if ($id) {
			$this->data['page'] = $this->page_m->get($id);
			count($this->data['page']) || $this->data['errors'][] = 'page could not be found';
		}
		else {
			die(1);
			$this->data['page'] = $this->page_m->get_new();
		}
		
		// Pages for dropdown
		$this->data['pages_no_parents'] = $this->page_m->get_no_parents();
		
		// Set up the form
		$rules = $this->page_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = $this->page_m->array_from_post(array(
				'title', 
				'slug', 
				'body', 
				'template', 
				'parent_id'
			));
			$this->page_m->save($data, $id);
			redirect('admin/pages');
		}
		
		// Load the view
		$this->data['content'] = 'admin/page/edit';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	function importImages ($url = 'https://www.dropbox.com/sh/6lr0mbanb92p1kl/AABMGXc0RZeedYxycyVWSKQja/EUH?dl=0')
	{


		$this->load->library('SimpleHtmlDom');
		$content = '';
	//	$url = urlencode($url);
	//	$url = str_replace('%2B','+',$url);
	//	$url = str_replace('%3A',':',$url);$url = str_replace('%3F','?',$url);$url = str_replace('%3D','=',$url);
	//	$url = str_replace('%2F','/',$url);log_message('error', $url);
		$html2 = $this->simplehtmldom->file_get_html($url);
		log_message('error',  $this->simplehtmldom);
		$cat_name = $html2->find('#folder-title .shmodel-filename', 1)->plaintext;
	//	die($cat_name);
		log_message('error', '3'.$cat_name);
		$this->data['title'] 	= $cat_name;
		$this->data['content'] = 'admin/images/import';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	public function export(){
		$heading=array('Dấu thời gian','Full Name:','Gender:','Date of birth:','Place of birth:','ID Card No.:','Date of issue:','Issued by Police of:','Hand phone No.:','Email:','Permanent Address:','Temporary Address:','Major:','University:','Student code:','Average GPA for all previous years:','Expected Graduation date:','English proficiency:','1.Please list down your most important extracurricular activities (if any) (school, union, community service, etc. Describe the activity:','2.Please list down your most significant academic or scholarship achievements (if any). Please specify the company/ university/ organization granted the scholarship or award.','1.Please list down your work experiences (if any). Please describe.','2.What is the plan for your career pursuit in the next three to five years? ','3.What is the most important factor that interests you to work for a company?','4.Tell us about your objectives in life. And how are you going to achieve these objectives? ','Registered field in the contest:','If your university is not listed above, please specify','Contest location','Câu hỏi không có tiêu đề');
		include(FCPATH.'/assets/excelassets/PHPExcel/IOFactory.php');
		//Create a new Object
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->setTitle("User");
		//Loop Heading
		$rowNumberH = 1;
		$colH = 'A';

		foreach($heading as $h){
			$objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
			$colH++;
		}
		//Loop Result
		$allUsers 	= $this->base_model->run_query(
			"SELECT u.* FROM users u, users_groups g WHERE u.id=g.user_id
		and g.group_id=2 and u.id!=1 ORDER BY u.id desc "
		);

		$i=2;$no = 1;
		foreach($allUsers as $n):
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,$n->date_of_registration);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$n->username);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$i,$n->gender);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$n->birthdate);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$n->birthplace);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$n->card_id_no);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$i,$n->date_of_issue);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$i,$n->issued_police);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$i,$n->phone);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$i,$n->email);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$i,$n->permanent_address);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$i,$n->temp_address);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$i,$n->major);
			if($n->university == 'National University of HCM' || $n->university == 'Hanoi Foreign Trade University' || $n->university == 'Can Tho Univesrity'){
				$university = $n->university;$another = '';
			}else{
				$university = '';
				$another = $n->university;
			}
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$i,$university);
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$i,$n->student_code);
			$objPHPExcel->getActiveSheet()->setCellValue('P'.$i,$n->score);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$i,$n->date_graduation);
			$objPHPExcel->getActiveSheet()->setCellValue('R'.$i,$n->english_proficiency);
			$objPHPExcel->getActiveSheet()->setCellValue('S'.$i,$n->extracurricular_activities);
			$objPHPExcel->getActiveSheet()->setCellValue('T'.$i,$n->achievements);
			$objPHPExcel->getActiveSheet()->setCellValue('U'.$i,$n->experiences);
			$objPHPExcel->getActiveSheet()->setCellValue('V'.$i,$n->career_pursuit);
			$objPHPExcel->getActiveSheet()->setCellValue('W'.$i,$n->factor);
			$objPHPExcel->getActiveSheet()->setCellValue('X'.$i,$n->objectives);
			$objPHPExcel->getActiveSheet()->setCellValue('Y'.$i,$n->registered_field);
			$objPHPExcel->getActiveSheet()->setCellValue('Z'.$i,$another);
			$objPHPExcel->getActiveSheet()->setCellValue('AA'.$i,$n->contest_location);
			$objPHPExcel->getActiveSheet()->setCellValue('AB'.$i,$n->company);
			$i++;$no++;
		endforeach;


		//Freeze pane
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		//Save as an Excel BIFF (xls) file
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$fileName = 'AllUserWilmar.'. date("Y-m-d") .'.xls';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename='.$fileName);
		header('Cache-Control: max-age=0');

		$objWriter->save('php://output');
		exit();
	}

	public function exportResult(){
		$heading=array('UserID','User Name','Email','Score','IQ','KTTH','English','Total questions','Date of test','Content writing');
		include(FCPATH.'/assets/excelassets/PHPExcel/IOFactory.php');
		//Create a new Object
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->setTitle("Exam result");
		//Loop Heading
		$rowNumberH = 1;
		$colH = 'A';

		foreach($heading as $h){
			$objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
			$colH++;
		}
		//Loop Result
		$allUsers 	= $this->base_model->run_query(
			"SELECT * FROM user_quiz_results"
		);

		$i=2;$no = 1;
		foreach($allUsers as $n):
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,$n->userid);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$n->username);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$i,$n->email);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$n->score);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$n->mark1);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$n->mark2);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$i,$n->mark3);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$i,$n->total_questions);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$i,$n->dateoftest);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$i,$n->content_exam);
			$i++;$no++;
		endforeach;


		//Freeze pane
		//$objPHPExcel->getActiveSheet()->freezePane('A2');
		//Save as an Excel BIFF (xls) file
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$fileName = 'ExamResult.'. date("Y-m-d") .'.xls';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename='.$fileName);
		header('Cache-Control: max-age=0');

		$objWriter->save('php://output');
		exit();
	}


	function articles()
	{
		$this->validate_admin();

		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] 			= $this->uri->segment(3);
			if ($this->base_model->delete_record(
				$this->db->dbprefix('articles'),
				$where)
			)
			$this->prepare_flashmessage("Record Deleted Successfully", 0);
			redirect('admin/articles');

		}
		$articles 	= $this->base_model->run_query(
			"SELECT * FROM articles"
		);
		$this->data['articles'] 	= $articles;
		$this->data['title'] 		= 'Tin tức và sự kiện';
		$this->data['active_menu'] 	= 'articles';
		$this->data['content'] 		= 'admin/articles/article';
		$this->_render_page('temp/admintemplate', $this->data);

	}

	function addeditArticle()
	{
		$this->validate_admin();
		$this->load->library('form_validation');
		$this->form_validation->set_rules(
			'bodyvi',
			'Nội dung tiết Việt',
			'trim|required'
		);
		$this->form_validation->set_rules(
			'bodyen',
			'Content for about program',
			'trim|required'
		);

		if ($this->form_validation->run() == true) {

			$inputdata['cat_id'] = 1;
			$inputdata['slug'] =  trim($this->input->post('slug'));

			if(!empty($_FILES['image']['name'])) {
				log_message('error',$_FILES['image']['name']);
				//$this->form_validation->set_rules('image',"Image", 'callback__image_check['.$_FILES['image']['name'].']');
				$image = $_FILES['image']['name'];
				//$ext = explode('.', $_FILES['image']['name']);
				$inputdata['image'] = $image;
				move_uploaded_file(
					$_FILES['image']['tmp_name'],
					'assets/uploads/images/news/'.$image
				);
				log_message('error','ok');
			}

			//log_message('error',$id);

			$inputdatavi['lang'] = 2;
			$inputdatavi['title'] = trim($this->input->post('titlevi'));
			$inputdatavi['short'] = trim($this->input->post('shortvi'));
			$inputdatavi['body'] = trim($this->input->post('bodyvi'));


			$inputdataen['lang'] = 1;
			$inputdataen['title'] = trim($this->input->post('titleen'));
			$inputdataen['short'] = trim($this->input->post('shorten'));
			$inputdataen['body'] = trim($this->input->post('bodyen'));

			if ($this->input->post('id') == '' ) {
				$inputdata['created'] = date('Y-m-d h:m:s');
				$inputdata['pubdate'] = date('Y-m-d h:m:s');
				$id = $this->base_model->insert_operation_id(
					$inputdata,
					$this->db->dbprefix('articles')
				);

				$inputdatavi['article_id'] = $id;
				$inputdataen['article_id'] = $id;
				$this->base_model->insert_operation($inputdatavi,
					$this->db->dbprefix('articles_description')
				);


				$this->base_model->insert_operation($inputdataen,
					$this->db->dbprefix('articles_description')
				);
				$this->prepare_flashmessage("Thêm tin tức thành công", 0);
			}else{
				$where['id'] = $this->input->post('id');
				$inputdata['modified'] = date('Y-m-d h:m:s');
				$inputdatavi['article_id'] =  $this->input->post('id');
				$inputdataen['article_id'] =  $this->input->post('id');

				$this->base_model->update_operation(
					$inputdata,
					$this->db->dbprefix('articles'),
					$where
				);

				$this->base_model->update_operation($inputdatavi,
					$this->db->dbprefix('articles_description'),
					'article_id = '.$this->input->post('id').' and lang = 2'
				);


				$this->base_model->update_operation($inputdataen,
					$this->db->dbprefix('articles_description'),
					'article_id = '.$this->input->post('id').' and lang = 1'
				);
				$this->prepare_flashmessage("Record Updated Successfully", 0);
			}
			redirect('admin/articles');
		}

		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {

			$record = $this->base_model->run_query(
				"select * from " . $this->db->dbprefix('articles')
				. " where id=" . $this->uri->segment(3));
			$this->data['datavi'] = $this->base_model->run_query(
				"select * from " . $this->db->dbprefix('articles_description') . " where article_id = " . $this->uri->segment(3) . " and lang=2");
			$this->data['dataen'] = $this->base_model->run_query(
				"select * from " . $this->db->dbprefix('articles_description') . " where article_id = " . $this->uri->segment(3) . " and lang=1");
			$this->data['data'] = $record;
			//$this->data['subject_id'] 	= $record[0]->subjectid;
			$this->data['id'] = $this->uri->segment(3);
			$title = "Cập nhật tin tức";
		}
		else {
			$this->data['data'] 		= array();
			$this->data['id'] 			= '';
			$title = "Thêm mới tin tức";
		}

		$this->data['title'] 			= $title;
		$this->data['active_menu'] 		= 'news';
		$this->data['content'] 			= 'admin/articles/addeditArticle';
		$this->_render_page('temp/admintemplate', $this->data);
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */