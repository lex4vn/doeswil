<!--	DON'T DELETE ANY DIV	-->
<div class="col-md-2 padd">
   <ul class="dropdown-menu sid-sub-menu" role="menu" aria-labelledby="dropdownMenu" >
      <li class="dropdown-submenu "> <a  href="<?php echo base_url();?>">Home</a> </li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="dashboard") echo "active";?>"> <a  href="<?php echo base_url();?>user">Hướng dẫn</a> </li>
	   <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="exams") echo "active";?>"> <a  href="<?php echo base_url();?>user/quizzes">Quizzes</a> </li>
	   <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="quiz_history") echo "active";?>"> <a  href="<?php echo base_url();?>user/quiz_history">Quiz History</a> </li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="profile") echo "active";?>"> <a  href="<?php echo base_url();?>user/profile">My Profile</a> </li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="change_password") echo "active";?>"> <a  href="<?php echo base_url();?>auth/change_password">Change Password</a> </li>
   </ul>
   <div class="clearfix"></div>
</div>
<div class="col-md-10 content">
<!--	DON'T DELETE ANY DIV	-->

