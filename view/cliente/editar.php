<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Clientes</h1>
    <p class="mb-4">Lista de clientes</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/cliente/alterar" method="POST">
                <input type="hidden" name="id" value="<?php echo $cliente->id; ?>">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input name="nome" type="text" class="form-control" id="nome" placeholder="Insira o nome" value="<?php echo $cliente->nome; ?>">
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input name="email" type="text" class="form-control" id="email" placeholder="Insira o e-mail" value="<?php echo $cliente->email; ?>">
                </div>

                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input name="telefone" type="text" class="form-control" id="telefone" placeholder="Insira o Telefone" value="<?php echo $cliente->telefone; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->