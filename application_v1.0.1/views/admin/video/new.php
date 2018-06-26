<style type="text/css">

</style>

<div class="panel admin-panel">
	<div class="panel-heading">
		<h4>VIDEO LIBRARY</h4>
	</div>
	<div class="panel-body">
		<div class="anime">
			<div class="with-error"></div>
			<div class="anime-heading">
				<ul class="pagination list-anime-paging pull-left">
					<li><a href="?s=a&e=e" class="list-anime-inline-menu">A-E</a></li>
					<li><a href="?s=f&e=j" class="list-anime-inline-menu">F-J</a></li>
					<li><a href="?s=k&e=o" class="list-anime-inline-menu">K-O</a></li>
					<li><a href="?s=p&e=s" class="list-anime-inline-menu">P-S</a></li>
					<li><a href="?s=u&e=z" class="list-anime-inline-menu">U-Z</a></li>
					<li><a href="?s=0&e=9" class="list-anime-inline-menu">0-9</a></li>
				</ul>
				<ul class="pagination pull-right">
					<li><a href="#" data-toggle="modal" data-target="#modalvideo">New video</a></li>
				</ul>
			</div>
			<div class="anime-body">
			<table class="table">
				<tr>
					<th width="50px">#</th>
					<th width="50px">ID</th>
					<th width="50px">COVER</th>
					<th>TITLE</th>
					<th width="100px">STATUS</th>
					<th width="100px">ACTION</th>
				</tr>
				<tbody>
					
				<?php 
				$i=1;
				foreach ($videos as $key) {
				 	# code...
				 	if(!empty($key->thumbnail)){
				 		$img = $key->thumbnail;
				 	}else{
				 		$img = site_url('image/r/no-thumbnail.jpg');
				 	}
				 	echo "<tr id='vid_$key->video_detail_id'>
				 		<td>$i</td>
				 		<td>$key->video_detail_id</td>
				 		<td><img src='$img'/ style='height:100px;width:100px;'></td>
				 		<td>$key->title</td>
				 		<td>".$this->auto_m->video_status($key->status)	."</td>
				 		<td><a href='video/edit/$key->video_detail_id' class='btn btn-sm'><i class='fa fa-edit'></i></a> <a href='#' onClick='remove($key->video_detail_id)' class='btn btn-sm'><i class='fa fa-remove'></i></a> </td>
				 		</tr>";
				 		$i++;
				 } ?>
				</tbody>

			</table>
			</div>
		</div>
	</div>
</div>





<!-- - MODALS - - - -->

<div id="modalvideo" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">NEW VIDEO</h4>
      </div>
      <div class="modal-body">
        <p><div class="form-group" style="padding:10px;">
			<div class="with-error"></div></div>
        <form class="form" id="frmvideo"  method="post" action="video/addvideo" enctype="multipart/form-data">

        	<div class="anime-col-md-6" >
        		<div class="form-group">
        			<label for="title">Title</label>
        			<input type="text" class="form-control" id="title" name="title" required />
        		</div>

        		<div class="form-group">
        			<label for="title">Synopsis</label>
        			<textarea class="form-control" id="synopsis" name="synopsis" ></textarea>
        		</div>

        		<div class="form-group">
        			<label for="title">Genre</label>
        			<textarea class="form-control" id="genre" name="genre" ></textarea>
        		</div>

        		<div class="form-group">
        			<label for="title">Release date</label>
        			<input type="date" class="form-control" id="release_date" name="release_date" />
        		</div>

        		<div class="form-group">
        			<label for="title">Countdown start date</label><br/>
        		<input type="date" name="countdown_date" id="countdown_date" placeholder="2018/06/05" class="form-control" style="width:200px;display:inline-block;" value="<?=isset($cover_page->released_date) ? date('Y-m-d',strtotime($cover_page->released_date)) : "2018-06-12";?>">
				<input type="time" name="countdown_time" id="countdown_time" placeholder="12:00:00" class="form-control" style="width:163px;display:inline-block;" value="<?=isset($cover_page->released_date) ? date('H:i:s',strtotime($cover_page->released_date)) : "12:00:00";?>"> 
			
        		</div>

			<div class="form-group hidden">
				<label class="title">Expired date</label>
				<span class="form-control"  id="sexpired_date" style="width:200px;display:inline-block;"><?=isset($cover_page->released_date) ? date('Y-m-d',strtotime($cover_page->released_date)) : "2018-06-12";?></span>
				<span class="form-control"  id="sexpired_time"  style="width:100px;display:inline-block;"><?=isset($cover_page->released_date) ? date('h:m:s',strtotime($cover_page->released_date)) : "12:00:00";?></span>
				<input  type="hidden"  id="expired_date"  name="expired_date" placeholder="2018/06/12" class="form-control" style="width:200px;display:inline-block;" value="<?=isset($cover_page->released_date) ? $cover_page->released_date : "2018/06/12";?>">
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
					<option value="1">Anime</option>
					<option value="2">Movies</option>
					<option value="3">Asian series</option>
					<option value="4">Others</option>
				</select>
			</div>
			<br/>
        	</div>
        	<div class="anime-col-md-4" >
        	<div class="form-group">
        		
        	<label>Select image</label>
        	<input class="btn alert-info" type="file" name="uploadthumb" id="uploadthumb"  accept="image/*" />
        	
        	</div>
        	<div class="form-group">
        		
        	<input class="form-control" type="url" name="thumbnail" id="thumbnail" placeholder="Enter image link here (optional)" />
        	
        	</div>

        	<div class="form-group">
        		
        	<input	type="button" id="btnupload" name="btnupload" value="Upload" class="btn btn-default" style="min-width:75px;" />
        	</div>
        	<div class="form-group">
        		<div class="preview-img"><img src="<?=site_url('image/r/no-thumbnail.jpg')?>" class="thumbnail" id="imgpreview"></div>
        	</div>
        	<div class="form-group">
        	<button class="btn btn-info" id="btnsave" type="submit" style="min-width:75px;">Save</button>
        	<button class="btn btn-warning" id="btncancel" type="button" style="min-width:75px;">Cancel</button>
        	</div>


        	</div>

			<div class="progress">
				<div class="progress-bar" role="progressbar"></div>
			</div>

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
	$('#frmvideo').on('submit',function(){

		var data = $(this).serialize();
		$.ajax({
			data: data,
			url: 'video/addvideo',
			type: 'post',
			dataType: 'json',
			success: function(response){
				if(response.success == true){
					$(".with-error").html(success(response.message));

					setTimeout(function(){

					$('#modalvideo').modal('hide');

					},5000);
				}
	            else
	            {
	                $(".with-error").html(error(response.message));
	            }
			}
		})
		return false;
	});

	$('#btnupload').on('click',function(){
		upload('<?=site_url()?>/image/upload','uploadthumb','imgpreview','thumbnail');
	});


</script>


<script type="text/javascript">

	function remove(id){

				$.ajax({
			data: 'detail_id='+id,
			url: 'video/remove',
			type: 'post',
			dataType: 'json',
			success: function(response){
				if(response.success == true){
					$(".with-error").html(success(response.message));

					$('#vid_'+id).remove();
				}
	            else
	            {
	                $(".with-error").html(error(response.message));
	            }
			}
		})
		//console.log(id);
	}
	//$('#modalvideo').modal('show');

	function covertdate (tt) {
	// body...

	//var tt = document.getElementById('release_date').value;

    var date = new Date(tt);
    var newdate = new Date(date);

    newdate.setDate(newdate.getDate() + 7);

    var dd = newdate.getDate();
    var mm = newdate.getMonth() + 1;
    var y = newdate.getFullYear();



	if(mm.toString().length < 2){
		mm = '0'+mm;
	//var formattedTime =  '0' + hours + ':'  + minutes + ':' + seconds;
	}

	if(dd.toString().length < 2){
		dd = '0'+dd;
	//var formattedTime =  '0' + hours + ':'  + minutes + ':' + seconds;
	}


    var someFormattedDate = y + '/' + mm + '/' + dd;
    return someFormattedDate;
}

function convertime (tt) {
	// body...
	date = new Date(tt);

	// hours part from the timestamp
	var hours = date.getHours();

	// minutes part from the timestamp
	var minutes = date.getMinutes();

	// seconds part from the timestamp
	var seconds = date.getSeconds();

	// will display time in 10:30:23 format

	if(hours.toString().length < 2){
		hours = '0'+hours;
	//var formattedTime =  '0' + hours + ':'  + minutes + ':' + seconds;
	}

	if(minutes.toString().length < 2){
		minutes = '0'+minutes;
	//var formattedTime =  '0' + hours + ':'  + minutes + ':' + seconds;
	}

	if(seconds.toString().length < 2){
		seconds = '0'+seconds;
	//var formattedTime =  '0' + hours + ':'  + minutes + ':' + seconds;
	}

	var formattedTime =  hours + ':'  + minutes + ':' + seconds;
	//}
	//console.log(formattedTime);
	return formattedTime;
}

window.onload = function(){
	$('#countdown_date').blur();
	$('#countdown_time').blur();
}


$('#release_date').on('blur',function(){
	var dd = $(this).val();
	if(dd.length <= 0){
		return false;
	}
	var xp = covertdate(dd);


	if(xp == 'NaN/NaN/NaN'){
		//alert('Invalid time.')
		$(this).notify('Invalid date.',{position:'top right',className:'error'});
		$(this).focus();

		tosubmit = false;
		return false;
	}

		tosubmit = true;

	//console.log(expired_date);
	$('#expired_date').val(xp); 
	$('#sexpired_date').html(xp); 
})

$('#release_time').on('blur',function(){
	var dd =$('#release_date').val()
	var tt = $(this).val();
	if(tt.length <= 0){
		return false;
	}
	var dt = dd + ' ' + tt;
	
	var xt = convertime(dt);
	//console.log(xt);

	if(xt == 'NaN:NaN:NaN'){
		//alert('Invalid time.')
		$(this).notify('Invalid time.',{position:'top right',className:'error'});
		$(this).focus();

		tosubmit = false;
		return false;
	}

		tosubmit = true;
	$('#expired_time').val(xt); 
	$('#sexpired_time').html(xt); 

	//var nxt = xt.toUTCString();

	//console.log(xt)

	$('.countdown').attr('value', dt + ' ' + xt);
	});
</script>