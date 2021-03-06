<!-- include the Placeholders.js file at the bottom of your page -->
<!--<script type="text/javascript">-->
<!--   $('input[type=text], textarea').placeholder();-->
<!--</script>-->
<!-- Slider-->
<div data-ride="carousel" class="carousel slide banner" id="myCarousel">
   <!-- Indicators -->
   <ol class="carousel-indicators">
      <li class="" data-slide-to="0" data-target="#myCarousel"></li>
      <li data-slide-to="1" data-target="#myCarousel" class=""></li>
      <li data-slide-to="2" data-target="#myCarousel" class="active"></li>
   </ol>
   <div class="carousel-inner">
      <div class="item">
         <img alt="Second slide" data-src="/holder.js/900x500/auto/#666:#6a6a6a/text:Second slide" src="<?php echo base_url();?>assets/designs/images/banner2.png">
         <div class="container">
         </div>
      </div>
      <div class="item">
         <img alt="Second slide" data-src="/holder.js/900x500/auto/#666:#6a6a6a/text:Second slide" src="<?php echo base_url();?>assets/designs/images/banner.png">
         <div class="container">
         </div>
      </div>
      <div class="item active">
         <img alt="Second slide" data-src="/holder.js/900x500/auto/#666:#6a6a6a/text:Second slide" src="<?php echo base_url();?>assets/designs/images/banner1.png">
         <div class="container">
         </div>
      </div>
   </div>
    <div class="width-form" id="ytplayer">
       <iframe width="560" height="315" src="https://www.youtube.com/embed/sTc82-bMsvQ" frameborder="0" allowfullscreen></iframe>
    </div>
       <a data-slide="prev" href="#myCarousel" class="left carousel-control"><span class="glyphicon glyphicon-chevron-left"></span></a>
   <a data-slide="next" href="#myCarousel" class="right carousel-control"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>
<!-- Slider-->
<!-- Middle Content-->

<div class="container-fluid content-bg">
   <div class="spacer"></div>
   <div class="container">
      <div class="col-lg-4 padding test-moni">
         <h2 class="test-hed"><?php echo lang('partner'); ?></h2>
         <div class="carousel slide" id="testimonials-rotate">
            <ol class="carousel-indicators">
               <li class="active" data-slide-to="0" data-target="#testimonials-rotate"></li>
               <li data-slide-to="1" data-target="#testimonials-rotate"></li>
               <li data-slide-to="2" data-target="#testimonials-rotate"></li>
            </ol>
            <div class="carousel-inner">
               <div class="item active">
                   <img alt="" src="<?php echo base_url();?>assets/designs/images/partner1.png" class="img-responsive"  />
               </div>
                <div class="item">
                    <img alt="" src="<?php echo base_url();?>assets/designs/images/partner2.png" class="img-responsive"  />
                </div>
                <div class="item">
                    <img alt="" src="<?php echo base_url();?>assets/designs/images/partner3.png" class="img-responsive"  />
                </div>
            </div>
         </div>
         <div class="pull-right pull">
            <a class="left" href="#testimonials-rotate" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right" href="#testimonials-rotate" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            <div class="clearfix"></div>
         </div>
      </div>
      <div class="col-lg-4 test-moni padding">
         <h2 class="test-hed"><?php echo lang('result'); ?></h2>
         <marquee direction="up" scrollamount="2" scrolldelay="2" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 2, 0);" height="218">
            <div class="notif">
               <ul>
                  <?php if(count($notifications)>0) {
                     foreach($notifications as $n) {
                  ?>
                  <li>
                     <a href="<?php echo base_url();?>info/notifications/<?php echo $n->nid;?>/<?php echo $n->title;?>">
                     <?php echo $n->title;?>. <br/>
                     Post Date: <?php echo date('d-m-Y',strtotime($n->post_date));?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Last Date: <?php echo date('d-m-Y',strtotime($n->last_date));?>
                     </a>
                  </li>
                  <?php }
				  } 
				  else echo "coming soon.";
				  ?>
               </ul>
            </div>
         </marquee>
      </div>
      <?php $this->load->library('ion_auth');
      if( $this->ion_auth->logged_in() ){ ?>
         <div class="col-lg-4 padding test-moni">
            <h2 class="test-hed"><?php echo lang('exam'); ?></h2>
            <marquee direction="up" scrollamount="2" scrolldelay="2" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 2, 0);" height="218">
               <div class="notif">
                  <ul>
                     <?php if (count($latest_quizzes)<0) {
                        foreach($latest_quizzes as $lq) {
                           $style = '';
                           if ($this->ion_auth->is_admin()) {
                              $style = 'cursor:default;text-decoration:none;';
                              $href = "";
                           }
                           else {
                              $href = 'href="'.base_url().'user/instructions/'.$lq->quizid.'"';
                           }
                           ?>
                           <li>
                              <a <?php echo $href;?> style="<?php echo $style;?>">
                                 Quiz of <b><?php echo $lq->name;?></b> has been added on <?php echo date('d-m-Y',strtotime($lq->startdate));?>. And will be closed on <?php echo date('d-m-Y',strtotime($lq->enddate));?>.<br/>
                                 Quiz Duration (Minutes): <?php echo $lq->deauration;?>
                              </a>
                           </li>
                        <?php }
                     }
                     else echo "coming soon.";
                     ?>
                  </ul>
               </div>
            </marquee>
         </div>

          <?php }else{ ?>
      <div class="col-lg-4 padding test-moni"  style="height: 320px;">
         <h2 class="test-hed">SIGN IN</h2>
         <div class="carousel-caption width-form">
            <div id="infoMessage"><?php  echo $message;?></div>
            <?php echo form_open("auth/login",'class="form-signin"');?>
            <p class="type">
               <?php echo form_input($identity);?>
            </p>
            <p class="type">
               <?php echo form_input($password);?>
            </p>
            <p class="type">
               <?php echo form_submit('submit', $this->lang->line('login_submit_btn'),'class="btn btn-lg btn-primary butt"');?>
            </p>
            <?php echo form_close();?>
            <p class="forget"><a href="<?php echo base_url(); ?>auth/forgot_password"><?php echo lang('login_forgot_password'); ?></a></p>
            <p class="forget"> <a href="<?php echo base_url(); ?>auth/create_user"> <?php echo lang('signup_user_submit_btn'); ?></a></p>

         </div>
      <?php } ?>
      <div class="clearfix"></div>
   </div>
   <div class="spacer"></div>
</div>


</div>
<script src = "https://www.youtube.com/iframe_api"></script>
<script>
   var player;
   function onYouTubeIframeAPIReady() {
      player = new YT.Player('ytplayer', {
         height: '315',
         width: '420',
         videoId: 'sTc82-bMsvQ',
         events: {
            'onStateChange': function(event) {
               if (event.data == YT.PlayerState.PLAYING) {
                  pauseAudio();
               }
               if (event.data == YT.PlayerState.PAUSED) {
                  playAudio();
               }
            }
         }
      });
   }

   function pauseAudio() {
      document.getElementById("bgmusic").pause()
   }
   function playAudio() {
      document.getElementById("bgmusic").play()
   }
</script>
 
