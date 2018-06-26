<div class="anime">
	<div class="anime-body">
				<div class="heading heading-default"><h4>SEARCH VIDEO</h4> <div class="pull-right" style="margin-top:-40px;"><label id="counter"></label></div></div>
		 
		<form class="form" action="<?=site_url()?>/home/search" style="padding:10px;">
			<input class="form-control" type="text" name="q" id="q2" style="padding-right:50px" value="<?php echo ($this->input->get('q')); ?>"><button type="submit" class="btn btn-info pull-right" style="display:inline;margin-top:-34px;"><i class="fa fa-search"></i></button>
		</form>

		<table class="table">
			
		</table>
	</div>

	<div class="anime-sidebar">
		 				<div class="video-anime">
				<div class="heading heading-default"><h4>RECENT RELEASE</h4></div>

			<?php if (!empty($list_mostviews) && is_array($list_mostviews)): ?>
				<?php /**/ foreach ($list_mostviews as $key): ?>
					
				<div class="anime-col-6 anime-col-sm-6 cover-contents" data-slug="<?=$key->slug?>">
					<div class="cover-countdown"></div>
					<div class="cover-photo" data-cover="<?=$key->thumbnail?>"></div>
					<div class="cover-title" style="font-size:11px;"><?=$key->title?></div>

				</div>
				<?php endforeach /**/ ?>
			<?php endif ?>
				</div>
	</div>
</div>

<script type="text/javascript">
	window.onload = function(){
		var query = '<?php echo ($this->input->get("q")); ?>';
		//console.log(query);
		search(query);
		$('.formSearch').addClass('hidden');
	}
	$('#q2').on('keyup',function(){
		var query = $(this).val();
		console.clear()
		console.log(query);
		search(query);
	})

	$('#q').on('keyup',function(){
		var query = $(this).val();
		//console.clear()
		search(query);
	})

	function search(q){

			  if(q.length < 2){
			    return false;
			  }

			  $('.table tr').remove();
			  $.ajax({
			    data: 'q='+q,
			    type: 'post',
			    dataType: 'json',
			    url:'<?php echo site_url("playlist/search");?>',
			    
			    success: function(response){
			      console.clear();
			      console.log(response);
			      var counter = 0;
			      if(response.success == true){

			          $.each(response.message, function(k, v) {
			            
			            var surl = '<?php echo site_url("watch/v/'+v.slug+'");?>';
			            var tr = '<tr>';
			            tr += '<td>';
			            tr += '<label>';
			            tr += '<a href="'+surl+'">'+v.title+'</a>';
			            tr += '</label>';
			            tr += '<p>'+v.synopsis+'</p>';
			            tr += '</td>';
			            tr += '</tr>';

			           
			      			$('.table').append(tr);

			          counter++;
			          });
			          $('#counter').html('Records: <span style="color:red">'+counter+'</span>');
			    }else{
			      $('.table tr').remove();
			    }


			    },
			        error: function(xhr, status, error) {
			          //var err = eval("(" + xhr.responseText + ")");
			          console.log(xhr.responseText);

			        }
			  });

	}


</script>