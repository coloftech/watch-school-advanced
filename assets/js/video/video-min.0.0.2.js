  function readURL(input,preview) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#'+preview).attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

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

//*----------------GET DOmain-------------------------*/
function extractHostname(url) {
    var hostname;
    //find & remove protocol (http, ftp, etc.) and get hostname

    if (url.indexOf("://") > -1) {
        hostname = url.split('/')[2];
    }
    else {
        hostname = url.split('/')[0];
    }

    //find & remove port number
    hostname = hostname.split(':')[0];
    //find & remove "?"
    hostname = hostname.split('?')[0];

    return hostname;
}

// To address those who want the "root domain," use this function:
function extractRootDomain(url) {
    var domain = extractHostname(url),
        splitArr = domain.split('.'),
        arrLen = splitArr.length;

    //extracting the root domain here
    //if there is a subdomain 
    if (arrLen > 2) {
        domain = splitArr[arrLen - 2] + '.' + splitArr[arrLen - 1];
        //check to see if it's using a Country Code Top Level Domain (ccTLD) (i.e. ".me.uk")
        if (splitArr[arrLen - 2].length == 2 && splitArr[arrLen - 1].length == 2) {
            //this is using a ccTLD
            domain = splitArr[arrLen - 3] + '.' + domain;
        }
    }
    return domain;
}

function split_url(url){
  var surl = url .split( '/' );
  return surl;
}

function split_urlY(url){
  var surl = url .split( '=' );
  return surl;
}
//GET SOURCE ID
function getsource_id(url){
  var id=0;
  var domain = url.substring(0, url.indexOf('.'));
  switch(domain) {
    case 'facebook':
       // code block
       id = 3;
        break;
    case 'vimeo':
        //code block
        id=8;
        break;
    case 'youtube':
        //code block
        id=2;
        break;
    case 'youtu':
        //code block
        id=2;
        break;
    case 'yourupload':
        //code block
        id = 10;
        break;
    case 'play44':
        //code block
        id=9;
        break;
    case 'mp4upload':
        //code block
        id=1;
        break;
    case 'dailymotion':
        //code block
        id=4;
        break;
    case 'openload.co':
    case 'openload.com':
        //code block
        id=5;
        break;
    case 'google.com':
        //code block
        id=6;
        break;
    default:
        //code block
        id = 7;

  }
  return id;
}


function embed_url(url,source_id){

  var div = document.createElement('div');
    div.id = 'div-embeded';
    div.className = 'embed-responsive embed-responsive-16by9';
  var video = document.createElement('video');
    video.className = 'embed-responsive-item';
    video.setAttribute('controls',true);
  var iframe = document.createElement('iframe');
    iframe.className = 'embed-responsive-item';
    iframe.setAttribute('scrolling','no');
    iframe.setAttribute('frameborder',0);
    iframe.setAttribute('allowTransparency',true);
    iframe.setAttribute('allowFullScreen',true);
    //console.log(div);
  var f_path = split_url(url);
  var domain = extractRootDomain(url);

  var embeded = false;

  switch(source_id) {
    case 3: //facebook
       // code block
       //id = 3;  scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"
        iframe.setAttribute('src','https://www.facebook.com/plugins/video.php?href='+url+'&mute=0');
        div.appendChild(iframe);
        break;
    case 8: //vimeo
      var player = extractHostname(url);
      if(player[2] === 'player.vimeo.com'){
        //url = 

      if(f_path[3] != 'video'){
          url = f_path[0]+'//'+'player.'+f_path[2]+'/video/'+f_path[3];

          iframe.setAttribute('src',url);
      }else{


          iframe.setAttribute('src',url);

      }
      }
    if(f_path[3] != 'video'){
        url = f_path[0]+'//'+'player.'+f_path[2]+'/video/'+f_path[3];

        iframe.setAttribute('src',url);
    }

        iframe.setAttribute('src',url);
        div.appendChild(iframe);
        break;
    case 2: //youtube
        //code block
        //id=2;
        //console.log('youtube');
        if(domain === 'youtube.be'){
        url = f_path[0]+'//'+'youtube.com'+'/embed/'+f_path[3]+'?rel=0';
        }else{
          var yt = split_urlY(url);
          url = f_path[0]+'//'+'youtube.com'+'/embed/'+yt[1]+'?rel=0';
        }
        iframe.setAttribute('src',url);
        div.appendChild(iframe);
        //console.log(embeded);
        break;
    case 10: //'yourupload':
        //code block
        
    if(f_path[3] == 'watch'){
        url = f_path[0]+'//'+f_path[2]+'/embed/'+f_path[4];
    }

    
        iframe.setAttribute('src',url);
        div.appendChild(iframe);
        break;
    case 9://'play44':
        //code block
        //id=9;

        video.setAttribute('src',url);
        div.appendChild(video);

        break;
    case 1: //'mp4upload':
        //code block
        url = f_path[0]+'//'+f_path[2]+'embed-'+f_path[3];

        iframe.setAttribute('src',url);
        div.appendChild(iframe);
       // id=1;
        break;
    case 4: //'dailymotion':
        //code block
        //id=4;

    if(f_path[3] != 'embed'){
        url = f_path[0]+'//'+f_path[2]+'/embed/video/'+f_path[4];
    }
        iframe.setAttribute('src',url);
        div.appendChild(iframe);
        break;
    /*case 'openload':
        //code block
        id=5;
        break;
    case 'google':
        //code block
        id=6;
        break;*/
    default:
        //code block

        iframe.setAttribute('src',url);
        div.appendChild(iframe);
        //id = 7;

    }
    return div;
}


/*
            <option value="0">-SELECT HERE-</option>
            <option value="3">FACEBOOK</option>
            <option value="8">VIMEO</option>
            <option value="9">ANISUBBED (HTML5 VIDEO)</option>
            <option value="10">YOURUPLOAD (IFRAME)</option>
            <option value="1">MP4UPLOAD</option>
            <option value="2">YOUTUBE</option>
            <option value="4">DAILYMOTION</option>
            <option value="5">OPENLOAD</option>
            <option value="6">GOOGLE DRIVE</option>
            <option value="7">OTHERS</option>
*/
// GET EMBED 

//*------------------------- upload ------------------*/
var image_url = false;
function upload (url,file_id,preview_id,input_id) {
  // body...


    //console.clear();

    $('.with-error').removeClass('alert alert-danger').html('');
    $('.progress-bar').text('0%');
    $('.progress-bar').width('0%');
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
            if (e.lengthComputable) {
              //var uploadPercent = e.loaded / e.total; typo uploadpercent (all lowercase)
              var uploadpercent = e.loaded / e.total; 
              uploadpercent = (uploadpercent * 100); //optional Math.round(uploadpercent * 100)
              $('.progress-bar').text(uploadpercent + '%');
              $('.progress-bar').width(uploadpercent + '%');
              if (uploadpercent == 100) {
                $('.progress-bar').text('Completed');
              }
            }
          }, false);
          
          return xhr;
        }
      })
    }
    
}

/* $(function(){
 
  $('.anime-img').each(function(){
    $(this).attr('data-img',function(e){

          var img = document.createElement('img');
          img.src = $(this).data('img');
      $(this).find('.photo').html(img);
    }); 

  });
});
*/
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