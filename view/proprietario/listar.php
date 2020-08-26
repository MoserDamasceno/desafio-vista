<!-- Begin Page Content -->
<div class="pagina-listar container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Proprietários</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Lista de proprietários</h6>
            <a class="btn btn-primary" href="/proprietario/criar">Adicionar novo</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Dia de repasse</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Dia de repasse</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($proprietarios as $c => $proprietario) : ?>
                            <tr>
                                <td><?php echo $proprietario->id; ?></td>
                                <td><?php echo $proprietario->nome; ?></td>
                                <td><?php echo $proprietario->email; ?></td>
                                <td><?php echo $proprietario->telefone; ?></td>
                                <td><?php echo $proprietario->dia_repasse; ?></td>
                                <td><a href="/proprietario/editar/<?php echo $proprietario->id; ?>">Editar</a> - <a href="/proprietario/excluir/<?php echo $proprietario->id; ?>">Apagar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->