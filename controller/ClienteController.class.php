<?php

class ClienteController
{

    static function index()
    {
        Utils::redirect('cliente/listar');
    }

    static function criar()
    {
        ViewController::view('templates/header');
        ViewController::view('cliente/criar');
        ViewController::view('templates/footer');
    }

    static function salvar()
    {
        if (!empty($_POST['nome']) &&  !empty($_POST['email']) &&  !empty($_POST['telefone'])) {
            $cliente = new Cliente;
            $cliente->nome = $_POST['nome'];
            $cliente->email = $_POST['email'];
            $cliente->telefone = $_POST['telefone'];
        } else {
            $mensagem = 'Erro ao criar cliente: Todos os campos são obrigatórios.<br/><br/><a href="' . BASE_URL . 'cliente/criar">Voltar</a>';
            MensagemController::index($mensagem);
            return;
        }

        $clienteDAO = new ClienteDAO;
        $erro = $clienteDAO->cadastrarCliente($cliente);

        if (!is_array($erro)) {
            $mensagem = 'Cliente cadastrado com sucesso! <br/><br/><a href="' . BASE_URL . 'cliente/listar">Voltar</a>';
            MensagemController::index($mensagem);
        } else {
            $mensagem = 'Cliente não cadastrado. O seguinte erro foi retornado: ' . $erro[2] . '.<br/><br/><a href="' . BASE_URL . 'cliente/criar">Voltar</a>';
            MensagemController::index($mensagem);
        }
    }

    static function listar()
    {
        $clienteDAO = new ClienteDAO;
        $data['clientes'] = $clienteDAO->listarClientes();

        ViewController::view('templates/header');
        ViewController::view('cliente/listar', $data);
        ViewController::view('templates/footer');
    }

    static function editar($id)
    {
        $clienteDAO = new ClienteDAO;
        $data['cliente'] = $clienteDAO->buscarCliente($id[0]);

        ViewController::view('templates/header');
        ViewController::view('cliente/editar', $data);
        ViewController::view('templates/footer');
    }

    static function alterar()
    {
        if (!empty($_POST['nome']) &&  !empty($_POST['email']) &&  !empty($_POST['telefone'])) {
            $cliente = new Cliente;
            $cliente->id = $_POST['id'];
            $cliente->nome = $_POST['nome'];
            $cliente->email = $_POST['email'];
            $cliente->telefone = $_POST['telefone'];
        } else {
            $mensagem = 'Todos os campos são obrigatórios.<br/><br/><a href="' . BASE_URL . 'cliente/editar/'. $_POST['id'].'">Voltar</a>';
            MensagemController::index($mensagem);
            return;
        }

            $clienteDAO = new ClienteDAO;
            $erro = $clienteDAO->alterarCliente($cliente);
            
            if (!$erro[1]) {
                $mensagem = 'Cliente atualizado com sucesso! <br/><br/><a href="' . BASE_URL . 'cliente/listar">Voltar</a>';
                MensagemController::index($mensagem);
            } else {
                $mensagem = 'Cliente não atualizado. O seguinte erro retornou: ' . $erro[2] . '.<br/><br/><a href="' . BASE_URL . 'cliente/editar/'.$_POST['id'].'">Voltar</a>';
                MensagemController::index($mensagem);
            }

    }


    static function excluir($id)
    {
        $clienteDAO = new ClienteDAO;
        $erro = $clienteDAO->excluirCliente($id[0]);

        if (!$erro[1]) {
            $mensagem = 'Cliente excluído com sucesso!<br/><br/><a href="' . BASE_URL . 'cliente/listar">Voltar</a>';
            MensagemController::index($mensagem);
        } else {
            $mensagem = 'O cliente não pode ser excluído. O seguinte erro retornou: ' . $erro[2] . '.<br/><br/><a href="' . BASE_URL . 'cliente/listar">Voltar</a>';
            MensagemController::index($mensagem);
        }
    }
}
