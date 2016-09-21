<link href="<?php echo base_url();?>assets/designs/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/designs/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/designs/css/TableBarChart.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/designs/css/TableBarChart.css" />
<script>
//    window.onload = function(){
//        var button = document.getElementById('startwriting');
//        if(button != null){
//            button.click();
//        }
//
//    }
   function isChecked()
   {
   	if (document.getElementById("exam_chkbox").checked == true) {
   		window.location = '<?php echo base_url();?>exam/startexam/<?php echo $exams[0]->quizid;?>';
   	}
   	else {
   		alert("Vui lòng chọn đã đọc hiểu.");
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
      </div>

       <?php if ($is_authorized){ ?>
       <?php if($record->quiztype == 'Free') {?>
               <div class="col-md-12 padd">
                   <div class="sectin-hed">
                       <p><b>HƯỚNG DẪN L&Agrave;M B&Agrave;I</b></p>
                   </div>
               </div>
               <p>Xin ch&agrave;o c&aacute;c bạn đến với V&ograve;ng kiểm tra tổng hợp của Wilmar CLV Awards 2016!</p>

               <p>C&aacute;c bạn h&atilde;y đọc thật kỹ hướng dẫn sau trước khi bắt đầu l&agrave;m b&agrave;i nh&eacute;!</p>

               <ul>
                   <li>B&agrave;i kiểm tra gồm c&oacute; 4 phần: trắc nghiệm IQ, trắc nghiệm kiến thức tổng hợp, trắc nghiệm tiếng Anh v&agrave; thi viết b&agrave;i luận bằng tiếng Anh.</li>
                   <li>Đối với phần trắc nghiệm, c&aacute;c bạn sẽ c&oacute; 60 ph&uacute;t để ho&agrave;n th&agrave;nh 75 c&acirc;u hỏi (25 c&acirc;u IQ, 25 c&acirc;u kiến thức tổng hợp v&agrave; 25 c&acirc;u hỏi tiếng Anh).&nbsp;</li>
                   <li>Khi trả lời c&acirc;u hỏi, c&aacute;c bạn c&oacute; thể bấm NEXT để tiếp tục l&agrave;m b&agrave;i, hoặc BACK để quay lại c&aacute;c c&acirc;u hỏi trước đ&oacute;, hoặc CLEAR ANSWER để bỏ c&acirc;u trả lời đ&atilde; chọn, hoặc KEEP LATER để bỏ qua c&acirc;u hỏi v&agrave; quay lại trả lời sau.</li>
                   <li>Trong suốt thời gian l&agrave;m b&agrave;i thi, c&aacute;c bạn ĐƯỢC SỬ DỤNG M&Aacute;Y T&Iacute;NH để t&iacute;nh to&aacute;n v&agrave; t&igrave;m ra c&acirc;u trả lời đối với phần thi trắc nghiệm IQ, tuy nhi&ecirc;n KH&Ocirc;NG ĐƯỢC SỬ DỤNG TỪ ĐIỂN, TRA CỨU, HAY BẤT KỲ TRỢ GI&Uacute;P n&agrave;o kh&aacute;c đối với tất cả c&aacute;c phần thi.</li>
                   <li>Kết quả thi trắc nghiệm sẽ được hiển thị ngay sau khi bạn ho&agrave;n th&agrave;nh phần thi. Nếu trong 60 ph&uacute;t m&agrave; bạn vẫn chưa ho&agrave;n th&agrave;nh 75 c&acirc;u hỏi th&igrave; hệ thống sẽ tự động ngắt, v&agrave; phần trả lời của c&aacute;c bạn vẫn được hệ thống chấm v&agrave; b&aacute;o kết quả ngay sau đ&oacute;.</li>
                   <li>Sau khi ho&agrave;n th&agrave;nh phần thi trắc nghiệm, c&aacute;c bạn sẽ tiếp tục thi viết b&agrave;i luận bằng tiếng Anh tr&ecirc;n m&aacute;y t&iacute;nh. Thời gian l&agrave;m b&agrave;i l&agrave; 50 ph&uacute;t. Kết quả đ&aacute;nh gi&aacute; b&agrave;i viết sẽ được Ban tổ chức th&ocirc;ng b&aacute;o sau.</li>
               </ul>

               <p>Nếu c&aacute;c bạn đ&atilde; hiểu r&otilde; c&aacute;c hướng dẫn tr&ecirc;n th&igrave; h&atilde;y chọn START bắt đầu l&agrave;m b&agrave;i thi nh&eacute;!</p>

               <p>Ch&uacute;c c&aacute;c bạn l&agrave;m b&agrave;i tốt v&agrave; lọt v&agrave;o Top 100 của Wilmar CLV Awards 2016!</p>




               <div class="infor-mation">
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
                               <td colspan="2"><p>Nếu c&aacute;c bạn đ&atilde; hiểu r&otilde; c&aacute;c hướng dẫn tr&ecirc;n th&igrave; h&atilde;y chọn START bắt đầu l&agrave;m b&agrave;i thi nh&eacute;!</p></td>
                           </tr>
                       <?php } ?>
                       <tr>
                           <td>&nbsp;</td>
                           <td colspan="2">
                               <a style="cursor:pointer;" onclick="isChecked(); return false;">
                                   <div class="btn bg-primary wnm-user rig-ht"> <i class="fa fa-sign-in"></i> START</div>
                               </a>
                           </td>

                       </tr>
                   </table>
               </div>
           </div></div>
	<?php }   elseif($record->quiztype == 'Write') {?>
               <p>&nbsp;</p>
               <p>&nbsp;</p>
           <div class="infor-mation">
        <div class="row">
            <div class="col-md-12">
                <br>
                <table width="100%" border="0">
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="2">
                                <a id="startwriting" style="cursor:pointer;" target="_self" href="<?php echo base_url();?>exam/startexam/<?php echo $exams[0]->quizid;?>">
                                    <div class="btn bg-primary wnm-user rig-ht"> <i class="fa fa-sign-in"></i> Go for writing</div>
                                </a>
                        </td>

                    </tr>
                </table>
            </div>
        </div>
           </div>
    <?php } else{ ?>
        Go for payment
    <?php  } ?>

<?php  } ?>
   </div>
</div>