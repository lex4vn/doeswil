
<!-- Slider-->
<div data-ride="carousel" class="carousel slide banner" id="myCarousel">
   <div class="container">
      <div class="col-lg-12"><img src="<?php echo base_url(); ?>assets/designs/images/wilmar.jpg" width="100%"></div>
   </div>
</div>
<!-- Slider-->
<!-- Middle Content-->
<div class="container-fluid content-bg">
   <div class="spacer"></div>
   <div class="container padding">
      <div class="col-md-8 col-xs-12">
         <div class="bradcome-menu">
            <ul>
               <li><a href="<?php echo base_url(); ?>"><?php echo lang('home'); ?></a></li>
               <li><img src="<?php echo base_url(); ?>assets/designs/images/arrow1.png" width="7" height="6"></li>
               <li><a href="#"> <?php echo lang('register'); ?></a></li>
            </ul>
         </div>
      </div>
   </div>
   <div class="container inner-content padding">
      <div class="col-md-12 col-xs-12">

         <div class="col-md-12 formgro">
            <!--  <div id="infoMessage"><?php  echo $message;?></div>	-->
            <?php echo $this->session->flashdata('message'); ?>
            <?php echo form_open("auth/register",'class="form-signin" id="user_creation_form" enctype="multipart/form-data"');?>
            
            <!--  A	-->
             <h1 class="inner-hed">A. <?php echo lang('register_subheading'); ?></h1>
             <!--  fullname	-->
             <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                     <div class="form-group paddin-cont">
                         <label class="col-lg-12 control-label" for="fullname"><?php echo lang('register_fullname_label'); ?> <span style="color:red;">*</span></label>
                         <div class="col-lg-12 ">
                             <?php echo form_input($fullname);?>
                         </div>
                     </div>
                </div>
            
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group paddin-cont">
                       <label class="col-lg-12 control-label" for="gender"><?php echo lang('register_gender_label'); ?><span style="color:red;">*</span></label>
                       <div class="col-lg-12 ">
                          <?php echo form_dropdown($gender['name'],$gender['options']);?>
                       </div>
                    </div>
                </div>
            </div>
            <!-- end fullname	-->
            
            <div class="row">
            <div class="col-lg-12 form-group">
               <label class="col-lg-12 control-label" for="image"><?php echo lang('register_photo_label'); ?> <span style="color:red;">*</span></label>
               <div class="col-lg-12 ">
                  <input type="file" name="image" id="image" class=""/>
               </div>
            </div>
            </div>
            
            <!--  birthdate	-->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                     <div class="form-group paddin-cont">
                       <label class="col-lg-12 control-label" for="birthdate"><?php echo lang('register_date_of_birth_label'); ?><span style="color:red;">*</span></label>
                       <div class="col-lg-12 ">
                           <div class='input-group date'>
                              <?php echo form_input($birthdate);?>
                              <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                           </div>
                       </div>
                    </div>
                </div>
            
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                     <div class="form-group paddin-cont">
                         <label class="col-lg-12 control-label" for="birthplace"><?php echo lang('register_place_of_birth_label'); ?><span style="color:red;">*</span></label>
                         <div class="col-lg-12 ">
                             <?php echo form_input($birthplace);?>
                         </div>
                     </div>            
                </div>
            </div><!--  end	birthdate -->
            
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="form-group paddin-cont">
                     <label class="col-lg-12 control-label" for="card_id_no"><?php echo lang('register_id_card_no_label'); ?><span style="color:red;">*</span></label>
                     <div class="col-lg-12 ">
                         <?php echo form_input($card_id_no);?>
                     </div>
                 </div>
                 </div>
                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                 <div class="form-group paddin-cont">
                     <label class="col-lg-12 control-label" for="date_of_issue"><?php echo lang('register_date_of_issue_label'); ?><span style="color:red;">*</span></label>
                     <div class="col-lg-12 ">
                         <div class='input-group date'>
                         <?php echo form_input($date_of_issue);?>
                         <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                         </div>
                     </div>
                 </div>
                 </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group paddin-cont">
                     <label class="col-lg-12 control-label" for="issued_police"><?php echo lang('register_issued_by_police_label'); ?><span style="color:red;">*</span></label>
                     <div class="col-lg-12 ">
                         <?php echo form_input($issued_police);?>
                     </div>
                 </div>
                 </div>
            </div>

        


             
            <!--  email	-->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                     <div class="form-group paddin-cont">
                         <label class="col-lg-12 control-label" for="email"><?php echo lang('register_email_label'); ?> <span style="color:red;">*</span></label>
                         <div class="col-lg-12 ">
                             <?php echo form_input($email);?>
                         </div>
                     </div>     
                </div>
            
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                     <div class="form-group paddin-cont">
                         <label class="col-lg-12 control-label" for="phone"><?php echo lang('register_phone_label'); ?><span style="color:red;">*</span></label>
                         <div class="col-lg-12 ">
                             <?php echo form_input($phone);?>
                         </div>
                     </div>               
                </div>
            </div><!--  end	email -->
            
             
            <!--  password	-->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group paddin-cont">
                       <label class="col-lg-12 control-label" for="password"><?php echo lang('register_password_label'); ?> <span style="color:red;">*</span></label>
                       <div class="col-lg-12 ">
                          <?php echo form_input($password);?>
                       </div>
                    </div>
                </div>
            
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group paddin-cont">
                        <label class="col-lg-12 control-label" for="password_confirm"><?php echo lang('register_password_confirm_label'); ?> <span style="color:red;">*</span></label>
                       <div class="col-lg-12 ">
                          <?php echo form_input($password_confirm);?>
                       </div>
                    </div>                 
                </div>
            </div><!--  end	password -->
            
             <div class="form-group paddin-cont">
                 <label class="col-lg-12 control-label" for="permanent_address"><?php echo lang('register_permanent_address_label'); ?><span style="color:red;">*</span></label>
                 <div class="col-lg-12 ">
                     <?php echo form_input($permanent_address);?>
                 </div>
             </div>
             <div class="form-group paddin-cont">
                 <label class="col-lg-12 control-label" for="temp_address"><?php echo lang('register_temporary_address_label'); ?><span style="color:red;">*</span></label>
                 <div class="col-lg-12 ">
                     <?php echo form_input($temp_address);?>
                 </div>
             </div>
             <div class="form-group paddin-cont">
                 <label class="col-lg-12 control-label" for="major"><?php echo lang('register_major_label'); ?><span style="color:red;">*</span></label>
                 <div class="col-lg-12 ">
                     <?php echo form_input($major);?>
                 </div>
             </div>

             <div class="form-group paddin-cont">
                 <label class="col-lg-12 control-label" for="university"><?php echo lang('register_university_label'); ?><span style="color:red;">*</span></label>
                 <div class="col-lg-12 ">
                     <?php echo form_input($university);?>
                 </div>
             </div>
             
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                     <div class="form-group paddin-cont">
                         <label class="col-lg-12 control-label" for="student_code"><?php echo lang('register_student_code_label'); ?><span style="color:red;">*</span></label>
                         <div class="col-lg-12 ">
                             <?php echo form_input($student_code);?>
                         </div>
                     </div>
                 </div>
                 
                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                     <div class="form-group paddin-cont">
                       <label class="col-lg-12 control-label" for="registered_field"><?php echo lang('register_registered_field_label'); ?><span style="color:red;">*</span></label>
                       <div class="col-lg-12 ">
                          <?php echo form_dropdown($registered_field['name'],$registered_field['options']);?>
                       </div>
                    </div>
                </div>
            </div> 
            
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                     <div class="form-group paddin-cont">
                         <label class="col-lg-12 control-label" for="score"><?php echo lang('register_average_gpa_label'); ?><span style="color:red;">*</span></label>
                         <div class="col-lg-12 ">
                             <?php echo form_input($score);?>
                         <em>The GPA's decimal should be separated from integer by a dot. Ex: Correct answer: 7.6; wrong answer: 7,6.</em>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                     <div class="form-group paddin-cont">
                         <label class="col-lg-12 control-label" for="date_graduation"><?php echo lang('register_expected_graduation_label'); ?><span style="color:red;">*</span></label>
                         <div class="col-lg-12 ">
                             <div class='input-group date'>
                                 <?php echo form_input($date_graduation);?>
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                               </div>
                         </div>
                     </div>

                 </div>
                
            </div>

             <div class="form-group paddin-cont">
                 <label class="col-lg-12 control-label" for="english_proficiency"><?php echo lang('register_english_proficiency_label'); ?><span style="color:red;">*</span></label>
                 <div class="col-lg-12 ">
                     <?php echo form_input($english_proficiency);?>
                 </div>
             </div>
             <div class="clearfix"></div>
             <div class="spacer"></div>
             
             <!--  B	-->
             <h1 class="inner-hed">B. <?php echo lang('register_heading_achievement_label'); ?></h1>
             <div class="form-group paddin-cont">
                 <label class="col-lg-12 label-text" for="extracurricular_activities">1. <?php echo lang('register_extracurricular_activities_label'); ?></label>
                 <div class="col-lg-12">
                     <?php echo form_textarea($extracurricular_activities);?>
                 </div>
             </div>

             <div class="form-group paddin-cont">
                 <label class="col-lg-12 label-text" for="achievements">2. <?php echo lang('register_achievements_label'); ?></label>
                 <div class="col-lg-12">
                     <?php echo form_textarea($achievements);?>
                 </div>
             </div>
             <div class="clearfix"></div>
             <div class="spacer"></div>
             
             <!--  C	-->
             <h1 class="inner-hed">C. <?php echo lang('register_heading_achievement_label'); ?></h1>
             <div class="form-group paddin-cont">
                 <label class="col-lg-12 label-text" for="experiences">1. <?php echo lang('register_experiences_label'); ?></label>
                 <div class="col-lg-12">
                     <?php echo form_textarea($experiences);?>
                 </div>
             </div>
             <div class="form-group paddin-cont">
                 <label class="col-lg-12 label-text" for="career_pursuit">2. <?php echo lang('register_career_pursuit_label'); ?></label>
                 <div class="col-lg-12">
                     <?php echo form_textarea($career_pursuit);?>
                 </div>
             </div>
             <div class="form-group paddin-cont">
                 <label class="col-lg-12 label-text" for="factor">3. <?php echo lang('register_factor_label'); ?></label>
                 <div class="col-lg-12">
                     <?php echo form_textarea($factor);?>
                 </div>
             </div>
             <div class="form-group paddin-cont">
                 <label class="col-lg-12 label-text" for="objectives">4. <?php echo lang('register_objectives_label'); ?></label>
                 <div class="col-lg-12">
                     <?php echo form_textarea($objectives);?>
                 </div>
             </div>

            <div class="form-group text-center">
                  <?php echo form_submit('submit', $this->lang->line('new_user_submit_btn'),'class="btn btn-danger butt"');?>
            </div>
            <?php echo form_close(); ?>
         </div>
      </div>
   </div>
   <div class="spacer"></div>
</div>
</div>
<!-- Middle Content-->
<!-- Validations -->
<script src="<?php echo base_url();?>assets/designs/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/designs/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/designs/js/additional-methods.min.js"></script>
<script type="text/javascript">
    $(function () {
                $('.input-group.date').datepicker();
    });
   (function($,W,D)
   {
      var JQUERY4U = {};
   
      JQUERY4U.UTIL =
      {
          setupFormValidation: function()
          {
              //Additional Methods			
   		$.validator.addMethod("pwdmatch", function(repwd, element) {
   			var pwd=$('#password').val();
   			return (this.optional(element) || repwd==pwd);
   		},<?php echo lang('register_validation_wrong_confirm_password_label'); ?>);
   		
   		$.validator.addMethod("lettersonly",function(a,b){return this.optional(b)||/^[a-z ]+$/i.test(a)},"Please enter valid name.");
   		
   		$.validator.addMethod("alphanumericonly",function(a,b){return this.optional(b)||/^[a-z0-9 ]+$/i.test(a)},"Alphanumerics only please");
   		
   		$.validator.addMethod("phoneNumber", function(uid, element) {
   			return (this.optional(element) || uid.match(/^([0-9]*)$/));
   		},"Please enter a valid number.");
   		
   		$.validator.addMethod("alphanumerichyphen", function(uid, element) {
   			return (this.optional(element) || uid.match(/^([a-zA-Z0-9 -]*)$/));
   		},"Only Alphanumerics and hyphens are allowed.");
   
   		$.validator.addMethod('check_duplicate_email', function (value, element) {
   			var is_valid=false;
   				$.ajax({
   						url: "<?php echo base_url();?>info/check_duplicate_email",
   						type: "post",
   						dataType: "html",
   						data:{ emailid:$('#email').val(), <?php echo $this->security->get_csrf_token_name();?>: "<?php echo $this->security->get_csrf_hash();?>"},
   						async:false,
   						success: function(data) {
   						//alert(data);
   						is_valid = data == 'true';
   				}
   		   });
   		   return is_valid;
   		}, "The Email-id you've entered already exists.Please enter other Email-id.");
   		
   		
   		//form validation rules
              $("#user_creation_form").validate({
                  rules: {
       				fullname: {
                            required: true,
                            rangelength: [3, 30]
                          },  
       				gender: {
                            required: true,
                          },
       				birthdate: {
                            required: true,
                          },
       				birthplace: {
                            required: true,
                          },
       				card_id_no: {
                            required: true,
                          },
       				date_of_issue: {
                            required: true,
                          },
       				issued_police: {
                            required: true,
                          },
       				permanent_address: {
                            required: true,
                          },
       				temp_address: {
                            required: true,
                          },
       				major: {
                            required: true,
                          },
       				university: {
                            required: true,
                          },
       				score: {
                            required: true,
                          },
       				student_code: {
                            required: true,
                          },
       				date_graduation: {
                            required: true,
                          },
                          
                          
       				english_proficiency: {
                            required: true,
                          },
       				extracurricular_activities: {
                            required: true,
                          },
       				achievements: {
                            required: true,
                          },
       				experiences: {
                            required: true,
                          },
       				career_pursuit: {
                            required: true,
                          },
       				factor: {
                            required: true,
                          },
       				objectives: {
                            required: true,
                          },
       				registered_field: {
                            required: true,
                          },
                          
                          
       				phone: {
                        required: true,
       					phoneNumber: true,
       					rangelength: [10, 11]
                          },
       				email: {
                        required: true,
       					email: true,
       					check_duplicate_email: true
                          },
   	// 			image: {
    //                       required: true,
				// 		  accept: "jpg|jpeg|png"
    //                   },
   				password:{
   					required:true,
   					rangelength: [8, 30]
   				},
   				password_confirm:{
   					required:true,
   					pwdmatch: true
   				}
                  },
   			
   			messages: {
   				fullname: {
                          required: "Please enter your last name."
                      },      
   				gender: {
                          required: "Please select an option from the list."
                      },                      
   				phone: {
                          required: "Please enter your number."
                      },
   				card_id_no: {
                          required: "Please enter your ID number."
                      },
   				email: {
                          required: "Please enter your email-id."
                      },
   	// 			image: {
    //                       required: "Please upload your photo.",
				// 		  accept: "Only jpg / jpeg / png images are accepted."
    //                   },
   				password:{
   					required: "Please enter password."
   				},
   				password_confirm:{
   					required: "Please enter confirm password."
   				}
   			},
                  
                  submitHandler: function(form) {
                      form.submit();
                  }
              });
          }
      }
   
      //when the dom has loaded setup form validation rules
      $(D).ready(function($) {
          JQUERY4U.UTIL.setupFormValidation();
      });
   
   })(jQuery, window, document);
</script>
