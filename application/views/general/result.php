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
      <div class="col-md-3 col-xs-12">
         <div class="bradcome-menu">
            <ul>
               <li><a href="<?php echo base_url(); ?>"><?php echo lang('home'); ?></a></li>
               <li><img src="<?php echo base_url(); ?>assets/designs/images/arrow1.png" width="7" height="6"></li>
               <li><a href="#"><?php echo lang('menu_result'); ?></a></li>
            </ul>
         </div>
      </div>
	 
   </div>
   <div class="container inner-content padding">
      <div class="col-md-8 col-xs-12">
         <?php if (isset($results) && count($results) > 0) {?>
         <h1 class="inner-hed">Comming soon</h1>
         <p>
             
				   <?php echo $term_content[0]->body;?>
			   
         </p>
         <?php } else echo "Coming Soon."; ?>
      </div>
      <?php echo $this->load->view('general/quick_links');?>
   </div>
   <div class="spacer"></div>
</div>
</div>
<!-- Middle Content-->

