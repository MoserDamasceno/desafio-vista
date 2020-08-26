<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Proprietarios</h1>
    <p class="mb-4">Editar informações do proprietario.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/proprietario/alterar" method="POST">
                <input type="hidden" name="id" value="<?php echo $proprietario->id; ?>">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input name="nome" type="text" class="form-control" id="nome" placeholder="Insira o nome" value="<?php echo $proprietario->nome; ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="Insira o e-mail" value="<?php echo $proprietario->email; ?>" required>
                </div>

                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input name="telefone" type="text" class="form-control" id="telefone" placeholder="Insira o Telefone" value="<?php echo $proprietario->telefone; ?>" required>
                </div>
                <div class="form-group">
                    <label for="dia_repasse">Dia de repasse</label>
                    <input name="dia_repasse" type="number" class="form-control" id="dia_repasse" placeholder="Insira o dia de repasse" value="<?php echo $proprietario->dia_repasse; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->