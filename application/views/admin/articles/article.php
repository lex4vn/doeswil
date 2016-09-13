

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
<li><a href="#">Tin tức và sự kiện </a></li>
 </ul>
 </div>

 </div>
 <div class="row">

	 <?php echo validation_errors();
	 echo $this->session->flashdata('message');
	 ?>
	 <div class="col-md-5">
		 <div class="ga">
			 <div class="btn-group ga1">
				 <a href="<?php echo base_url();?>admin/addeditArticle" class="btn btn-default dropdown-toggle ga-btn">
					Thêm tin tức
				 </a>
			 </div>
		 </div>
	 </div>

 </div>

 <div class="row">
 <div class="col-md-12">
<table id="example" class="cell-border" cellspacing="0" width="100%">
			  <thead>
					<tr>

						<th>ID</th>
						<th>Ảnh</th>
						<th>Danh mục</th>
						<th>Đường dẫn</th>
						<th>Tạo</th>
						<th>Cập nhật</th>
					</tr>
				</thead>
				<tbody>
				
				<?php if(count($articles)>0) {
					foreach($articles as $r)
					{
				?>
				
					<tr>
						<td><?php echo $r->id;?></td>
						<td><img style="height:45px;width:60px;" src="<?php echo base_url();?>assets/uploads/images/news/<?php
							if(isset($r->image)&&$r->image!='')echo $r->image; else echo "noimage.jpg";?>"></td>
						<td><?php echo $r->cat_id;?></td>
						<td><?php echo $r->slug;?></td>


						<td><?php echo $r->created;?></td>
						<td><?php echo $r->modified;?></td>
						<td>
							 <a href="<?php echo base_url();?>admin/viewArticle/<?php echo $r->id;?>"><div class="btn bg-primary wnm-user">View</div></a>
						     <a href="<?php echo base_url();?>admin/addeditArticle/<?php echo $r->id;?>"><div class="btn bg-primary wnm-user">Edit</div></a>
							 <a href="<?php echo base_url();?>admin/articles/<?php echo $r->id;?>"><div class="btn bg-primary wnm-user" onclick="return confirm('Are you sure you want to delete this record?')">Delete</div></a>
							 
						</td>
					</tr>
					
				<?php } } else "<tr><td colspan='4'>No Data Available.</td></tr>"; ?>
					
				</tbody>
			</table>
 </div>
  </div>
 