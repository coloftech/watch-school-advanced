<div class="panel anime">

<style type="text/css">
	.badge-remove{
		cursor: pointer;
		background-color: white;
		background-color: #f3f8fe;
		color: red;
	}
	.badge-remove:hover{
		background-color: red;
		color: white;
		color: #fff;
	}
	.search-output{
		cursor: pointer;
	}

	.search-output:hover{
		background-color: rgba(1,1,1,0.1);
	}
</style>
			<div class="with-error"></div>
			<div class="anime-heading">
			</div>
			<div class="anime-body panel-body">

			<form class="form" id="frmupdateseries">
			<input type="hidden" id="detail_id" name="detail_id" value="<?=$detail_id?>">
			<div class="col-md-3">
        		<label for="title">Cover photo <i class="btn btn-default fa fa-camera" data-toggle='modal' data-target='#modalthumbnail'></i></label>
        		<input type="hidden" value="<?php echo !empty($details->thumbnail) ? $details->thumbnail : site_url('image/r/no-thumbnail.jpg');?>" name="thumbnail" id="thumbnail" />
				<div class="preview-img"><img src="<?php echo !empty($details->thumbnail) ? $details->thumbnail : site_url('image/r/no-thumbnail.jpg');?>" class="thumbnail" id="imgpreview" style="width:100%;"></div>
			</div>
			<div class="col-md-5">

        		<div class="form-group">
        		<label for="title">Title</label>
        		<input type="text" name="title" id="title" class="form-control" value="<?php echo isset($details->title) ? $details->title : '';?>">
        		</div>
        		<div class="form-group">
        		<label for="title">Synopsis</label>
				<textarea class="form-control synopsis" style="width:100%;padding:5px;min-height:40vh;overflow:auto;" name="synopsis" id="synopsis"><?php echo isset($details->synopsis) ? $details->synopsis : '';?></textarea>
				</div>
        		<div class="form-group">
        		<label for="title">Genre</label>
        		<textarea  class="form-control" id="genre" name="genre" style="overflow:auto;" ></textarea>
        		</div>

			</div>

			<div class="col-md-4">
				<div class="moreinfo">
					
        		<div class="form-group">
        			<label for="title">Release date</label>
        			<input type="date" class="form-control" id="release_date" name="release_date"  value="<?=isset($details->release_date) ? date('Y-m-d',strtotime($details->release_date)) : "2018-06-12";?>"/>
        		</div>

        		<div class="form-group">
        			<label for="title">Countdown start date</label><br/>
        		<input type="date" name="countdown_date" id="countdown_date" placeholder="2018/06/05" class="form-control" style="width:100%;;display:inline-block;" value="<?=isset($details->live_chart_date) ? date('Y-m-d',strtotime($details->live_chart_date)) : "2018-06-12";?>">
				<input type="time" name="countdown_time" id="countdown_time" placeholder="12:00:00" class="form-control" style="width:100%;;display:inline-block;" value="<?=isset($details->live_chart_date) ? date('H:i:s',strtotime($details->live_chart_date)) : "12:00:00";?>"> 
			
        		</div>

			<div class="form-group hidden">
				<label class="title">Expired date</label>
				<span class="form-control"  id="sexpired_date" style="width:200px;display:inline-block;"><?=isset($details->live_chart_date_end) ? date('Y-m-d',strtotime($details->live_chart_date_end)) : "2018-06-12";?></span>
				<span class="form-control"  id="sexpired_time"  style="width:100px;display:inline-block;"><?=isset($details->live_chart_date_end) ? date('h:m:s',strtotime($details->live_chart_date_end)) : "12:00:00";?></span>
				<input  type="hidden"  id="expired_date"  name="expired_date" placeholder="2018/06/12" class="form-control" style="width:200px;display:inline-block;" value="<?=isset($details->live_chart_date_end) ? $details->live_chart_date_end : "2018/06/12";?>">
				<input  type="hidden"  id="expired_time"  name="expired_time"placeholder="12:00:00" class="form-control" style="width:100px;display:inline-block;"> 
			</div>
			<div class="form-group">
				<label>Status</label>
				<select class="form-control" id="status" name="status">
					<option value="1">Ongoing</option>
					<option value="2">Incoming</option>
					<option value="3">Completed</option>
					<option value="4">Unknown</option>
				</select>
			</div>

			<div class="form-group">
				<label>Video type</label>
				<select class="form-control" id="type" name="type">
					<option value="1" <?php echo ($details->type == 1) ? 'selected' : ''; ?>>Anime</option>
					<option value="2" <?php echo ($details->type == 2) ? 'selected' : ''; ?>>Movies</option>
					<option value="3" <?php echo ($details->type == 3) ? 'selected' : ''; ?>>Asian series</option>
					<option value="4" <?php echo ($details->type == 4) ? 'selected' : ''; ?>>Others</option>
				</select>
			</div>
			<div class="form-group">
				<label>Show to live chart?</label>
				<select class="form-control" id="islivechart" name="islivechart">
					<option value="0">Yes</option>
					<option value="1">No</option>
				</select>
			</div>

			<div class="form-group"><button type="submit" class="btn btn-info" id="btnupdate">Update</button>
			</div>
				</div>
			</div>
			</form>

			</div>

<div class="col-md-12">
<label>Episodes <i class="btn btn-sm btn-default fa fa-plus" data-toggle="modal" data-target="#modalepisode"></i> <i class="btn btn-sm btn-default fa fa-edit hidden" data-toggle="modal" data-target="#playlist" onclick="playlist()"></i></label>
	<ul class="list-group row" id="listepisodes">

					<?php $next_episode = 0; ?>
				<?php if (isset($episodes) && is_array($episodes)): ?>
					<?php $class = array('danger','success','info','warning');
					$i=0;
						 ?>
					<?php foreach ($episodes as $key): ?>

						<li class="list-group-item col-xs-4 list-group-item-<?=$class[2]?>"><span class="badge badge-primary badge-pill badge-remove" data-series='<?=$detail_id?>' data-episode='<?=$key->video_id?>'>&times;</span> <a href="#" class="list-edit-video"  data-series='<?=$detail_id?>' data-episode='<?=$key->video_id?>' data-category='<?=$details->type?>'>Episode <?=$key->episode?></a> <i class="font-10" style="display:block;font-size:10px;margin-left:20px;"><?=$key->title;?></i> </li>
					
					<?php $next_episode = $key->episode + 1; ?>
						<?php

						 $i++;
						 if($i==4){
						 	$i=0;
						 }
						  ?>
					<?php endforeach ?>
				<?php endif ?>
    
</ul>
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
        	<input type="file" class="btn btn-default" id="uploadthumb" name="uploadthumb"  accept="image/*" ><br/>
        	<button id="btnupload" class="btn btn-info">Upload</button>
        </div>
        <div class="form-group">
        	
        <label>Image url</label>
        	<input type="url" class="form-control" id="thumbnail_new" name="thumbnail_new" placeholder="Enter link here (optional)">
        	<button id="btnimgset" class="btn btn-default btn-sm">Use this image url</button>
        </div>
        <div class="form-group">
        	<div id="preview-img" class="anime-col-md-4 preview-img hidden"><img id="preview_thumbnail" src="" class="thumbnail"></div>
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

<div id="playlist" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">PLAYLIST</h4>
      </div>
      <div class="modal-body">
        <p>
        <div class="form-group" style="padding:10px;">
			<div class="with-error"></div>        	
        </div>
        <table class="table">
        	<thead><tr><td width="50px">ID</td><td>Title</td><td width="75px">Episode</td><td width="75px"></td></tr></thead>
        	<tbody class="playlist-edit">
        		
        	</tbody>
        </table>

        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- - MODALS - - - -->

<div id="modalepisode" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
					
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">NEW EPISODE</h4>
      </div>
      <div class="modal-body">
        <p>
        <div class="form-group" style="padding:10px;">
			<div class="with-error"></div>
        	<ul class="nav nav-tabs" id="ul_new">
				  <li class="li_link active"><a data-toggle="tab" href="#tab_link" class="tab_link">New episode</a></li>
				  <li class="li_existing"><a data-toggle="tab" href="#tab_existing" class="tab_existing">Existing on site</a></li>
				 

			</ul>

					<div class="tab-content">

			  		<div id="tab_link" class="tab-pane fade in active">
			   		 <h3>Add new episode to playlist</h3>
			    	
					
        <form class="form" id="frmaddepisode"  method="post" action="add_video" enctype="multipart/form-data">
        	<input type="hidden" name="videoparent" id="inputvideoparent" value="<?=$detail_id?>">
        	<input type="hidden" name="videocategory" id="inputvideocategory" value="<?=$details->type?>">

        	<div class="form-group">
        		<label>Episode Title</label>
        		<input type="episode_title" name="title" class="form-control" value="<?php echo isset($details->title) ? $details->title.' episode '.$next_episode : '';?>">
        	</div>

      			<div class="form-group"  style="">
      				<label>Episode number</label>
      				<input class="form-control" type="number" step="0.01"  id="episode_number" name="episode_number" value="<?=$next_episode?>">
      			</div>
				<div class="form-group if-episode">
					<label>Synopsis/Description</label>
					
					<textarea class="form-control" id="episode_synopsis" name="synopsis" placeholder="Enter synopsis here..." rows="3"></textarea>
				</div>

        	<div class="form-group">

        	<ul class="nav nav-tabs" id="ul_url">
				  <li class="li_url active"><a data-toggle="tab" href="#tab_url" class="tab_url">Episode url</a></li>
				  <li class="tab_embed"><a data-toggle="tab" href="#tab_embed" class="tab_embed">Embeded</a></li>
				  <li class="tab_video_thumbnail"><a data-toggle="tab" href="#tab_video_thumbnail" class="tab__videothumbnail">Thumbnail</a></li>
				 

			</ul>

					<div class="tab-content">
						<div id="tab_url"  class="tab-pane fade in active">
							<div class="form-group">
								
        						<label>Episode url</label>
        						<input type="url" id="episode_url" name="episode_url" class="form-control" value="" placeholder="Enter link here">
							</div>

							<div class="form-group"  style="">
								<label>Video Source</label>
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
				        		<input type="url" id="episode_thumbnail" name="episode_thumbnail" class="form-control" value="<?php echo isset($details->thumbnail) ? $details->thumbnail : site_url('image/r/no-thumbnail.jpg');?>" placeholder="Enter link here"> <a href="#" class="btn btn-default"><i class="fa fa-camera"></i></a>
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

				<br/>
				<div class="form-group">
					<button class="btn btn-info">Save <i class="fa fa-save"></i></button>
					<div class="with-error"></div>
				</div>
        	

        </form>
					</div>

			  		<div id="tab_existing" class="tab-pane fade">
			   		 <h3>Existing on site</h3>
			    	
						<div class="form-group">
							<input type="search" class="form-control episode-title" id="episodetitle" placeholder="Enter title here..." value="">
						</div>
						<div class="form-group">
							<div id="search-output">
								<ul id="listhere" class="list-group"></ul>
							</div>
						</div>
						<div class="form-group">
							<div class="selected-output">
								<table class="table table-output">
									<tr><td>Title</td><td width="50px">Episode</td><td width="150px;">Action</td></tr>
									<tbody id="tbody"></tbody>
									<tfoot>
										
									<tr><td></td><td></td><td><button id="btnselected">Add selected</button></td></tr>

									</tfoot>
								</table>
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