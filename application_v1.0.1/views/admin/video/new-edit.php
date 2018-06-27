
							<style type="text/css">
								#listhere{
									list-style:none;
									margin:0;
									padding:0;
									position: absolute;
									background-color: #e5e5e5;
									width: 95%;
									margin-top:-20px;

								}
								#listhere li{
									padding: 5px;
								}

								#listhere li:hover{
									background-color: #fff;
									border-top: 1px solid #111;
								}

								#listhere li a{
									cursor: pointer;
									text-decoration: none;
								}
								.font-10{
									font-size:10px;display:block;padding-left:20px;
								}
								</style>

<div class="panel admin-panel">
	<div class="panel-heading">
		<h3>VIDEO LIBRARY - EDIT</h3>
	</div>
	<div class="panel-body">
		<div class="anime">
			<div class="with-error-main"></div>
			<div class="anime-heading">
			</div>
			<div class="anime-body">

			<div class="col-md-3">
        		<label for="title">Cover photo <i class="btn btn-default fa fa-camera" data-toggle='modal' data-target='#modalthumbnail'></i></label>
        		<input type="hidden" value="<?php echo !empty($details->thumbnail) ? $details->thumbnail : site_url('image/r/no-thumbnail.jpg');?>" name="thumbnail" id="thumbnail" />
				<div class="preview-img"><img src="<?php echo !empty($details->thumbnail) ? $details->thumbnail : site_url('image/r/no-thumbnail.jpg');?>" class="thumbnail" id="imgpreview"></div>
			</div>
			<form class="form" id="frmupdate">
			<div class="col-md-3">

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

			<div class="col-md-2">
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

			<div class="col-md-4">
			<label>Episodes <i class="btn btn-sm btn-default fa fa-plus" data-toggle="modal" data-target="#modalepisode"></i> <i class="btn btn-sm btn-default fa fa-edit" data-toggle="modal" data-target="#playlist" onclick="playlist()"></i></label>
			<ul class="list-episode-here">

					<?php $next_episode = 0; ?>
				<?php if (isset($episodes) && is_array($episodes)): ?>

					<?php foreach ($episodes as $key): ?>
						<li><a href="<?=site_url('video/episode/'.$details->video_detail_id.'/'.$key->video_id)?>">Episode <?=$key->episode?></a> <i class="font-10"><?=$key->title;?></i></li>
					
					<?php $next_episode = $key->episode + 1; ?>
					<?php endforeach ?>
				<?php endif ?>
			</ul>
			</div>
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
			   		 <h3>Video url</h3>
			    	
					
        <form class="form" id="frmnewvideo"  method="post" action="../../video/saveepisode" enctype="multipart/form-data">
        	
        	<div class="form-group">
        		<label>Episode Title</label>
        		<input type="episode_title" name="episode_title" class="form-control" value="<?php echo isset($details->title) ? $details->title.' episode '.$next_episode : '';?>">
        	</div>

      			<div class="form-group"  style="margin-top:-15px;">
      				<label>Episode number</label>
      				<input class="form-control" type="number" id="episode_number" name="episode_number" value="<?=$next_episode?>">
      			</div>
				<div class="form-group if-episode">
					<label>Synopsis/Description</label>
					
					<textarea class="form-control" id="episode_syspnosis" name="episode_syspnosis" placeholder="Enter syspnosis here..." rows="3"></textarea>
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

							<div class="form-group"  style="margin-top:-15px;">
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
				</div>
        	

        </form>
					</div>

			  		<div id="tab_existing" class="tab-pane fade">
			   		 <h3>Existing on site</h3>
			    	
						<div class="form-group">
							<input type="search" class="form-control episode-title" id="episode-title" placeholder="Enter title here..." value="">
						</div>
						<div class="form-group">
							<div id="search-output">
								<ul id="listhere"></ul>
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
<script type="text/javascript">
var no_image = "<?php echo site_url('image/r/no-thumbnail.jpg');?>";
var site_url = '<?php echo site_url()?>';
var detail_id = '<?php echo isset($details->video_detail_id) ? $details->video_detail_id : 0;?>';


window.onload = function(){

clearmodalthumbnail();

playlist(detail_id);

//$('#modalepisode').modal('show');
}
$('#btnimgset').on('click',function(){
	var img_url = $('#thumbnail_new').val();

				$.ajax({
				data:'thumbnail='+img_url,
				type:'post',
				url: site_url+'/video/change_cover/'+detail_id,
				success: function(response){
					console.log(response);
					$('#modalthumbnail').modal('hide');
					clearmodalthumbnail();
				}
			});

	$('#thumbnail').val(img_url);
	$('#imgpreview').attr('src',img_url);
})
$('#thumbnail_new').on('blur',function(){
	var t = $(this).val();
	if(t.length < 8){
		return false;
	}
	$('#preview_thumbnail').attr('src',t);
});
$('#frmupdate').on('submit',function(){
	var data = $(this).serialize();
	//console.log(data);
	//return false;

	$.ajax({
		data: data,
		type: 'post',
		url: site_url+'/video/updatedetail/'+detail_id,
		success: function(response){
			console.log(response);
		},
		error: function(){
			console.log('error');
		}
	});
	return false;
})

$('#frmnewvideo').on('submit',function(){
	var data = $(this).serialize();
	var url = site_url+'/video/saveepisode/'+detail_id;
	$.ajax({
		data: data,
		url:url,
		type: 'post',
		success: function(response){
			console.log(response);
		},
		error: function (response,status,info) {
			// body...
			console.log(response.responseText);
		}
	});
	//console.log(data);
	return false;
})



$("#file").change(function() {
  readURL(this,'preview_thumbnail');
});
function clearmodalthumbnail(){
	$('#modalthumbnail input').val('');
	$('#modalthumbnail img').attr('src',no_image);

}

	$('#btnupload').on('click',function(){
		var uploaded = upload('<?=site_url()?>/image/upload','file','imgpreview','thumbnail');

		//if(image_url != false){
			setTimeout(function(){

			console.log(image_url);
			$.ajax({
				data:'thumbnail='+image_url,
				type:'post',
				url:'../../video/change_cover/'+detail_id,
				success: function(response){
					console.log(response);
					$('#modalthumbnail').modal('hide');
					clearmodalthumbnail();
				}
			});

			},2000)
		//}
	});
</script>

<script type="text/javascript">
	//$('#modalepisode').modal('show');
$('#btnselected').on('click',function(){
	//console.log(selected_object.length);
	//console.log(detail_id);return false;
	if(detail_id == 0 || detail_id == undefined){

		return false;
	}
	if(selected_object.length != undefined || selected_object != 0 || selected_object != false){
		//console.log(selected_object);
		$.ajax({
			data:{episodes:array_video_id},
			url:'../../video/moveepisode/'+detail_id,
			type:'post',
			success: function(response){
				console.log(response);
				$('.tr_episode').remove();
				$('#modalepisode').modal('hide');
			}

		});

		$.each(selected_object,function(k,v){
			//console.log(v);
			$('.list-episode-here').append('<li><a target="_blank" href="'+site_url+'/watch/v/'+v.id+'">Episode '+v.episode+'</a> <i style="" class="font-10">'+v.title+'</i></li>');
		});
	}else{
		console.log('Do nothing');
	}
});
$('#listhere').on('mouseleave',function(){
	$('#listhere li').remove();
})
$('#episode-title').on('keyup',function(){
	var q = $(this).val();
	if(q.length <= 0){
		return false;
	}

			$('#listhere').html('');
	$.ajax({
		data: 'q='+q,
		type: 'post',
		dataType: 'json',
		url:'<?php echo site_url("playlist/search");?>',
		
		success: function(response){
			console.clear();
			console.log(response);
			if(response.success == true){

				  $.each(response.message, function(k, v) {
				    
				    
				    $('#listhere').append('<li onclick="addtolist('+v.video_id+','+v.episode_number+','+'\''+v.title+'\''+')"><a>'+v.title+'</a></li>');
				
				  });

		}else{
			$('#listhere').html('<li>No reponse.</li>');
		}


		},
        error: function(xhr, status, error) {
          //var err = eval("(" + xhr.responseText + ")");
          console.log(xhr.responseText);

        }
	});
});
var array_video_id = false;
var i = 0;
function addtolist(video_id,episode_number,title){
	var selected = singlearray(video_id);
	if(selected === true){
		selectedarray(video_id,episode_number,title)
	$('.table-output').append('<tr class="tr_episode">'+'<td>'+title+'</td>'+'<td>'+episode_number+'</td>'+'<td><a class="btn btn-sm btn-danger"><i class="fa fa-remove"></i></td>'+'</tr>');

	}else{
		$('.with-error').html(error('Episode already on the list.'));
		setTimeout(function(){

		$('.alert-dismissable .close').click();
		},3000)
	}
	$('.btn-danger').on('click',function(){
		$(this).parent().parent().remove();
		var index = array_video_id.indexOf(video_id);
			if (index > -1) {
				array_video_id.splice(index,video_id);
				removeobject(video_id);
			}
			//console.log(array_video_id);
	});
}
var embed = false;

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


	});

	$('#videosource').on('change',function(elem){

		let url = $('#episode_url').val();
		if(url.length < 10){
		$('.with-error').html('');
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


	function is_supported(source_id){
		var supported = '';
		if(source_id == 10){
			supported = '<p>YOURUPLOAD</p>';
		}
		return supported;
	}

	var selected_object = false;
function selectedarray(video_id,episode,title){
	var added = false;
		if (selected_object == false) {
			selected_object= [];
		};
		var kv ='';
		kv = {id:video_id , episode: episode, title: title};

		objIndex = selected_object.findIndex((obj => obj.id == video_id));

		if(objIndex != -1){
			//array_video_id[objIndex].episode = episode
			added = false;
			//console.log(array_video_id);
			//console.log('not in array');
		}else{
			selected_object.push(kv);
			added = true;
			//console.log(array_video_id);
			///console.log('in array');
		}
		return added;
		}

function singlearray(video_id) {
	// body...
	if(array_video_id == false){
		array_video_id = [];
		array_video_id.push(video_id);
		added = true;
			console.log('Not In array')
	}else{

		//var array = [2, 5, 9];
		var index = array_video_id.indexOf(video_id);
		if (index > -1) {
		  //array_video_id.splice(index, 1);
		  	added = false;
		  	console.log('In array')
		}else{
			array_video_id.push(video_id);
			added = true;
			console.log('Not In array')
		}
	}
	return added;
}

function removeobject(video_id){

		objIndex = selected_object.findIndex((obj => obj.id == video_id));

		if(objIndex != -1){
			selected_object.splice(objIndex,1);

		}
}

function playlist(){
	if(detail_id != false || detail_id != undefined){
		var jsonurl = site_url+'/playlist/v/'+detail_id;
		$.getJSON(jsonurl,'detail_id='+detail_id, function(data) {
			      

				if(data.success == true){
					$('.playlist-edit tr').remove();
					$('.list-episode-here').html('');
				  $.each(data.message, function(k, v) {
				    //console.log(v.title)
				    $('.playlist-edit').append('<tr id="tr_'+v.video_id+'"><td>'+v.video_id+'</td><td>'+v.title+'</td><td>'+v.episode+'</td><td><button class="btn btn-sm btn-danger " onclick="removetoplaylist('+v.video_id+')"><i class="fa fa-remove"></i></button></td></tr>');

					$('.list-episode-here').append('<li><a href="'+site_url+'/video/episode/'+detail_id+'/'+v.video_id+'">Episode '+v.episode+'</a> <i style="" class="font-10">'+v.title+'</i></li>');
							  });
				}

			}).fail(function() { 
			      //console.log( "error" ); 
			      	console.clear();
			      	console.log('Playlit: Error 500!');
					//$('.playlist-edit tr').remove();
					//$('.list-episode-here').html('');
			}); 

	}
}
function removetoplaylist(video_id){

			$.ajax({
				data:'video_id='+video_id,
				type:'post',
				url:'../../video/removetoplaylist/'+detail_id,
				success: function(response){
					//console.log(response);
					if(response.success == true){
						//$('#tr_'+video_id).remove();

						playlist();
					}
					
				}
			});
}
</script>