<div class="anime panel">
<div class="panel-body">
                <h4>New series</h4>
<div class="with-error"></div>
        <form class="form" id="frmnewseries"  method="post" action="add_series" enctype="multipart/form-data">

        	<div class="col-md-7" >

                        <div class="form-group">
                                <label>Video category</label>
                                <select class="form-control" id="type" name="type">
                                        <option value="1">Anime</option>
                                        <option value="2">Movies</option>
                                        <option value="3">Asian series</option>
                                        <option value="4">Others</option>
                                </select>
                        </div>
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
        	<div class="col-md-5" >
        	    
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
        		<div class="preview-img hidden"><img src="<?=site_url('image/r/no-thumbnail.jpg')?>" class="thumbnail" id="imgpreview"></div>
        	</div>
        	<div class="form-group">
        	<button class="btn btn-info" id="btnsave" type="submit" style="min-width:75px;">Save</button>
        	<button class="btn btn-warning" id="btncancel" type="button" style="min-width:75px;">Cancel</button>
        	</div>


        	</div>


        </form>
</div>
</div>