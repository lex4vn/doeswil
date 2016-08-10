<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');

		// Load MongoDB library instead of native db driver if required
		$this->config->item('use_mongodb', 'ion_auth') ?
		$this->load->library('mongo_db') :

		$this->load->database();

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
		$this->load->helper('language');
	}

	//redirect if needed, otherwise display the user list
	function index()
	{

		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
		{
			//redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}
			$this->data['content'] = 'general/index';
			$this->_render_page('temp/template', $this->data);
		}
	}

	//log the user in
	function login()
	{
		if (!$this->ion_auth->logged_in())
		{
		
		$this->data['title'] = "Login";
		
		if($this->input->post('submit')!='')
		{
			//validate form input
			$this->form_validation->set_rules('identity', 'Identity', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run() == true)
			{
				//check to see if the user is logging in
				//check for "remember me"
				$remember = (bool) $this->input->post('remember');

				if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
				{
					//if the login is successful
					//redirect them back to the home page
					
					
					if ($this->ion_auth->is_admin())
					{
						//$this->session->set_flashdata('message', $this->ion_auth->messages());
						$this->prepare_flashmessage($this->ion_auth->messages(),0);
						redirect('admin', 'refresh');
					}
					elseif ($this->ion_auth->is_moderator())
					{
						//$this->session->set_flashdata('message', $this->ion_auth->messages());
						$this->prepare_flashmessage($this->ion_auth->messages(),0);
						redirect('moderator', 'refresh');
					}
					else
					{
						//Check wether the user has updated his group or not
						$userid = $this->ion_auth->get_user_id();
						if(is_numeric($userid)) {
							$result =	$this->base_model->run_query("select * FROM  users where id=".$userid);	
							
								if($result[0]->group==0) {
								$this->prepare_flashmessage("Please update your group to continue ",1);
						redirect('user/profile');
								}
								
							
							
						}
						
						
						$this->prepare_flashmessage($this->ion_auth->messages(),0);
						redirect('user', 'refresh');
					}
				}
				else
				{
					//if the login was un-successful
					//redirect them back to the login page					
					$this->prepare_flashmessage($this->ion_auth->errors(),1);
					redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
				}
			}
			else
			{
				//the user is not logging in so display the login page
				//set the flash data error message if there is one			
				$this->prepare_flashmessage(validation_errors(),1);
				redirect('auth/login', 'refresh');
			}
		}

			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				'class'=>'form-control',
				'placeholder'=>'User Email',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'class'=>'form-control',
				'placeholder'=>'Password',
				'type' => 'password',
			);
			$this->data['content'] = "auth/login";
			$this->_render_page('temp/template', $this->data);
		}
		else
		{
			redirect('info','refresh');
		}
	}

	//log the user out
	function logout()
	{
		
		$this->data['title'] = "Logout";
		
		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them to the login page
		$this->prepare_flashmessage($this->ion_auth->messages(),0);
		redirect('auth/login', 'refresh');
	}

	//change password
	function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			//display the form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'class'=>'form-control',
				'placeholder'=>'Old Password',
				'id'   => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name' => 'new',
				'class'=>'form-control',
				'placeholder'=>'New Password',
				'id'   => 'new',
				'type' => 'password',
			);
			$this->data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'class'=>'form-control',
				'placeholder'=>'New Confirm Password',
				'id'   => 'new_confirm',
				'type' => 'password',
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);
								
				$this->data['active_menu']='change_password';
				$this->data['content']='auth/change_password';
				$this->data['title']='Change Password';
				
					$this->data['user_type']='user';
					$template_type = "usertemplate";
				if($this->ion_auth->is_admin())
				{
					$this->data['user_type']='admin';
					$template_type = "admintemplate";
				}
				elseif($this->ion_auth->is_moderator())
				{
					$this->data['user_type']='moderator';
					$template_type = "moderatortemplate";
				}
				$this->_render_page('temp/'.$template_type,$this->data);

		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->prepare_flashmessage($this->ion_auth->messages(),0);
				redirect('auth/change_password', 'refresh');
				//$this->logout();
			}
			else
			{
				$this->prepare_flashmessage($this->ion_auth->errors(),1);
				redirect('auth/change_password', 'refresh');
			}
		}
	}

	//forgot password
	function forgot_password()
	{
		$this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required');
		if ($this->form_validation->run() == false)
		{
			//setup the input
			$this->data['email'] = array(
				'name' => 'email',
				'class'=>'form-control',
				'placeholder'=>'User Email',
				'id' => 'email',
			); 

			if ( $this->config->item('identity', 'ion_auth') == 'username' ){
				$this->data['identity_label'] = $this->lang->line('forgot_password_username_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			//set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['content'] = 'auth/forgot_password';
			$this->_render_page('temp/template', $this->data);
		}
		else
		{
			// get identity from username or email
			if ( $this->config->item('identity', 'ion_auth') == 'username' ){
				$identity = $this->ion_auth->where('username', strtolower($this->input->post('email')))->users()->row();
			}
			else
			{
				$identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
			}
	            	if(empty($identity)) {
		        	$this->ion_auth->set_message('forgot_password_email_not_found');
		                //$this->session->set_flashdata('message', $this->ion_auth->messages());
						$this->prepare_flashmessage($this->ion_auth->messages(),2);
                		redirect("auth/forgot_password", 'refresh');
            		}
            
			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				//if there were no errors
				$this->prepare_flashmessage($this->ion_auth->messages(),0);
				redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->prepare_flashmessage($this->ion_auth->errors(),1);
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	//reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			//if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false)
			{
				//display the form

				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'class'=>'form-control',
					'placeholder'=>'New Password (at least 8 characters long)',
					'id'   => 'new',
					'type' => 'password',
				);
				$this->data['new_password_confirm'] = array(
					'name' => 'new_confirm',
					'class'=>'form-control',
				'placeholder'=>'Confirm New Password',
					'id'   => 'new_confirm',
					'type' => 'password',
				);
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				//set any errors and display the form
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				$this->data['content'] = 'auth/reset_password';
				$this->_render_page('temp/template', $this->data);
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					//something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						//if the password was successfully changed
						$this->prepare_flashmessage($this->ion_auth->messages(),0);
						$this->logout();
					}
					else
					{
						$this->prepare_flashmessage($this->ion_auth->errors(),1);
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			//if the code is invalid then send them back to the forgot password page
			$this->prepare_flashmessage($this->ion_auth->errors(),1);
			redirect("auth/forgot_password", 'refresh');
		}
	}


	//activate the user
	function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			//redirect them to the auth page
			$this->prepare_flashmessage($this->ion_auth->messages(),0);
			redirect("auth/login", 'refresh');
		}
		else
		{
			//redirect them to the forgot password page
			$this->prepare_flashmessage($this->ion_auth->errors(),1);
			redirect("auth/forgot_password", 'refresh');
		}
	}

	//deactivate the user
	function deactivate($id = NULL)
	{
		$id = $this->config->item('use_mongodb', 'ion_auth') ? (string) $id : (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->_render_page('auth/deactivate_user', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			//redirect them back to the auth page
			redirect('auth', 'refresh');
		}
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
		
		if (!in_array($ext, $allowed_types))
		{			
			
			$this->form_validation->set_message('_image_check', 'Only jpg / jpeg / png images are accepted.');
			
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	//create a new user
	function register()
	{
		$this->data['title'] = "Create User";
	
		//$this->load->config('ion_auth');
		$this->config->load('ion_auth', TRUE);
		$tables = $this->config->item('tables','ion_auth');
		
		if($this->input->post('submit')!='')
		{
			//validate form input
			$this->form_validation->set_rules('fullname', $this->lang->line('register_validation_fullname_label'), 'required|xss_clean');
			$this->form_validation->set_rules('email', $this->lang->line('register_validation_email_label'), 'required|valid_email|is_unique['.$tables['users'].'.email]');
			$this->form_validation->set_rules('phone', $this->lang->line('register_validation_phone_label'), 'required|xss_clean|integer');
			$this->form_validation->set_rules('gender', $this->lang->line('register_validation_gender_label'), 'required');
			$this->form_validation->set_rules('company', $this->lang->line('register_validation_company_label'), 'required|xss_clean');
			$this->form_validation->set_rules('password', $this->lang->line('register_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
			$this->form_validation->set_rules('password_confirm', $this->lang->line('register_validation_password_confirm_label'), 'required');
			
			if(!empty($_FILES['image']['name'])) {

				$this->form_validation->set_rules('image',"Image", 'callback__image_check['.$_FILES['image']['name'].']');			

			}

			if ($this->form_validation->run() == true)
			{
				$username = $this->input->post('full_name');
				$email    = strtolower($this->input->post('email'));
				$password = $this->input->post('password');
				$image = $_FILES['image']['name'];

				$additional_data = array(
					'full_name' => $this->input->post('full_name'),
					'phone'      => $this->input->post('phone'),
					'gender'      => $this->input->post('gender'),
					'birthdate'      => $this->input->post('birthdate'),
					'birthplace'      => $this->input->post('birthplace'),
					'card_id_no'      => $this->input->post('card_id_no'),
					'date_of_issue'      => $this->input->post('date_of_issue'),
					'issued_police'      => $this->input->post('issued_police'),
					'permanent_address'      => $this->input->post('permanent_address'),
					'temp_address'      => $this->input->post('temp_address'),
					'major'      => $this->input->post('major'),
					'university'      => $this->input->post('university'),
					'student_code'      => $this->input->post('student_code'),
					'score'      => $this->input->post('score'),
					'date_graduation'      => $this->input->post('date_graduation'),
					'english_proficiency'      => $this->input->post('english_proficiency'),
					'extracurricular_activities'      => $this->input->post('extracurricular_activities'),
					'achievements'      => $this->input->post('achievements'),
					'experiences'      => $this->input->post('experiences'),
					'career_pursuit'      => $this->input->post('career_pursuit'),
					'factor'      => $this->input->post('factor'),
					'objectives'      => $this->input->post('objectives'),
					'date_of_registration'      => date('Y-m-d')
				);
				
				if(!empty($image))
					$additional_data['image'] = $image;
				
			}
			if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
			{
				//check to see if we are creating the user
				//redirect them back to the admin page
				$this->prepare_flashmessage($this->ion_auth->messages(),2);
				redirect("auth/login", 'refresh');
			}
			else
			{
				//display the create user form
				//set the flash data error message if there is one
				$this->prepare_flashmessage((validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'))),1);
				redirect("auth/register", 'refresh');
				
			}
		}
		$this->data['full_name'] = array(
			'name'  => 'full_name',
			'class'=>'form-control',
			'placeholder'=> lang('register_fullname_placeholder'),
			'id'    => 'full_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('full_name'),
		);
		$this->data['gender'] = array(
			'name'  => 'gender',
			'options'=> array(
				'0'=> '',
				'1'=> lang('male'),
				'2'=> lang('female')
			),
			'selected'    => array(
				'1'=> lang('male')
			)
		);
			$this->data['birthdate'] = array(
				'name'  => 'birthdate',
				'class'=>'form-control',
				'placeholder'=> lang('date_placeholder'),
				'id'    => 'birthdate',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('birthdate'),
			);
			$this->data['birthplace'] = array(
				'name'  => 'birthplace',
				'class'=>'form-control',
				'placeholder'=> lang('register_place_of_birth_placeholder'),
				'id'    => 'birthplace',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('birthplace'),
			);
			$this->data['date_of_issue'] = array(
				'name'  => 'date_of_issue',
				'class'=>'form-control',
				'placeholder'=> lang('date_placeholder'),
				'id'    => 'date_of_issue',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('date_of_issue'),
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
			$this->data['birthplace'] = array(
				'name'  => 'birthplace',
				'class'=>'form-control',
				'placeholder'=>lang('register_place_of_birth_placeholder'),
				'id'    => 'birthplace',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('birthplace'),
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


		$this->data['extracurricular_activities'] = array(
			'name'  => 'extracurricular_activities',
			'class'=>'form-control',
			'id'    => 'extracurricular_activities',
			'value' => $this->form_validation->set_value('extracurricular_activities'),
		);

		$this->data['achievements'] = array(
			'name'  => 'achievements',
			'class'=>'form-control',
			'id'    => 'achievements',
			'value' => $this->form_validation->set_value('achievements'),
		);

		$this->data['experiences'] = array(
			'name'  => 'experiences',
			'class'=>'form-control',
			'id'    => 'experiences',
			'value' => $this->form_validation->set_value('experiences'),
		);
		$this->data['objectives'] = array(
			'name'  => 'objectives',
			'class'=>'form-control',
			'id'    => 'objectives',
			'value' => $this->form_validation->set_value('objectives'),
		);
		$this->data['career_pursuit'] = array(
			'name'  => 'career_pursuit',
			'class'=>'form-control',
			'id'    => 'career_pursuit',
			'value' => $this->form_validation->set_value('career_pursuit'),
		);
		$this->data['factor'] = array(
			'name'  => 'factor',
			'class'=>'form-control',
			'id'    => 'factor',
			'value' => $this->form_validation->set_value('factor'),
		);
			$this->data['content'] = 'auth/register';
			$this->_render_page('temp/template', $this->data);
	}

	//edit a user
	function edit_user($id)
	{
		$this->data['title'] = "Edit User";

		if (!$this->ion_auth->logged_in() ||  !($this->ion_auth->user()->row()->id == $id))
		{
			redirect('auth', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		//validate form input
		$this->form_validation->set_rules('full_name', $this->lang->line('edit_user_validation_fullname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required|xss_clean');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required|xss_clean');
		$this->form_validation->set_rules('groups', $this->lang->line('edit_user_validation_groups_label'), 'xss_clean');

		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'full_name'  => $this->input->post('full_name'),
				'company'    => $this->input->post('company'),
				'phone'      => $this->input->post('phone'),
			);
			
			$image = $_FILES['image']['name'];
			
			if(!empty($image)) {
			
				unlink('assets/uploads/images/'. $user->image);
				unlink('assets/uploads/images(200x200)/'. $user->image);
				unlink('assets/uploads/images(50x50)/'. $user->image);
				
				$ext = explode('.', $image);
				
				$img = $ext[0]."_".$user->id.".".$ext[1];
				
				$data['image'] = $img;
			
			}

			// Only allow updating groups if user is admin
			if ($this->ion_auth->is_admin())
			{
				//Update the groups user belongs to
				$groupData = $this->input->post('groups');

				if (isset($groupData) && !empty($groupData)) {

					$this->ion_auth->remove_from_group('', $id);

					foreach ($groupData as $grp) {
						$this->ion_auth->add_to_group($grp, $id);
					}

				}
			}

			//update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');

				$data['password'] = $this->input->post('password');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$this->ion_auth->update($user->id, $data);

				//check to see if we are creating the user
				//redirect them back to the admin page
				$this->session->set_flashdata('message', "User Saved");
				if ($this->ion_auth->is_admin())
				{
					redirect('auth', 'refresh');
				}
				else
				{
					redirect('/', 'refresh');
				}
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
		$this->data['full_name'] = array(
			'name'  => 'full_name',
			'class'=>'form-control',
			'placeholder'=> lang('register_fullname_label'),
			'id'    => 'full_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('full_name', $user->full_name),
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
			$this->data['content']='auth/edit_user';
			$this->_render_page('common/user_template',$this->data);
		//$this->_render_page('auth/edit_user', $this->data);
	}

	// create a new group
	function create_group()
	{
		$this->data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		//validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash|xss_clean');
		$this->form_validation->set_rules('description', $this->lang->line('create_group_validation_desc_label'), 'xss_clean');

		if ($this->form_validation->run() == TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth", 'refresh');
			}
		}
		else
		{
			//display the create group form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);

			$this->_render_page('auth/create_group', $this->data);
		}
	}

	//edit a group
	function edit_group($id)
	{
		// bail if no group id given
		if(!$id || empty($id))
		{
			redirect('auth', 'refresh');
		}

		$this->data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		//validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash|xss_clean');
		$this->form_validation->set_rules('group_description', $this->lang->line('edit_group_validation_desc_label'), 'xss_clean');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if($group_update)
				{
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("auth", 'refresh');
			}
		}

		//set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$this->data['group'] = $group;

		$this->data['group_name'] = array(
			'name'  => 'group_name',
			'id'    => 'group_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_name', $group->name),
		);
		$this->data['group_description'] = array(
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->description),
		);

		$this->_render_page('auth/edit_group', $this->data);
	}
	

}
