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
        $cliente = new Cliente;
        $cliente->nome = $_POST['nome'];
        $cliente->email = $_POST['email'];
        $cliente->telefone = $_POST['telefone'];

        $clienteDAO = new ClienteDAO;
        $erro = $clienteDAO->cadastrarCliente($cliente);

        if (!is_array($erro)) {
            Utils::redirect(BASE_URL . 'cliente/listar');
        } else {
            $mensagem = 'The country  was not created, follow error was returned: ' . $erro[2] . '.<br/><br/><a href="' . BASE_URL . 'cliente/criar">Voltar</a>';
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
        $cliente = new Cliente;
        $cliente->id_cliente = $_POST['id'];
        $cliente->nome = $_POST['nome'];
        $cliente->email = $_POST['email'];
        $cliente->telefone = $_POST['telefone'];

        $clienteDAO = new ClienteDAO;
        $erro = $clienteDAO->alterarCliente($cliente);

        if (!$erro[1]) {
            Utils::redirect(BASE_URL . 'cliente/listar');
        } else {
            $mensagem = 'The client  was not updated, follow error was returned: ' . $erro[2] . '.<br/><br/><a href="' . BASE_URL . 'cliente/listar">Voltar</a>';
            MensagemController::index($mensagem);
        }

    }


    static function excluir($id)
    {
        $clienteDAO = new ClienteDAO;
        $erro = $clienteDAO->excluirCliente($id[0]);

        if (!$erro[1]) {
            Utils::redirect(BASE_URL . 'cliente/listar');
        } else {
            $mensagem = 'The country  was not deleted, follow error was returned: ' . $erro[2] . '.<br/><br/><a href="' . BASE_URL . 'cliente/listar">Voltar</a>';
            MensagemController::index($mensagem);
        }
    }
}
