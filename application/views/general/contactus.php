<!-- Slider-->
<div data-ride="carousel" class="carousel slide banner" id="myCarousel">
   <div class="container padding">
      <img src="<?php echo base_url(); ?>assets/designs/images/wilmar.jpg" width="100%">
   </div>
</div>
<!-- Slider-->
<!-- Middle Content-->
<div class="container-fluid content-bg">
   <div class="spacer"></div>
  <div class="container padding">
      <div class="col-md-2 col-xs-12">
         <div class="bradcome-menu">
            <ul>
               <li><a href="<?php echo base_url(); ?>"><?php echo lang('home'); ?></a></li>
               <li><img src="<?php echo base_url(); ?>assets/designs/images/arrow1.png" width="7" height="6"></li>
               <li><a href="#"><?php echo lang('menu_contact_us'); ?></a></li>
            </ul>
         </div>
      </div>
 
   </div>
   <div class="container inner-content padding">
      <div class="col-md-8 col-xs-12">
         <h1 class="inner-hed"><?php echo lang('menu_contact_us'); ?></h1>
         <div class="col-md-12 formgro">
            <?php echo $this->session->flashdata('message');?>
            <form novalidate id="contact_form" name="myForm1" method="POST" action="<?php echo base_url();?>info/contact_request_sent" role="form" class="form-horizontal">
			
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			
               <div class="form-group paddin-cont">
                  <label class="col-lg-3 control-label" for="ftname">Name <span style="color:red;">*</span></label>
                  <div class="col-lg-9 ">
                     <input type="text" placeholder="Name" class="form-control" id="name" name="name">
                  </div>
               </div>
               <div class="form-group paddin-cont">
                  <label class="col-lg-3 control-label" for="emailid">Email <span style="color:red;">*</span></label>
                  <div class="col-lg-9">
                     <input type="text" placeholder="Email" id="email" class="form-control" name="email">
                  </div>
               </div>
               <div class="form-group paddin-cont">
                  <label class="col-lg-3 control-label" for="mob">Phone <span style="color:red;">*</span></label>
                  <div class="col-lg-9">
                     <input type="text" placeholder="phone" id="phone" class="form-control" name="phone" maxlength="11">
                  </div>
               </div>
                <div class="form-group paddin-cont">
                    <label class="col-lg-3 control-label" for="university">University</span></label>
                    <div class="col-lg-9">
                        <input type="text" placeholder="university" id="university" class="form-control" name="university" maxlength="11">
                    </div>
                </div>
                <div class="form-group paddin-cont">
                    <label class="col-lg-3 control-label" for="major">Major</label>
                    <div class="col-lg-9">
                        <input type="text" placeholder="major" id="major" class="form-control" name="major" maxlength="11">
                    </div>
                </div>
<!--               <div class="form-group paddin-cont">-->
<!--                  <label class="col-lg-3 control-label" for="pcode">Address <span style="color:red;">*</span></label>-->
<!--                  <div class="col-lg-9">-->
<!--                     <textarea rows="3" id="address" class="form-control" name="address"  placeholder="Address" ></textarea>-->
<!--                  </div>-->
<!--               </div>-->
               <div class="form-group paddin-cont">
                  <label class="col-lg-3 control-label" for="sub">Subject <span style="color:red;">*</span></label>
                  <div class="col-lg-9">
                     <input type="text" placeholder="Subject" id="subject" class="form-control" name="subject">
                  </div>
               </div>
               <div class="form-group paddin-cont">
                  <label class="col-lg-3 control-label" for="mes">Message</label>
                  <div class="col-lg-9">
                     <textarea rows="3" class="form-control" name="msg" placeholder="Message"></textarea>
                  </div>
               </div>
               <div style="margin-left:60px;" class="form-group ">
                  <div class="col-lg-offset-2 col-lg-10">
                     <input type="submit" value="Submit" name="submit" class="btn btn-danger butt">
                  </div>
               </div>
            </form>
         </div>
		 

      </div>
      <?php echo $this->load->view('general/quick_links');?>

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
   (function($,W,D)
   {
      var JQUERY4U = {};
   
      JQUERY4U.UTIL =
      {
          setupFormValidation: function()
          {
              //Additional Methods			
   		//$.validator.addMethod("lettersonly",function(a,b){return this.optional(b)||/^[a-z ]+$/i.test(a)},"Please enter valid name.");
   					
   		$.validator.addMethod("phoneNumber", function(uid, element) {
   			return (this.optional(element) || uid.match(/^([0-9]*)$/));
   		},"Please enter a valid number.");			
   		
   		
   		//form validation rules
              $("#contact_form").validate({
                  rules: {
                      name: {
                          required: true,
   					rangelength: [3, 30]
                      },
                      email: {
                          required: true,
   					email: true
                      },
   				phone: {
                          required: true,
   					phoneNumber: true,
   					rangelength: [10, 11]
                      },
//   				address:{
//   					required:true
//   				},
   				subject:{
   					required:true
   				}				
                  },
   			
   			messages: {
   				name: {
                          required: "Please enter your name."
                      },
                      email: {
                          required: "Please enter your email-id."
                      },
   				phone: {
                          required: "Please enter your number."
                      },
//   				address:{
//   					required: "Please enter your address."
//   				},
   				subject:{
   					required: "Please enter the purpose of contacting."
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

