<div class="col-md-12 post-index">
	
<div class="col-md-9">

		
<?php if(isset($video) && isset($video->title)): ?>

<div class="panel">
	<div class="panel-body">
	
	<style type="text/css">
	.mirrors{
		display: block;
	}
	.mirrors .table-mirror tr td{
		color: #000;
		text-transform: uppercase;
	}

	.mirrors .table-mirror tr td.mirror-note{
		
	}
	.mirrors .table-mirror tr td.mirror-url{
		background-color: rgba(0,0,250,0.3);
		font-weight: bold;
	}
	.mirrors .table-mirror tr td.mirror-url:hover{
		background-color: #e5e5e5;
		color: #555555;
		cursor: pointer;
	}
	.post-index{
		min-width: 350px;
	}
	.embed-responsive{
	    border:solid 2px #000;
	}

	</style>
	<div class="mirrors">
		<table class="table table-hovered table-mirror">
		    
			<tr>
			<td class="mirror-note">MIRROR </td>
			<td class="mirror-url" data-mirror='<?=$video->slug?>'><?php echo $this->auto_m->mirror($video->source_id); ?></td>
					<?php if (isset($mirrors)): ?>

						<?php if (is_array($mirrors)): ?>
							<?php foreach ($mirrors as $m): ?>
								<?php 
									$mirror = $m->source_id;
									$m_name = $this->auto_m->mirror($mirror);
								 ?>
					<td class="mirror-url" data-mirror='<?=$video->slug?>?mirror=<?=$m->source_id?>'><?=$m_name?></td>
							<?php endforeach ?>
						<?php endif ?>
					<?php endif ?>
			</tr>
		</table>
		
	</div>	
	<script type="text/javascript">
	$(document).on('click','.mirror-url',function(e){
		var url = $(this).data('mirror');
		//console.log(url);
		window.location = '<?php echo site_url("watch/v/'+url+'");?>';
	});
	</script>
	<div class="video-content" style="display:block;">
		
		
<?php if ($video->source_id != 7): ?>
    <?php if ($video->source_id == 9): ?>
    
    <?php 
    $url = $video->link;
    $exp = time() + 60*60*2;
    $parts = parse_url($url);
    $output = [];
    parse_str($parts['query'], $output);
    $video_url = $parts['scheme'].'://'.$parts['host'].':'.$parts['port'].$parts['path'].'?st='.$output['st'].'&e='.$exp;
    
    
     ?>
    <div class="embed-responsive embed-responsive-16by9"><video class="embed-responsive-item" controls controlsList="nodownload"><source src="<?=$video_url?>">Your browser does not support the video tag.</video></div>
    
    <?php else: ?>
    
    <?php echo $video->embed; ?>
    <?php endif ?>

	<?php else: ?>
		<div class="panel cideo" style="">
			<div class="panel-body">
	<video  controls autoplay style="width:100%;margin-bottom:-5px;"><source src="" type="video/mp4">
	Your browser does not support the video tag.</video>
		</div>
		</div>

		<script type="text/javascript">
		getLink();
		function getLink(){
			$.ajax({
				data: 'video='+'<?=$video->slug?>',
				url: '<?=site_url("watch/v_url")?>',
				type: 'post',
				dataType: 'html',
				success: function(resp){
					console.log(resp);

					var video = document.createElement('video');

						video.src = resp;
						video.autoplay = true;
						video.controls = true;
						video.style = 'width:100%';
						video.className = 'video';
						$('.cideo .panel-body').html(video);
					//$('video').attr('src',resp);


		$('.video').click(function(){this.paused?this.play():this.pause();});

				}
			});
		}
	</script>
<?php endif ?>

	</div>
	

	<div class="col-md-12 video-title-group" style="padding:0;margin:0;">
		<div class="video">
		
	<style type="text/css">

	.video{}
	.video-controls{
		display: block;
		background-color: #000;
		min-height:50px;
		padding: 5px;
		color: #fff;
		vertical-align: text-top;
		overflow: hidden;
	}
	.video-controls > .video-title{
		display: inline-block;
		font-size: 14px;
		color: #fff;
		width: 48%;
		vertical-align: text-top;
		overflow: hidden;
	}
	.video-controls > .video-episode{
		display: inline-block;
		text-align: center;
		width: 30%;
		vertical-align: text-top;
	}
	.video-controls > .video-episode > .video-previus{
		display: inline-block;
		width: 48%;
		vertical-align: text-top;
		padding: 5px;
	}

	.video-controls > .video-episode > .video-next{
		display: inline-block;
		width: 48%;
		vertical-align: text-top;
		padding: 5px;
	}
	.video-controls > .video-episode > .video-previus.ok,
	.video-controls > .video-episode > .video-next.ok{

	}

	.video-controls > .video-episode > .video-previus.no,
	.video-controls > .video-episode > .video-next.no{
		color: #e5e5e5;
	}
	.video-controls > .video-error{
		display: inline-block;
		width: 20%;
		vertical-align: text-top;
		text-align: center;
		color: red;
		padding: 5px;
	}
	.video-controls > .video-episode > .video-previus.ok:hover,
	.video-controls > .video-episode > .video-next.ok:hover,
	.video-controls > .video-error.ok:hover{
		cursor: pointer;
		background-color: rgba(250,250,250,0.5);
	}
	@media only screen and (max-width: 768px){
	.video-controls > .video-title{font-size: 12px;}
	.video-controls > .video-title,
	.video-controls > .video-episode,
	.video-controls > .video-episode,
	.video-controls > .video-error{
		display: block;
		width: 100%;
		text-align: left;
	}

	
	}

</style>
	
			<div class="video-controls">
				<div class="video-title"><?=$video->title;?> 	<?php if ($this->authentication->is_loggedin()	): ?>
				<?php
                    $id = $this->authentication->read('identifier');
                    //echo "$id";
                    if($id == 1){
                      echo '<a href="'.site_url('video/info/'.$video->video_id).'" class="btn"><i class="fa fa-edit">
                          </i></a>';
                    }
                    

                    ?>
		<?php endif ?></div>
				<div class="video-episode">
					<div class="video-episode-control video-previus <?=!empty($previous) ? 'ok' : 'no';?>" data-slug="<?=isset($previous) ? $previous : '';?>">Previous</div>
					<div class="video-episode-control video-next <?=!empty($next) ? 'ok' : 'no';?>" data-slug="<?=isset($next) ? $next : '';?>">Next</div>
				</div>
				<div class="video-error ok">Report Video</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$('.video-episode-control.ok').on('click',function(e){
		var slug = $(this).data('slug');
		//console.log(slug);
		window.location = '<?=site_url("watch/v/'+slug+'")?>'
	});

	</script>
	
	</div>

</div>


<div class="panel">
	<div class="panel-heading"><h4>COMMENTS</h4></div>
	<div class="panel-body">

	<div class="video-content" style="display:block;">
	    Not yet available.
		
	</div>
	<div class="panel-body"><br /><br />
	<?php 
	/*
	    <iframe style="width:100%;height:250px" src="https://lap.lazada.com/banner/dynamic.php?banner_id=5b1881300b2c7&theme=2&p=3" frameborder="0" scrolling="no"></iframe>
	    */ 
	    ?>
	</div>

	</div>

</div>
<?php else: ?>
	
<?php endif ?>





<script type="text/javascript">
	$(document).ready(function() {
    $('iframe').removeAttr('width');
    $('iframe').removeAttr('height');
});
</script>








</div>
<div class="col-md-3 side-bar">
	<?php if (isset($video)  && isset($video->title)): ?>
		
	<div class="panel">
		<div class="panel-heading"><h4>SYNOPSIS</h4></div>
		<div class="panel-body"  style="max-height:300px;overflow:auto;">
			<p>
			<label><?php echo strtoupper($video->title) ?></label> <div class="fb-share-button" data-href="<?=$link?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=urlencode(site_url($link))?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div> -
				<?php echo !empty($video->sypnosis) ? $video->sypnosis : 'No information.'; ?>
			</p>
			
		</div>


	</div>

	<?php if (isset($playlist)): ?>
		<div class="panel" style="padding-bottom:10px;">
		<div class="panel-heading"><h4>PLAY LIST</h4></div>
		<div class="panel-body" style="max-height:500px;overflow:auto;">
			<ul class="recent-post" style="margin:1px; padding:0;list-style:none;">
				<?php echo $playlist ?>
			</ul>
		</div>


	</div>	
	<?php endif ?>
	<div class="panel hidden">
		<div class="panel-heading"><h4>RATING</h4></div>
		<div class="panel-body">
			<ul class="recent-post">
				<?php //echo $this->auto_m->recent_post(5); ?>
			</ul>
		</div>


	</div>



	<?php endif ?>
	<div class="panel hidden">
		<div class="panel-heading"><h4>SHARE US NOW </h4>
			
		</div>
		<div class="panel-body">
		
      <p>
          <div class="fb-page" data-href="https://www.facebook.com/LewFoLui" data-tabs="about" data-width="350" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/LewFoLui/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/LewFoLui/">Watch Anime by Coloftech</a></blockquote></div>
      </p>
		</div>
	</div>
	<div class="panel hidden">
		<div class="panel-heading"><h4>ADVERTISEMENT </h4>
			
		</div>
		<div class="panel-body">
		<p>
        <?php /*
    <iframe style="width:100%;height:250px;" src="https://lap.lazada.com/banner/dynamic.php?banner_id=5b1880a1d24f2&theme=1&p=1" frameborder="0" scrolling="no"></iframe>
*/ ?>
      	</p>
      
		</div>
	</div>
</div>
</div>


<div class="modal fade" role="dialog" id="modalupload">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" data-dismiss="modal">&times;</button>
				<div class="modal-title"><h4>Report video</h4></div>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="canvas" style="display:block;">
						<canvas id="reportcanvas" style="width:100%;max-width:300px;height:100px;border:1px solid #000000;"></canvas>
					</div>
					<div class="textbox" style="display:block;">
						<input type="text" class="form-control" style="width:100%;max-width:300px;" id="txtreport" name="txtreport" placeholder="Type the text above.">
						<br />
						<button class="btn btn-info " id="btnsend" type="button">Send</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var reported = false;
	var reportedtxt = false;

	var video_id = 0;
	var video_title = false;
	var source_id = 0;

			<?php if(isset($video->video_id)): ?>

			video_id = <?=$video->video_id?>;
			video_title = '<?=$video->title?>';
			source_id = <?=$video->source_id?>;
			
			<?php endif ?>


	$('.video-error.ok').on('click',function(){
		if(reported == false && video_id > 0){

			var report = reportHistory();

			$.ajax({
				data:'video_id='+video_id+'&source_id='+source_id,
				url:'../../watch/reported',
				type:'post',
				dataType:'json',
				success: function(res){
				    alert('Thank you. We\'ll try to update the link');
				    console.log('Thank you');

				    reported = true;
				}
			})

		}


	});


	function randomtext() {
	  var text = "";
	  var possible = "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz23456789";

	  for (var i = 0; i < 6; i++)
	    text += possible.charAt(Math.floor(Math.random() * possible.length));

	  return text;
	}


	function reportHistory(){


				if(sessionStorage){

					var videos = sessionStorage.getItem("video_"+video_id);

					if(videos != null){

					
						console.log(videos);


						$('.video-error').removeClass('ok').addClass("no");



					}else{

						$('.video-error').removeClass('ok').addClass("no");

						sessionStorage.setItem("video_"+video_id, video_title);


					}


				}else{

					alert('Report failed. Maybe your browser is not supported.');

				}
	}

window.onload = function() {
  //console.log('window - onload'); // 4th


  if(video_id > 0){

				if(sessionStorage){

					var videos = sessionStorage.getItem("video_"+video_id);

					if(videos != null){

						reported == true;
						console.log(videos);


						$('.video-error').removeClass('ok').addClass("no");

						return true;


					}

				}
				reported == true;
  }else{
  	reported = false;
  }

$('video').attr('controlsList',"nodownload").bind("contextmenu",function(){
        return false;
        });
};



</script>


<?php 
/*
$_SESSION['visit'] = 1;
$time = date('H',time());
$m = date('i',time());

$showadds= '
<script type="text/javascript" src="//go.oclasrv.com/apu.php?zoneid=1734346"></script>';
if($_SESSION['visit'] <= 2){
switch ($time) {
	case '7':
		# code...
		if($m < 30){
		    
	echo $showadds;
		}
		break;
	
	case '10':
		# code...
		if($m < 30){
		    
	echo $showadds;
		}
		break;
	case '12':
		# code...
		if($m < 30){
		    
	echo $showadds;
		}
		break;
	case '1':
		# code...
		if($m < 30){
		    
	echo $showadds;
		}
		break;
	case '4':
		# code...
		if($m < 30){
		    
	echo $showadds;
		}
		break;
	
	case '8':
		# code...
		if($m < 30){
		    
	echo $showadds;
		}
		break;	
		
	default:
		# code...
	echo "";
		break;
}
$_SESSION['visit'] = 2;
}*/
 ?>
