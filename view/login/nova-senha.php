<body class="login-body">

	<div class="container">
	  <form class="login-form nova-senha" action="<?php echo BASE_URL ?>login/change_password" method="POST">  
	  	<input type="hidden" value="<?php echo $usuario->id_usuario ?>" name="usuario">
	  	<input type="hidden" value="<?php echo $usuario->hash ?>" name="hash">
		<div class="login-wrap">
			<p>New password for: <?php echo $usuario->login ?></p>	
			<div class="input-group">
				<span class="input-group-addon"><i class="icon_key_alt"></i></span>
				<input type="password" class="form-control" placeholder="Password"  id="senha" name="senha">
			</div>
			<div class="input-group">
				<span class="input-group-addon"><i class="icon_key_alt"></i></span>
				<input type="password" class="form-control" placeholder="Confirm Password" id="senha2" name="senha2">
			</div>
			<button class="btn btn-primary btn-lg btn-block" type="submit">save</button>
		</div>
	  </form>

	</div>


  </body>

<script src="<?php echo LIB ?>js/jquery.js"></script>
<script src="<?php echo LIB ?>js/bootstrap.min.js"></script>
<script src="<?php echo LIB ?>js/login.js"></script>
</html>