<?php if(isset($list_video) && is_array($list_video)): ?>
<div class="panel">
	<div class="panel-body">
		<form class="form" action="<?=site_url()?>/home/search">
			<input class="form-control" type="text" name="q" id="q" style="padding-right:50px"><button type="submit" class="btn btn-info pull-right" style="display:inline;margin-top:-40px;"><i class="fa fa-search"></i></button>
		</form>
	</div>
	<div class="panel-body">
	<h3>List videos</h3>
	<table class="table">
		<?php $i=0; ?>
	<?php foreach ($list_video as $key): ?>
		<?php $i++; ?>
		<tr id="video_<?=$key->video_id?>">
			<td><?=$i?></td>
			<td><?=$key->video_id?></td>
			<td><?=$key->title?></td>
			<td></td>
			<td><button class="btn btn-danger btn-sm" onclick="remove(<?=$key->video_id?>)"><i class="fa fa-remove"></i></button></td>
		</tr>
	<?php endforeach ?>

	</table>
</div>
</div>
	

<?php endif ?>