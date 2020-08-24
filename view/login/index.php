<body class="bg-gradient-primary">

	<div class="container">

		<!-- Outer Row -->
		<div class="row justify-content-center">

			<div class="col-xl-10 col-lg-12 col-md-9">

				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
							<div class="col-lg-6">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">Bem vindo de volta!</h1>
									</div>
									<form method="POST" action="<?php echo BASE_URL ?>login/logar" id="form-login" class="user">

										<div class="form-group">
											<input type="email" name="login" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
										</div>
										<div class="form-group">
											<input type="password" name="senha" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
										</div>

										<button class="btn btn-primary btn-user btn-block" type="submit">Login</button>

									</form>
									<hr>
									<div class="text-center">
										<button class="btn small" type="button" id="btn-esqueci-senha" data-toggle="modal" data-target="#myModal">Forgot password?</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-validate form-horizontal" id="lembrar_senha" method="post" action="<?php echo BASE_URL . 'login/esqueci_senha' ?>" novalidate="novalidate">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" id="botao-fechar-password">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Forgot password</h4>
					</div>
					<div class="modal-body">
						<div class="mensagem"></div>
						<div class="form">
							<div class="form-group ">
								<div class="col-lg-offset-2">
									<p>An email will be sent to you. Please make sure the email is not in your spam folder and follow the procedure to set your new password</p>
								</div>
								<label for="login" class="control-label col-lg-3">Email<span class="required">*</span></label>
								<div class="col-lg-8">
									<input class="form-control " id="login" type="email" name="login">
								</div>
								<div class="col-lg-1 loader"></div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" id="send-password" type="button">Send</button>
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- Bootstrap core JavaScript-->
	<script src="<?php echo LIB ?>vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo LIB ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?php echo LIB ?>vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?php echo LIB ?>js/sb-admin-2.min.js"></script>

</body>

</html>