<!-- Begin Page Content -->
<div class="pagina-listar container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Clientes</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Lista de clientes</h6>
            <a class="btn btn-primary" href="/cliente/criar">Adicionar novo</a>
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
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($clientes as $c => $cliente) : ?>
                            <tr>
                                <td><?php echo $cliente->id; ?></td>
                                <td><?php echo $cliente->nome; ?></td>
                                <td><?php echo $cliente->email; ?></td>
                                <td><?php echo $cliente->telefone; ?></td>
                                <td><a href="/cliente/editar/<?php echo $cliente->id; ?>">Editar</a> - <a href="/cliente/excluir/<?php echo $cliente->id; ?>">Apagar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->