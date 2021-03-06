<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?php if(isset($title)) echo $title." - Wilmar CLV Awards"; else echo "Welcome To Wilmar CLV Awards Moderator Panel"; ?></title>
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js Wilmar CLV Awardsn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
      <div class="container-fluid top-header padd">
         <div class="col-md-2 padd">
            <a href="<?php echo base_url();?>admin">
               <div class="logo">
                  <img src="<?php echo base_url();?>assets/designs/images/logo.png" width="100%" height="50" > 
               </div>
            </a>
         </div>
         <div class="col-md-10">
            <div class="menu">
               <div class="profile">
                  <div class="profile-im"><img src="<?php echo base_url();?>assets/uploads/images(200x200)/<?php if($this->session->userdata('image')!='') echo $this->session->userdata('image');else echo 'dflt-user-icn.png';?>" width="35" height="35"></div>
                  <div class="profile-name"><?php echo $this->session->userdata('username');?></div>
               </div>
               <div class="small-menu">
                  <nav class="navbar navbar-default menu-nav" role="navigation">
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
                           <ul class="nav navbar-nav">
                              <li><a href="<?php echo base_url();?>moderator/profile"><i class="fa fa-user"></i> Account</a></li>
                              <!-- <li><a href="#"><i class="fa fa-envelope-square"></i> Message</a></li>
                                 <li><a href="#"> <i class="fa fa-cog"></i> Projects</a></li>	-->
                              <li class="dropdown">
                                 <a href="<?php echo base_url();?>auth/logout" class="dropdown-toggle" > <i class="fa fa-lock"></i> Logout </a>        
                              </li>
                           </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                     </div>
                     <!-- /.container-fluid -->
                  </nav>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid padd">
      <!--	DON'T DELETE ANY DIV	-->

