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
   <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FWilmarCLVAwards%2F&tabs=timeline&width=340&height=480&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=603142946436792" width="340" height="480" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></div>

