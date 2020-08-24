<div class="row">
	<div class="col-lg-12">
		<section class="panel lista_usuarios">
			<header class="panel-heading">
				Users list
				<button class="btn_action btn_top" id="adicionar-usuario" type="button" data-toggle="modal" data-target="#myModal"><i class="icon_add"></i></button>
			</header>
			<table class="table table-striped border-top" id="sample_1">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Country</th>
						<th>Category</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>  
					<?php foreach ($usuarios as $usuario): ?>
						<tr class="odd gradeX">
							<td><?php echo $usuario->nome ?></td>
							<td><?php echo $usuario->login ?></td>
							<td><?php echo $usuario->pais ?></td>
							<td><?php echo $usuario->tipo_usuario ?></td>
							<td>
								<?php 
								$icon = ($usuario->status) ? 'icon-ok':'icon-remove';
								$url = ($usuario->status) ? 'desactive':'active';
								?>
								<a class="icone-acao" href="<?php echo BASE_URL.'usuario/editar/'.$usuario->id_usuario ?>"><i class="icon-edit" title="Edit"></i></a>
								<a class="icone-ativo icone-acao" href="<?php echo BASE_URL.'usuario/'.$url.'/'.$usuario->id_usuario ?>"><i class="<?php echo $icon ?>" title="<?php echo $url ?>" ></i></a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</section>
	</div>
</div>



<div class="modal fade" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-validate form-horizontal" id="cadastro_usuario" method="post" action=" <?php echo BASE_URL.'usuario/salvar' ?>" novalidate="novalidate">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Create user</h4>
				</div>
				<div class="modal-body">

					<div class="form">
						<div class="form-group ">
							<label for="nome" class="control-label col-lg-3">Name<span class="required">*</span></label>
							<div class="col-lg-9">
								<input class="form-control" id="nome" name="nome" type="text">
							</div>
						</div>
						<div class="form-group ">
							<label for="login" class="control-label col-lg-3">Email <span class="required">*</span></label>
							<div class="col-lg-9">
								<input class="form-control " id="login" type="email" name="login">
							</div>
						</div>

						<div class="form-group ">
							<label for="senha" class="control-label col-lg-3">Password <span class="required">*</span></label>
							<div class="col-lg-9">
								<input class="form-control " id="senha" type="password" name="senha">
							</div>
						</div>

						<div class="form-group ">
							<label for="senha2" class="control-label col-lg-3">Confirm password<span class="required">*</span></label>
							<div class="col-lg-9">
								<input class="form-control " id="senha2" type="password" name="senha2">
							</div>
						</div>

						<div class="form-group ">
							<label for="tipo" class="control-label col-lg-3">User category<span class="required">*</span></label>
							<div class="col-lg-9">
								<select name="tipo" id="tipo"  class="form-control ">
									<?php foreach ($tipos as $tipo): ?>
										<option value="<?php echo $tipo->id_tipo_usuario ?>"><?php echo $tipo->tipo_usuario ?></option>	
									<?php endforeach ?>
								</select>
							</div>
						</div>

						<div class="form-group pais">
							<label for="pais" class="control-label col-lg-3">Country<span class="required">*</span></label>
							<div class="col-lg-9">
								<select name="pais" id="pais"  class="form-control ">
									<?php foreach ($paises as $pais): ?>
										<option value="<?php echo $pais->id_pais ?>"><?php echo $pais->pais ?></option>	
									<?php endforeach ?>
								</select>
							</div>
						</div>

					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button class="btn btn-primary" type="submit">Save</button>
				</div>
			</div><!-- /.modal-content -->
		</form>
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

