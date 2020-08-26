<!-- Begin Page Content -->
<div class="pagina-listar container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Contratos</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Lista de contratos</h6>
            <a class="btn btn-primary" href="/contrato/criar">Adicionar novo</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Proprietário</th>
                            <th>Locatário</th>
                            <th>Imóvel</th>
                            <th>Data de início</th>
                            <th>Valor</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Proprietário</th>
                            <th>Locatário</th>
                            <th>Imóvel</th>
                            <th>Data de início</th>
                            <th>Valor</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($contratos as $c => $contrato) : ?>
                            <tr>
                                <td><?php echo $contrato->id; ?></td>
                                <td><?php echo $contrato->proprietario; ?></td>
                                <td><?php echo $contrato->locatario; ?></td>
                                <td><?php echo $contrato->endereco . ' - ' . $contrato->bairro ; ?></td>
                                <td><?php echo Utils::convertDate($contrato->inicio, 'php'); ?></td>
                                <td>R$ <?php echo str_replace('.',',',$contrato->valor_aluguel); ?></td>
                                <td>
                                    <a href="/contrato/repasses/<?php echo $contrato->id; ?>">Ver repasses</a> - 
                                    <a href="/contrato/mensalidades/<?php echo $contrato->id; ?>">Ver mensalidades</a> - 
                                    <a href="/contrato/editar/<?php echo $contrato->id; ?>">Editar</a> - 
                                    <a href="/contrato/excluir/<?php echo $contrato->id; ?>">Apagar</a> - 
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->