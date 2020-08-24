<div class="row">
	<div class="col-lg-7">
		<section class="panel" id="form_user">
			<header class="panel-heading">
			Create user
			</header>
			<div class="panel-body">
				<div class="form">
					<form class="form-validate form-horizontal" id="cadastro_usuario" method="post" action=" <?php echo BASE_URL.'usuario/salvar' ?>" novalidate="novalidate">
						<div class="form-group ">
							<label for="nome" class="control-label col-lg-2">Name<span class="required">*</span></label>
							<div class="col-lg-10">
								<input class="form-control" id="nome" name="nome" type="text">
							</div>
						</div>
						<div class="form-group ">
							<label for="login" class="control-label col-lg-2">Email <span class="required">*</span></label>
							<div class="col-lg-10">
								<input class="form-control " id="login" type="email" name="login">
							</div>
						</div>

						<div class="form-group ">
							<label for="senha" class="control-label col-lg-2">Password <span class="required">*</span></label>
							<div class="col-lg-10">
								<input class="form-control " id="senha" type="password" name="senha">
							</div>
						</div>

						<div class="form-group ">
							<label for="senha2" class="control-label col-lg-2">Confirm password<span class="required">*</span></label>
							<div class="col-lg-10">
								<input class="form-control " id="senha2" type="password" name="senha2">
							</div>
						</div>

						<div class="form-group ">
							<label for="tipo" class="control-label col-lg-2">User category<span class="required">*</span></label>
							<div class="col-lg-10">
								<select name="tipo" id="tipo"  class="form-control ">
									<?php foreach ($tipos as $tipo): ?>
										<option value="<?php echo $tipo->id_tipo_usuario ?>"><?php echo $tipo->tipo_usuario ?></option>	
									<?php endforeach ?>
								</select>
							</div>
						</div>

						<div class="form-group pais">
							<label for="pais" class="control-label col-lg-2">Country<span class="required">*</span></label>
							<div class="col-lg-10">
								<select name="pais" id="pais"  class="form-control ">
									<?php foreach ($paises as $pais): ?>
										<option value="<?php echo $pais->id_pais ?>"><?php echo $pais->pais ?></option>	
									<?php endforeach ?>
								</select>
							</div>
						</div>

						
						<div class="form-group botoes-form">
							<div class="col-lg-offset-2 col-lg-10">
								<button class="btn btn-primary" type="submit">Save</button>
								<a class="btn btn-default" type="button" href="<?php echo BASE_URL.'usuario/listar' ?>">Cancel</a>
							</div>
						</div>
					</form>
				</div>

			</div>
		</section>
	</div>
</div>