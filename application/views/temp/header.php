<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="keywords" content="<?php if(isset($site_data->site_keywords)) echo $site_data->site_keywords; else echo ""; ?>">
      <meta name="description" content="<?php if(isset($site_data->site_description)) echo $site_data->site_description; else echo ""; ?>">
	  <title><?php if(isset($title)) echo $title; else echo $site_data->site_title; ?></title>
      <!-- Bootstrap -->
      <link href="<?php echo base_url();?>assets/designs/css/bootstrap.css" rel="stylesheet">
      <link href="<?php echo base_url();?>assets/designs/css/bootstrap-datepicker.min.css" rel="stylesheet">
	  
      <link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
      <link href="<?php echo base_url();?>assets/designs/css/front-style.css" rel="stylesheet" type="text/css">
      <link href="<?php echo base_url();?>assets/designs/css/jquery.dataTables.css" rel="stylesheet">
      <?php if(isset($site_data->google_analytics)) echo $site_data->google_analytics; ?>
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
	  <script type="text/javascript" charset="utf-8">
  (function(G,o,O,g,L,e){G[g]=G[g]||function(){(G[g]['q']=G[g]['q']||[]).push(
   arguments)},G[g]['t']=1*new Date;L=o.createElement(O),e=o.getElementsByTagName(
   O)[0];L.async=1;L.src='//www.google.com/adsense/search/async-ads.js';
  e.parentNode.insertBefore(L,e)})(window,document,'script','_googCsa');
</script>

   </head>
   <body>
      <!---Hedder--->
      <div class="container-fluid fluid-hedder navbar-fixed-top padding">
            <div class="container">
         <div class="col-xs-6 col-md-2 col-lg-2 text-right nopadding"><a href="<?php echo base_url();?>">
            <img class ="logo" src="<?php echo base_url();?>assets/designs/images/<?php echo $site_data->site_logo; ?>" align="center"></a>
         </div>
         <div class="total-hed col-xs-6 col-md-10 col-lg-10">
            <!--<div class="rs-cha menu-wi">-->
               <nav class="navbar navbar-default menu" role="navigation">
                  <div class="container-fluid">
                     <!-- Brand and toggle get grouped for better mobile display -->
                     <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Brand</a>
                     </div>
                     <!-- Collect the nav links, forms, and other content for toggling -->
                     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav menu-list">
                           <li class="dropdown">
                              <a href="<?php echo base_url();?>user" class="dropdown-toggle menu-drop" data-toggle="dropdown"><?php echo lang('menu_about_us'); ?><b class="caret"></b></a>
                              <ul class="dropdown-menu menu-drop">
                                 <li class="<?php if(isset($active_menu) && $active_menu=="aboutus") echo "active";?>"><a href="<?php echo base_url(); ?>aboutus"><?php echo lang('menu_about_information'); ?></a></li>
                                 <li class="<?php if(isset($active_menu) && $active_menu=="aboutprogram") echo "active";?>"><a href="<?php echo base_url(); ?>aboutprogram"><?php echo lang('menu_about_program'); ?></a></li>
                              </ul>
                           </li>

                           <li class="<?php if(isset($active_menu) && $active_menu=="term") echo "active";?>"><a href="<?php echo base_url(); ?>term" title="Thể lệ cuộc thi"><?php echo lang('menu_term'); ?></a></li>
                           <li class="<?php if(isset($active_menu) && $active_menu=="articles") echo "active";?>"><a href="<?php echo base_url(); ?>articles"><?php echo lang('menu_news'); ?></a></li>
                           <li class="<?php if(isset($active_menu) && $active_menu=="result") echo "active";?>"><a href="<?php echo base_url(); ?>result"  title="Kết quả các vòng thi"><?php echo lang('menu_result'); ?></a></li>
                           <li class="<?php if(isset($active_menu) && $active_menu=="guess") echo "active";?>"><a href="<?php echo base_url(); ?>guess" title="Dự đoán người thắng cuộc"><?php echo lang('menu_guess'); ?></a></li>

                           <li class="<?php if(isset($active_menu) && $active_menu=="pictures") echo "active";?>"><a href="<?php echo base_url(); ?>images"><?php echo lang('menu_images'); ?></a></li>
                           <li class="<?php if(isset($active_menu) && $active_menu=="video") echo "active";?>"><a href="<?php echo base_url(); ?>video" title="Video clip"><?php echo lang('menu_video'); ?></a></li>
                           <?php if ($this->ion_auth->logged_in() && ($this->ion_auth->is_admin() || $this->ion_auth->is_moderator())) { ?>
                              <li class="<?php if(isset($active_menu) && $active_menu=="exam") echo "active";?>"><a href="<?php echo base_url(); ?>exam"><?php echo lang('menu_exam'); ?></a></li>

                           <?php }else{ ?>
                              <li class="<?php if(isset($active_menu) && $active_menu=="register") echo "active";?>"><a href="<?php echo base_url(); ?>auth/register"><?php echo lang('menu_register'); ?></a></li>
                           <?php } ?>
                           <li class="<?php if(isset($active_menu) && $active_menu=="contactus") echo "active";?>"><a href="<?php echo base_url(); ?>info/contact"><?php echo lang('menu_contact_us'); ?></a></li>

                           <li class="dropdown">
                              <a href="<?php echo base_url();?>user" class="dropdown-toggle menu-drop" data-toggle="dropdown"><?php echo lang('language'); ?><b class="caret"></b></a>
                              <ul class="dropdown-menu menu-drop">
                                 <li><a id="vietnamese" href="<?php echo base_url();?>langswitch/switchLanguage/vietnamese?url=<?php echo base_url(uri_string()); ?>">Tiếng Việt</a></li>
                                 <li><a id="english" href="<?php echo base_url();?>langswitch/switchLanguage/english?url=<?php echo base_url(uri_string()); ?>">English</a></li>
                              </ul>
                           </li>

                           <?php $this->load->library('ion_auth');		
                              if ($this->ion_auth->logged_in() && !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))
                              {
                              ?>
                           <li class="dropdown <?php if(isset($active_menu) && $active_menu=="dashboard") echo "active";?>">
                              <a href="<?php echo base_url();?>user" class="dropdown-toggle menu-drop" data-toggle="dropdown">Dashboard<b class="caret"></b></a>
                              <ul class="dropdown-menu menu-drop">
                                 <li><a href="<?php echo base_url();?>user">My Dashboard</a></li>
                                 <li><a href="<?php echo base_url();?>user/profile">Profile</a></li>
                                 <li><a href="<?php echo base_url();?>user/quiz_history">Quiz History</a></li>
                                 <li><a href="<?php echo base_url();?>auth/logout">Logout</a></li>
                              </ul>
                           </li>
                            <?php } else if ($this->ion_auth->logged_in() && ($this->ion_auth->is_admin() || $this->ion_auth->is_moderator())) { ?>
                           <li class="dropdown">
                              <a href="<?php echo base_url();?>user" class="dropdown-toggle menu-drop" data-toggle="dropdown">Dashboard<b class="caret"></b></a>
                              <ul class="dropdown-menu menu-drop">
                                 <li><a href="<?php echo base_url();?>admin">My Dashboard</a></li>
                                 <li><a href="<?php echo base_url();?>auth/logout">Logout</a></li>
                              </ul>
                           </li>
                           <?php } ?>
                        </ul>
                     </div>
                     <!-- /.navbar-collapse -->
                  </div>
                  <!-- /.container-fluid -->
               </nav>
            <!--</div>-->
			 
         </div>
      </div></div>
      <!---Hedder--->
	