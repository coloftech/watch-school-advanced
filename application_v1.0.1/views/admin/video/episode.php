<div class="panel admin-panel">
	<div class="panel-heading">
		<h3>VIDEO LIBRARY - EDIT</h3>

			<ul class="pagination pull-right" style="margin:0;padding:0;margin-top:-40px;margin-right:15px;">
			    <li class="item-3"><a class="" href="#" data-toggle="modal" data-target="#modaluploadmirror">Add new mirror <i class="fa fa-plus pull-right"></i></a></li>
		 		<li class="item-3"><a class="" href="<?=site_url('video/edit/'.$detail_id)?>">Cover/Live chart <i class="fa fa-photo pull-right"></i></a></li>
			</ul>
	</div>
	<div class="panel-body">
		<div class="anime">
			<div class="with-error-main"></div>
			<div class="anime-heading">
			</div>
			<div class="anime-body">
			<?php if (is_object($details)): ?>
					
					
        <form class="form" id="frmupdatevideo"  method="post" action="../../updateepisode/<?php echo $detail_id.'/'.$details->video_id;?>" enctype="multipart/form-data">
        	<div class="col-md-4">

        	<div class="form-group">
        	<div class="preview-img">
        		<img src="<?php echo !empty($details->thumbnail) ? $details->thumbnail : site_url('image/r/no-thumbnail.jpg');?>" class='thumbnail'>
        	</div>
        		<label>Episode thumbnail</label>
        		<input type="url" id="episode_thumbnail" name="episode_thumbnail" class="form-control" value="<?php echo !empty($details->thumbnail) ? $details->thumbnail : site_url('image/r/no-thumbnail.jpg');?>" placeholder="Enter link here"> <a href="#" class="btn btn-default"><i class="fa fa-camera"></i></a>
        	</div>
        	</div>
        		
        		<div class="col-md-8">
        			<div class="form-group">
        		<label>Episode Title</label>
        		<input type="episode_title" name="episode_title" class="form-control" value="<?php echo isset($details->title) ? $details->title : '';?>">
        	</div>

      			<div class="form-group"  style="margin-top:-15px;">
      				<label>Episode number</label>
      				<input class="form-control" type="number" id="episode_number" name="episode_number" value="<?php echo !empty($details->episode_number) ? $details->episode_number : 0;?>">
      			</div>
				<div class="form-group if-episode">
					<label>Synopsis/Description</label>
					
					<textarea class="form-control" id="episode_syspnosis" name="episode_syspnosis" placeholder="Enter syspnosis here..." rows="3">
						<?php echo !empty($details->Synopsis) ? $details->Synopsis : '';?>
					</textarea>
				</div>

        	<div class="form-group">

        	<ul class="nav nav-tabs" id="ul_url">
				  <li class="li_url active"><a data-toggle="tab" href="#tab_url" class="tab_url">Episode url</a></li>
				  <li class="tab_embed"><a data-toggle="tab" href="#tab_embed" class="tab_embed">Embeded</a></li>
				 

			</ul>

					<div class="tab-content">
						<div id="tab_url"  class="tab-pane fade in active">
							<div class="form-group">
								<br/>
        						<label>Episode url</label>
        						<input type="url" id="episode_url" name="episode_url" class="form-control" value="<?php echo !empty($details->link) ? $details->link : '';?>" placeholder="Enter link here">
							</div>

							<div class="form-group"  style="margin-top:-15px;">
								<label>Video Mirror</label>
								<select class="form-control" id="videosource" name="videosource">
									<option value="0"  <?php echo !empty($details->source_id) ? ($details->source_id == 0 ) ? 'selected' : '' : '';?> >-SELECT HERE-</option>
									<option value="1"  <?php echo !empty($details->source_id) ? ($details->source_id == 1 ) ? 'selected' : '' : '';?> >FACEBOOK</option>
									<option value="2"  <?php echo !empty($details->source_id) ? ($details->source_id == 2 ) ? 'selected' : '' : '';?> >VIMEO</option>
									<option value="3"  <?php echo !empty($details->source_id) ? ($details->source_id == 3 ) ? 'selected' : '' : '';?> >DAILYMOTION</option>
									<option value="4"  <?php echo !empty($details->source_id) ? ($details->source_id == 4 ) ? 'selected' : '' : '';?> >YOUTUBE</option>
									<option value="5"  <?php echo !empty($details->source_id) ? ($details->source_id == 5 ) ? 'selected' : '' : '';?> >YOURUPLOAD (IFRAME support)</option>
									<option value="6"  <?php echo !empty($details->source_id) ? ($details->source_id == 6 ) ? 'selected' : '' : '';?> >MP4UPLOAD</option>
									<option value="7"  <?php echo !empty($details->source_id) ? ($details->source_id == 7 ) ? 'selected' : '' : '';?> >OPENLOAD</option>
									<option value="9"  <?php echo !empty($details->source_id) ? ($details->source_id == 9 ) ? 'selected' : '' : '';?> >ANISUBBED (HTML5 VIDEO support)</option>
									<option value="8"  <?php echo !empty($details->source_id) ? ($details->source_id == 8 ) ? 'selected' : '' : '';?> >OTHERS (IFRAME)</option>
									<option value="10"  <?php echo !empty($details->source_id) ? ($details->source_id == 10 ) ? 'selected' : '' : '';?> >OTHERS (VIDEO)</option>

								</select>
							</div>
						</div>
						<div id="tab_embed" class="tab-pane fade">
							<div class="form-group"><br/>
								<label>Embeded <button type="button" class="btn btn-sm btn-default" id="btn-preview"><i class="fa fa-eye"></i></button></label> 

	        					<textarea name="embed" id="embed" class="form-control" rows="4">
	        						<?php echo !empty($details->embed) ? $details->embed : '';?>
	        					</textarea>
							</div>
						</div>

					</div>

							<div class="form-group"  style="margin-top:5px;">
								<label>Release mode</label>
								<select class="form-control" id="release_mode" name="release_mode">
									<option value="1">Most recent</option>
									<option value="0">Others</option>
								</select>
							</div>
        	</div>

				<br/>
				<div class="form-group">
					<button class="btn btn-info">Save <i class="fa fa-save"></i></button>
				</div>
        		</div>
        	
        	

        </form>




			<?php endif ?>
			</div>
		</div>
	</div>
</div>

<!-- - MODALS - - - -->

<div id="modalthumbnail" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">THUMBNAIL</h4>
      </div>
      <div class="modal-body">
        <p>
        <div class="form-group" style="padding:10px;">
			<div class="with-error"></div>
        	
        </div>
        <div class="form-group">
        <label>Select your photo</label>
        	<input type="file" class="btn btn-default" id="file" name="file"><br/>
        	<button id="btnupload" class="btn btn-info">Upload</button>
        </div>
        <div class="form-group">
        	
        <label>Image url</label>
        	<input type="url" class="form-control" id="thumbnail_new" name="thumbnail_new" placeholder="Enter link here (optional)">
        	<button id="btnimgset" class="btn btn-default btn-sm">Use this image url</button>
        </div>
        <div class="form-group">
        	<div id="preview-img" class="anime-col-md-4"><img id="preview_thumbnail" src="" class="thumbnail"></div>
        </div>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- - MODALS - - - -->

<div id="modaluploadmirror" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ADD MIRROR VIDEO</h4>
      </div>
      <div class="modal-body">
        <p>
        <div class="form-group" style="padding:10px;">
			
        	<div class="error-message"></div>      	
        </div>

        	<div class="form-group">

        	<ul class="nav nav-tabs" id="ul_url">
				  <li class="li_mirror_url active"><a data-toggle="tab" href="#tab_mirror_url" class="tab_mirror_url">Episode url</a></li>
				  <li class="li_mirror_embed"><a data-toggle="tab" href="#tab_mirror_embed" class="tab_mirror_embed">Embeded</a></li>
				 

			</ul>

					<div class="tab-content">
						<div id="tab_mirror_url"  class="tab-pane fade in active">
							<div class="form-group">
								<br/>
        						<label>Episode url</label>
        						<input type="url" id="mirror_url" name="episode_url" class="form-control" value="" placeholder="Enter link here">
							</div>

							<div class="form-group"  style="margin-top:-15px;">
								<label>Video Mirror</label>


								<select class="form-control" id="videosource" name="videosource">
									<option value="0"  <?php echo !empty($details->source_id) ? ($details->source_id == 0 ) ? 'selected' : '' : '';?> >-SELECT HERE-</option>
									<option value="1"  <?php echo !empty($details->source_id) ? ($details->source_id == 1 ) ? 'selected' : '' : '';?> >FACEBOOK</option>
									<option value="2"  <?php echo !empty($details->source_id) ? ($details->source_id == 2 ) ? 'selected' : '' : '';?> >VIMEO</option>
									<option value="3"  <?php echo !empty($details->source_id) ? ($details->source_id == 3 ) ? 'selected' : '' : '';?> >DAILYMOTION</option>
									<option value="4"  <?php echo !empty($details->source_id) ? ($details->source_id == 4 ) ? 'selected' : '' : '';?> >YOUTUBE</option>
									<option value="5"  <?php echo !empty($details->source_id) ? ($details->source_id == 5 ) ? 'selected' : '' : '';?> >YOURUPLOAD (IFRAME support)</option>
									<option value="6"  <?php echo !empty($details->source_id) ? ($details->source_id == 6 ) ? 'selected' : '' : '';?> >MP4UPLOAD</option>
									<option value="7"  <?php echo !empty($details->source_id) ? ($details->source_id == 7 ) ? 'selected' : '' : '';?> >OPENLOAD</option>
									<option value="9"  <?php echo !empty($details->source_id) ? ($details->source_id == 9 ) ? 'selected' : '' : '';?> >ANISUBBED (HTML5 VIDEO support)</option>
									<option value="8"  <?php echo !empty($details->source_id) ? ($details->source_id == 8 ) ? 'selected' : '' : '';?> >OTHERS (IFRAME)</option>
									<option value="10"  <?php echo !empty($details->source_id) ? ($details->source_id == 10 ) ? 'selected' : '' : '';?> >OTHERS (VIDEO)</option>


								</select>
							</div>
						</div>
						<div id="tab_mirror_embed" class="tab-pane fade">
							<div class="form-group"><br/>
								<label>Embeded <button type="button" class="btn btn-sm btn-default" id="btn-preview-mirror"><i class="fa fa-eye"></i></button></label> 

	        					<textarea name="embed" id="mirror_embed" class="form-control" rows="4">
	        					</textarea>
							</div>
						</div>

					</div>

        	</div>

        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- - MODALS - - - -->

<div id="modalpreviewvideo" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">PREVIEW VIDEO</h4>
      </div>
      <div class="modal-body">
        <p>
        <div class="form-group" style="padding:10px;">
		
        	<div class="show-message"></div>      	
        </div>

        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">

var site_url = '<?php echo site_url()?>';
var detail_id = <?=$detail_id?>;
var video_id = <?=$details->video_id;?>;

	$('#frmupdatevideo').on('submit',function(){
		var data = $(this).serialize();

		$.ajax({
			data: data,
			url: site_url+'/video/updateepisode/'+detail_id+'/'+video_id,
			type: 'post',
			dataType: 'json',
			success: function (response) {
				// body...
				
					var message = response.message;
				if(response.success == true){
					//$(".show-message").html(success(message));
					//console.log(response.message);
					//alert(response.message);
			 		$('#frmupdatevideo').notify(message,{position:'top right',className:'success'});
				}
	            else
	            {
	                //$(".show-message").html(error(message));
	                console.log(message);
	                //alert(response.message);
			 		$('#frmupdatevideo').notify(message,{position:'top right',className:'error'});
	            }
			}
		});

		return false;
	});
var embed = false;

	$('#mirror_url').on('blur',function(){
		var url = $(this).val();
		var hostname = extractRootDomain(url);
		var source_id = getsource_id(hostname);
		var f_path = split_url(url);
		var embed = '';

		$('#mirror_videosource').val(source_id);

		if(source_id == 7){
		}else if (source_id == 2) {
			var yt = split_urlY(url);
		}else if (source_id == 8) {

		}

		embed = embed_url(url,source_id);
		$('#mirror_embed').val(embed.outerHTML);
		//console.log(embed);

		$('.error-message').html(embed);

	});

	$('#episode_url').on('blur',function(){

		let url = $(this).val();

		if(url.length < 10){
		$('.with-error').html('');
			return false;
		}
		let video = new Embed_video();
		video._url = url;
		//let hostname = video.host_name();
		let source_id = video.source_id();
		$('#videosource').val(source_id);
		let embeded = video.embeded();
		$('#embed').val(embeded);

		$('#modalpreviewvideo').modal('show');
		$('.show-message').html(embeded);

		/*
		var url = $(this).val();
		var hostname = extractRootDomain(url);
		var source_id = getsource_id(hostname);
		var f_path = split_url(url);
		var embed = '';

		$('#videosource').val(source_id);

		if(source_id == 7){
		}else if (source_id == 2) {
			var yt = split_urlY(url);
		}else if (source_id == 8) {

		}

		embed = embed_url(url,source_id);
		$('#embed').val(embed.outerHTML);
		$('#modalpreviewvideo').modal('show');
		//console.log(embed);

		$('.show-message').html(embed);
		*/
	});

	$('#videosource').on('change',function(elem){

		let url = $('#episode_url').val();
		if(url.length < 10){
		$('.show-message').html('');
		$('#embed').val('');
			return false;
		}
		let source = $(this).val();
		let video = new Embed_video();
		video._url = url;
		if(source == 8 || source == 10){

			var embeded = video.embeded('video');
		}else{

			var embeded = video.embeded();
		}
		$('#embed').val(embeded);

	});


	$('#episode_thumbnail').on('blur',function(){
		var url = $(this).val();
		$('.thumbnail').attr('src',url);
	});
$('#btn-preview').on('click',function(){
	var preview = $('#embed').val();

		$('#modalpreviewvideo').modal('show');
		//console.log(embed);
		$('.show-message').html(preview);

})
</script>