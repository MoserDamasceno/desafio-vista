<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Imóveis</h1>
    <p class="mb-4">Editar informações do imóvel.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <form action="/imovel/alterar/<?php echo $imovel->id; ?>" method="POST">
                <input type="hidden" name="id" value="<?php echo $imovel->id; ?>">
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input name="endereco" type="text" class="form-control" id="endereco" placeholder="Insira o endereço do imóvel" value="<?php echo $imovel->endereco; ?>">
                </div>

                <div class="form-group">
                    <label for="numero">Número</label>
                    <input name="numero" type="text" class="form-control" id="numero" placeholder="Insira o número do imóvel" value="<?php echo $imovel->numero; ?>">
                </div>

                <div class="form-group">
                    <label for="complemento">Complemento</label>
                    <input name="complemento" type="text" class="form-control" id="complemento" placeholder="Insira o complemento do imóvel" value="<?php echo $imovel->complemento; ?>">
                </div>

                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input name="bairro" type="text" class="form-control" id="bairro" placeholder="Insira o bairro do imóvel" value="<?php echo $imovel->bairro; ?>">
                </div>

                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input name="cidade" type="text" class="form-control" id="cidade" placeholder="Insira o cidade do imóvel" value="<?php echo $imovel->cidade; ?>">
                </div>

                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input name="estado" type="text" class="form-control" id="estado" placeholder="Insira o estado do imóvel" value="<?php echo $imovel->estado; ?>">
                </div>

                <div class="form-group">
                    <label for="proprietario_id">Proprietário</label>
                    <select class="custom-select" id="proprietario_id" name="proprietario_id" value="<?php echo $imovel->proprietario_id; ?>">
                        <option value disabled>Escolha o proprietário</option>
                        <?php foreach ($proprietarios as $p => $proprietario) : ?>
                            <option value="<?php echo $proprietario->id; ?>" <?php echo ($proprietario->id == $imovel->proprietario_id) ? ' selected ':'' ; ?>><?php echo $proprietario->nome; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input-group mb-3">

                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->