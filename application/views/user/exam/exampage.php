<?php 
   $this->session->set_userdata('isExamStarted',0);
?>
<div class="col-md-12 padd">
   <div class="bradcome-menu">
      <ul>
         <li><a href="<?php echo base_url();?>user">Home</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="#"> Online Assessment Test <?php if(isset($quizName)) echo "(".$quizName.")";?></a></li>
      </ul>
   </div>
</div>
<div class="row margin">
   <div class="col-md-12 padd">
      <div class="col-md-8 ">
         <?php
            $attributes = array('class' => 'email', 'id' => 'myform', 'name'=>'myform');
             echo form_open_multipart("exam/validateexam",$attributes);?>
         <div class="col-md-1 padd">
            <div class="sectin-hed">
               Subjects
            </div>
         </div>
         <div class="col-md-11">
            <div class="hed-line"> </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="ga">
                  <div class="btn-group ga1">
                     <div class="subjectc">
                        <ul>
                           <?php if (count($quiz_info)) {
                              foreach($quiz_info as $qi) {
                              ?>  
                           <li class="ga-main-hed"  onclick="showSubjectQuestions('<?php echo $qi->subjectid;?>');">
						   <?php echo $qi->subjectname;?></li>
                           <?php } 
						   } 
						   ?>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div  class="col-md-12 padd">
            <!--Print questions here-->
            <div id="divs">
               <?php 
                  $question_slno=1; 
                  if(count($questions)) {
                  
                  $totRowCount = 0;
                  foreach($questions as $row) {
                  	
                  	$totRowCount = $totRowCount + count($row);
                  	$i=0;
                  	
                  	foreach($row as $q) {		
                  	$i++;
                  ?>
               <div id="<?php echo $q->subjectid."_".$i;?>"  class="display_question">
                  <div class="bradcome-menu qu-pa">
                     <div class="col-md-6"> <span class="question"> Question No. <?php echo $question_slno++; ?></span></div>
                  </div>
                  <h4 class="quction"  > 
                     <?php echo $q->question;?> 
                  </h4>
                   <?php if($q->questiontype == 'Write'){ ?>
                       <textarea class="editors" id="editorWrite" style="width: 100%;height:350px;" name="content" value="" placeholder="Enter Answer"></textarea>
                   <?php }else{ ?>
                  <table width="100%" border="0" class="answeers">
                     <input type="hidden" name="<?php echo $q->questionid;?>" value="0" id="" checked >
                     <?php 
                        if (isset($q->answer1)) {  
                         ?>
                     <tr>
                        <td>
                           <input type="radio" name="<?php echo $q->questionid;?>" value="1" id="">
                           <?php echo $q->answer1;?>
                        </td>
                     </tr>
                     <?php } ?>
                     <?php 
                        if (isset($q->answer2)) {  
                         ?>
                     <tr>
                        <td>
                           <input type="radio" name="<?php echo $q->questionid;?>" value="2" id="">
                           <?php echo $q->answer2;?>
                        </td>
                     </tr>
                     <?php } ?>
                     <?php 
                        if (isset($q->answer3)) {  
                         ?>
                     <tr>
                        <td>
                           <input type="radio" name="<?php echo $q->questionid;?>" value="3" id="">
                           <?php echo $q->answer3;?>
                        </td>
                     </tr>
                     <?php } ?>
                     <?php 
                        if (isset($q->answer4)) {  
                         ?>
                     <tr>
                        <td>
                           <input type="radio" name="<?php echo $q->questionid;?>" value="4" id="">
                           <?php echo $q->answer4;?>
                        </td>
                     </tr>
                     <?php } ?>
                     <?php 
                        if (isset($q->answer5)) {  
                         ?>
                     <tr>
                        <td>
                           <input type="radio" name="<?php echo $q->questionid;?>" value="5" id="">
                           <?php echo $q->answer5;?>
                        </td>
                     </tr>
                     <?php } ?>
                  </table>
                   <?php }?>
                   </div>
               <?php } 
				 } 
			   }
			   ?>
            </div>
            <!--End Print questions here-->
         </div>
         <div class="col-md-12 padd  down-buttons">
            <div class="col-md-8">
               <div id="prev" class="btn bg-primary down-bt">Previous</div>
               <div id="mnext" class="btn bg-primary down-bt">Mark for Review & Next</div>
               <div id="next" class="btn bg-primary down-bt">Next</div>
               <div id="clearAnswer" class="btn bg-primary down-bt">Clear Answer</div>
            </div>
            <div class="col-md-4">
               <input type="submit" id="finish" class="btn bg-primary down-bt finished" value="Finish" name="Finish" onclick="return confirm('Are you sure you want to submit the quiz?')"/>
               
            </div>
         </div>
         <?php echo form_close();?> 
      </div>
      <div class="col-md-4">
         <div class="timer">
            <div class="timer-img">
			<?php $img=$this->session->userdata('image'); if(isset($img) && $img!='') { ?>
            <img  src="<?php echo base_url();?>assets/uploads/images(200x200)/<?php echo $this->session->userdata('image');?>" width="69" height="68">
            	<?php } else {?>
            	<img  src="<?php echo base_url();?>assets/uploads/images(200x200)/dflt-user-icn.png" width="69" height="68">
            	<?php } ?>
			
			</div>
            <div class="timer-img-con">Time Left : <span id="mins"></span>:<span id="seconds"></span>
               <?php if(isset($negativeMark)) echo "&nbsp;&nbsp;&nbsp;&nbsp;Negative Mark: ".$negativeMark; ?>
               <br>
               <small><?php echo $this->session->userdata('username');?></small>
            </div>
         </div>
         <div class="col-md-12 padd g-awareness">
            <div class="awareness-view">
               <h4 class="awareness-view-hed">You are viewing  <?php if(isset($quizName)) echo $quizName; else echo "Online Assessment Mock Test";?> Section<br>
                  <small>Question Palette :</small>
               </h4>
               <div class="col-md-12">
                  <div class="number-plate">
                     <?php 
                        $cnt=1;
                        foreach ($questions as $row) {
                        $i=1;
                        	foreach($row as $q) {		?>
                     <li id="<?php echo "number-". $q->subjectid."_".$i;?>" onclick="showQuestion('<?php echo "#".$q->subjectid."_".$i;?>');" class="btn bg-primary numbers z-answered"  >
                        <?php echo $cnt++;?>
                     </li>
                     <?php 
                        $i++;
                           } 
						} 
					  ?>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="lagend">
                     <table width="90%" border="0">
                        <tr>
                           <td>
                              <h4 class="mar-lgn"><small>Legends :</small></h4>
                           </td>
                           <td></td>
                        </tr>
                        <tr>
                           <td>
                              <div class="btn bg-primary answered mar-lgn"><span class="aq-answered">0</span></div>
                              Answered
                           </td>
                           <td>
                              <div class="btn bg-primary not-answered mar-lgn"><span class="an-answered">0</span></div>
                              Not Answered
                           </td>
                        </tr>
                        <tr>
                           <td>   </td>
                           <td>  </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="btn bg-primary review mar-lgn"><span class="am-answered">0</span></div>
                              Marked
                           </td>
                           <td>
                              <div class="btn bg-primary not-visited mar-lgn"><span class="az-answered">0</span></div>
                              Not Visited
                           </td>
                        </tr>
                     </table>
                  </div>
               </div>
               <div class="col-md-12" style="padding:10px 0;">
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="col-md-12 padd">
   <div class="version">Version : 10.00.02
   </div>
</div>
<link href="<?php echo base_url();?>assets/designs/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url();?>assets/designs/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>
<!-- CK EDITOR -->
<script src="<?php echo base_url();?>assets/designs/ckeditor.js"></script>
<script>

    $(function() {
        $('.editors').each(function(){

            CKEDITOR.replace($(this).attr('id'), {
                /*
                 * Ensure that htmlwriter plugin, which is required for this sample, is loaded.
                 */
                //extraPlugins: 'htmlwriter',

                /*
                 * Style sheet for the contents
                 */
                contentsCss: 'body {color:#000; background-color#:FFF;}',

                /*
                 * Simple HTML5 doctype
                 */
                docType: '<!DOCTYPE HTML>',

                /*
                 * Allowed content rules which beside limiting allowed HTML
                 * will also take care of transforming styles to attributes
                 * (currently only for img - see transformation rules defined below).
                 *
                 * Read more: http://docs.ckeditor.com/#!/guide/dev_advanced_content_filter
                 */
                allowedContent:
                'h1 h2 h3 p pre[align]; ' +
                'blockquote code kbd samp var del ins cite q b i u strike ul ol li hr table tbody tr td th caption; ' +
                'img[!src,alt,align,width,height]; font[!face]; font[!family]; font[!color]; font[!size]; font{!background-color}; a[!href]; a[!name]',

                /*
                 * Core styles.
                 */
                coreStyles_bold: { element: 'b' },
                coreStyles_italic: { element: 'i' },
                coreStyles_underline: { element: 'u' },
                coreStyles_strike: { element: 'strike' },

                /*
                 * Font face.
                 */

                // Define the way font elements will be applied to the document.
                // The "font" element will be used.
                font_style: {
                    element: 'font',
                    attributes: { 'face': '#(family)' }
                },

                /*
                 * Font sizes.
                 */
                fontSize_sizes: 'xx-small/1;x-small/2;small/3;medium/4;large/5;x-large/6;xx-large/7',
                fontSize_style: {
                    element: 'font',
                    attributes: { 'size': '#(size)' }
                },

                /*
                 * Font colors.
                 */

                colorButton_foreStyle: {
                    element: 'font',
                    attributes: { 'color': '#(color)' }
                },

                colorButton_backStyle: {
                    element: 'font',
                    styles: { 'background-color': '#(color)' }
                },

                /*
                 * Styles combo.
                 */
                stylesSet: [
                    { name: 'Computer Code', element: 'code' },
                    { name: 'Keyboard Phrase', element: 'kbd' },
                    { name: 'Sample Text', element: 'samp' },
                    { name: 'Variable', element: 'var' },
                    { name: 'Deleted Text', element: 'del' },
                    { name: 'Inserted Text', element: 'ins' },
                    { name: 'Cited Work', element: 'cite' },
                    { name: 'Inline Quotation', element: 'q' }
                ],

                on: {
                    pluginsLoaded: configureTransformations,
                    loaded: configureHtmlWriter
                }
            });
        });



    });

    /*
     * Add missing content transformations.
     */
    function configureTransformations( evt ) {
        var editor = evt.editor;

        editor.dataProcessor.htmlFilter.addRules( {
            attributes: {
                style: function( value, element ) {
                    // Return #RGB for background and border colors
                    return CKEDITOR.tools.convertRgbToHex( value );
                }
            }
        } );

        // Default automatic content transformations do not yet take care of
        // align attributes on blocks, so we need to add our own transformation rules.
        function alignToAttribute( element ) {
            if ( element.styles[ 'text-align' ] ) {
                element.attributes.align = element.styles[ 'text-align' ];
                delete element.styles[ 'text-align' ];
            }
        }
        editor.filter.addTransformations( [
            [ { element: 'p',	right: alignToAttribute } ],
            [ { element: 'h1',	right: alignToAttribute } ],
            [ { element: 'h2',	right: alignToAttribute } ],
            [ { element: 'h3',	right: alignToAttribute } ],
            [ { element: 'pre',	right: alignToAttribute } ]
        ] );
    }

    /*
     * Adjust the behavior of htmlWriter to make it output HTML like FCKeditor.
     */
    function configureHtmlWriter( evt ) {
        var editor = evt.editor,
            dataProcessor = editor.dataProcessor;

        // Out self closing tags the HTML4 way, like <br>.
        dataProcessor.writer.selfClosingEnd = '>';

        // Make output formatting behave similar to FCKeditor.
        var dtd = CKEDITOR.dtd;
        for ( var e in CKEDITOR.tools.extend( {}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent ) ) {
            dataProcessor.writer.setRules( e, {
                indent: true,
                breakBeforeOpen: true,
                breakAfterOpen: false,
                breakBeforeClose: !dtd[ e ][ '#' ],
                breakAfterClose: true
            });
        }
    }

</script>
<script>
$(document).ready(function(){
 
	//DisableF5 key 
	document.onkeydown = function (e) {
        return (e.which || e.keyCode) != 116;
    };
	// Disable Right click
	$(document).bind('contextmenu',function(e){
        e.preventDefault();
      });
		
   updateSummary();
    $(".display_question").each(function(e) {
           if (e != 0)
               $(this).hide();
       });
   	
       $("#next").click(function(){
   		$("#prev").show();
   		var  numberPlateId ="#"+"number-"+$(".display_question:visible").attr('id');
   		if($(".display_question:visible table input:radio:checked").length == 0)
   		$(numberPlateId).removeClass('q-answered m-answered n-answered z-answered').addClass('n-answered');
   		else
   		$(numberPlateId).removeClass('q-answered m-answered n-answered z-answered').addClass('q-answered');
           if ($(".display_question:visible").next().length != 0)
               $(".display_question:visible").next().fadeIn(1000).prev().hide();
           else {
               
   			$(this).hide();
           }
   		updateSummary();
           return false;
       });
   	
   	$("#mnext").click(function(){
   		$("#prev").show();
   		
   		var  numberPlateId ="#"+"number-"+$(".display_question:visible").attr('id');
   		if($(".display_question:visible table input:radio:checked").length == 0)
   		$(numberPlateId).removeClass('q-answered m-answered n-answered z-answered').addClass('n-answered');
   		else
   		$(numberPlateId).removeClass('q-answered m-answered n-answered z-answered').addClass('m-answered');
   		
           if ($(".display_question:visible").next().length != 0)
               $(".display_question:visible").next().fadeIn(1000).prev().hide();
           else {
              $(this).hide();
           }
   		updateSummary();
           return false;
       });
   
       $("#prev").click(function(){
   		$("#next").show();
           if ($(".display_question:visible").prev().length != 0)
               $(".display_question:visible").prev().fadeIn(1000).next().hide();
           else {
              
   			$(this).hide();
           }
   		updateSummary();
           return false;
       });
   	
   	  $("#clearAnswer").click(function(){
   		//$("#next").show();
   		var  numberPlateId ="#"+"number-"+$(".display_question:visible").attr('id');
   		if($(".display_question:visible table input:radio:checked").length != 0)
   		{
   		$(".display_question:visible table input:radio:checked").removeAttr("checked");
   			$(numberPlateId).removeClass('q-answered m-answered n-answered z-answered').addClass('z-answered');
   		}
   		else
   		alert('No Answer Selected');
   		
           
   		updateSummary();
           return false;
       });
   
    var mins=60;
   		 var sec = 60;
   		
   			intilizetimer();
   
   });
   
   function showSubjectQuestions(id){
   $('.display_question').hide();
   $('#'+id+'_1').fadeIn(1000);
   $("#next").show();
   $("#prev").show();
   }
   
   function showQuestion(id){
   
   $('.display_question').hide();
   $(id).fadeIn(1000);
   $("#next").show();
    $("#prev").show();
   }
   
   function updateSummary()
   {
   	$(".am-answered").text($(".number-plate .m-answered").length);
   	$(".az-answered").text($(".number-plate .z-answered").length);
   	$(".an-answered").text($(".number-plate .n-answered").length);
   	$(".aq-answered").text($(".number-plate .q-answered").length);
   }
   
   
   	function intilizetimer()
   		 {
   		 	 //totaltime = $("#totaltime").text().split(":");
   			 mins = <?php echo $quizTime; ?>//totaltime[0];
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
   					alert('You are exceeded the time to finish the exam.');
   					$('#finish').removeAttr('onclick');
   					$('#finish').click();
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

