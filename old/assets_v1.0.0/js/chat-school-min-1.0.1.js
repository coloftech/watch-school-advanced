
/*----------------------------------------------------------------------
| global variable
------------------------------------------------------------------------*/
var popoverposition = 'left';
var w = window.innerWidth;
var h = window.innerHeight;
var user = 0;
var refresh = 0;
bootChat();

window.addEventListener('resize', function(){
    w = window.innerWidth;
    h = window.innerHeight;
    
     if(w <=768 ){

        $('#chatcontainer').removeClass('device-pc').addClass('device-mobile');
     }else{
         
        $('#chatcontainer').removeClass('device-pc');
        $('#chatcontainer').removeClass('device-mobile').addClass('device-pc');
     }

}, true);


/*----------------------------------------------------------------------
| Initiate chat box on window load complete
------------------------------------------------------------------------*/
$(document).ready(function(){

     if(isMobileDevice() == true || w <=768 ){
        //var h = window.innerHeight;
        //console.log(w);
        //console.log(h);

        $('#chatcontainer').removeClass('device-pc').addClass('device-mobile');
     }else{
         
        $('#chatcontainer').removeClass('device-pc');
        $('#chatcontainer').removeClass('device-mobile').addClass('device-pc');
     }

});


/*---------------------------------*/
$(document).on('click', '[data-toggle="popover"]', function(){
        $(this).popover('hide');
        $('ul.school-chat-box-body').empty();

        //console.log('hey');
        user = $(this).find('input[name="user_id"]').val();
        $(this).find('span[rel="'+user+'"]').text('');
        load_thread(user);
 
        
    if($('#school-chat-box').hasClass('close')){

        $('#school-chat-box').removeClass('close');
    }
        $('#school-chat-box').removeClass('min').addClass('max');
        $('#school-chat-box').show('slow');
});

/*----------------------------------------------------------------------
| Function to load threaded messages or user conversation
------------------------------------------------------------------------*/
var limit = 1;
function load_thread(user, limit){
        //send an ajax request to get the user conversation 
       $.ajax({ type: "POST", url: base  + "chat/messages", data: {user : user, limit:limit },cache: false,
        success: function(response){
        if(response.success){
            buddy = response.buddy;
            status = buddy.status == 1 ? 'Online' : 'Offline';
            statusClass = buddy.status == 1 ? 'user-status is-online' : 'user-status is-offline';

            $('#chat_buddy_id').val(buddy.id);
            $('.display-name', '#school-chat-box').html(buddy.name);
            $('#school-chat-box > .school-chat-box-header > small').html(status);
            $('#school-chat-box > .school-chat-box-header > span.user-status').removeClass().addClass(statusClass);

            $('ul.school-chat-box-body').html('');
            if(buddy.more){
             $('ul.school-chat-box-body').append('<li id="load-more-wrap" style="text-align:center"><a onclick="javascript: load_thread(\''+buddy.id+'\', \''+buddy.limit+'\')" class="btn btn-xs btn-info" style="width:100%">View older messsages('+buddy.remaining+')</a></li>');
            }
 

                thread = response.thread;
                $.each(thread, function() {
                  li = '<li class="'+ this.type +'"><img src="'+base_url+'assets/images/thumbs/'+this.avatar+'" class="avt img-responsive">\
                    <div class="message">\
                    <span class="chat-arrow"></span>\
                    <span class="chat-datetime">'+this.time+'</span>\
                    <span class="chat-body">'+this.body+'</span></div></li>';

                    $('ul.school-chat-box-body').append(li);
                });
                if(buddy.scroll){
                    $('ul.school-chat-box-body').animate({scrollTop: $('ul.school-chat-box-body').prop("scrollHeight")}, 500);
                }
                
            }
        }});
}

  function getCaret(el) { 
    if (el.selectionStart) { 
        return el.selectionStart; 
    } else if (document.selection) { 
        el.focus();
        var r = document.selection.createRange(); 
        if (r == null) { 
            return 0;
        }
        var re = el.createTextRange(), rc = re.duplicate();
        re.moveToBookmark(r.getBookmark());
        rc.setEndPoint('EndToStart', re);
        return rc.text.length;
    }  
    return 0; 
}

$(document).on('keyup','textarea',function (event) {
    if (event.keyCode == 13) {
        var content = this.value;  
        var caret = getCaret(this);          
        if(event.shiftKey){
            this.value = content.substring(0, caret - 1) + "\n" + content.substring(caret, content.length);
            event.stopPropagation();
        } else {
            this.value = content.substring(0, caret - 1) + content.substring(caret, content.length);
            $('#sendchat').submit();
        }
    }
});
$(document).on('submit','#sendchat',function(){
  var message = $(this).children('textarea').val();
      

        if(message !== ""){
          //return false;
            $(this).children('textarea').val('');
            // save the message 
            $.ajax({ type: "POST", url: base  + "chat/save_message", data: {message: message, user : user},cache: false,
              beforeSend: function(){
                $('.loader-sm').removeClass('hidden');
          
              },
                success: function(response){

                $('.loader-sm').addClass('hidden');
                  
                    msg = response.message;
                    li = '<li class=" bubble '+ msg.type +'"><img src="'+base_url+'assets/images/thumbs/'+msg.avatar+'" class="avt img-responsive">\
                    <div class="message">\
                    <span class="chat-arrow"></span>\
                    <span class="chat-datetime">'+msg.time+'</span>\
                    <span class="chat-body">'+msg.body+'</span></div></li>';

                    $('ul.school-chat-box-body').append(li);

                    $('ul.school-chat-box-body').animate({scrollTop: $('ul.school-chat-box-body').prop("scrollHeight")}, 500);
                },
                error: function(xhr, status, error) {
          //var err = eval("(" + xhr.responseText + ")");
          console.log(xhr.responseText);

                $('.loader-sm').addClass('hidden');
        }
            });
        }

  return false;
})


/*----------------------------------------------------------------------------------------------------
| Function to load messages
-------------------------------------------------------------------------------------------------------*/
function bootChat()
{
    refresh = setInterval(function()
    {
 
    $.ajax(
        {
            type: 'GET',
            url : base + "chat/updates/",
            async : true,
            cache : false,
            success: function(data){
                if(data.success){
                     thread = data.messages;
                     senders = data.senders;

                     if(thread.length <= 0 || senders.length <= 0){
                        return false;
                     }
                     var counter = 0;
                     $.each(thread, function() {
                        if($("#school-chat-box").is(":visible")){
                            chatbuddy = $("#chat_buddy_id").val();
                                if(this.sender == chatbuddy){
                                  li = '<li class="'+ this.type +'"><img src="'+base_url+'assets/images/thumbs/'+this.avatar+'" class="avt img-responsive">\
                                    <div class="message">\
                                    <span class="chat-arrow"></span>\
                                    <span class="chat-datetime">'+this.time+'</span>\
                                    <span class="chat-body">'+this.body+'</span></div></li>';
                                    $('ul.school-chat-box-body').append(li);
                                    $('ul.school-chat-box-body').animate({scrollTop: $('ul.school-chat-box-body').prop("scrollHeight")}, 500);
                                    //Mark this message as read
                                $.ajax({ type: "POST", url: base + "chat/mark_read", data: {id: this.msg}});
                                }
                                else{
                                    from = this.sender;
                                    $.each(senders, function() {
                                        if(this.user == from){
                                            $(".chat-group").find('span[rel="'+from+'"]').text(this.count);
                                            //if(this.count > 0){
                                                counter++;
                                           // }
                                        }
                                    });
                                }
                         }
                         else{
                            from = this.sender;
                            $.each(senders, function() {
                                if(this.user == from){
                                    $(".chat-group").find('span[rel="'+from+'"]').text(this.count);
                                }
                            });
                            
                         }
                     });
                        
                     if(counter > 0 ){

                        var audio = new Audio('assets/notify/notify.mp3').play();
                     }
                }
            },
                error: function(xhr, status, error) {
				  //var err = eval("(" + xhr.responseText + ")");
				 // console.log(xhr.responseText);
                 console.clear();

				}
        }
    );

       }, 5000);
}


/*----------------------------------------------------------------------
| Login function
------------------------------------------------------------------------*/

$(document).ready(function(){
/*----------------------------------------------------------------------
| Iniatiating the chat window with the appropriate HTML
------------------------------------------------------------------------*/
var chat_init = function(){
    $( "#chatcontainer" ).load( base+"users/");
}

chat_init();

$(document).on('click', '#login', function(){
        dataString = $('#login-frm').serialize();
        $.ajax({
            type: "POST",
            url: base  + "auth",
            data: dataString,
            cache: false,
            beforeSend: function(){
             $("#login").html('<img src="'+base_url+'assets/images/ajax-loader.gif" /> Connecting...');
         },
        success: function(response){
            if(response.success)
            {
                $(".message").html(success(response.message));
                $('#login-frm')[0].reset();
                chat_init();
            }
            else
            {
                $(".message").html(error(response.message));
            }
            $("#login").html('<i class="fa fa-lock"></i> Login');
            highlightFields(response.errors);
        }});
return false;
});

$(document).on('click', '.goback', function(){
    chat_init();
});
/*----------------------------------------------------------------------
| logout function
------------------------------------------------------------------------*/
$(document).on('click', '#logout', function(){
        $.ajax({
            type: "POST",
            url: base  + "auth/logout",
            cache: false,
            beforeSend: function(){},
            success: function(response){ chat_init(); }
        });
    return false;
});

/*----------------------------------------------------------------------
| Close the chat container
------------------------------------------------------------------------*/
$(document).on('click', '.chat-form-close', function(){
    $('#chatcontainer').toggle('slide', {
        direction: 'right'
    }, 500);
    $('#school-chat-box').hide();
});

/*----------------------------------------------------------------------
| Close the chat box window
------------------------------------------------------------------------*/

$(document).on('click','.school-chat-box-min', function(){
   
    if($('#school-chat-box').hasClass('min')){
        console.log('TO maximized');
        $(this).children('.fa').removeClass('fa-caret-up').addClass('fa-caret-down');
    $('#school-chat-box').removeClass('min').removeClass('close').addClass('max');
    }else{

        $(this).children('.fa').removeClass('fa-caret-down').addClass('fa-caret-up');
    $('#school-chat-box').removeClass('max').removeClass('close').addClass('min');
    }
   

   

});
$(document).on('click','.school-chat-box-exit', function(){
   

    $('#school-chat-box').removeClass('max').removeClass('min').addClass('close');
    


});
/*----------------------------------------------------------------------
| Display the chat container
------------------------------------------------------------------------*/
$(document).on('click','#chat-toggle',function (e) {
    if($('#school-chat-box').is(':visible')){
        $('#chatcontainer').toggle('slide', {
            direction: 'right'
        }, 500);
        $('#school-chat-box').hide();
    } else{

        $('#chatcontainer').toggle('slide', {
            direction: 'right'
        }, 500);
        chat_init();
    }
    return false;
});
/*----------------------------------------------------------------------
| change status Function
------------------------------------------------------------------------*/

var r = 0;
  $(document).on('click','.switch',function(e){
    if(r == 0){

    var input = $(this).children('input');
        $.ajax({ url: base  + "users/toggle_status" , 
            success: function(response){
                //console.log(response);
                if(response.status == 1){
                    $('#current_status').html('Online');
                    input.val(1);
                }            
                else{
                    $('#current_status').html('Offline');

                    input.val(0);
                }
        }});
        r++;
    }else{
      r=0;
    }

  });
/*----------------------------------------------------------------------
| Registration Process
------------------------------------------------------------------------*/
$(document).on('click', '#create-account', function(){
    $( "#chatcontainer" ).load( base+"auth/register/");
    return false;
});
$(document).on('click', '#register', function(){
        dataString = $('#register-frm').serialize();
        $.ajax({
            type: "POST",
            url: base  + "auth/register",
            data: dataString,
            cache: false,
            beforeSend: function(){
             $("#register").html('<img src="'+base_url+'assets/images/ajax-loader.gif" /> Connecting...');
         },
        success: function(response){
            if(response.success)
            {
                $(".message").html(success(response.message));
                $('#register-frm')[0].reset();
            }
            else
            {
                $(".message").html(error(response.message));
            }
            $("#register").html('<i class="fa fa-plus-circle"></i> Register');
            highlightFields(response.errors);
            return false;
        },
                error: function(xhr, status, error) {
                  //var err = eval("(" + xhr.responseText + ")");
                  console.log(xhr.responseText);
                  alert(xhr.responseText);
                  return false;

                }


    });
return false;
});

 $(document).on('click', '.dropdown-menu', function(e) {
    e.stopPropagation();
});

/*----------------------------------------------------------------------
| Editing profile process
------------------------------------------------------------------------*/
$(document).on('click', '#edit-profile', function(){
    $( "#chat-inner" ).load( base+"users/editProfile/");
    $('[data-toggle="dropdown"]').parent().removeClass('open');
    return false;
});

$(document).on("submit", "#profile-frm", function(e)
{
    e.preventDefault();
     dataString = new FormData(this);
        $.ajax({
            type: "POST",
            url: base  + "users/editProfile",
            data: dataString,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function(){
             $("#update-profile").html('<img src="'+base_url+'assets/images/ajax-loader.gif" /> Connecting...');
         },
        success: function(response){
            if(response.success)
            {
                if(response.errors.avatar_error)
                    $(".message").html(error(response.errors.avatar_error));
                else{
                    $(".message").html(success(response.message));
                    $( "#chat-inner" ).load( base+"users/editProfile/");
                }
            }
            else
            {
                $(".message").html(error(response.message));
            }
            $("#update-profile").html('<i class="fa fa-plus-circle"></i> Update Profile');
            highlightFields(response.errors);

        }});
});

/*----------------------------------------------------------------------
| change password process
------------------------------------------------------------------------*/
$(document).on('click', '#change-password', function(){
    $( "#chat-inner" ).load( base+"users/changePassword/");
    $('[data-toggle="dropdown"]').parent().removeClass('open');
    return false;
});
$(document).on('click', '#update-password', function(){
        dataString = $('#changepassword-frm').serialize();
        $.ajax({
            type: "POST",
            url: base  + "users/changePassword",
            data: dataString,
            cache: false,
            beforeSend: function(){
             $("#update-password").html('<img src="'+base_url+'assets/images/ajax-loader.gif" /> Connecting...');
         },
        success: function(response){
            if(response.success)
            {
                $(".message").html(success(response.message));
                $('#changepassword-frm')[0].reset();
            }
            else
            {
                $(".message").html(error(response.message));
            }
            $("#update-password").html('<i class="fa fa-plus-circle"></i> Change Password');
            highlightFields(response.errors);
        }});
return false;
});

});




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

/*----------------------------------------------------------------------
| Used to detect mobile device size
------------------------------------------------------------------------*/

function isMobileDevice() {
    return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
};

/*----------------------------------------------------------------------
| Initiate chat box on window load complete
------------------------------------------------------------------------*/
$(document).ready(function(){


	 if(isMobileDevice() == true){

	 	$('#chatcontainer').removeClass('device-pc').addClass('device-mobile');

        $('.chatschool').width(w);
        console.log(w);
	 }

});

$(document).on('focus','.chat-textarea textarea',function(e){
	$('.chat-textarea ').addClass('focus-on');
	//console.log('focus on');
});


$(document).on('click','.chat-textarea btn-send-off',function(e){


	$('.chat-textarea ').removeClass('focus-on');
	//console.log('focus off');
});


$(document).on('submit','.chat-textarea  form',function(e){

	$('.chat-textarea ').removeClass('focus-on');
	//console.log('focus off');
	//return false;
});



/*----------------------session hidechat box--------------------------*/



  $(document).ready(function(){



  if(sessionStorage){
    // Store data
    var is_chat = sessionStorage.getItem("livechat");
    if(is_chat === undefined || is_chat === null || is_chat.length <= 0 || is_chat === false){

    sessionStorage.setItem("livechat", "hidechat");

          $('#chatcontainer').toggle('slide', {
              direction: 'right'
          }, 500);
          $('#school-chat-box').hide();


    }else{
      if(is_chat == 'hidechat'){

          $('#chatcontainer').toggle('slide', {
              direction: 'right'
          }, 500);
          $('#school-chat-box').hide();
        }
        }
    }
 
    // Retrieve data
   
  });
  $('#chat-toggle').on('click',function(e){
    if(sessionStorage){
    // Store data
          sessionStorage.setItem("livechat", "show");
    }
       
  });

$(document).on('click', '.chat-form-close', function(){
   if(sessionStorage){
    // Store data
          sessionStorage.setItem("livechat", "hidechat");
    }
});





