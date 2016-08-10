<div class="col-md-4">
   <h1 class="inner-hed">Quick Links</h1>
   <div class="notif">
      <ul>
         <li><a href="<?php echo base_url();?>"><?php echo lang('quick_link_home');?></a></li>
         <?php $this->load->library('ion_auth');		
            if ($this->ion_auth->logged_in() && !$this->ion_auth->is_admin())
            {
            ?>
         <li><a href="<?php echo base_url();?>user">My Dashboard</a></li>
         <li><a href="<?php echo base_url();?>user/profile">Profile</a></li>
         <li><a href="<?php echo base_url();?>user/quiz_history">Quiz History</a></li>
         <?php } else if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) { ?>
         <li><a href="<?php echo base_url();?>admin">My Dashboard</a></li>
         <li><a href="<?php echo base_url();?>admin/profile">Profile</a></li>
         <?php } else { ?>
         <li><a href="<?php echo base_url(); ?>auth/login">Đăng nhập</a>  </li>
         <li><a href="<?php echo base_url(); ?>auth/register">Đăng ký</a>  </li>
         <?php } ?>
         <li><a href="<?php echo base_url(); ?>info/termsConditions">Thể lệ</a> </li>
         <li><a href="<?php echo base_url(); ?>info/contact">Liên hệ</a> </li>
      </ul>
   </div>
   
</div>

