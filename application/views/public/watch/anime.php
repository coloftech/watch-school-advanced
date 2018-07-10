	<div class="anime">
	<div class="anime-body">
	<style type="text/css">
	.pagination > li > a{padding:5px 10px;}</style>
	<div class="heading">
		<ul class="pagination">
		<li><a href="/watch/anime/NO">#</a></li>
		<?php $l='A';
			for ($i='A'; $i != 'AA' ; $i++) { 
				# code...
				echo "<li><a href='/watch/anime/".$i."'>$i</a></li>";
			}

		 ?>
	</ul>

	</div>
	<?php foreach ($list_video as $key): ?>
				<div class="item-6 cover-contents" data-slug="<?=$key->slug?>">
					<div class="cover-countdown"></div>
					<div class="cover-photo" data-cover="<?=$key->thumbnail?>"><!--img src="<?=$key->thumbnail?>"--></div>
					<div class="cover-title"><?=$key->title?></div>

				</div>
	<?php endforeach  ?>
</div>
</div>