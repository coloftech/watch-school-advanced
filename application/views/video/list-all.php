<div class="anime panel">
<div class="panel-body">
		<h4>List all series</h4>
			<div class="with-error"></div>
			<div class="anime-heading">
				<ul class="pagination list-anime-paging pull-left">
					<li><a href="?s=a&e=z" class="list-anime-inline-menu">ALL</a></li>
					<li><a href="?s=a&e=e" class="list-anime-inline-menu">A-E</a></li>
					<li><a href="?s=f&e=j" class="list-anime-inline-menu">F-J</a></li>
					<li><a href="?s=k&e=o" class="list-anime-inline-menu">K-O</a></li>
					<li><a href="?s=p&e=t" class="list-anime-inline-menu">P-T</a></li>
					<li><a href="?s=u&e=z" class="list-anime-inline-menu">U-Z</a></li>
					<li><a href="?s=0&e=9" class="list-anime-inline-menu">0-9</a></li>
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
				 		<td><a href='#video/edit/$key->video_detail_id'  class='btn btn-sm btn-edit-series' data-series='$key->video_detail_id'><i class='fa fa-edit'></i></a> <a href='#' onClick='remove($key->video_detail_id)' class='btn btn-sm'><i class='fa fa-remove'></i></a> </td>
				 		</tr>";
				 		$i++;
				 } ?>
				</tbody>

			</table>
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

			<br/>
        	</div>
        	<div class="anime-col-md-4" >
        	    
			<div class="form-group">
				<label>Video type</label>
				<select class="form-control" id="type" name="type">
					<option value="1">Anime</option>
					<option value="2">Movies</option>
					<option value="3">Asian series</option>
					<option value="4">Others</option>
				</select>
			</div>
			<div class="form-group">
				<label>Show to live chart?</label>
				<select class="form-control" id="islivechart" name="islivechart">
					<option value="0">Yes</option>
					<option value="1">No</option>
				</select>
			</div>
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
