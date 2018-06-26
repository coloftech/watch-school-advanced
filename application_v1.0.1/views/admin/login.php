<div class="anime">
	<div class="anime-body">
	<div class="panel" style="margin: 10%;">
		<form method="POST" id="login-frm" action="../auth">
                    <br>
                    <h2>Login</h2>
                    <div class="message"></div>
                    <div class="form-group">
                        <input type="text" name="username" id="Username" class="form-control" placeholder="Username" required="required" autofocus="autofocus"/>
                    </div>
                    <div class="form-group">
                         <input type="password" name="password" class="form-control" placeholder="Password" required="required" />
                    </div>
                    <button class="btn btn-block btn-default btn-success" id="login" type="submit"><i class="fa fa-lock"></i> Login</button>
                </form> <br>
                <button class="btn btn-block btn-default btn-primary" id="create-account" type="submit"><i class="fa fa-plus-circle"></i> Register</button>
           
	</div>
                

	</div>
</div>

<script type="text/javascript">
	$('form').on('submit',function(e){
		//alert('Hey')
		$.ajax({
			data : $(this).serialize(),
			url: '../auth',
			dataType: 'json',
			type: 'post',
			success: function(resp){
				if(resp.success == true){
					window.location = '<?php echo site_url();?>';
				}else{
					alert('Invalid login detail.');
				}
			}
		})
		return false;
	})
</script>