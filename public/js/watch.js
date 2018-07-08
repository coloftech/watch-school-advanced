	
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





$(document).on('keyup','input',function(){
  var q = $(this).val();
  if(q.length < 2){
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
            
            var surl = base_url+'watch/v/'+v.slug;
            $('#listhere').append('<li onclick="addtolist('+v.video_id+','+v.episode_number+','+'\''+v.title+'\''+')"><a href="'+surl+'">'+v.title+'</a></li>');
        
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


$('#listhere').on('mouseleave',function(){
  $('#listhere li').remove();
});
