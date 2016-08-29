
<!-- Bootstrap -->

<link href="<?php echo base_url();?>assets/designs/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/editor.css" type="text/css" rel="stylesheet"/>

<script src="<?php echo base_url();?>assets/designs/js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready( function() {

		$("#txtEditor").Editor();

	});
</script>

<script src="<?php echo base_url();?>assets/designs/js/editor.js"></script>
<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>




<div class="col-md-12 padd">

	<div class="bradcome-menu">
		<ul>
			<li><a href="<?php echo base_url();?>admin">Home</a></li>
			<li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
			<li><a href="#">Update About Program Content</a></li>
		</ul>
	</div>

</div>

<div class="row">
	<div class="col-md-8">
		<div style="color:#FF0000; font-size:12px; padding-left:10px;"><?php echo validation_errors();
			echo $this->session->flashdata('message');
			?>
		</div>
		<form method="POST" action="<?php echo base_url();?>admin/aboutprogram" id="term_form" enctype="multipart/form-data">

			<div id="term" class="container">
				<ul class="nav nav-tabs">
					<li class="active">
						<a  href="#vietnamese" data-toggle="tab">Tiếng Việt</a>
					</li>
					<li><a href="#english" data-toggle="tab">English</a>
					</li>
				</ul>

				<div class="tab-content ">
					<div class="tab-pane active" id="vietnamese">
						<?php if(count($datavi)>0)
							$datavi=$datavi[0];
						?>
						<div class="form-group">
							<label for="title">Title</label>

							<?php
							$title = '';
							if( ( $this->input->post( 'titlevi' ) ) )
							{
								$title = $this->input->post( 'titlevi' );
							}
							elseif(count($datavi))
							{
								$title = $datavi->title;
							}

							?>

							<input class="form-control" id="titlevi" name=
							"titlevi" placeholder="Enter title" type="text" value=
								   "<?php echo $title;?>">
						</div>
						<div class="form-group">
							<label for="bodyvi">Content for Term Page</label>

							<?php
							$val = '';
							if( ( $this->input->post( 'bodyvi' ) ) )
							{
								$val = $this->input->post( 'bodyvi' );
							}
							elseif(count($datavi))
							{
								$val = $datavi->body;
							}

							?>

							<textarea class="editors" id="editorvi" name="bodyvi" placeholder="Type Content for about program Page" ><?php echo $val;?></textarea>
						</div>

						<input type="hidden" name="lang" value="vietnamese">
						<input type="hidden" name="idvi" value="<?php if(isset($datavi->id)) echo $datavi->id;?>">


					</div>
					<div class="tab-pane" id="english">
						<?php if(count($dataen)>0)
							$dataen=$dataen[0];
						?>
						<div class="form-group">
							<label for="titleen">Title</label>

							<?php
							$title = '';
							if( ( $this->input->post( 'titleen' ) ) )
							{
								$title = $this->input->post( 'titleen' );
							}
							elseif(count($dataen))
							{
								$title = $dataen->title;
							}

							?>

							<input class="form-control" id="titleen" name=
							"titleen" placeholder="Enter title" type="text" value=
								   "<?php echo $title;?>">
						</div>
						<div class="form-group">
							<label for="bodyen">Content for Term Page</label>

							<?php
							$val = '';
							if( ( $this->input->post( 'bodyen' ) ) )
							{
								$val = $this->input->post( 'bodyen' );
							}
							elseif(count($dataen))
							{
								$val = $dataen->body;
							}

							?>

							<textarea class="editors" id="editoren" name="bodyen" placeholder="Type Content for about program Page" ><?php echo $val;?></textarea>
						</div>
						<input type="hidden" name="lang" value="english">
						<input type="hidden" name="iden" value="<?php if(isset($dataen->id)) echo $dataen->id;?>">
					</div>
				</div>
			</div>




			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />


			<button type="submit" class="btn btn-primary wnm-user">Update</button>

		</form>


	</div>
</div>



<!-- CK EDITOR -->
<script src="<?php echo base_url();?>assets/designs/ckeditor.js"></script>
<script>

	$(function() {
		$('.editors').each(function(){

			CKEDITOR.replace($(this).attr('id'), {
				/*
				 * Ensure that htmlwriter plugin, which is required for this sample, is loaded.
				 */
				extraPlugins: 'htmlwriter',

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

<!-- Validations -->
<script src="<?php echo base_url();?>assets/designs/js/jquery.validate.min.js"></script>
<script type="text/javascript">

	(function($,W,D) {
		var JQUERY4U = {};

		JQUERY4U.UTIL =
		{
			setupFormValidation: function()
			{
				//form validation rules
				$("#term_content_form").validate({

					ignore: "", //To validate hidden fields
					rules: {
						content: {
							required: true
						}

					},

					messages: {
						content: {
							required: "Please enter content for about page."
						}
					},

					submitHandler: function(form) {
						form.submit();
					}
				});
			}
		}

		//when the dom has loaded setup form validation rules
		$(D).ready(function($) {
			JQUERY4U.UTIL.setupFormValidation();
		});

	})(jQuery, window, document);

</script>
  
  