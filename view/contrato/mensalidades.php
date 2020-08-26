<!-- Begin Page Content -->
<div class="pagina-listar container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Mensalidades do contrato <?php echo $contrato->id; ?></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Lista de mensalidades</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Valor</th>
                            <th>Mês</th>
                            <th>Paga</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Valor</th>
                            <th>Mês</th>
                            <th>Paga</th>
                            <th>Ações</th>
                    </tfoot>
                    <tbody>
                        <?php foreach ($mensalidades as $c => $mensalidade) : ?>
                            <tr>
                                <td><?php echo $mensalidade->id; ?></td>
                                <td>R$ <?php echo number_format($mensalidade->valor, 2, ",", "."); ?></td>
                                <td><?php echo date('m/Y', strtotime($mensalidade->mes)); ?></td>
                                <td><?php echo ($mensalidade->paga) ? "Sim" : "Não"  ?></td>
                                <td>
                                    <?php if (!$mensalidade->paga) : ?>
                                        <a href="/contrato/pagar_mensalidade/<?php echo $mensalidade->id; ?>">Marcar como paga</a>
                                    <?php endif; ?>
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