<div class="col-md-12 padd">
   <div class="bradcome-menu">
      <ul>
         <li><a href="<?php echo base_url();?>user">Home</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="#">  Quiz Results </a></li>
      </ul>
   </div>
</div>
<div class="row margin">
   <div class="col-md-12">
      <div class="col-md-12 padd">
         <div class="col-md-12 padd">
            <div class="panel panel-default">
               <div class="panel-heading p-hed">
                  <?php echo $quiz_info->name; ?> 
                  <div>
                     <?php foreach($quizRecords as $subj) { ?>
                     <a href="#<?php echo $subj->subjectid."_1";?>"><?php echo $subj->subjectname;?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <?php } ?>
                  </div>
               </div>
               <!-- /.panel-heading -->
               <div class="panel-body  pre-scrollable scroll-height">
                  <div id="morris-area-chart">
                        <?php $sno=1;foreach($questions as $row) {
                           $i=1;
                           foreach($row as $q) {
                              ?>
                              <div class="col-md-12 padd border" id="<?php echo $q->subjectid."_".$i++;?>">
                                 <h4 class="quction"><?php echo $sno++.". ".$q->question;?></h4>
                                 <?php if($q->questiontype == 'Write'){ ?>
                                    <textarea class="editors" id="editorWrite" name="content" value="" placeholder="Enter Answer"><?php echo $content_exam; ?></textarea>
                                 <?php }else{ ?>
                                    <table width="100%" border="0" class="answeers">
                                       <input type="radio" name="<?php echo $q->questionid;?>" value="0" id="" style="display:none;" <?php if(isset($user_options[$q->questionid])) if($user_options[$q->questionid]==0) echo "checked";?> >
                                       <?php
                                       if (isset($q->answer1)) {
                                          ?>
                                          <tr>
                                             <td>
                                                <input type="radio" name="<?php echo $q->questionid;?>" value="1" id="" <?php if(isset($user_options[$q->questionid])) if($user_options[$q->questionid]==1) echo "checked";?> >
                                                <?php echo $q->answer1;?>
                                             </td>
                                          </tr>
                                       <?php } ?>
                                       <?php
                                       if (isset($q->answer2)) {
                                          ?>
                                          <tr>
                                             <td>
                                                <input type="radio" name="<?php echo $q->questionid;?>" value="2" id="" <?php if(isset($user_options[$q->questionid])) if($user_options[$q->questionid]==2) echo "checked";?> >
                                                <?php echo $q->answer2;?>
                                             </td>
                                          </tr>
                                       <?php } ?>
                                       <?php
                                       if (isset($q->answer3)) {
                                          ?>
                                          <tr>
                                             <td>
                                                <input type="radio" name="<?php echo $q->questionid;?>" value="3" id="" <?php if(isset($user_options[$q->questionid])) if($user_options[$q->questionid]==3) echo "checked";?> >
                                                <?php echo $q->answer3;?>
                                             </td>
                                          </tr>
                                       <?php } ?>
                                       <?php
                                       if (isset($q->answer4)) {
                                          ?>
                                          <tr>
                                             <td>
                                                <input type="radio" name="<?php echo $q->questionid;?>" value="4" id="" <?php if(isset($user_options[$q->questionid])) if($user_options[$q->questionid]==4) echo "checked";?> >
                                                <?php echo $q->answer4;?>
                                             </td>
                                          </tr>
                                       <?php } ?>
                                       <?php
                                       if (isset($q->answer5)) {
                                          ?>
                                          <tr>
                                             <td>
                                                <input type="radio" name="<?php echo $q->questionid;?>" value="5" id="" <?php if(isset($user_options[$q->questionid])) if($user_options[$q->questionid]==5) echo "checked";?> >
                                                <?php echo $q->answer5;?>
                                             </td>
                                          </tr>
                                       <?php } ?>
                                       <tr>
                                          <td> </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <div class="btn bg-primary   <?php if(isset($user_options[$q->questionid])){ if($user_options[$q->questionid]==$answers[$q->questionid])  echo "correct-answ"; else echo "wrong-answ"; } else echo "wrong-answ";?>">Correct answer: <?php echo $answers[$q->questionid]; ?></div>
                                          </td>
                                       </tr>
                                    </table>
                                 <?php } ?>
                              </div>
                           <?php } } ?>
                  </div>
               </div>
               <!-- /.panel-body -->
            </div>
         </div>
      </div>
   </div>
</div>
<link href="<?php echo base_url();?>assets/designs/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url();?>assets/designs/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/designs/js/TableBarChart.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/designs/css/TableBarChart.css" />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Include all compiled plugins (below), or include individual files as needed --> 

<style>
   .progress-bar {
   border-radius: 2px;
   box-shadow: 0 2px 3px rgba(0, 0, 0, 0.25) inset;
   width: 250px;
   height: 20px;
   position: relative;
   display: block;
   }
   .progress-bar > span {
   background-color: blue;
   border-radius: 2px;
   display: block;
   text-indent: -9999px;
   }
</style>
