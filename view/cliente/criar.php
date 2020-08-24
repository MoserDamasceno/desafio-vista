<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Clientes</h1>
    <p class="mb-4">Lista de clientes</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    
        <div class="card-body">
            <form action="/cliente/salvar" method="POST">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input name="nome" type="text" class="form-control" id="nome" placeholder="Insira o nome">
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input name="email" type="text" class="form-control" id="email" placeholder="Insira o e-mail">
                </div>

                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input name="telefone" type="text" class="form-control" id="telefone" placeholder="Insira o Telefone">
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->