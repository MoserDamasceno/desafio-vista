<!-- Begin Page Content -->
<div class="pagina-listar container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Imóveis</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Lista de imóveis</h6>
            <a class="btn btn-primary" href="/imovel/criar">Adicionar novo</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Endereço</th>
                            <th>Número</th>
                            <th>Bairro</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Endereço</th>
                            <th>Número</th>
                            <th>Bairro</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($imoveis as $c => $imovel) : ?>
                            <tr>
                                <td><?php echo $imovel->id; ?></td>
                                <td><?php echo $imovel->endereco; ?></td>
                                <td><?php echo $imovel->numero; ?></td>
                                <td><?php echo $imovel->bairro; ?></td>
                                <td><?php echo $imovel->cidade; ?></td>
                                <td><?php echo $imovel->estado; ?></td>
                                <td><a href="/imovel/editar/<?php echo $imovel->id; ?>">Editar</a> - <a href="/imovel/excluir/<?php echo $imovel->id; ?>">Apagar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->