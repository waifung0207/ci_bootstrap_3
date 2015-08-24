<?php
	$this->set_css('assets/image_crud/css/fineuploader.css');
	$this->set_css('assets/image_crud/css/photogallery.css');
	$this->set_css('assets/image_crud/css/colorbox.css');

	//$this->set_js('assets/image_crud/js/jquery-1.8.2.min.js');
	$this->set_js('assets/image_crud/js/jquery-ui-1.9.0.custom.min.js');

	$this->set_js('assets/image_crud/js/fineuploader-3.2.min.js');
	
	$this->set_js('assets/image_crud/js/jquery.colorbox-min.js');
?>
<script>
$(function(){
	<?php if ( ! $unset_upload) {?>
		createUploader();
	<?php }?>
		loadColorbox();
});
function loadColorbox()
{
	$('.color-box').colorbox({
		rel: 'color-box'
	});
}
function loadPhotoGallery(){
	$.ajax({
		url: '<?php echo $ajax_list_url?>',
		cache: false,
		dataType: 'text',
		beforeSend: function()
		{
			$('.file-upload-messages-container:first').show();
			$('.file-upload-message').html("<?php echo $this->l('loading');?>");
		},
		complete: function()
		{
			$('.file-upload-messages-container').hide();
			$('.file-upload-message').html('');
		},
		success: function(data){
			$('#ajax-list').html(data);
			loadColorbox();
		}
	});
}

function createUploader() {
	var uploader = new qq.FineUploader({
		element: document.getElementById('fine-uploader'),
		request: {
			 endpoint: '<?php echo $upload_url?>'
		},
		validation: {
			 allowedExtensions: ['jpeg', 'jpg', 'png', 'gif']
		},		
		callbacks: {
			 onComplete: function(id, fileName, responseJSON) {
				 loadPhotoGallery();
			 }
		},
		debug: true,
		/*template: '<div class="qq-uploader">' +
			'<div class="qq-upload-drop-area"><span><?php echo $this->l("upload-drop-area");?></span></div>' +
			'<div class="qq-upload-button"><?php echo $this->l("upload_button");?></div>' +
			'<ul class="qq-upload-list"></ul>' +
			'</div>',
		fileTemplate: '<li>' +
			'<span class="qq-upload-file"></span>' +
			'<span class="qq-upload-spinner"></span>' +
			'<span class="qq-upload-size"></span>' +
			'<a class="qq-upload-cancel" href="#"><?php echo $this->l("upload-cancel");?></a>' +
			'<span class="qq-upload-failed-text"><?php echo $this->l("upload-failed");?></span>' +
			'</li>',
*/
	});
}

function saveTitle(data_id, data_title)
{
	  	$.ajax({
			url: '<?php echo $insert_title_url; ?>',
			type: 'post',
			data: {primary_key: data_id, value: data_title},
			beforeSend: function()
			{
				$('.file-upload-messages-container:first').show();
				$('.file-upload-message').html("<?php echo $this->l('saving_title');?>");
			},
			complete: function()
			{
				$('.file-upload-messages-container').hide();
				$('.file-upload-message').html('');
			}
			});
}

window.onload = createUploader;

</script>
<?php if(!$unset_upload){ ?><!-- <div id="file-uploader-demo1" class="floatL upload-button-container"></div>
<div class="file-upload-messages-container hidden">
	<div class="message-loading"></div>
	<div class="file-upload-message"></div>
	<div class="clear"></div>
</div>-->
<div id="fine-uploader"></div>
<?php }?>
<div class="clear"></div>
<div id='ajax-list'>
	<?php if(!empty($photos)){?>
	<script type='text/javascript'>
		$(function(){
			$('.delete-anchor').click(function(){
				if(confirm('<?php echo $this->l("alert_delete");?>'))
				{
					$.ajax({
						url:$(this).attr('href'),
						beforeSend: function()
						{
							$('.file-upload-messages-container:first').show();
							$('.file-upload-message').html("<?php echo $this->l('deleting');?>");
						},
						success: function(){
							loadPhotoGallery();
						}
					});
				}
				return false;
			});
			$(".color-box img").mousedown(function(){
				return false;
			});
    		$(".photos-crud").sortable({
        		handle: '.move-box',
        		opacity: 0.6,
        		cursor: 'move',
        		revert: true,
        		update: function() {
    				var order = $(this).sortable("serialize");
	    				$.post("<?php echo $ordering_url?>", order, function(theResponse){});
    			}
    		});
    		$('.ic-title-field').keyup(function(e) {
    			if(e.keyCode == 13) {
					var data_id = $(this).attr('data-id');
					var data_title = $(this).val();

					saveTitle(data_id, data_title);
    			}
    		});

    		$('.ic-title-field').bind({
    			  click: function() {
    				$(this).css('resize','both');
    			    $(this).css('overflow','auto');
    			    $(this).animate({height:80},600);
    			  },
    			  blur: function() {
      			    $(this).css('resize','none');
      			  	$(this).css('overflow','hidden');
      			  	$(this).animate({height:20},600);

					var data_id = $(this).attr('data-id');
					var data_title = $(this).val();

					saveTitle(data_id, data_title);
    			  }
    		});
		});
	</script>
	<ul class='photos-crud'>
	<?php foreach($photos as $photo_num => $photo){?>
			<li id="photos_<?php echo $photo->$primary_key; ?>">
				<div class='photo-box'>
					<a href='<?php echo $photo->image_url?>' <?php if (isset($photo->title)) {echo 'title="'.str_replace('"',"&quot;",$photo->title).'" ';}?>target='_blank' class="color-box" rel="color-box" tabindex="-1"><img src='<?php echo $photo->thumbnail_url?>' width='90' height='60' class='basic-image' /></a>
					<?php if($title_field !== null){ ?>
					<textarea class="ic-title-field" data-id="<?php echo $photo->$primary_key; ?>" autocomplete="off" ><?php echo $photo->$title_field; ?></textarea>
					<div class="clear"></div><?php }?>
					<?php if($has_priority_field){?><div class="move-box"></div><?php }?>
					<?php if(!$unset_delete){?><div class='delete-box'>
						<a href='<?php echo $photo->delete_url?>' class='delete-anchor' tabindex="-1"><?php echo $this->l('list_delete');?></a>
					</div><?php }?>
					<div class="clear"></div>
				</div>
			</li>
	<?php }?>
		</ul>
		<div class='clear'></div>
	<?php }?>
</div>