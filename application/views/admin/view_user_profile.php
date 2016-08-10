
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/designs/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">

<?php if(count($details)) {

		foreach($details as $d) {

?>
	
	
 <div class="col-md-12 padd">

<div class="bradcome-menu">
 <ul>
<li><a href="<?php echo base_url();?>admin">Home</a></li>
<li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
<li><a href="<?php echo base_url();?>admin/viewAllUsers">Users</a></li>
<li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
<li><a href="#">  Profile of <?php echo $d->username;?> </a></li>
 </ul>
 </div>

 </div>
   <div class="row margin">
   
   <?php echo $this->session->flashdata('message');
   

	$imgSRC = base_url()."assets/uploads/images(200x200)/"."dflt-user-icn.png";;
	if($d->image!='')
		$imgSRC = base_url()."assets/uploads/images(200x200)/".$d->image;
	
	
   
   
   ?>
   
 <div class="col-md-12">
 <div class="col-md-2"><img src="<?php echo $imgSRC;?>"  class="img-responsive thumbnail"></div>
 <div class="col-md-9">
  <div class="col-md-4 padd">
 <div class="sectin-hed">
 Personal Details of <?php echo $d->username;?>
 </div>
 </div>
 <div class="col-md-8">
 <div class="hed-line"> </div>
 </div>
 
 <div class="col-md-12 padd">

 <div class="details">
 
 <strong>Full Name </strong>: <?php echo $d->username;?>
 </div>
   <div class="details">
 
 <strong>Email</strong> : <?php echo $d->email;?>
 </div>
  <div class="details">
 <strong> Phone </strong>: <?php echo $d->phone;?>
 </div>

  <?php if($d->active==1) { ?>
 
  <a href="<?php echo base_url();?>admin/blockUser/<?php echo $d->id;?>" onclick="return confirm('Are you sure you want to block this user?')"><div class="btn bg-primary  exam-histry-btn">Block User</div></a>
  
   <?php } else { ?>
   
	<a href="<?php echo base_url();?>admin/activateUser/<?php echo $d->id;?>" onclick="return confirm('Are you sure you want to activate this user?')"><div class="btn bg-primary  exam-histry-btn">Activate User</div></a>
   
   <?php } ?>
   
  
 </div>
 
 
 </div>
   
    </div>
  </div>
  
  <?php } }?>
   
   
   
         <script src="<?php echo base_url();?>assets/designs/js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>
   