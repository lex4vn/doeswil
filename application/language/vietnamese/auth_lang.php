<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Author: Daniel Davis
*         @ourmaninjapan
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.09.2013
*
* Description:  English language file for Ion Auth example views
*
*/

// Errors
$lang['error_csrf'] = 'This form post did not pass our security checks.';
$lang['home'] = 'Trang chủ';
// Login
$lang['login_heading']         = 'Đăng nhập';
$lang['login_subheading']      = 'Bạn vui lòng nhập địa chỉ email hoặc tài khoản và mật khẩu bên dưới.';
$lang['login_identity_label']  = 'Địa chỉ email/Tài khoản:';
$lang['login_password_label']  = 'Mật khẩu:';
$lang['login_remember_label']  = 'Nhớ tôi:';
$lang['login_submit_btn']      = 'Đăng nhập';
$lang['login_forgot_password'] = 'Quên mật khẩu?';

// Index
$lang['index_heading']           = 'Users';
$lang['index_subheading']        = 'Below is a list of the users.';
$lang['index_fname_th']          = 'First Name';
$lang['index_lname_th']          = 'Last Name';
$lang['index_email_th']          = 'Email';
$lang['index_groups_th']         = 'Groups';
$lang['index_status_th']         = 'Status';
$lang['index_action_th']         = 'Action';
$lang['index_active_link']       = 'Active';
$lang['index_inactive_link']     = 'Inactive';
$lang['index_register_link']  = 'Create a new user';
$lang['index_create_group_link'] = 'Create a new group';

// Deactivate User
$lang['deactivate_heading']                  = 'Deactivate User';
$lang['deactivate_subheading']               = 'Are you sure you want to deactivate the user \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Yes:';
$lang['deactivate_confirm_n_label']          = 'No:';
$lang['deactivate_submit_btn']               = 'Submit';
$lang['deactivate_validation_confirm_label'] = 'confirmation';
$lang['deactivate_validation_user_id_label'] = 'user ID';

// Create User
$lang['register']                           = 'Đăng ký';
$lang['register_heading']                           = 'Đăng ký';
$lang['register_subheading']                        = 'Thông tin cá nhân:';
$lang['register_fullname_label']                       = 'Họ tên:';
$lang['register_gender_label']                       = 'Gender:';
$lang['register_date_of_birth_label']               = 'Date of birth:';
$lang['register_place_of_birth_label']               = 'Place of birth:';
$lang['register_id_card_no_label']               = 'ID Card No.:';
$lang['register_date_of_issue_label']               = 'Date of issue:';
$lang['register_issued_by_police_label']               = 'Issued by Police of:';
$lang['register_permanent_address_label']               = 'Permanent Address:';
$lang['register_temporary_address_label']               = 'Temporary Address:';
$lang['register_major_label']               = 'Major:';
$lang['register_university_label']               = 'University:';
$lang['register_student_code_label']               = 'Student code:';
$lang['register_average_gpa_label']               = 'Average GPA for all previous years:';
$lang['register_expected_graduation_label']               = 'Expected Graduation date:';
$lang['register_english_proficiency_label']               = 'English proficiency:';

// Achievement
$lang['register_extracurricular_activities_label']               = 'Please list down your most important extracurricular activities (if any) (school, union, community service, etc. Describe the activity:';
$lang['register_achievements_label']               = 'Please list down your most important of your academic or scholarship achievements (if any) Which company / Organization award?';
$lang['register_experiences_label']               = 'Please list down your work experiences (if any). Please describe.';
$lang['register_career_pursuit_label']               = 'What is the plan for your career pursuit in the next three to five years?';
$lang['register_factor_label']               = 'What is the most important factor that interests you to work for a company?';
$lang['register_objectives_label']               = 'Tell us about your objectives in life. And how are you going to achieve these objectives?';

$lang['register_department_label']                       = 'Phòng ban:';
$lang['register_fname_label']                       = 'Tên:';
$lang['register_lname_label']                       = 'Họ:';
$lang['register_company_label']                     = 'Công ty:';
$lang['register_email_label']                       = 'Địa chỉ Email:';
$lang['register_phone_label']                       = 'Số điện thoại:';
$lang['register_photo_label']                       = 'Ảnh đại diện';
$lang['register_password_label']                    = 'Mật khẩu:';
$lang['register_password_confirm_label']            = 'Nhập lại mật khẩu:';
$lang['register_submit_btn']                        = 'Đăng ký';
$lang['new_user_submit_btn']                           = 'Đăng ký';
$lang['signup_user_submit_btn']                        = 'Đăng ký';
$lang['register_validation_fname_label']            = 'Tên';
$lang['register_validation_lname_label']            = 'Họ';
$lang['register_validation_email_label']            = 'Email';
$lang['register_validation_phone1_label']           = 'First Part of Phone';
$lang['register_validation_phone2_label']           = 'Second Part of Phone';
$lang['register_validation_phone3_label']           = 'Third Part of Phone';
$lang['register_validation_company_label']          = 'Tên công ty';
$lang['register_validation_password_label']         = 'Mật khẩu';
$lang['register_validation_password_confirm_label'] = 'Nhập lại mật khẩu';
$lang['register_join_work_label'] = 'Mảng công việc đăng ký tham gia';
$lang['register_validation_wrong_confirm_password_label'] = 'Mật khẩu không khớp nhau. Vui lòng thử lại';
$lang['register_contest_location_label']           = 'Contest location';
$lang['register_university_another_label']           = 'If your university is not listed above, please specify';
$lang['register_validation_gender_label']          = 'Gender';
$lang['register_validation_fullname_label']          = 'Please enter fullname';
$lang['register_validation_phone_label']          = 'Please enter phone';
$lang['register_validation_contest_location_label']          = 'Please enter contest location';
$lang['register_issued_police_placeholder']          = 'Please enter issued police';

// Edit User
$lang['edit_user_heading']                           = 'Cập nhật thông tin';
$lang['edit_user_subheading']                        = 'Please enter the user\'s information below.';
$lang['edit_user_fname_label']                       = 'First Name:';
$lang['edit_user_lname_label']                       = 'Last Name:';
$lang['edit_user_company_label']                     = 'Company Name:';
$lang['edit_user_email_label']                       = 'Email:';
$lang['edit_user_phone_label']                       = 'Phone:';
$lang['edit_user_password_label']                    = 'Password: (if changing password)';
$lang['edit_user_password_confirm_label']            = 'Confirm Password: (if changing password)';
$lang['edit_user_groups_heading']                    = 'Member of groups';
$lang['edit_user_submit_btn']                        = 'Save User';
$lang['edit_user_validation_fname_label']            = 'First Name';
$lang['edit_user_validation_lname_label']            = 'Last Name';
$lang['edit_user_validation_email_label']            = 'Email Address';
$lang['edit_user_validation_phone1_label']           = 'First Part of Phone';
$lang['edit_user_validation_phone2_label']           = 'Second Part of Phone';
$lang['edit_user_validation_phone3_label']           = 'Third Part of Phone';
$lang['edit_user_validation_company_label']          = 'Company Name';
$lang['edit_user_validation_groups_label']           = 'Groups';
$lang['edit_user_validation_password_label']         = 'Password';
$lang['edit_user_validation_password_confirm_label'] = 'Password Confirmation';

// Create Group
$lang['create_group_title']                  = 'Create Group';
$lang['create_group_heading']                = 'Create Group';
$lang['create_group_subheading']             = 'Please enter the group information below.';
$lang['create_group_name_label']             = 'Group Name:';
$lang['create_group_desc_label']             = 'Description:';
$lang['create_group_submit_btn']             = 'Create Group';
$lang['create_group_validation_name_label']  = 'Group Name';
$lang['create_group_validation_desc_label']  = 'Description';

// Edit Group
$lang['edit_group_title']                  = 'Edit Group';
$lang['edit_group_saved']                  = 'Group Saved';
$lang['edit_group_heading']                = 'Edit Group';
$lang['edit_group_subheading']             = 'Please enter the group information below.';
$lang['edit_group_name_label']             = 'Group Name:';
$lang['edit_group_desc_label']             = 'Description:';
$lang['edit_group_submit_btn']             = 'Save Group';
$lang['edit_group_validation_name_label']  = 'Group Name';
$lang['edit_group_validation_desc_label']  = 'Description';

// Change Password
$lang['change_password_heading']                               = 'Change Password';
$lang['change_password_old_password_label']                    = 'Old Password:';
$lang['change_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['change_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['change_password_submit_btn']                            = 'Change';
$lang['change_password_validation_old_password_label']         = 'Old Password';
$lang['change_password_validation_new_password_label']         = 'New Password';
$lang['change_password_validation_new_password_confirm_label'] = 'Confirm New Password';

// Forgot Password
$lang['forgot_password_heading']                 = 'Forgot Password';
$lang['forgot_password_subheading']              = 'Enter Your Valid Email';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Submit';
$lang['forgot_password_validation_email_label']  = 'Email Address';
$lang['forgot_password_username_identity_label'] = 'Username';
$lang['forgot_password_email_identity_label']    = 'Email';
$lang['forgot_password_email_not_found']         = 'No record of that email address.';

// Reset Password
$lang['reset_password_heading']                               = 'Change Password';
$lang['reset_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['reset_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['reset_password_submit_btn']                            = 'Change';
$lang['reset_password_validation_new_password_label']         = 'New Password';
$lang['reset_password_validation_new_password_confirm_label'] = 'Confirm New Password';

//Contact Form
$lang['contact_form_validation_name_label']          = 'Name';
$lang['contact_form_validation_email_label']         = 'Email';
$lang['contact_form_validation_phone_label']         = 'Phone';
$lang['contact_form_validation_address_label']       = 'Address';
$lang['contact_form_validation_subject_label']       = 'Subject';

//Quick links
$lang['quick_link_home']          = 'Trang chủ';