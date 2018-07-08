<div class="anime">
	<div class="anime-body">
				<div class="heading heading-default"><h4>PLAYLIST</h4> 
				<div class="line-divider"></div>
				<div style="margin-top:-10px;" class="anime-list-pagination-top">
				
				
				</div>
				</div>
				<div class="col-md-12">
					
				<ul class="list-group" >
				
				<a class="list-group-item col-xs-4" href="#ongoing" onclick="playlist(1)" style="border-radius:0;text-decoration:none;" class="item-4">ONGOING</a>
				<a class="list-group-item col-xs-4" href="#incoming" onclick="playlist(2)" style="border-radius:0;text-decoration:none;" class="item-4">INCOMING</a>
				<a class="list-group-item col-xs-4" href="#completed" onclick="playlist(3)" style="border-radius:0;text-decoration:none;" class="item-4">COMPLETED</a>
				
				</ul>

					<select class="form-control" id="type" name="type" >
						<option value="1">Anime</option>
						<option value="2">Movies</option>
						<option value="3">Tv Series</option>
					</select>
					<br/>
				</div>
				<div class="playlist-block">
					
				<?php foreach ($playlist as $key): ?>

				 	<?php $slug = site_url('watch/c/'.$key->slug); ?>
					<div class="anime-list"><a href="<?=$slug?>"><?=$key->title?></a></div>
				<?php endforeach ?>
				</div>
				<br/>
				<br/>
	</div>

	<div class="anime-sidebar">
		 				<div class="video-anime">
				<div class="heading heading-default"><h4>RECENT RELEASE</h4></div>
				<?php foreach ($list_mostviews as $key): ?>
					
				<a class="cover-contents item-2 item-2-s item-1-xs" data-slug="<?=$key->slug?>">
					<div class="cover-countdown"></div>
					<div class="cover-photo" data-cover="<?=$key->thumbnail?>"></div>
					<div class="cover-title" style="font-size:11px;"><?=$key->title?></div>

				</a>
				<?php endforeach ?>

				</div>
	</div>
</div>

<script type="text/javascript">
	/*
$('.cover-contents').on('click',function(){
	var slug = $(this).data('slug');
	window.location = '<?php echo site_url("watch/v/'+slug+'")?>';
})*/

var base_url = '<?php echo base_url();?>';

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

	var jsonurl = base_url+'playlist/all/'+type+'/'+status;
			$.getJSON(jsonurl, function(data) {
			      

				if(data.success == true){
					$('.playlist-block').html('');

				  $.each(data.message, function(k, v) {
				  	var div = '';

				    var status = video_status(v.status);
				    
				  	div += '<div class="anime-list">';
				  	div += '<a href="'+base_url+'/watch/c/'+v.slug+'">'+v.title+'</a>';
				  	div += '</div>';

					$('.playlist-block').append(div);
				  	 });
					
				}else{

					$('.playlist-block').html('');
				}

			}).fail(function() { 
			      	console.clear();
			      	console.log('Playlit: Error 500!');
					$('.playlist-edit tr').remove();
					$('.list-episode-here').html('');
			}); 


}


    function video_status(status)
    {
    	/*
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
        return status_name;*/
    }
</script>