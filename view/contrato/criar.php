<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Contratos</h1>
    <p class="mb-4">Adicionar novo contrato.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <form action="/contrato/salvar" method="POST">
                <div class="form-group">
                    <label for="imovel_id">Imóvel</label>
                    <select class="custom-select" id="imovel_id" name="imovel_id" required>
                        <option value disabled selected>Escolha o imóvel</option>
                        <?php foreach ($imoveis as $i => $imovel) : ?>
                            <option value="<?php echo $imovel->id; ?>"><?php echo $imovel->endereco . ' - ' . $imovel->bairro . ' - ' . $imovel->cidade; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="locatario_id">Locatário</label>
                    <select class="custom-select" id="locatario_id" name="locatario_id" required>
                        <option value disabled selected>Escolha o locatário</option>
                        <?php foreach ($clientes as $c => $cliente) : ?>
                            <option value="<?php echo $cliente->id; ?>"><?php echo $cliente->nome; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="proprietario_id">Proprietário</label>
                    <select class="custom-select" id="proprietario_id" name="proprietario_id" required>
                        <option value disabled selected>Escolha o proprietário</option>
                        <?php foreach ($proprietarios as $p => $proprietario) : ?>
                            <option value="<?php echo $proprietario->id; ?>"><?php echo $proprietario->nome; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="inicio">Início</label>
                    <input name="inicio" class="form-control" type="date" id="inicio">
                </div>


                <div class="form-group">
                    <label for="taxa_administracao">Taxa de administração</label>
                    <div class="input-group">
                        <input name="taxa_administracao" pattern="[0-9]+([,\.][0-9]+)?" type="text" class="form-control fix-rounded-left" id="taxa_administracao" placeholder="Insira o valor da taxa de administração">
                        <div class="input-group-append">
                            <span class="input-group-text">R$</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="valor_aluguel">Valor do aluguel</label>
                    <div class="input-group">
                        <input name="valor_aluguel" pattern="[0-9]+([,\.][0-9]+)?" type="text" class="form-control fix-rounded-left" id="valor_aluguel" placeholder="Insira o valor do aluguel">
                        <div class="input-group-append">
                            <span class="input-group-text">R$</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="condominio">Condomínio</label>
                    <div class="input-group">
                        <input name="condominio" pattern="[0-9]+([,\.][0-9]+)?" type="text" class="form-control fix-rounded-left" id="condominio" placeholder="Insira o valor do condomínio">
                        <div class="input-group-append">
                            <span class="input-group-text">R$</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="iptu">IPTU</label>
                    <div class="input-group">
                        <input name="iptu" pattern="[0-9]+([,\.][0-9]+)?" type="text" class="form-control fix-rounded-left" id="iptu" placeholder="Insira o valor do IPTU">
                        <div class="input-group-append">
                            <span class="input-group-text">R$</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->