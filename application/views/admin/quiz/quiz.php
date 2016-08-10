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
         <li><a href="#">   Quiz </a></li>
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
            <a href="<?php echo base_url();?>admin/addeditQuiz" class="btn btn-default dropdown-toggle ga-btn">
            Add Quiz
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
               <th>S.No.</th>
               <th>Quiz Name</th>
               <th>Category</th>
               <th>Sub Category</th>
               <th>Difficulty Level</th>
               <th>Start Date</th>
               <th>End Date</th>
               <th>Duration</th>
               <th>Action</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>S.No.</th>
               <th>Quiz Name</th>
               <th>Category</th>
               <th>Sub Category</th>
               <th>Difficulty Level</th>
               <th>Start Date</th>
               <th>End Date</th>
               <th>Duration</th>
               <th>Action</th>
            </tr>
         </tfoot>
         <tbody>
            <?php if (count($records)>0) { 
					$i=1;
					foreach ($records as $r) {
               ?>
            <tr>
               <td><?php echo $i++;?></td>
               <td><?php echo $r->name;?></td>
               <td><?php echo $r->catname;?></td>
               <td><?php echo $r->subcatname;?></td>
               <td><?php echo $r->difficultylevel;?></td>
               <td><?php echo date('d-m-Y',strtotime($r->startdate));?></td>
               <td><?php echo date('d-m-Y',strtotime($r->enddate));?></td>
               <td><?php echo $r->deauration;?></td>
               <td>
                  <a href="<?php echo base_url();?>admin/addeditQuiz/<?php echo $r->quizid;?>" class="btn bg-primary wnm-user"> <i class="fa fa-edit"></i> Edit</a>
                  <a href="<?php echo base_url();?>admin/quiz/<?php echo $r->quizid;?>" onclick="return confirm('Are you sure you want to delete this record?')" class="btn bg-primary wnm-user"><i class="fa fa-times-circle"></i> Delete</a>
               </td>
            </tr>
            <?php } 
			} 
			else "<tr><td colspan='4'>No Data Available.</td></tr>"; 
			?>
         </tbody>
      </table>
   </div>
</div>

