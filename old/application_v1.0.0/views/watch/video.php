
<div class="post-index">
    <?php if(isset($list_video) && is_array($list_video)): ?>

<div class="col-md-12  content anime-latest">
	
<div class="panel">
	<div class="panel-body">
		<form class="form" action="<?=site_url()?>/home/search">
			<input class="form-control" type="text" name="q" id="q" style="padding-right:50px"><button type="submit" class="btn btn-info pull-right" style="display:inline;margin-top:-34px;"><i class="fa fa-search"></i></button>
		</form>
	</div>
	<div class="panel-body">
	<h3>Latest videos </h3>
	<?php foreach ($list_video as $key): ?>
		<div class="col-lg-3 col-sm-4 col-xs-6  content-trending">
			<div class="panel">
				<div class="panel-body trending-body">
					<a href="<?=site_url("watch/v/$key->slug")?>" title="Click the picture/link to show the list."><?php if (!empty($key->thumbnail)): ?>
						<img src="<?php echo $key->thumbnail;?>"   class="img-thumbnail" >
					<?php else: ?>

						<img src="<?php echo base_url('public/images/default-img.jpg');?>"  class="img-thumbnail" >
					<?php endif ?></a>
					<a href="<?=site_url("watch/v/$key->slug")?>" title="<?=$key->title ?>"><?=$key->title ?></a>
				</div>
				

			</div>
		</div>
	<?php endforeach ?>
</div>
</div>
</div>
	

<?php endif ?>

</div>