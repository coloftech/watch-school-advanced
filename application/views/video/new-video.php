<div class="anime panel">
<div class="panel-body">
		<h4>New video</h4>
<div class="with-error"></div>
<form class="form" id="frmnewvideo">
<div class="col-md-12">
	<div class="form-group">
					<label>Video category</label>
					<select class="form-control" id="videocategory" name="videocategory">
						<option value="1">Anime</option>
						<option value="2">Movies</option>
						<option value="3">Asian/Drama</option>
					</select>
				</div>
				<div class="form-group">
					<label>Video series/playlist</label>
					<select class="form-control" id="videoparent" name="videoparent">
						<option value='0'>No parent</option>
					</select>
				</div>

      			<div class="form-group">
      				<button class="btn btn-info btn-continue">Continue...</button>
      			</div>
</div>
<div class="col-md-7 more-info hidden" >
	<div class="form-group">
					<label>Title</label>
					<input type="text" class="form-control" id="title" name="title" required>
				</div>

        		<div class="form-group">
	        		<label for="title">Synopsis</label>
					<textarea class="form-control synopsis" style="width:100%;padding:5px;min-height:20vh;overflow:auto;" name="synopsis" id="synopsis"><?php echo isset($details->synopsis) ? $details->synopsis : '';?></textarea>
				</div>

      			<div class="form-group"  style="">
      				<label>Episode number</label>
      				<input class="form-control" type="number"  step="0.1"  id="episode_number" name="episode_number" value="<?php echo !empty($details->episode_number) ? $details->episode_number : 0;?>">
      			</div>

</div>
<div class="col-md-5  more-info hidden">
	<div class="form-group">

        	<ul class="nav nav-tabs" id="ul_url">
				  <li class="li_url active"><a data-toggle="tab" href="#tab_url" class="tab_url">Episode url</a> </li>
				  <li class="tab_embed"><a data-toggle="tab" href="#tab_embed" class="tab_embed">Embeded</a></li>
				  <li class="tab_video_thumbnail"><a data-toggle="tab" href="#tab_video_thumbnail" class="tab__videothumbnail">Thumbnail</a></li>
				 

			</ul>

					<div class="tab-content">
						<div id="tab_url"  class="tab-pane fade in active">
							<div class="form-group">
								
        						<label>Episode url <a class="btn" id="btnpreview" data-toggle="modal" data-target="#modalpreview"><i class="fa fa-eye "></i></a></label>
        						<input type="url" id="episode_url" name="episode_url" class="form-control" value="" placeholder="Enter link here">
							</div>

							<div class="form-group"  style="">
								<label>Video Mirror</label>
								<select class="form-control" id="videosource" name="videosource">
									<option value="0">-SELECT HERE-</option>
									<option value="1">FACEBOOK</option>
									<option value="2">VIMEO</option>
									<option value="3">DAILYMOTION</option>
									<option value="4">YOUTUBE</option>
									<option value="5">YOURUPLOAD (IFRAME support)</option>
									<option value="6">MP4UPLOAD</option>
									<option value="7">OPENLOAD</option>
									<option value="9">ANISUBBED (HTML5 VIDEO support)</option>
									<option value="8">OTHERS (IFRAME)</option>
									<option value="10">OTHERS (VIDEO)</option>

									
								</select>
							</div>
						</div>
						<div id="tab_embed" class="tab-pane fade">
							<div class="form-group">
								<label>Embeded</label>

	        					<textarea name="embed" id="embed" class="form-control"></textarea>
							</div>
						</div>

						<div id="tab_video_thumbnail" class="tab-pane fade">
							
				        	<div class="form-group">
				        		<label>Episode thumbnail</label>
				        		<input type="url" id="episode_thumbnail" name="episode_thumbnail" class="form-control" value="<?php echo isset($details->thumbnail) ? $details->thumbnail : site_url('image/r/no-thumbnail.jpg');?>" placeholder="Enter link here"> <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modalupload"><i class="fa fa-camera"></i></a>
				        	</div>
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

<div class="form-group">
	<button class="btn btn-info" id="btnsave" type="submit">Save</button>
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
        <h4 class="modal-title">NEW VIDEO<div class="loader pull-right hidden"><img src="<?=base_url()?>public/images/loader.gif" style="width:50px;height:50px;"></div></h4>
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
        <h4 class="modal-title">NEW VIDEO THUMBNAIL<div class="loader pull-right hidden"><img src="<?=base_url()?>public/images/loader.gif" style="width:50px;height:50px;"></div></h4>
      </div>
      <div class="modal-body">
        <p>
        <div class="form-group">
        		
        	<label>Select image</label>
        	<input class="btn alert-info" type="file" name="uploadthumb" id="uploadthumb"  accept="image/*" />
        	
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


