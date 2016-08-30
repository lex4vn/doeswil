<!-- Footer-->
<div class="panel-footer padding">
   <div class="container-fluid footer">
      <div class="container">
         <div class="col-md-4">
         <a href="<?php echo base_url(); ?>">Trang chủ</a> | <a href="<?php echo base_url(); ?>aboutus">Giới thiệu</a> |
         <a href="<?php echo base_url(); ?>term">Thể lệ</a> |
         <a href="<?php echo base_url(); ?>info/contact">Liên hệ</a></div>
         <div class="col-md-4">
         <audio controls autoplay id="bgmusic">
            <source src="<?php echo base_url();?>assets/nang-canh-uoc-mo.mp3" type="audio/ogg">
            Your browser does not support the audio element.
         </audio>
         </div>
         <div class="col-md-4 rs-cha">
            <div class="social">
               <a href="https://www.facebook.com/WilmarCLVAwards" target="_blank"><i class="fa fa-facebook"></i></a>
               <a href="https://plus.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a>
            </div>
         </div>
      </div>
   </div>
   <div class="container-fluid copy">
      <div class="container padding">
         <div class="col-md-9">Copyright &copy;  <?php if(isset($site_data->copy_right)) echo $site_data->copy_right; ?>  All rights reserved.</div>
         <div class="col-md-3"> <a href="http://www.ksoft.vn" target="_blank"> Disigned By : KSoft</a></div>
      </div>
   </div>
</div>

<!-- Footer-->     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url();?>assets/designs/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/designs/js/bootstrap-datepicker.min.js"></script>

<script src="<?php echo base_url();?>assets/designs/js/html5placeholder.jquery.js"></script>
<script>
   $('.inner-content table').addClass('table table-bordered');
</script>
</body>

</html>

