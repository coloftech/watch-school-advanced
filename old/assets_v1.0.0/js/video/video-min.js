 $(function(){
 
  $('.anime-img').each(function(){
    $(this).attr('data-img',function(e){

          var img = document.createElement('img');
          img.src = $(this).data('img');
      $(this).find('.photo').html(img);
    }); 

  });
});

/*

// The function to insert a fallback image
var imgNotFound = function() {
    $(this).unbind("error").attr("src", "/public/images/default-img.jpg");
};
// Bind image error on document load
$("img").error(imgNotFound);
// Bind image error after ajax complete
$(document).ajaxComplete(function(){
    $("img").error(imgNotFound);
});



*/