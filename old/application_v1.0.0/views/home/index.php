<div class="post-index">
	<div class="col-md-8 content anime-latest">
		<div class="panel">

			<div class="panel-heading"><div class="col-md-12" style="margin:0;padding:0;"><div class="col-md-4 col-sm-4 col-xs-12"  style="margin:0;padding:0;"><H4>TRENDING ANIME</H4></div><div class="col-md-8 col-sm-8 col-xs-12"><form class="form" action="<?=site_url()?>/home/search">
			<input class="form-control" type="text" name="q" id="q" style="padding-right:50px"><button type="submit" class="btn btn-info pull-right" style="display:inline;margin-top:-34px;"><i class="fa fa-search"></i></button>
		</form></div></div></div>

			<div class="panel-body">
				
		<?php if (isset($list_mostviews) && is_array($list_mostviews)): ?>
			<?php foreach ($list_mostviews as $key): ?>
				<div class="col-md-4 col-sm-6 col-xs-6 content-trending">
				<div class="panel">
					<div class="panel-body trending-body">
					<a href="<?=site_url("watch/v/$key->slug")?>" title="<?=$key->title ?>"><?php if (!empty($key->thumbnail)): ?>
						<img src="<?php echo $key->thumbnail;?>"   class="img-thumbnail" >
					<?php else: ?>

						<img src="<?php echo base_url('public/images/default-img.jpg');?>"  class="img-thumbnail" >
					<?php endif ?></a>
					<a href="<?=site_url("watch/v/$key->slug")?>" title="<?=$key->title ?>"><?=$key->title.' ('.$key->episode_number.')' ?></a>
				</div>
				</div>
			</div>		
			<?php endforeach ?>
			
		<?php endif ?>

			</div>
		</div>
	</div>











	<!-- end of anime latest -->









	<div class="col-md-4 sidebar anime-live-chart">
		
		<div class="panel">
			<div class="panel-heading"><H4>LIVE CHART</H4></div>
			<div class="panel-body">
				
<?php if(isset($livechart) && is_array($livechart)): ?>
	<?php foreach ($livechart as $key): ?>
		<div class="col-md-12 col-xs-12 sidebar-content">
			<div class="col-md-4 col-sm-5 col-xs-5 anime-img" data-img="<?=$key->thumbnail?>"><div class="photo"></div></div>
			<div class="col-md-8 col-sm-7 col-xs-7 anime-title">
			<?php $slug = $this->auto_m->getLatest($key->video_id); ?>
					 <a class="btn btn-default btn-sm pull-right" href="<?=site_url('watch/v/'.$slug)?>"><i class="fa fa-sign-out"></i></a>
					 <?php 
					 
					 	$currentD = date('Y/m/d');

						$currentT = date('H:i:s');

						$expired_onD = date('Y/m/d',strtotime($key->next_episode));

						$expired_onT = date('H:i:s',strtotime($key->next_episode));

						//$countdown = date('m/d/Y H:i:s',strtotime($key->next_episode));
						//$countdown =  gmdate('d/m/Y H:i:s', strtotime($key->next_episode));
						$given = new DateTime("2014-12-12 14:18:00");
						$countdown = $given->format("m/d/Y H:i:s");// . "\n"; // 2014-12-12 14:18:00 Asia/Bangkok

						//$given->setTimezone(new DateTimeZone("UTC"));
						//$countdown =  $given->format("m/d/Y H:i:s e");// . "\n"; // 2014-12-12 07:18:00 UTC
						
						if($key->status == 0){

						if($currentD == $expired_onD && $currentT > $expired_onT){
							echo '<label>Now showing</label>';
						}else{
							?>
						
					 <label class="countdown" value="  value='<?=isset($countdown) ? $countdown : "";?>"></label>
							<?php
						}
						}else{
						echo "<label>Season completed</label>";
						}
					 ?>
					 <br/><?=$key->cover_title?></div>
		</div>
	<?php endforeach ?>


<script type="text/javascript">
	/*
	$(function(){
	$('.countdown').each(function(){
		$(this).countdown($(this).attr('value'), function(event) {
			var ed = event.strftime('%D');
    		var d = 1;
    		var DH = '';
    		if(ed < d){

      			DH = event.strftime('%H:%M:%S')
      		}else{
      	
      			DH = event.strftime('%D days %H:%M:%S')
     		 }
    	$(this).text(DH);
		});
	});


	$('.anime-img').each(function(){
		$(this).attr('data-img',function(e){

					var img = document.createElement('img');
					img.src = $(this).data('img');
			$(this).find('.photo').html(img);
		});
		//$(this).child().html('')
		//$('.photo').html('<img src="'+url+'" />');

	});
});
*/

</script>
<?php endif ?>
			</div>
		</div>

	</div>
</div>