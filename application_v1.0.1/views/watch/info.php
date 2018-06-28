<div class="anime">
	<div class="anime-body">
				<div class="heading heading-default"><h4>PLAYLIST </h4> </div>
				<?php if (isset($details) && is_array($details)): ?>
					<?php $details = $details[0]; ?>
					<div class="col-md-4">
						
				<div class="cover-photo" data-cover="<?=$details->thumbnail?>"></div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
									<div class="fb-share-button" 
								    data-href="<?=$link;?>" 
								    data-layout="button_count">
								  </div>
						</div>
						<div class="form-group">
							<h3><?=$title?> 
				<?php if ($this->authentication->is_loggedin()	): ?>
				<?php
                    $id = $this->authentication->read('identifier');
                    //echo "$id";
                    if($id == 1){
                      echo '<a href="'.site_url('video/edit/'.$details->video_detail_id).'" class="btn"><i class="fa fa-edit">
                          </i></a>';
                    }
                    

                    ?>
				<?php endif ?></h3>
						</div>
						<div class="form-group">
						<div class="synopsis">
							<label>SYNOPSIS</label>
							<p style="padding-left:5px;"><?=$details->synopsis?></p>
							
						</div>
						</div>

						<div class="form-group">
						<div class="genre">
							<label>GENRE</label>
							<p style="padding-left:5px;"><?=$details->genre?></p>
							
						</div>
						</div>

						<div class="form-group">
						<div class="genre">
							<label>STATUS</label>
							<p style="padding-left:5px;"><?=$this->auto_m->video_status($details->status)?></p>
							
						</div>
						</div>

						<div class="form-group">
						<div class="episodes">
							<label>EPISODE</label>
							<p style="padding-left:5px;">
								<?php if (isset($episodes) && is_array($episodes)): ?>
									<ul class="pagination">
										
									<?php foreach ($episodes as $key): ?>
										<?php $slug = $this->auto_m->getslug($key->video_id);  ?>
										<li><a href="<?=site_url('watch/v/'.$slug)?>">Ep - <?=$key->episode?></a></li>
									<?php endforeach ?>
									</ul>
								<?php endif ?>
							</p>
						</div>
						</div>

					</div>

				<?php endif ?>

	</div>

	<div class="anime-sidebar">
		 				<div class="video-anime">
				<div class="heading heading-default"><h4>NEW UPLOAD</h4></div>
				<?php if(isset($list_mostviews)): ?> 

				<?php foreach ($list_mostviews as $key): ?>
					
				<div class="anime-col-6 anime-col-sm-6 cover-contents" data-slug="<?=$key->slug?>">
					<div class="cover-countdown"></div>
					<div class="cover-photo" data-cover="<?=$key->thumbnail?>"></div>
					<div class="cover-title" style="font-size:11px;"><?=$key->title?></div>

				</div>
				<?php endforeach ?>

				<?php endif ?>

				</div>
	</div>
</div>

<script type="text/javascript">
	
$(function(){
 
  $('.cover-photo').each(function(){
    $(this).attr('data-cover',function(e){

          var url = $(this).data('cover');

          if(url.length <= 0){
          	url = '<?=base_url("assets/images/default.jpg")?>';
          }
          
      $(this).css('background','url('+url+')')
      		.css('background-size','100% 100%')
      		.css('background-repeat','no-repeat');
    }); 

  });
});
</script>