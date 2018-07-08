<div class="anime">
	<div class="anime-body">
				<div class="heading heading-default"><h4>VIDEO LIBRARY</h4> 
				<div class="line-divider"></div>
				</div>
				<br/>


	<?php foreach ($list_video as $key): ?>


				<div class="item-4 item-2-s item-1-xs cover-contents" data-slug="">
					<div class="cover-countdown"></div>
					<a href="<?=site_url('watch/v/'.$key->slug)?>" class="cover-photo" data-cover="<?=$key->thumbnail?>"><!--img src="<?=$key->thumbnail?>"--></a>
					<div class="cover-title"><?=$key->title?></div>

				</div>
	<?php endforeach ?>
		<div class="item-1">
			<center>
			<?php echo $pagination; ?>
			</center>
		</div>
				
	</div>

	<div class="anime-sidebar">
		 				<div class="video-anime">
				<div class="heading heading-default"><h4><?php echo isset($sidebar_title) ? $sidebar_title : 'RECENT RELEASE';?></h4></div>
				<?php if (isset($list_mostviews)): ?>
					
				<?php foreach ($list_mostviews as $key): ?>
					
				<div class="anime-col-6 anime-col-sm-6 cover-contents" data-slug="<?=$key->slug?>">
					<div class="cover-countdown"></div>
					<div class="cover-photo" data-cover="<?=$key->thumbnail?>"></div>
					<div class="cover-title" style="font-size:11px;"><?=$key->title?></div>

				</div>
				<?php endforeach ?>
				<?php endif ?>
				
				
				<?php if (isset($playlist)): ?>
					
				<?php foreach ($playlist as $key): ?>

				 	<?php $slug = site_url('watch/c/'.$key->slug); ?>
					<div class="anime-list item-1" style="width:97%;"><a href="<?=$slug?>"><?=$key->title?></a></div>
					
				<?php endforeach ?>
				
				<?php endif ?>

				</div>
	</div>
</div>

<script type="text/javascript">
	/*
$('.cover-contents').on('click',function(){
	var slug = $(this).data('slug');
	window.location = '<?php echo site_url("watch/v/'+slug+'")?>';
})*/

var site_url = '<?php echo site_url()?>';

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


function playlist(status){
	var type = $('#type').val();
	var jsonurl = site_url+'/playlist/all/'+type+'/'+status;
			$.getJSON(jsonurl, function(data) {
			      

				if(data.success == true){
					$('.playlist-block').html('');

				  $.each(data.message, function(k, v) {
				  	var div = '';

				    var status = video_status(v.status);
				    
				  	div += '<div class="anime-list">';
				  	div += '<a href="'+site_url+'/watch/c/'+v.slug+'">'+v.title+'</a>';
				  	div += '</div>';

					$('.playlist-block').append(div);
				  	 });
					/*
					$('.playlist-tbody tr').remove();
					var i = 1;
				  $.each(data.message, function(k, v) {
				    //console.log(v.title);
				    //console.log(v.status);
				    var status = video_status(v.status);
				    var tr = '<tr>';
				    tr += '<td>'+i+'</td>';
				    tr += '<td><a href="'+site_url+'/watch/c/'+v.slug+'"><img style="height:100px;width:100px;" src="'+v.thumbnail+'"/></a></td>';
				    tr += '<td>'+v.title+'</td>';
				    tr += '<td>'+v.synopsis+'</td>';
				    tr += '<td>'+status+'</td>';
				    tr += '</tr>';
					$('.playlist-tbody').append(tr);
					i++;
				    //$('.playlist-edit').append('<tr id="tr_'+v.video_id+'"><td>'+v.video_id+'</td><td>'+v.title+'</td><td>'+v.episode+'</td><td><button class="btn btn-sm btn-danger " onclick="removetoplaylist('+v.video_id+')"><i class="fa fa-remove"></i></button></td></tr>');

					//$('.list-episode-here').append('<li><a target="_blank" href="'+site_url+'/watch/v/'+v.video_id+'">Episode '+v.episode+'</a> <i style="" class="font-10">'+v.title+'</i></li>');
							  });
				  */
				}else{

					$('.playlist-block').html('');
				}

			}).fail(function() { 
			      //console.log( "error" ); 
			      	console.clear();
			      	console.log('Playlit: Error 500!');
					$('.playlist-edit tr').remove();
					$('.list-episode-here').html('');
			}); 
}


    function video_status(status)
    {
    	//console.log(status);
    	var status_name = '';
        switch (parseInt(status)) {
            case 1:
            //console.log(status);
            status_name = 'Ongoing';
                break;
            case 2:
            status_name = 'Incoming';
                break;
            case 3:
            status_name = 'Completed';
                break;
            
            default:
            status_name = 'Unknown';
                break;
        }
        return status_name;
    }
</script>