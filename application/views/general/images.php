<!-- Middle Content-->
<div class="container-fluid content-bg">
   <div class="spacer"></div>
   <div class="container padding">
      <div class="col-md-2 col-xs-12">
         <div class="bradcome-menu">
            <ul>
               <li><a href="<?php echo base_url(); ?>">Home</a></li>
               <li><img src="<?php echo base_url(); ?>assets/designs/images/arrow1.png" width="7" height="6"></li>
               <li><a href="#"> Images </a></li>
            </ul>
         </div>
      </div>
	 
   </div>
   <div class="container inner-content padding">
       <?php if (count($images)) {
           foreach ($images as $image) {
               $image_src = str_replace('www.dropbox.com','dl.dropboxusercontent.com',$image->image);
               $image_src = str_replace('?dl=0','?size_mode=01&size=0392x392.1',$image_src);
               ?>
               <a href="<?php echo $image_src; ?>">
                   <img src="<?php echo $image->thumbnail; ?>">
               </a>

               <?php
           }
       }
       ?>
   </div>
   <div class="spacer"></div>
</div>
</div>
<!-- Middle Content-->

<script src="<?php echo base_url();?>assets/designs/js/jquery.min.js"></script>

 
 
