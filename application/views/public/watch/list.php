<div class="post-index">
	<div class="panel" style="margin:5px;padding-left:15px;">
				<div class="heading heading-default"><h4>ANIME/VIDEO LISTING</h4></div>
						<form class="form" action="<?=site_url()?>/home/search">
			<input class="form-control" type="text" name="q" id="q" style="padding-right:50px"><button type="submit" class="btn btn-info pull-right" style="display:inline;margin-top:-34px;"><i class="fa fa-search"></i></button>
		</form><br/>
			
	<?php foreach ($list_video as $key): ?>
				<div class="item-6 cover-contents" data-slug="<?=$key->slug?>">
					<div class="cover-countdown"></div>
					<div class="cover-photo" data-cover="<?=$key->thumbnail?>"><!--img src="<?=$key->thumbnail?>"--></div>
					<div class="cover-title"><?=$key->title?></div>

				</div>
	<?php endforeach ?>
	</div>
</div>

<script type="text/javascript">
	$(function(){
 
  $('.cover-photo').each(function(){
    $(this).attr('data-cover',function(e){

          var url = $(this).data('cover');

          if(url.length <= 0){
          	url = '<?php echo base_url("assets/images/default.jpg");?>';
          }
          
      $(this).css('background','url('+url+')')
      		.css('background-size','100% 100%')
      		.css('background-repeat','no-repeat');
    }); 

  });
});


</script>