<div class="anime">
	<div class="anime-body">
				<div class="heading heading-default"><h4>LIVE CHART</h4></div>
		 

<?php foreach ($livechart as $key): ?>
	<?php $slug = $this->auto_m->getLatest($key->video_id) ?>

	<div class="anime-col-3 anime-col-md-6  anime-col-sm-6  cover-contents"  data-slug="<?=$slug?>">
		<div class="cover-countdown"> <?php 
					 
					 	$currentD = date('Y/m/d');

						$currentT = date('H:i:s');

						$expired_onD = date('Y/m/d',strtotime($key->next_episode));

						$expired_onT = date('H:i:s',strtotime($key->next_episode));
						if($key->status == 0){

						if($currentD == $expired_onD && $currentT > $expired_onT){
							echo '<label>Now showing</label>';
						}else{
							?>
						
					 <label class="countdown" value="  value='<?=isset($key->next_episode) ? $key->next_episode : "";?>"><?=isset($key->next_episode) ? $key->next_episode : "";?></label>
							<?php
						}
						}else{
						echo "<label>Season completed</label>";
						}
					 ?></div>
					<div class="cover-photo-body"><img src="<?=$key->thumbnail?>"></div>
					<div class="cover-title"><?=$key->cover_title?></div>

	</div>
<?php endforeach ?>
	</div>

	<div class="anime-sidebar">
		 				<div class="video-anime">
				<div class="heading heading-default"><h4>NEW UPLOAD</h4></div>
				<?php foreach ($list_mostviews as $key): ?>
					
				<div class="anime-col-6 anime-col-sm-6 cover-contents" data-slug="<?=$key->slug?>">
					<div class="cover-countdown"></div>
					<div class="cover-photo"><img src="<?=$key->thumbnail?>"></div>
					<div class="cover-title"><?=$key->title?></div>

				</div>
				<?php endforeach ?>

				</div>
	</div>
</div>

<?php if ($is_countdown == true): ?>
	
  <script src="<?=base_url('assets/js/plugin/jquery.countdown-2.2.0/jquery.countdown.min.js')?>" type="text/javascript"></script>

<script type="text/javascript">
var browser = false;
			function checkBrowser(){
		    var c = navigator.userAgent.search("Chrome");
		    var f = navigator.userAgent.search("Firefox");
		    var m8 = navigator.userAgent.search("MSIE 8.0");
		    var m9 = navigator.userAgent.search("MSIE 9.0");
		    if (c > -1) {
		        browser = "Chrome";
		    } else if (f > -1) {
		        browser = "Firefox";
		    } else if (m9 > -1) {
		        browser ="MSIE 9.0";
		    } else if (m8 > -1) {
		        browser ="MSIE 8.0";
		    }
		    return browser;
		}

	$(function(){

		//if(checkBrowser() != false){
			//console.clear();

              	$('.countdown').each(function(){

					var timer = $(this).text();
					$(this).countdown(timer, function(event) {
			    	$(this).text(
			      	event.strftime('%D days %H:%M:%S')
			      );
					});
				});

		//}
           
});


</script>
<?php endif ?>
<script type="text/javascript">
	
$('.cover-contents').on('click',function(){
	var slug = $(this).data('slug');
	window.location = '<?php echo site_url("watch/v/'+slug+'")?>';
})
var tocount = new Date('2001-01-01T12:00:00Z'.replace(/\-/g,'\/').replace(/[T|Z]/g,' '));
console.log(tocount);
</script>