<?php
	
	$disabled = (!LoginController::verificarAcesso()) ? 'disabled': '';

?>
	<div class="row">
		<div class="col-lg-12">
			<section class="panel" id="form_user">
				<header class="panel-heading">
					Edit user

				</header>
				<div class="panel-body">
					<div class="form">
						<form class="form-validate form-horizontal" id="alterar_usuario" method="post" action=" <?php echo BASE_URL.'usuario/alterar' ?>" novalidate="novalidate">
							<input type="hidden" name="id_usuario" id="inputId_usuario" class="form-control" value="<?php echo $usuario->id_usuario ?>">
							<div class="form-group ">
								<label for="nome" class="control-label col-lg-2">Name</label>
								<div class="col-lg-10">
									<input class="form-control" id="nome" name="nome" type="text"  value="<?php echo $usuario->nome ?>" <?php echo $disabled ?>>
								</div>
							</div>
							<div class="form-group ">
								<label for="login" class="control-label col-lg-2">Login</label>
								<div class="col-lg-10">
									<input class="form-control " id="login" type="text" name="login"  value="<?php echo $usuario->login ?>" <?php echo $disabled ?>>
								</div>
							</div>

							<div class="form-group ">
								<label for="senha" class="control-label col-lg-2">Password</label>
								<div class="col-lg-10">
									<input class="form-control " id="senha" type="password" name="senha" >
								</div>
							</div>

							<div class="form-group ">
								<label for="senha2" class="control-label col-lg-2">Confirm password</label>
								<div class="col-lg-10">
									<input class="form-control " id="senha2" type="password" name="senha2" >
								</div>
							</div>
							<?php if (LoginController::verificarAcesso()): ?>
								<div class="form-group ">
									<label for="tipo" class="control-label col-lg-2">User category</label>
									<div class="col-lg-10">
										<select name="tipo" id="tipo"  class="form-control">
											<?php 
												foreach ($tipos as $tipo) {
													$selected = ($usuario->tipo_usuario == $tipo->id_tipo_usuario) ? 'selected=""' : '' ;
													echo '<option value="'.$tipo->id_tipo_usuario.'" '.$selected.'> '.$tipo->tipo_usuario.'</option>';	
												}

											?>
										</select>
									</div>
								</div>
							<?php endif ?>
								
							<?php  if (!LoginController::verificarAcesso()): ?>
								<div class="form-group pais">
									<label for="pais" class="control-label col-lg-2">Country<span class="required">*</span></label>
									<div class="col-lg-10">
										<select name="pais" id="pais"  class="form-control " <?php echo $disabled ?>>
											<?php 
												foreach ($paises as $pais) {
													$selected = ($usuario->pais_id == $pais->id_pais) ? 'selected="selected"' : '' ;
													echo '<option value="'.$pais->id_pais.'" '.$selected.'> '. $pais->pais . '</option>';	
												}
											?>
										</select>
									</div>
								</div>
							<?php endif ?>

							<div class="form-group botoes-form">
								<div class="col-lg-offset-2 col-lg-10">
									<button class="btn btn-primary" type="submit">Save</button>
									<a class="btn btn-default" type="button" href="<?php echo BASE_URL.'usuario' ?>">Cancel</a>
									<?php  if (LoginController::verificarAcesso()): ?>
										<button class="btn btn-danger" id="excluir-usuario" type="button" data-toggle="modal" data-target="#myModal">Delete user</button>
									<?php endif ?>
								</div>
							</div>
						</form>
					</div>

				</div>
			</section>
		</div>
	</div>


<div class="modal fade" id="myModal">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		<h4 class="modal-title">Delete user</h4>
	  </div>
	  <div class="modal-body">
		<p>Are you sure?</p>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		<a class="btn btn-danger" id="excluir-usuario" type="button" href="<?php echo BASE_URL.'usuario/delete/'.$usuario->id_usuario ?>">Delete</a>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

