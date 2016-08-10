<link href="<?php echo base_url();?>assets/designs/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/designs/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/designs/css/TableBarChart.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/designs/css/TableBarChart.css" />
<script>
   function isChecked()
   {
   	if (document.getElementById("exam_chkbox").checked == true) {
   		window.location = '<?php echo base_url();?>exam/startexam/<?php echo $exams[0]->quizid;?>';
   	}
   	else {
   		alert("Please check the instructions.");
   		return false; 
   	}
   }
   
</script>
<div class="col-md-12 padd">
   <div class="bradcome-menu">
      <ul>
         <li><a href="<?php echo base_url();?>user">Home</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="#"> Instruction</a></li>
      </ul>
   </div>
</div>

<?php 
   $message = $this->session->flashdata('message');
   if(isset($message)) echo $message;?>

<div class="row margin">
   <div class="col-md-12">
      <div class="col-md-2 padd">
         <div class="sectin-hed">
            Exam Name 
         </div>
      </div>
      <div class="col-md-10">
         <div class="hed-line"> </div>
      </div>
      <div class="col-md-12 padd">
         <p><?php $record =$exams[0]; 
            echo $record->name;
            ?> </p>
         <center><em><strong>Please read the following instructions carefully</strong></em></center>
      </div>
      <div class="col-md-12 padd">
         <div class="sectin-hed">
            General Instructions: 
         </div>
      </div>
      <ol>
         <li>Total of <?php echo $record->deauration;?> minutes duration will be given to attempt all the questions. <?php if($record->negativemarkstatus == "Active") echo "And there a penalty of minus ".$record->negativemark." marks for each wrong answer."; ?></li>
         <li>The clock has been set at the server and the countdown timer at the top right corner of your screen will display the time remaining for you to complete the exam. When the clock runs out the exam ends by default - you are not required to end or submit your exam. </li>
         <li>
            The question palette at the right of screen shows one of the following statuses of each of the questions numbered: 
            <br><br>
            <table width="100%" border="0">
               <tr>
                  <td>
                     <div class="btn bg-primary not-visited"> <i class="fa fa-eye-slash"></i> </div>
                  </td>
                  <td>You have not visited the question yet.</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
               </tr>
               <tr>
                  <td></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
               </tr>
               <tr>
                  <td>
                     <div class="btn bg-primary not-answered"> <i class="fa fa-times-circle"></i> </div>
                  </td>
                  <td>You have not answered the question.</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
               </tr>
               <tr>
                  <td></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
               </tr>
               <tr>
                  <td>
                     <div class="btn bg-primary answered"> <i class="fa fa-check-square-o"></i> </div>
                  </td>
                  <td>You have answered the question. </td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
               </tr>
               <tr>
                  <td></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
               </tr>
               <tr>
                  <td>
                     <div class="btn bg-primary review"> <i class="fa fa-bolt"></i> </div>
                  </td>
                  <td>You have answered the question but have marked the question for review.</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
               </tr>
               <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
               </tr>
            </table>
         </li>
      </ol>
	  
	<div class="infor-mation"> 
	<?php if ($is_authorized){
			if ($record->quiztype == 'Paid') { 
					$cnt='';
					if($record->validitytype=='Days') {
						$date1 = new DateTime(date('Y-m-d'));
						$date2 = new DateTime($payment_info[0]->expirydate);
						$cnt = $date2->diff($date1)->format("%a");
					}
					else {
						$cnt=$payment_info[0]->remainingattempts;
					}
			?>
			<strong>	You have <?php echo $cnt ." ". $record->validitytype;  ?> remaining to use this quiz</strong>
	<?php	}
	?> 
	
	<?php } 
		  elseif ($record->quiztype == 'Paid') { 
		  $currency = $this->base_model->fetch_single_column_value('paypal','currency_code');
		 
		  ?>
				<strong>Please Buy this quiz at <?php echo $record->quizcost." ".$currency; ?>  for <?php echo $record->validityvalue ." ". $record->validitytype; ?> </strong>
		  
		  <?php } ?>
	 <div class="row">
         <div class="col-md-12">
            <br>
            <table width="100%" border="0">
			<?php if ($is_authorized) { ?>
               <tr>
                  <td width="4%">
                     <form name="form1" method="post" action="">
                        <input type="checkbox" name="checkbox" id="exam_chkbox" >
                        <label for="checkbox"></label>
                     </form>
                  </td>
                  <td colspan="2">The computer provided to me is in proper working condition. I have read and understood the instructions given above.</td>
               </tr>
			   <?php } ?>
               <tr>
                  <td>&nbsp;</td>
                  <td colspan="2">
				  <?php if ($is_authorized) { ?>
                     <a style="cursor:pointer;" onclick="isChecked(); return false;">
                        <div class="btn bg-primary wnm-user rig-ht"> <i class="fa fa-sign-in"></i> Start Exam</div>
                     </a>
				 <?php } 
						else { ?>
						<a style="cursor:pointer;" target="_blank" href="<?php echo base_url();?>user/payment/paypal/<?php echo $record->quizid."/".$record->quizcost;?>">
                        <div class="btn bg-primary wnm-user rig-ht"> <i class="fa fa-sign-in"></i> Go for Payment</div>
                     </a>
					 
										
						<?php }?>
					 
                  </td>
                  
               </tr>
            </table>
         </div>
      </div>
	
	
	</div>
     
   </div>
</div>