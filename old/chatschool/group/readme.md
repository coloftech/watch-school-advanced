
;#-------------------------------------------------------------#
[Required]

	[Application][controllers]
	application/controllers/chat.php

	[Application][models]
	application/models/User_model.php
	application/models/Lastmsg_model.php
	application/models/Message_model.php

	[Application][helpers]
	application/helpers/json_error_helper.php
	application/helpers/smiley_helper.php

	[Application][libraries]
	application/libraries/Authentication.php

	[Application][config]
	application/config/authentication.php
	application/config/autoload.php 			
			;update your config autoload file. 	$autoload['libraries'] = array('database','session','authentication','form_validation')
			;update your config helper file 	$autoload['helper'] = array('url','json_error','security');

			
	[Assets]
	application/views/chat
	assets/js/main.js
	assets/chat.js
	assets/css/chat.css
	assets/css/default.css

;#-------------------------------------------------------------#
[Optional]
	[plugin]
	Bootstrap version 3.3.7