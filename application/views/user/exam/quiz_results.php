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
      <div class="col-md-8 padd">
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




                     <?php if ($quiz_type == 'Write'){ ?>
                        <p>Cám ơn bạn đã hoàn thành bài thi. Kết quả của bài thi viết sẽ được Ban tổ chức thông báo đến bạn sau.</p>
                     <?php }else{?>
                     <p><i>Ch&uacute;c mừng bạn đ&atilde; ho&agrave;n th&agrave;nh xong phần thi trắc nghiệm. Kết quả của bạn đạt được như sau:</i></p>

                     <ul>
                        <li><i>IQ: <?php echo $mark1; ?> /25</i></li>
                        <li><i>Kiến thức tổng hợp: <?php echo $mark2; ?> /25</i></li>
                        <li><i>Tiếng Anh trắc nghiệm: <?php echo $mark3; ?> /25</i></li>
                     </ul>

                     <p><i>V&agrave; b&acirc;y giờ bạn h&atilde;y thư gi&atilde;n 10 ph&uacute;t v&agrave; tiếp tục ho&agrave;n th&agrave;nh phần thi viết b&agrave;i luận bằng tiếng Anh nh&eacute;. H&atilde;y lưu &yacute; bạn chỉ c&oacute; 50 ph&uacute;t để ho&agrave;n th&agrave;nh b&agrave;i luận v&agrave; kh&ocirc;ng được sử dụng bất kỳ sự trợ gi&uacute;p n&agrave;o như từ điển, truy cập internet&hellip; Ch&uacute;c bạn sẽ ho&agrave;n th&agrave;nh thật tốt phần thi n&agrave;y!</i></p>

                     <p><i>Nếu đ&atilde; sẵn s&agrave;ng, bạn h&atilde;y bấm START để bắt đầu phần thi viết nh&eacute;!</i></p>

                     <div class="text-center">Thi trong: <span id="mins"></span>:<span id="seconds"></span>

                        <br>
                        <button id="startwrite" disabled onclick="location.href='<?php echo base_url();?>user/instructions/<?php echo 5+ $quiz_id; ?>';">START</button>
                     </div>

                     <?php } ?>
                  </div>
               </div>
               <!-- /.panel-body -->
            </div>
         </div>
      </div>
      <?php if ($quiz_type != 'Write'){ ?>
      <div class="col-md-4">
         <div class="lates-users">
            <div class="recent-msg-hed quiz-bhed">Quiz Info <i class="fa fa-exclamation-circle"></i></div>
            <div class="recent-msg-total">
               <div class="lates-users-img-hed quiz-hed">
                  Total Questions:<br>
               </div>
               <div class="btn bg-primary wnm-user"><?php echo $totalQuestions; ?></div>
            </div>
            <div class="recent-msg-total">
               <div class="lates-users-img-hed quiz-hed">
                  Time (minutes) for all multiple-choice tests:<br>
               </div>
               <div class="btn bg-primary wnm-user"><?php echo $quiz_info->deauration; ?></div>
            </div>
            <?php if(isset($negativeMark)) { ?>
            <div class="recent-msg-total">
               <div class="lates-users-img-hed quiz-hed">
                  Negative Mark:<br>
               </div>
               <div class="btn bg-primary wnm-user"><?php echo $negativeMark; ?></div>
            </div>
            <?php } ?>   
         </div>
         <div class="lates-users top">
            <div class="recent-msg-hed quiz-bhed">General Info <i class="fa fa-clock-o"></i></div>
            <div class="recent-msg-total">
               <div class="lates-users-img-hed quiz-hed">
                  Your Score is 
                  :
               </div>
               <div class="btn bg-primary wnm-user"><?php echo $score; ?> / <?php echo $totalQuestions; ?></div>
            </div>
         </div>
         <div class="lates-users top">
            <div class="recent-msg-hed quiz-bhed">Results Summary <i class="fa fa-tasks"></i></div>
            <div class="recent-msg-total mar-resu-summ">
               <div class="lates-users-img-hed quiz-hed result-sum-hed">
                  Attempted Questions : <?php echo $attempted_percentage.'%';?> 
               </div>
               <div class="progress gress">
                  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $attempted_percentage.'%';?>">
                     <span class="sr-only"><?php echo $attempted_percentage.'%';?> Complete</span>
                  </div>
               </div>
            </div>
            <div class="recent-msg-total mar-resu-summ">
               <div class="lates-users-img-hed quiz-hed result-sum-hed">
                  Correct Answers : <?php echo $score_percentage.'%';?> 
               </div>
               <div class="progress gress">
                  <div class="progress-bar  progress-bar-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php if($score_percentage < 0) echo '0%'; else echo $score_percentage.'%';?>">
                     <span class="sr-only"><?php echo $score_percentage.'%';?> Complete</span>
                  </div>
               </div
                  >
            </div>
            <div class="recent-msg-total mar-resu-summ">
               <div class="lates-users-img-hed quiz-hed result-sum-hed">
                  Wrong Answers : <?php echo $wrong_percentage.'%';?> 
               </div>
               <div class="progress gress">
                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $wrong_percentage.'%';?>">
                     <span class="sr-only"><?php echo $wrong_percentage.'%';?> Complete (warning)</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php } ?>
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
<script>
   $(document).ready(function() {
      //DisableF5 key
      document.onkeydown = function (e) {
         return (e.which || e.keyCode) != 116;
      };
      // Disable Right click
      $(document).bind('contextmenu', function (e) {
         e.preventDefault();
      });
      var mins = 60;
      var sec = 60;

      intilizetimer();
   });

function intilizetimer()
{
//totaltime = $("#totaltime").text().split(":");
mins = '10';//totaltime[0];
sec = '0';//totaltime[1];
startInterval();
}

function tictac(){
sec--;
if(sec<=0)
{
mins--;
$("#mins").text(mins);
if(mins<1)
{
$("#timerdiv").css("color", "red");
}
if(mins<0)
{
stopInterval();
$("#mins").text('0');
alert('Mời bạn bắt đầu thi viết.');
$('#startwrite').disabled = false;
$('#startwrite').click();
//$('form').submit();

}


sec=60;
}
if(mins>=0)
$("#seconds").text(sec);
else
$("#seconds").text('00');
}
function startInterval()
{
timer= setInterval("tictac()", 1000);
}
function stopInterval()
{
clearInterval(timer);
}
</script>