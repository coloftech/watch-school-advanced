<div class="anime">
	<div class="item-1 content">
		<div class="content-body content-anime item-2">
			<header class="heading heading-black item-1 "><h4>ANIME LIVE CHART</h4></header>
			<main class="item-1">
				<?php if (!empty($livecharts) && is_array($livecharts)): ?>
	<?php $anime_total = 0; ?>
	<?php foreach ($livecharts as $key): ?>
		<?php 

			$expired_onD = date('Y/m/d',strtotime($key->live_chart_date_end));
			$expired_onT = date('H:i:s',strtotime($key->live_chart_date_end));

						if($currentD == $expired_onD && $currentT > $expired_onT){
							$countdown = '<label>Now showing</label>';
						}else{
							$countdown = '<label class="countdown" value="'.$key->live_chart_date_end.'">'.$key->live_chart_date_end.'</label>';
						}

						$next = $this->auto_m->latestepisode($key->video_detail_id);
					 		$episode_url = '';
					 		$episode = '';
					 	if(is_object($next)){
					 		$episode_url = $next->slug;
					 		$episode = $next->episode;

					 	}
					 	$episode = $episode+0;
		 ?>
		<a class="cover-contents item-4 item-2-s item-1-xs" href="<?=site_url("watch/c/$key->slug/$episode")?>">
		<div class="cover-countdown"><?=$countdown?></div>
		<div class="cover-photo" data-cover="<?=$key->thumbnail?>">
			
		</div>
		<div class="cover-title"><?=$key->title?></div>
		</a>
	<?php endforeach ?>
	<?php endif ?>
			</main>

		</div>

		<div class="content-body content-asian item-4">
			<header class="heading heading-black item-1 "><h4>ASIAN/DRAMA LIVE CHART</h4></header>
			<main class="item-1">
				<?php if (!empty($livecharts3) && is_array($livecharts3)): ?>
	<?php $anime_total = 0; ?>
	<?php foreach ($livecharts3 as $key): ?>
		<?php 

			$expired_onD = date('Y/m/d',strtotime($key->live_chart_date_end));
			$expired_onT = date('H:i:s',strtotime($key->live_chart_date_end));

						if($currentD == $expired_onD && $currentT > $expired_onT){
							$countdown = '<label>Now showing</label>';
						}else{
							$countdown = '<label class="countdown" value="'.$key->live_chart_date_end.'">'.$key->live_chart_date_end.'</label>';
						}

						$next = $this->auto_m->latestepisode($key->video_detail_id);
					 		$episode_url = '';
					 		$episode = '';
					 	if(is_object($next)){
					 		$episode_url = $next->slug;
					 		$episode = $next->episode;

					 	}
					 	$episode = $episode+0;
		 ?>
		<a class="cover-contents item-2 item-2-s item-1-xs" href="<?=site_url("watch/c/$key->slug/$episode")?>">
		<div class="cover-countdown"><?=$countdown?></div>
		<div class="cover-photo" data-cover="<?=$key->thumbnail?>">
			
		</div>
		<div class="cover-title"><?=$key->title?></div>
		</a>
	<?php endforeach ?>
	<?php endif ?>
			</main>

		</div>


		<div class="content-body content-asian item-4">
			<header class="heading heading-black item-1 "><h4>RECENTLY ADDED</h4></header>
			<main class="item-1">
				<?php if (!empty($list_mostviews) && is_array($list_mostviews)): ?>
				<?php /**/ foreach ($list_mostviews as $key): ?>
					
				<a class="cover-contents item-2 item-2-s item-2-xs" href="<?=site_url('watch/v/'.$key->slug)?>" data-slug="<?=$key->slug?>">
					<div class="cover-countdown"></div>
					<div class="cover-photo" data-cover="<?=$key->thumbnail?>"></div>
					<div class="cover-title" style="font-size:11px;"><?=$key->title?></div>

				</a>
				<?php endforeach /**/ ?>
			<?php endif ?>
			</main>

		</div>


	</div>
</div>