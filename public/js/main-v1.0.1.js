$(document).ready(function () {
	var url = window.location;
	$('ul.nav a[href="'+ url +'"]').parent().addClass('active');
	$('ul.nav a').filter(function() {
		 return this.href == url;
	}).parent().addClass('active');
});




    $( document ).ready(function() {
        $('.loader').removeClass('hidden');
        var series_id = $('#series_id').val();
        console.log(series_id);
        if(series_id != undefined && series_id.trim() != ''){

            $('.video-container').load(base_url + 'video/edit_series/'+series_id, function( response, status, xhr ) {
            if ( status != "error" ) {
               
            $('.loader').addClass('hidden');
            }
            });
            return false;
        }
    	$('.video-container').load(base_url + 'video/list_all/'+letter_1+'/'+letter_2, function( response, status, xhr ) {
        if ( status != "error" ) {
           
        $('.loader').addClass('hidden');
        }
        });



	});

    $('.btn-new-series').on('click',function(){
        $('.loader').removeClass('hidden');
    	$('.video-container').load(base_url + 'video/new_series/', function( response, status, xhr ) {
        if ( status != "error" ) {
           
        $('.loader').addClass('hidden');
        }
        });
	});

    $('.btn-list-all').on('click',function(){

        $('.loader').removeClass('hidden');
    	$('.video-container').load(base_url + 'video/list_all/'+letter_1+'/'+letter_2, function( response, status, xhr ) {
        if ( status != "error" ) {
           
        $('.loader').addClass('hidden');
        }
        });
        
	});

    $('.btn-list-all-video').on('click',function(){

        $('.loader').removeClass('hidden');
        $('.video-container').load(base_url + 'video/list_video/', function( response, status, xhr ) {
        if ( status != "error" ) {
           
        $('.loader').addClass('hidden');
        }
        });
        
    });
    $('.btn-new-video').on('click',function(){

        $('.loader').removeClass('hidden');
    	$('.video-container').load(base_url + 'video/new_video/', function( response, status, xhr ) {
        if ( status != "error" ) {
           
        $('.loader').addClass('hidden');
        }
        });
    	var category = $('#videocategory').val();
    	 listcover (category,'videoparent');


		});

    $('.btn-statistics').on('click',function(){

        $('.loader').removeClass('hidden');
        $('.video-container').load(base_url + 'video/statistics/', function( response, status, xhr ) {
        if ( status != "error" ) {
           
        $('.loader').addClass('hidden');
        }
        });

        });

    $(document).on('click','#btn_country',function(){

        $('.loader').removeClass('hidden');
        $('.video-container').load(base_url + 'video/list_visitors/', function( response, status, xhr ) {
        if ( status != "error" ) {
           
        $('.loader').addClass('hidden');
        }
        });

        });

    $('.btn-reports').on('click',function(){

        $('.loader').removeClass('hidden');
        $('.video-container').load(base_url + 'video/reported/', function( response, status, xhr ) {
        if ( status != "error" ) {
           
        $('.loader').addClass('hidden');
        }
        });

        });

    $(document).on('click','.list-edit-video',function(){
        var detail_id = $(this).data('series');
        var video_id = $(this).data('episode');
        var category = $(this).data('category');

        //return false;

        $('.loader').removeClass('hidden');
        $('.video-container').load(base_url + 'video/edit_video/'+detail_id+'/'+video_id, function( response, status, xhr ) {
        if ( status != "error" ) {
           
        $('.loader').addClass('hidden');
        }
        });

        ///var category = $('#videocategory').val();
         listcover(category,'videoparent');

        });

	function listcover (category,select) {
		// body...

		if (category == undefined) {
			category = 1;
		};
        //console.log(category);
        var url = base_url+'video/videocategory/';
        var detail_id = $('#detail_id').val();
        if(detail_id != undefined){
            url = base_url+'video/videocategory/'+detail_id;
        }
		$.ajax({
    		data: 'videocategory='+category,
    		type:'post',
    		url: url,
    		success: function(response){
    			
    			$('#'+select).html(response);
    		}
    	})
        $('.loader').addClass('hidden');

	}
	function getThumbnail (parent,input) {
		// body...
		$.ajax({
    		data: 'parent_id='+parent,
    		type:'post',
    		url: base_url+'video/parent_thumbnail/',
    		success: function(response){
    			console.log(response)
    			$('#'+input).val(response);
    		}
    	})
	}

		function removeseries(id){
           
				$.ajax({
			data: 'detail_id='+id,
			url: base_url+'video/removeseries',
			type: 'post',
			dataType: 'json',
			success: function(response){
				if(response.success == true){
					$(".with-error").html(success(response.message));

					$('#vid_'+id).remove();
				}
	            else
	            {
	                $(".with-error").html(error(response.message));
	            }
			}
		})

	}

    function removetoplaylist(detail_id,video_id){

                $.ajax({
                    data:'video_id='+video_id,
                    type:'post',
                    url:base_url+'video/removetoplaylist/'+detail_id,
                    success: function(response){
                        //console.log(response);
                        if(response.success == true){
                            //$('#tr_'+video_id).remove();

                            playlist();
                        }
                        
                    }
                });
    }
    function remove(id){
        $.ajax({
            data: 'video_id='+id,
            url: base_url+'video/removevideo',
            type: 'post',
            dataType: 'json',
            success: function(response){
                console.log(response);
                if(response.success == true){
                    $('#video_'+id).remove();
                }
            }
        })
    }

var array_video_id = false;
var i = 0;
var selected_object = false;
    function addtolist(video_id,episode_number,title){
    var selected = singlearray(video_id);
    if(selected === true){
        selectedarray(video_id,episode_number,title)
    $('.table-output').append('<tr class="tr_episode">'+'<td>'+title+'</td>'+'<td>'+episode_number+'</td>'+'<td><a class="btn btn-sm btn-danger"><i class="fa fa-remove"></i></td>'+'</tr>');

    }else{
        $('.with-error').html(error('Episode already on the list.'));
        setTimeout(function(){

        $('.alert-dismissable .close').click();
        },3000)
    }
    $('.btn-danger').on('click',function(){
        $(this).parent().parent().remove();
        var index = array_video_id.indexOf(video_id);
            if (index > -1) {
                array_video_id.splice(index,video_id);
                removeobject(video_id);
            }
            //console.log(array_video_id);
    });
    }
    function selectedarray(video_id,episode,title){
    var added = false;
        if (selected_object == false) {
            selected_object= [];
        };
        var kv ='';
        kv = {id:video_id , episode: episode, title: title};

        objIndex = selected_object.findIndex((obj => obj.id == video_id));

        if(objIndex != -1){
            //array_video_id[objIndex].episode = episode
            added = false;
            //console.log(array_video_id);
            //console.log('not in array');
        }else{
            selected_object.push(kv);
            added = true;
            //console.log(array_video_id);
            ///console.log('in array');
        }
        return added;
        }

function singlearray(video_id) {
    // body...
    if(array_video_id == false){
        array_video_id = [];
        array_video_id.push(video_id);
        added = true;
            console.log('Not In array')
    }else{

        //var array = [2, 5, 9];
        var index = array_video_id.indexOf(video_id);
        if (index > -1) {
          //array_video_id.splice(index, 1);
            added = false;
            console.log('In array')
        }else{
            array_video_id.push(video_id);
            added = true;
            console.log('Not In array')
        }
    }
    return added;
}

    $(document).on('click','#btnselected',function(e){
    detail_id = $('#detail_id').val();
    if(detail_id == 0 || detail_id == undefined){

        return false;
    }
    //console.log(array_video_id);
    //return false;
    if(selected_object.length != undefined || selected_object != 0 || selected_object != false){
        //console.log(selected_object);
        $.ajax({
            data:{episodes:array_video_id},
            url:base_url+'video/addtoplaylist/'+detail_id,
            type:'post',
            success: function(response){
                console.log(response);
                //$('.tr_episode').remove();
               // $('.modal').modal('hide');
            }

        });

        $.each(selected_object,function(k,v){
            //console.log(v);
            $('#listepisodes').append('<li class="list-group-item col-xs-4 list-group-item"><a target="_blank" href="'+base_url+'/watch/v/'+v.id+'">Episode '+v.episode+'</a> <i style="" class="font-10">'+v.title+'</i></li>');
        });
    }else{
        console.log('Do nothing');
    }
});

    $(document).on('blur','#videocategory',function(e){
    	//alert('hey')

    	 	var category = $(this).val();

    	 	listcover (category,'videoparent');
    });

    $(document).on('blur','#videoparent',function(e){

    	 	var parent = $(this).val();
    	 	getThumbnail (parent,'episode_thumbnail');
    });

    $(document).on('submit','#frmnewvideo',function(e){
        //alert('hey')
        $('.loader').removeClass('hidden');
        var episode_url = $('#episode_url').val();
        var embed = $('#embed').val();
        if(episode_url.length <= 0 && embed.length <= 0){
            alert('Video url/embed is requeired');
            return false;
        } 
        var data = $(this).serialize();

        $.ajax({
            url: base_url+'video/add_video',
            type: 'post',
            dataType: 'json',
            data: data,
            success: function(response){
                //console.log(response);

                if(response.success == true){
                    $(".with-error").html(success('New video is added.'));
                $('.loader').addClass('hidden');
                }
                else
                {
                    $(".with-error").html(error("Unknow error occured!"));
                }
            }
        })
        return false;
    });

    $(document).on('submit','#frmupdatevideo',function(e){
    	//alert('hey')
        //return true;
        $('.loader').removeClass('hidden');
    	var episode_url = $('#episode_url').val();
    	var embed = $('#embed').val();
    	if(episode_url.length <= 0 && embed.length <= 0){
    		alert('Video url/embed is requeired');
    		return false;
    	} 
    	var data = $(this).serialize();

    	$.ajax({
    		url: base_url+'video/update_video',
    		type: 'post',
    		dataType: 'json',
    		data: data,
    		success: function(response){
    			console.log(response);

				if(response.success == true){
					$(".with-error").html(success('Video updated success.'));
                $('.loader').addClass('hidden');
				}
	            else
	            {
	                $(".with-error").html(error("Unknow error occured!"));
	            }
    		}
    	})
    	return false;
    });


    $(document).on('submit','#frmaddepisode',function(e){
        //alert('hey')
        $('.loader').removeClass('hidden');
        var episode_url = $('#episode_url').val();
        var embed = $('#embed').val();
        if(episode_url.length <= 0 && embed.length <= 0){
            alert('Video url/embed is requeired');
            return false;
        } 
        var data = $(this).serialize();


        var series = $('#videoparent').val()
        //console.log(data);
        //return false;
        $.ajax({
            url: base_url+'video/add_video',
            type: 'post',
            dataType: 'json',
            data: data,
            success: function(response){
                console.log(response);

                if(response.success == true){
                    $(".with-error").html(success('New video is added.'));

                    $('.loader').addClass('hidden');
                }
                else
                {
                    $(".with-error").html(error("Unknow error occured!"));
                }
            }
        })
        return false;
    });

    $(document).on('keyup','#episodetitle',function(e){
    var q = $(this).val();
    if(q.length <= 0){
        return false;
    }

    $('#listhere').html('');
    $.ajax({
        data: 'q='+q,
        type: 'post',
        dataType: 'json',
        url:base_url+'playlist/search',
        
        success: function(response){
            console.clear();
            console.log(response);
            if(response.success == true){

                  $.each(response.message, function(k, v) {
                    
                    
                    $('#listhere').append('<li class="list-group-item search-output" onclick="addtolist('+v.video_id+','+v.episode_number+','+'\''+v.title+'\''+')"><a>'+v.title+'</a></li>');
                
                  });

        }else{
            $('#listhere').html('<li>No reponse.</li>');
        }


        },
        error: function(xhr, status, error) {
          //var err = eval("(" + xhr.responseText + ")");
          console.log(xhr.responseText);

        }
    });
});

    $(document).on('submit','#frmnewseries',function(e){

        $('.loader').removeClass('hidden');
    	var data = $(this).serialize();

    	$.ajax({
    		url: base_url+'video/add_series',
    		type: 'post',
    		dataType: 'json',
    		data: data,
    		success: function(response){

				if(response.success == true){
					$(".with-error").html(success('New Series is added.'));
                 $('.loader').addClass('hidden');
				}
	            else
	            {
	                $(".with-error").html(error("Unknow error occured!"));
	            }

    		}
    	})
    	return false;
    });

    $(document).on('submit','#frmupdateseries',function(e){

        $('.loader').removeClass('hidden');
        var data = $(this).serialize();
        var detail_id = $('#detail_id').val();


        $.ajax({
            url: base_url+'video/update_series/'+detail_id,
            type: 'post',
            dataType: 'json',
            data: data,
            success: function(response){
                if(response.success == true){
                    $(".with-error").html(success('Series updated.'));
                    $('.loader').addClass('hidden');
                }
                else
                {
                    $(".with-error").html(error("Unknow error occured!"));
                }

            }
        })
        return false;
    });

    $(document).on('click','#btnpreview',function(){
    	var embeded = $('#embed').val();

    	$('.preview-video').html(embeded);
    });

    $(document).on('click','.close',function(){

    	$('.preview-video').html('');
    })

    $(document).on('click','.btn-edit-series',function(){
        //alert("Greate")
        $('.loader').removeClass('hidden');
        var series = $(this).data('series');
        $('.video-container').load(base_url + 'video/edit_series/'+series, function( response, status, xhr ) {
        if ( status != "error" ) {
           
        $('.loader').addClass('hidden');
        }
        });

    })
 $(document).on('click','.badge-remove',function(){
     //  alert('Greate')
     var detail_id = $(this).data('series');
     var video_id = $(this).data('episode');

        $.ajax({
            url: base_url+'video/removetoplaylist/'+detail_id,
            type: 'post',
            dataType: 'json',
            data: 'video_id='+video_id,
            success: function(response){

                if(response.success == true){
                    $(".with-error").html(success('Episode remove.'));
                }
                else
                {
                    $(".with-error").html(error("Unknow error occured!"));
                }

            }
        });

       $(this).parent().remove();

    })

    



    $(document).on('click','.btn-continue',function(){
    	$('.more-info').removeClass('hidden');
    	$(this).hide();
    })


	var embed = false;

    $(document).on('blur','#episode_url',function(e){
		let url = $(this).val();

		if(url.length < 10){
		$('.with-error').html('');
			return false;
		}
		let video = new Embed_video();
		video._url = url;
		//let hostname = video.host_name();
		let source_id = video.source_id();
		$('#videosource').val(source_id);
		let embeded = video.embeded();
		$('#embed').val(embeded);


	});

    $(document).on('change','#videosource',function(e){

		let url = $('#episode_url').val();
		if(url.length < 10){
		$('.with-error').html('');
		$('#embed').val('');
			return false;
		}
		let source = $(this).val();
		let video = new Embed_video();
		video._url = url;
		if(source == 8 || source == 10){

			var embeded = video.embeded('video');
		}else{

			var embeded = video.embeded();
		}


		$('#embed').val(embeded);

	})


    $(document).on('click','#btnupload',function(e){
		$('.preview-img').removeClass('hidden');
		upload(base_url+'image/upload','uploadthumb','imgpreview','thumbnail');

        $('.modal').modal('hide');


	});

    $(document).on('click','#btnuploadnewvideo',function(e){
		$('.preview-img').removeClass('hidden');
		upload(base_url+'image/upload','uploadthumb','imgpreview','episode_thumbnail');

		$('.modal').modal('hide');



	});

    $(document).on('blur','#thumbnail',function(e){
		var t = $(this).val();
		if(t.length < 8){
		$('.preview-img').addClass('hidden');
			return false;
		}
		$('.preview-img').removeClass('hidden');
		$('#imgpreview').attr('src',t);
	});

    $(document).on('change','#thumbnail',function(e){
        var t = $(this).val();
        if(t.length < 8){
        $('.preview-img').addClass('hidden');
            return false;
        }
        $('#thumbnail_new').val(t);
        $('.preview-img').removeClass('hidden');
        $('#preview_thumbnail').attr('src',t);
    });


    $(document).on('change','#uploadthumb',function(e){
		readURL('uploadthumb','imgpreview')

		$('.preview-img').removeClass('hidden');
	});

    $(document).on('click','#btnimgset',function(){
        var img = $('#thumbnail_new').val();
        if(img.length > 8){

        $('#thumbnail').val(img);
        $('#imgpreview').attr('src',img);
        $('.modal').modal('hide');
        }
    })
	



/*----------------------------------------------------------------------
| Function to display error messages
------------------------------------------------------------------------*/
function error(message){
    var alert = '<div style="font-size:12px; margin-top:10px;" class="alert alert-danger alert-dismissable">\
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\
                <strong>Error ! </strong> ' + message + ' </div>';
    return alert;
}

/*----------------------------------------------------------------------
| Function to display success messages
------------------------------------------------------------------------*/

function success(message){
    var alert = '<div style="font-size:12px; margin-top:10px;" class="alert alert-success alert-dismissable">\
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>\
                <strong>Success ! </strong> ' + message + ' </div>';
    return alert;
}
/*----------------------------------------------------------------------
| Function to highlight incorrect fields 
------------------------------------------------------------------------*/
function highlightFields(message){
    $('.form-group').removeClass('has-error');
    $('.error').remove();
    for (var key in message) {
        $('input[name="'+ key+'"]' ).parent().addClass('has-error');
        $('input[name="'+ key+'"]').after('<span class="error">' +message[key]+ '</span>');
    }
}


  function readURL(input,preview) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#'+preview).attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}


//*------------------------- upload ------------------*/
var image_url = false;
function upload (url,file_id,preview_id,input_id) {
  // body...

    //console.clear();

    $('.with-error').removeClass('alert alert-danger').html('');
    /*$('.progress-bar').text('0%');
    $('.progress-bar').width('0%');*/
    var uploadInput = $('#'+file_id); 

    if (uploadInput[0].files[0] != undefined) {
      var formData = new FormData();
      formData.append('upload', uploadInput[0].files[0]);
      formData.append('type','images');

      console.log('Upload on proccess.');
      $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        //processType: false, WRONG syntax
        processData: false,
        contentType: false,
            dataType:'json',
                beforeSend: function() {
                // setting a timeout
                $('.with-error').addClass('loading...');
               
            },
        success: function(data) {
          //$('#uploadthumb').val('');
         // console.log(data);
          if(data.stats == true){
            $('.preview-image').removeClass('hidden');

            $('#'+input_id).val(data.msg);
            var img = $('#'+preview_id);
            img.attr('src',data.msg);

            image_url = data.msg;
            //return data.msg;;
            console.log(image_url);
            return image_url;

          }else{
            $('.with-error').addClass('alert alert-danger').html(data.msg)

          }
        },
        xhr: function() {
          var xhr = new XMLHttpRequest();
          xhr.upload.addEventListener("progress", function(e) {
            /*if (e.lengthComputable) {
              //var uploadPercent = e.loaded / e.total; typo uploadpercent (all lowercase)
              var uploadpercent = e.loaded / e.total; 
              uploadpercent = (uploadpercent * 100); //optional Math.round(uploadpercent * 100)
              $('.progress-bar').text(uploadpercent + '%');
              $('.progress-bar').width(uploadpercent + '%');
              if (uploadpercent == 100) {
                $('.progress-bar').text('Completed');
              }
            }*/
          }, false);
          
          return xhr;
        }
      })
    }
    
}