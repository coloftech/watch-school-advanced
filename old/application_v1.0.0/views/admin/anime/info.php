<?php if (isset($infos) && is_object($infos)): ?>
<div class="col-md-8">
	<?php //echo urlencode('https://www.facebook.com/prince.lelouch.549668/videos/160788471414619/'); ?>
	<div class="panel">
		<div class="panel-heading">
			<h3><span class="video-title" onblur="change_title(this)" contentEditable="true"><?php echo $infos->title ?></span> <a href="<?=site_url('watch/v/'.$infos->slug)?>" target="_blank"><i class="fa fa-sign-out"></i></a></h3> 
		</div>
		<div class="panel-body">
			<div class="col-md-4">
			<?php if(!empty($infos->thumbnail)): ?>
			<img src="<?php echo $infos->thumbnail ?>" id="imgpreview" style="width:100%;">

			<?php else: ?>

			<img src="<?php echo base_url('public/images/default-img.jpg'); ?>" id="imgpreview" style="width:100%;">
			<?php endif ?>
			<a class="btn btn-default" href="#"  data-toggle="modal" data-target="#modalupload"><i class="fa fa-camera"></i> </a> Change thumbnail
			</div>
			<div class="col-md-8">
				<div name='synopsis' id='txtsynopsis' onblur='change_synopsis(this)' contentEditable="true" class='form-control' style="height:350px;overflow:auto;"><?php echo $infos->sypnosis ?></div>    
				
			
			</div>
			
			
			<div class="col-md-12">
				<br />
			<div class="panel">
			<div class="panel-heading"><label>MIRROR</label></div>
				<div class="panel-body">
				<table class="table table-stripped">
					<?php 
					if (isset($mirrors)) {
						$i=2;

							$source = '<span style="cursor:pointer;" class="span_source" data-id="'.$infos->source_id.'">'.$this->auto_m->mirror($infos->source_id).'</span>';
							echo "<tr><td>1</td><td contentEditable='true'>$infos->link</td><td>$source</td></tr>";
						foreach ($mirrors as $key) {
							# code...
							$source = '<span style="cursor:pointer;" class="span_source" data-id="'.$key->source_id.'">'.$this->auto_m->mirror($key->source_id).'</span>';
							echo "<tr><td>$i</td><td contentEditable='true'>$key->link</td><td>$source</td></tr>";
							$i++;
						}
					}
					 ?>
				</table>
				</div>
			</div>
			</div>
		</div>
	</div>

</div>
<div class="col-md-4">
	<div class="panel">
		<div class="panel-heading"><h4>Episodes</h4></div>
		<div class="panel-body">
			<a href="" class="btn btn-default hidden" data-toggle="modal" data-target="#modaluploadvideo"><i class="fa fa-upload"></i> Upload new episode/video source</a><br/>
			
			<ul class="pagination" style="margin:0;padding:0;">
			    <li style="width:100%;"><a class="" onclick="javascript:$('#btnnewepisode').click();"  style="width:100%;"  href="#" data-toggle="modal" data-target="#modaluploadvideo">Add new episode <i class="fa fa-upload pull-right"></i></a></li>
			    <li style="width:100%;"><a class="" onclick="javascript:$('#btnnewepisodesource').click();"  style="width:100%;"  href="#" data-toggle="modal" data-target="#modaluploadvideo">Add new mirror <i class="fa fa-plus pull-right"></i></a></li>
			    <li style="width:100%;"><a class=""  style="width:100%;"  href="#" data-toggle="modal" data-target="#modalembed">Change video mirror <i class="fa fa-exclamation pull-right"></i></a></li>
			    <li style="width:100%;"><a class=""  style="width:100%;" href="<?=site_url('video/episodes/'.$video_id)?>">Arrange episode(s)</a></li>
		 		<li style="width:100%;"><a class=""  style="width:100%;" href="<?=site_url('video/cover_page/'.$parent_video_id)?>">Cover/Live chart <i class="fa fa-photo pull-right"></i></a></li>
			</ul>
			<br/>
      	
			<ul id="list_episodes" style="margin:0;padding:0;list-style:none;margin-top:20px;">
			<?php if (isset($total_episodes) && $total_episodes > 0): ?>
				<?php foreach ($list_episodes as $key): ?>
					<li><a href="<?=$key->video_id?>"><?=$key->title;?> (<?=$key->episode_number?>)</a></li>
				<?php endforeach ?>
			<?php else: ?>

				<li><a href="#">No video</a></li>
			<?php endif ?>
			</ul>
		</div>
	</div>
</div>
<?php endif ?>

<div id="modaluploadvideo" class="modal fade" role="dialog" style="min-width:270px;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload videos</h4>
      </div>
      <div class="modal-body">
      	<div class="buttons">
      		
        	<a href="javascript:void(0)" class="btn btn-default" id="btnnewepisode">Add New episode</a>
        	<a href="javascript:void(0)" class="btn btn-default" id="btnnewepisodesource" <?php if ($total_episodes <= 0) {
        		# code...
        	echo "disabled";} ?> >Add new mirror</a>

      	</div>
      	<div class="forms">
      	<br />
      		<select class="form-control hidden" id="optionepisodes">
      		<?php if ($total_episodes > 0): ?>
      			<?php foreach ($list_episodes as $key): ?>
      				<option value="<?=$key->episode_number?>" <?php if($video_id == $key->video_id) echo 'selected'; ?> >Episode no <?=$key->episode_number?></option>
      			<?php endforeach ?>
      		<?php else: ?>
      			<option value="0">No episode</option>
      		<?php endif ?>
      			<option></option>
      		</select><br/>

      		<form class="form" id="frmsaveepisode" method="post" action="">
      			<input	type="hidden" id="video_id" name="video_id" value="<?php echo isset($video_id) ? $video_id : 0; ?>"/>
      			<div class="form-group" style="margin-top:-15px;">
      				<label>Episode title</label>
      				<input class="form-control" type="text" id="txtepisodetitle" name="txtepisodetitle" value="<?php echo isset($infos->title) ? $infos->title : ''; ?>">
      			</div>

      			<div class="form-group"  style="margin-top:-15px;">
      				<label>Episode number</label>
      				<input class="form-control" type="number" id="txtepisodenumber" name="txtepisodenumber" value="<?=$infos->episode_number?>">
      			</div>
				<div class="form-group if-episode">
					<label>Sypnosis/Description</label>
					
					<textarea class="form-control" id="syspnosis" name="syspnosis" placeholder="Enter syspnosis here..." rows="3"></textarea>
				</div>

				<div class="form-group"  style="margin-top:-15px;">
					<label>Source</label>
					<select class="form-control" id="videosource" name="videosource">
						<option value="0">-SELECT HERE-</option>
						<option value="3">FACEBOOK</option>
						<option value="8">VIMEO</option>
						<option value="9">ANISUBBED (HTML5 VIDEO)</option>
						<option value="10">YOURUPLOAD (IFRAME)</option>
						<option value="1">MP4UPLOAD</option>
						<option value="2">YOUTUBE</option>
						<option value="4">DAILYMOTION</option>
						<option value="5">OPENLOAD</option>
						<option value="6">GOOGLE DRIVE</option>
						<option value="7">OTHERS</option>
					</select>
				</div>
				<div class="form-group hidden" id="video-url"  style="margin-top:-10px;">
				<ul class="nav nav-tabs" id="ul_new">
				  <li class="li_link active"><a data-toggle="tab" href="#tab_link" class="tab_link">Video url</a></li>
				  <li class="li_thumbnail"><a data-toggle="tab" href="#tab_thumbnail" class="tab_thumbnail">Thumbnail</a></li>
				  <li class="li_embed"><a data-toggle="tab" href="#tab_embed" class="tab_embed">Embed</a></li>

				</ul>

					<div class="tab-content">

			  		<div id="tab_link" class="tab-pane fade in active">
			   		 <h3>Video url</h3>
			    	
					<input type="text" id="txtlink" name="txtlink" placeholder="Enter link here..." class="form-control">
					
					<span style="font-size:12px;">Paste the video url above this line.</span>
					</div>

			  		<div id="tab_thumbnail" class="tab-pane fade">
			   		 <h3>Thumbnail</h3>
			    	
						<div class="form-group">
							<input type="text" class="form-control episode-thumbnail" id="episode-thumbail" placeholder="Thumbnail url (optional)" value="<?=!empty($infos->thumbnail) ? $infos->thumbnail : '';?>">
						</div>

					</div>

			  		<div id="tab_embed" class="tab-pane fade">
			   		 <h3>Embeded</h3>
			    	
					<textarea class="form-control" rows="8" id="txtembed" name="txtembed"></textarea>
					<br />
					<span style="font-size:12px;">Please add this line inside iframe attribute-><i> class="watch" </i></span>
					<br />
					<span>ex: <?php echo htmlentities('<iframe class="watch" src="https://youtube.com/embed/XMLFepyz1lE"></iframe>'); ?></span>
					</div>
					</div>
				</div>

				<div class="form-group">
					<label>Keywords <span style="font-size:12px;font-weight:normal;">(Press <i>Tab key</i>)</span></label><br />
					<input type="text" id="txttags" name="txttags" placeholder="Enter title here..." class="form-control" data-role="tagsinput">
					<br />

				</div>
      		</form>

      		<form class="form  hidden" action="<?=site_url('video/save_source')?>" method="post" id="frmsource">
      		<input	type="hidden" id="video_id_source" name="video_id" value="<?php echo isset($video_id) ? $video_id : 0; ?>"/>
      			<div class="form-group">
      				<div class="form-group"  style="margin-top:-15px;">
					<label>Source</label>
					<select class="form-control" id="videosource_source" name="videosource">
						<option value="0">-SELECT HERE-</option>
						<option value="3">FACEBOOK</option>
						<option value="8">VIMEO</option>
						<option value="9">ANISUBBED (HTML5 VIDEO)</option>
						<option value="10">YOURUPLOAD (IFRAME)</option>
						<option value="1">MP4UPLOAD</option>
						<option value="2">YOUTUBE</option>
						<option value="4">DAILYMOTION</option>
						<option value="5">OPENLOAD</option>
						<option value="6">GOOGLE DRIVE</option>
						<option value="7">OTHERS</option>
					</select>
				</div>
				<div class="form-group hidden" id="video-url_source"  style="margin-top:-10px;">
				<ul class="nav nav-tabs" id="ul_new">
				  <li class="li_link active"><a data-toggle="tab" href="#tab_link_source" class="tab_link">Video url</a></li>
				  <li class="li_embed"><a data-toggle="tab" href="#tab_embed_source" class="tab_embed">Embed</a></li>

				</ul>

					<div class="tab-content">

			  		<div id="tab_link_source" class="tab-pane fade in active">
			   		 <h3>Video url</h3>
			    	
					<input type="text" id="txtlink_source" name="txtlink" placeholder="Enter link here..." class="form-control">
					
					<span style="font-size:12px;">Paste the video url above this line.</span>
					</div>

			  		<div id="tab_embed_source" class="tab-pane fade">
			   		 <h3>Embeded</h3>
			    	
					<textarea class="form-control" rows="8" id="txtembed_source" name="txtembed"></textarea>
					<br />
					<span style="font-size:12px;">Please add this line inside iframe attribute-><i> class="watch" </i></span>
					<br />
					<span>ex: <?php echo htmlentities('<iframe class="watch" src="https://youtube.com/embed/XMLFepyz1lE"></iframe>'); ?></span>
					</div>
					</div>
				</div>
      			</div>
      		</form>
      	</div>
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-default hidden" id="btnsource">Save source</button>
        <button type="button" class="btn btn-default" id="btnsave">Save episode</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="modalembed" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change video server</h4>
      </div>
      <div class="modal-body">
        <p>
			<div class="edit-embed" style="mar">
				<div class="form-group"  style="margin-top:15px;">
					<label>Source</label>
					<form class="form" id="frmembed">
						<select class="form-control" id="video_link" name="video_link">
						<option value="0">-SELECT HERE-</option>
						<option value="3" <?php if($infos->source_id == 3) echo 'selected'; ?>>FACEBOOK</option>
						<option value="8" <?php if($infos->source_id == 8) echo 'selected'; ?>>VIMEO</option>
						<option value="9" <?php if($infos->source_id == 9) echo 'selected'; ?>>ANISUBBED (HTML5 VIDEO)</option>
						<option value="10" <?php if($infos->source_id == 10) echo 'selected'; ?>>YOURUPLOAD (IFRAME)</option>
						<option value="1" <?php if($infos->source_id == 1) echo 'selected'; ?> >MP4UPLOAD</option>
						<option value="2" <?php if($infos->source_id == 2) echo 'selected'; ?>>YOUTUBE</option>
						<option value="4" <?php if($infos->source_id == 4) echo 'selected'; ?>>DAILYMOTION</option>
						<option value="5" <?php if($infos->source_id == 5) echo 'selected'; ?>>OPENLOAD</option>
						<option value="6" <?php if($infos->source_id == 6) echo 'selected'; ?>>GOOGLE DRIVE</option>
						<option value="7" <?php if($infos->source_id == 7) echo 'selected'; ?>>OTHERS</option>
					</select>
				</div>
				<input type="text" value="<?php  echo $infos->link; ?>" class="form-control" name='txtlink' id='editembed'/>
					</form>
					
				<br/>
					<button class="btn btn-info btn-update-embed">Save changes</button>
				</div>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="modalupload" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload thumbnail</h4>
      </div>
      <div class="modal-body">
        <p>
        <form class="form" id="frmupload"  method="post" action="./upload" enctype="multipart/form-data">
        	
        	<label>Select image</label>
        	<input class="btn alert-info" type="file" name="uploadthumb" id="uploadthumb"  accept="image/*" />
        	<br />
        	<input class="form-control" type="text" name="thumbnail" id="thumbnail" placeholder="Enter image link here (optional)" />
        	<br />
        	<input	type="submit" id="btnupload" name="btnupload" value="Upload" class="btn btn-info" />

			<div class="progress">
				<div class="progress-bar" role="progressbar"></div>
			</div>

			<div class="with-error"></div>
        </form>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
$('#txtepisodetitle').on('blur',function(e){

	var title = $(this).val();
	if(title.length <= 0){
		return false;
	}

	var old = $('#syspnosis').val();
	if(old.length > 0 ){
		return false;
	}
	$('#syspnosis').val(title);
	return false;




})

    function change_synopsis(e){
        var synopsis = $(e).html();//val();

        //console.log(synopsis);return false;
        //console.log(synopsis);
        		$.ajax({
			url: '<?=site_url("video/change_synopsis")?>',
			data: 'synopsis='+synopsis+'&video_id='+$('#video_id').val(),
			type: 'post',
			dataType:'html',
			success: function (res) {
				// body...
				
				console.log(res);
			}
		})
    }
    function change_title(e){
        var title = $(e).html();
        //console.log(title);
        //return false;
        	$.ajax({
			url: '<?=site_url("video/change_title")?>',
			data: 'title='+title+'&video_id='+$('#video_id').val(),
			type: 'post',
			dataType:'html',
			success: function (res) {
				// body...
				
				console.log(res);
			}
		})
    }
	$('#video_link').on('blur change',function(){
		$('#editembed').removeClass('hidden');
		
		return false;
	})

	$('.btn-update-embed').on('click',function(){
		var data = $('#frmembed').serialize();
			//data = $('#imgpreview').attr('src');
		//console.log(data);return false;
		//var embed = $('#editembed').val();
		$.ajax({
			url: '<?=site_url("video/change_link")?>',
			data: data+'&video_id='+$('#video_id').val(),
			type: 'post',
			dataType:'json',
			success: function (res) {
				// body...
				$('.btn-embed').click();
				if(res.stats== true){
					alert('Embeded updated');
					$('#modalembed').modal('hide');
					//$('.btn-embed').click();
				}else{
					alert('Request not proccess.');
				}
			}
		})
	})
	
	$('#thumbnail').on('blur',function(){
		var thumbnail = $(this).val();
		if(thumbnail.length <= 0){
			return false;
		}

		changeThumb(thumbnail);
		$('#modalupload').modal('hide');
						var img = $('#imgpreview');
						img.attr('src',thumbnail);


	});
	$('#uploadthumb').change(function(){
		$('.progress-bar').text('0%');
		$('.progress-bar').width('0%');
	});
	$('#btnupload').on('click', function() {

		console.clear();

		$('.with-error').removeClass('alert alert-danger').html('');
		$('.progress-bar').text('0%');
		$('.progress-bar').width('0%');
		var uploadInput = $('#uploadthumb'); 

		if (uploadInput[0].files[0] != undefined) {
			var formData = new FormData();
			formData.append('upload', uploadInput[0].files[0]);
			formData.append('type','images');

			console.log('Upload on proccess.');
			$.ajax({
				url: '<?=site_url()?>/video/upload',
				type: 'POST',
				data: formData,
				//processType: false, WRONG syntax
				processData: false,
				contentType: false,
		      	dataType:'json',
		      	    beforeSend: function() {
				        // setting a timeout
				        $('.with-error').addClass('loading...');
				       
				    },
				success: function(data) {
					//$('#uploadthumb').val('');
					console.log(data);
					if(data.stats == true){
						$('.preview-image').removeClass('hidden');

						$('#thumbnail').val(data.msg);
						var img = $('#imgpreview');
						img.attr('src',data.msg);

						setTimeout(function () {
							$('#modalupload').modal('hide');
						},1000);
						changeThumb(data.msg);
					}else{
						$('.with-error').addClass('alert alert-danger').html(data.msg)

					}
				},
				xhr: function() {
					var xhr = new XMLHttpRequest();
					xhr.upload.addEventListener("progress", function(e) {
						if (e.lengthComputable) {
							//var uploadPercent = e.loaded / e.total; typo uploadpercent (all lowercase)
							var uploadpercent = e.loaded / e.total; 
							uploadpercent = (uploadpercent * 100); //optional Math.round(uploadpercent * 100)
							$('.progress-bar').text(uploadpercent + '%');
							$('.progress-bar').width(uploadpercent + '%');
							if (uploadpercent == 100) {
								$('.progress-bar').text('Completed');
							}
						}
					}, false);
					
					return xhr;
				}
			})
		}
    });
function changeThumb(imgurl){
	var video_id = $('#video_id').val();
	$.ajax({
		data: 'thumbnail='+imgurl+'&video_id='+video_id,
		type:'post',
		dataType:'json',
		url: '<?php echo site_url("video/change_thumb")?>',
		success: function(resp){
			console.log(resp);
		}
	})
}
</script>
<script type="text/javascript">
	var options = false;
	$('#btnnewepisodesource').on('click',function(){
		if(options == false){
			options == true
		$('#optionepisodes').removeClass('hidden')
		$('#frmsaveepisode').addClass('hidden')
		$('#frmsource').removeClass('hidden')
		$('#btnsource').removeClass('hidden');
		$('#btnsave').addClass('hidden');




		}else{
			options == false
		$('#optionepisodes').removeClass('hidden').addClass('hidden')

		$('#frmsaveepisode').removeClass('hidden')
		$('#frmsource').addClass('hidden')

		$('#btnsource').removeClass('hidden').addClass('hidden');
		$('#btnsave').removeClass('hidden');
		}
	})
	$('#btnnewepisode').on('click',function(){
		
		options == false
		$('#optionepisodes').removeClass('hidden').addClass('hidden')
		$('#frmsaveepisode').removeClass('hidden')
		$('#frmsource').addClass('hidden')
		$('#btnsource').removeClass('hidden').addClass('hidden');
		$('#btnsave').removeClass('hidden');
	
	})

	$('#btnsource').on('click',function(){
		$('#frmsource').submit();
	})
</script>



<script type="text/javascript">
	$('#videosource').on('blur',function(e){

		$('#txtlink').val('');
		$('#txtembed').val('');

		if($(this).val() > 0){
			$('#video-url').removeClass('hidden');
		}else{
			$('#video-url').removeClass('hidden');
			$('#video-url').addClass('hidden');
		}
		return false;
	})

		$('#videosource_source').on('blur',function(e){

		$('#txtlink_source').val('');
		$('#txtembed_source').val('');

		if($(this).val() > 0){
			$('#video-url_source').removeClass('hidden');
		}else{
			$('#video-url_source').removeClass('hidden');
			$('#video-url_source').addClass('hidden');
		}
		return false;
	})

	$('.li_link').on('click',function(){
		$('#txtembed').val('');
	})

	$('.li_embed').on('click',function(){
		$('#txtlink').val('');
	})

	$('#frmupload').on('submit',function(){

		return false;
	})


	$('#txtepisodenumber').on('blur',function(){
		var n = $(this).val();
		//$(this).focus();
		$.ajax({
			data: 'episodenumber='+n+'&video_id='+$('#video_id').val(),
			dataType: 'json',
			type: 'post',
			url: './searchepisode',
			success: function(resp){
				if(resp.stats == true){
					$(this).notify('Episode number unavailable, please use another.', { position:"bottom right", className:"error" })
				}else{

				}
			}
		});
	});

	$('#btnsave').on('click',function(){
		$('#frmsaveepisode').submit();
	})
	$('#frmsaveepisode').on('submit',function(){
		var url = '<?=site_url("video/saveepisode");?>';
		console.clear();
		var data = $(this).serialize();
		var thumbnail = $("#imgpreview").attr('src');

		$.ajax({
			data: data+'&thumbnail='+thumbnail,
			url: url,
			type: 'post',
			dataType: 'json',
			success: function(resp){

				console.log(resp)
				if(resp.stats==true){
					$('#frmsaveepisode').notify(resp.msg, { position:"top right", className:"success" });
					setTimeout(function(){

					location.reload();
				},1500);
				}else{

					$('#frmsaveepisode').notify(resp.msg, { position:"top right", className:"error" });
				}
			}
		})
		

		return false;
	})
</script>