

   <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/designs/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
 
   <link href="<?php echo base_url();?>assets/designs/css/jquery.dataTables.css" rel="stylesheet">

 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/designs/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/designs/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" class="init">

$(document).ready(function() {
	$('#example').dataTable();
});

	</script>

<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>

<div class="col-md-12 padd">

<div class="bradcome-menu">
 <ul>
<li><a href="<?php echo base_url();?>admin">Home</a></li>
<li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
<li><a href="#">   General Users </a></li>
 </ul>
 </div>

 </div>
 <div class="row">
 
   <?php echo validation_errors();
		echo $this->session->flashdata('message');
	 ?>
 

 </div>
 
 <div class="row">
 <div class="col-md-12">
<table id="example" class="cell-border" cellspacing="0" width="100%">
			  <thead>
					<tr>
						<th>S.No.</th>
						<th>Photo</th>
						<th>User Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Date of Registration</th>
						<th>Status</th>
						<th>Action</th>
						
					</tr>
				</thead>

				<tfoot>
					<tr>
						<th>S.No.</th>
						<th>Photo</th>
						<th>User Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Date of Registration</th>
						<th>Status</th>
						<th>Action</th>
						
					</tr>
				</tfoot>

				<tbody>
				
				<?php if(count($allUsers)>0) { 
					$i=1;
					foreach($allUsers as $r)
					{
				
				?>
				
					<tr>
						<td><?php echo $i++;?></td>
						<td><img style="height:45px;width:60px;" src="<?php echo base_url();?>assets/uploads/images(200x200)/<?php 
						if(isset($r->image)&&$r->image!='')echo $r->image; else echo "dflt-user-icn.png";?>"></td>
						<td><?php echo $r->username;?></td>
						<td><?php echo $r->email;?></td>
						<td><?php echo $r->phone;?></td>
						<td><?php echo $r->date_of_registration;?></td>
						<td><?php if($r->active==1) echo "Active"; else echo "Inactive";?></td>
						<td>
							 <a href="<?php echo base_url();?>admin/viewUserProfile/<?php echo $r->id;?>"><div class="btn bg-primary wnm-user">View</div></a>
	 
							 <?php if($r->active==1) { ?>
							 
								<a href="<?php echo base_url();?>admin/blockUser/<?php echo $r->id;?>" onclick="return confirm('Are you sure you want to block this user?')"><div class="btn bg-primary wnm-user">Block</div></a>
							 
							 <?php } else {?>
							 
								<a href="<?php echo base_url();?>admin/activateUser/<?php echo $r->id;?>" onclick="return confirm('Are you sure you want to activate this user?')"><div class="btn bg-primary wnm-user">Activate</div></a>
							 
							 <?php } ?>
							 
							 <a href="<?php echo base_url();?>admin/deleteUser/<?php echo $r->id;?>/general_user"><div class="btn bg-primary wnm-user" onclick="return confirm('Are you sure you want to delete this record?')">Delete</div></a>
							 
						</td>
					</tr>
					
				<?php } } else "<tr><td colspan='4'>No Data Available.</td></tr>"; ?>
					
				</tbody>
			</table>
 </div>
  </div>
 