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

<section>
	<h2>Pages</h2>
	<?php echo anchor('admin/page/edit', '<i class="icon-plus"></i> Add a page'); ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Title</th>
				<th>Parent</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($pages)): foreach($pages as $page): ?>	
		<tr>
			<td><?php echo anchor('admin/editPage/' . $page->id, $page->title); ?></td>
			<td><?php echo $page->parent_slug; ?></td>
			<td><?php echo btn_edit('admin/editPage/' . $page->id); ?></td>
			<td><?php echo btn_delete('admin/editPage/' . $page->id); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="3">We could not find any pages.</td>
		</tr>
<?php endif; ?>	
		</tbody>
	</table>
</section>