<div class="anime panel">
<div class="panel-body">
		<h4>New video </h4>
		
<div class="with-error"></div>
<form class="form" id="frmupdatevideo" action="update_video" method="post">
<div class="col-md-12">
	<div class="col-md-3">
		
				        	<div class="form-group">
				        		<label>Episode thumbnail</label>
				        		<input type="url" id="episode_thumbnail" name="episode_thumbnail" class="form-control" value="<?php echo isset($details->thumbnail) ? $details->thumbnail : site_url('image/r/no-thumbnail.jpg');?>" placeholder="Enter link here"> <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modalupload"><i class="fa fa-camera"></i></a>

				        	</div>
				        	<div class="formgroup">
				        		<img src="" id="imgpreview" src="<?php echo isset($details->thumbnail) ? $details->thumbnail : site_url('image/r/no-thumbnail.jpg');?>" class="thumbnail">
				        	</div>
	</div>

<div class="col-md-5 more-info" >
	<div class="form-group">
					<input type="hidden" name="detail_id" id="detail_id" value="<?=$detail_id?>">
					<input type="hidden" name="video_id" id="video_id" value="<?=$details->video_id?>">
					<label>Video category</label>

					<select class="form-control" id="videocategory" name="videocategory">
						<option value="1" <?php if($details->video_type == 1) echo 'selected'; ?> >Anime</option>
						<option value="2" <?php if($details->video_type == 2) echo 'selected'; ?> >Movies</option>
						<option value="3" <?php if($details->video_type == 3) echo 'selected'; ?> >Asian/Drama</option>
					</select>
				</div>
				<div class="form-group hidden">
					<label>Video series/playlist</label>
					<select class="form-control" id="videoparent" name="videoparent">
						<option value='0'>No parent</option>
					</select>
				</div>

      			<div class="form-group hidden">
      				<button class="btn btn-info btn-continue" type="button">Continue...</button>
      			</div>

	<div class="form-group">
					<label>Title</label>
					<input type="text" class="form-control" id="title" name="title" value="<?=$details->title?>" required>
				</div>

        		<div class="form-group">
	        		<label for="title">Synopsis</label>
					<textarea class="form-control synopsis" style="width:100%;padding:5px;min-height:20vh;overflow:auto;" name="synopsis" id="synopsis"><?php echo isset($details->sypnosis) ? $details->sypnosis : '';?></textarea>
				</div>

      			<div class="form-group"  style="">
      				<label>Episode number</label>
      				<input class="form-control" type="number"  step="0.1"  id="episode_number" name="episode_number" value="<?php echo !empty($details->episode_number) ? $details->episode_number : 0;?>">
      			</div>

</div>
<div class="col-md-4  more-info">
	<div class="form-group">

        	<ul class="nav nav-tabs" id="ul_url">
				  <li class="li_url active"><a data-toggle="tab" href="#tab_url" class="tab_url">Episode url</a> </li>
				  <li class="tab_embed"><a data-toggle="tab" href="#tab_embed" class="tab_embed">Embeded</a></li>
				  

			</ul>

					<div class="tab-content">
						<div id="tab_url"  class="tab-pane fade in active">
							<div class="form-group">
								
        						<label>Episode url <a class="btn" id="btnpreview" data-toggle="modal" data-target="#modalpreview"><i class="fa fa-eye "></i></a></label>
        						<input type="url" id="episode_url" name="episode_url" class="form-control" placeholder="Enter link here" value="<?php echo $details->link; ?>" >
							</div>

							<div class="form-group"  style="">
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
							<div class="form-group">
								<label>Embeded</label>

	        					<textarea name="embed" id="embed" class="form-control"><?=$details->embed?></textarea>
							</div>
						</div>


					</div>
        	</div>

							<div class="form-group"  style="margin-top:5px;">
								<label>Release mode</label>
								<select class="form-control" id="release_mode" name="release_mode">
									<option value="1" <?php if ($details->release_mode == 1) {
										echo " selected ";
									} ?>>Most recent</option>
									<option value="0" <?php if ($details->release_mode == 0) {
										echo " selected ";
									} ?>>Others</option>
								</select>
							</div>

<div class="form-group">
	<button class="btn btn-info" id="btnsave" type="submit">Update</button> &nbsp;
	
			<?php  if (isset($detail_id)): ?>
				<a class="btn btn-default btn-edit-series" href="#" data-series="<?=$detail_id?>">Cover page</a>
			<?php endif  ?>
		
</div>
</div>
				

				
        	
</form>

</div>
</div>


<!-- - MODALS - - - -->

<div id="modalpreview" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">NEW VIDEO</h4>
      </div>
      <div class="modal-body">
        <p>
        <div class="preview-video"></div>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<!-- - MODALS - - - -->

<div id="modalupload" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">NEW VIDEO THUMBNAIL</h4>
      </div>
      <div class="modal-body">
        <p>
        <div class="form-group">
        		
        	<label>Select image</label>
        	<input class="btn alert-info" type="file" name="uploadthumb" id="uploadthumb"  accept="image/*" value="<?=$details->thumbnail?>" />
        	
        	</div>
        	<div class="form-group">
        		
        	<input class="form-control" type="url" name="thumbnail" id="thumbnail" placeholder="Enter image link here (optional)" />
        	
        	</div>

        	<div class="form-group">
        		
        	<input	type="button" id="btnuploadnewvideo" name="btnupload" value="Upload" class="btn btn-default" style="min-width:75px;" />
        	</div>
        	<div class="form-group">
        		<div class="preview-img hidden"><img src="<?=site_url('image/r/no-thumbnail.jpg')?>" class="thumbnail" id="imgpreview" style="width:100%;"></div>
        	</div>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


