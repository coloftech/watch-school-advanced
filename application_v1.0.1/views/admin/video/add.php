<div class="anime">
	<textarea class="form-control" id="textarea" rows="10"></textarea>
</div>

<script type="text/javascript">
	//$(function() {
    //"use strict";
 /*   var valid_url = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi;
/*
    $("#textarea").on("keyup", function( e ) {
        var urls, output = "";
        if ( e.keyCode !== 8 && e.keyCode !== 9 && e.keyCode !== 13 && e.keyCode !== 32 && e.keyCode !== 46 ) {
            // Return is backspace, tab, enter, space or delete was not pressed.
            return;
        }

        while ((urls = valid_url.exec(this.value)) !== null) {
            output += urls[0] + ", ";
        }
        //console.log("URLS: " + output.substring(0, output.length - 2));


    });
//});
*/

class Video_link
{	
	constructor(url){
		this._url = url;
	}
	
	host_name(){
	var hostname;
    //find & remove protocol (http, ftp, etc.) and get hostname

    if (this._url.indexOf("://") > -1) {
        hostname = this._url.split('/')[2];
    }
    else {
        hostname = this._url.split('/')[0];
    }

    //find & remove port number
    hostname = hostname.split(':')[0];
    //find & remove "?"
    hostname = hostname.split('?')[0];

    return hostname;
	}

	root_domain() {
    var domain = this.host_name(),
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

	split_url(ex,murl){
		var surl = false;
		if(ex != undefined){
			if(murl == undefined){

		  		surl = this._url.split( ex );
			}else{

			  	surl = murl.split( ex );
			}
		}else{

			if(murl == undefined){

		 		surl = this._url.split( '/' );
			}else{

			  	surl = murl.split( '/' );
			}
		}
		  return surl;
		}
	source_id(){
		var domain = this.root_domain();
		var id = 0;
		switch(domain){
			case 'facebook.com':
			id = 1;
			break;
			case 'vimeo.com':
			id = 2;
			break;
			case 'dailymotion.com':
			id = 3;
			break;
			case 'youtube.com':
			case 'youtu.be':
			id = 4;
			break;
			case 'yourupload.com':
			id = 5;
			break;
			case 'mp4upload.com':
			id = 6;
			break;
    		case 'openload.co':
    		case 'openload.com':
			id = 7;
			break;
			case 'mp4upload.com':
			id = 8;
			break;
			case 'play44.net':
			id = 9;
			break;
    		default:
        	id = 10;
		}
		return id;
	}
	embed(source,domain,murl){
		if(source == undefined){

		var source = this.source_id();
		var split = this.split_url(murl);
		var domain = this.root_domain(murl);

		}else{

		var split = this.split_url(murl);
		var domain = this.root_domain(murl);

		}
		var e = false;


		switch(source){
			case 1://'facebook.com':
			e = 'https://www.facebook.com/plugins/video.php?href='+this._url+'&mute=0';
			break;
			case 2://'vimeo.com':
			//e = 2;
			      var player = this.host_name();
			    if(player != 'player.vimeo.com'){

			      if(split[3] != 'video'){
			       e = 'https:'+'//'+'player.'+split[2]+'/video/'+split[3];

			      }else{
			      	e = this._url;

			      }
			  	}else{
			      	e = this._url;
			  	}
			      
			break;
			case 3://'dailymotion.com':
			//e = ;

				    if(split[3] != 'embed' || split[4] != 'video'){

				        e = 'https:'+'//'+split[2]+'/embed/video/'+split[4];
				    }else{
				        e = this._url;//split[0]+'//'+split[2]+'/embed/video/'+split[5];
				    }
			break;
			case 4://'youtube.com':
			//e = 4;

				if(split[3] != 'embed'){
		        if(domain === 'youtu.be'){
		        	split = this.split_url('/');
		        	e = 'https:'+'//'+'youtube.com'+'/embed/'+split[3]+'?rel=0';
		        }else{
		        	split = this.split_url('=');
		          	e = 'https:'+'//'+'youtube.com'+'/embed/'+split[1]+'?rel=0';
		        }}
		        else{
		        	e = this._url;
		        }
			
			break;
			case 5://yourupload.com':
			//e = 5;
				e = this._url;
			    if(split[3] == 'watch'){
			        e = 'https:'+'//'+split[2]+'/embed/'+split[4];
			    }
			break;
			case 6://'mp4upload.com':

				e = split[0]+'//'+split[2]+'embed-'+split[3];
			break;
    		case 7://'openload.co':
    		//case 'openload.com':
			e = this._url;
			break;
			break;
			case 8://'play44.net':
			e = this._url;
			break;
    		default:
        	e = this._url;
		}
		return e;
	}

	frame_type(){
		
		var source = this.source_id();
		switch(id){
			case 8:
			case 9:
			var type = 'video';
			break;
			case 1:
			case 2:
			case 3:
			case 4:
			case 5:
			case 6:
			case 7:
			var type = 'iframe';
			break;

    		default:
			var type = 'iframe';

		}
		return type;
	}
	embeded(){
		var embed_url = this.embed();


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


		switch(this.frame_type){
			case 'video':

		        video.setAttribute('src',embed_url);
		        div.appendChild(video);
			break;

			default:

		        iframe.setAttribute('src',embed_url);
		        div.appendChild(iframe);
		}
		return div.outerHTML;
	}

}

/*
var urls = new Video('http://www.fb.com');
let u = urls.gethostname()
console.log(u);

let d = urls.rootdomain()
console.log(d);
*/
//let video = new Video_link();
//video._url = 'https://vimeo.com/275474103';
//let h = video.host_name()
//let d = video.root_domain()
//let s = video.source_id()
//let e = video.embed();
//let ex = video.split_url('/');
//let embeded = video.embeded();
//console.log(h);
//console.log(d);
//console.log(s);
//console.log(e);
//console.log(ex);
//console.log(embeded);
</script>