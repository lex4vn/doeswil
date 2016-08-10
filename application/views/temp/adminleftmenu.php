<!--	DON'T DELETE ANY DIV	-->
<div class="col-md-2 padd">
   <ul class="dropdown-menu sid-sub-menu" role="menu" aria-labelledby="dropdownMenu" >
      <li class="dropdown-submenu "> <a href="<?php echo base_url();?>">Home</a> </li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="dashboard") echo "active";?>"> <a href="<?php echo base_url();?>admin">Dashboard</a> </li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="categories") echo "active";?>"> 
	  <a href="<?php echo base_url();?>admin/categories">Categories</a> </li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="subcategories") echo "active";?>"> 
	  <a href="<?php echo base_url();?>admin/subcategories">Sub Categories</a> </li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="subjects") echo "active";?>"> 
	  <a  href="<?php echo base_url();?>admin/subjects">Subjects</a> </li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="questions") echo "active";?>"> 
	  <a href="<?php echo base_url();?>admin/questionsindex">Questions</a></li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="quiz") echo "active";?>"> 
	  <a href="<?php echo base_url();?>admin/quiz">Quiz</a></li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="notifications") echo "active";?>"> 
	  <a href="<?php echo base_url();?>admin/notifications">Notifications</a></li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="testimonials") echo "active";?>"> 
	  <a href="<?php echo base_url();?>admin/testimonials">Testimonials</a></li>
	  
	  <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="payment_report") echo "active";?>"> 
	  <a href="<?php echo base_url();?>admin/payreport">Payment Report</a></li>
	  
	  <li class="dropdown <?php if(isset($active_menu) && $active_menu=="users") echo "active";?>">  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Users </a> 
	  <ul class="dropdown-menu bg-col" role="menu">  
		<li class="dropdown-submenu"> 
		  <a href="<?php echo base_url();?>admin/viewAllUsers">General Users</a></li>
		<!--  <li class="dropdown-submenu"> 
		  <a href="<?php echo base_url();?>admin/admins">Admins</a></li>	-->
		  <li class="dropdown-submenu"> 
		  <a href="<?php echo base_url();?>admin/moderators">Moderators</a></li>
		  
	  </ul>
	  
	  </li>
	  
	  
      <li class="dropdown <?php if(isset($active_menu) && $active_menu=="tings") echo "active";?>">  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Settings </a> 
	  <ul class="dropdown-menu bg-col" role="menu">  
		<li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="settings") echo "active";?>"> 
		  <a href="<?php echo base_url();?>admin/settings">General Settings</a></li>
		  <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="email-settings") echo "active";?>"> 
		  <a href="<?php echo base_url();?>admin/emailSettings">Email Settings</a></li>
		  <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="paypal") echo "active";?>"> 
		  <a href="<?php echo base_url();?>admin/paypal_settings">Paypal Settings</a></li>
		  <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="change_password") echo "active";?>"> 
		  <a  href="<?php echo base_url();?>auth/change_password">Change Password</a> </li>
		  <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="aboutus_content") echo "active";?>"> 
		  <a href="<?php echo base_url();?>admin/aboutusContent">Aboutus Content</a></li>
		  <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="groups_settings") echo "active";?>"> 
		  <a href="<?php echo base_url();?>admin/group_settings">Groups Settings</a></li>
		  
	  </ul>
	  
	  </li>
	 
   </ul>
   <div class="clearfix"></div>
</div>
<div class="col-md-10 content">
<!--	DON'T DELETE ANY DIV	-->
