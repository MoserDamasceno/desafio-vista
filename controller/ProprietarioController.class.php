<?php

class ProprietarioController
{

    static function index()
    {
        Utils::redirect('proprietario/listar');
    }

    static function criar()
    {
        ViewController::view('templates/header');
        ViewController::view('proprietario/criar');
        ViewController::view('templates/footer');
    }

    static function salvar()
    {
        if (!empty($_POST['nome']) &&  !empty($_POST['email']) &&  !empty($_POST['telefone'])) {
            $proprietario = new Proprietario;
            $proprietario->id = $_POST['id'];
            $proprietario->nome = $_POST['nome'];
            $proprietario->email = $_POST['email'];
            $proprietario->telefone = $_POST['telefone'];
            $proprietario->dia_repasse = $_POST['dia_repasse'];
        } else {
            $mensagem = 'Todos os campos são obrigatórios.<br/><br/><a href="' . BASE_URL . 'proprietario/editar/' . $_POST['id'] . '">Voltar</a>';
            MensagemController::index($mensagem);
            return;
        }

        $proprietarioDAO = new ProprietarioDAO;
        $erro = $proprietarioDAO->cadastrarProprietario($proprietario);

        if (!is_array($erro)) {
            $mensagem = 'Proprietário criado com sucesso! <br/><br/><a href="' . BASE_URL . 'proprietario/listar">Voltar</a>';
            MensagemController::index($mensagem);
        } else {
            $mensagem = 'Proprietário não criado. O seguinte erro retornou:' . $erro[2] . '.<br/><br/><a href="' . BASE_URL . 'proprietario/criar">Voltar</a>';
            MensagemController::index($mensagem);
        }
    }

    static function listar()
    {
        $proprietarioDAO = new ProprietarioDAO;
        $data['proprietarios'] = $proprietarioDAO->listarProprietarios();

        ViewController::view('templates/header');
        ViewController::view('proprietario/listar', $data);
        ViewController::view('templates/footer');
    }

    static function editar($id)
    {
        $proprietarioDAO = new ProprietarioDAO;
        $data['proprietario'] = $proprietarioDAO->buscarProprietario($id[0]);

        ViewController::view('templates/header');
        ViewController::view('proprietario/editar', $data);
        ViewController::view('templates/footer');
    }

    static function alterar()
    {
        if (!empty($_POST['nome']) &&  !empty($_POST['email']) &&  !empty($_POST['telefone'])) {
            $proprietario = new Proprietario;
            $proprietario->id = $_POST['id'];
            $proprietario->nome = $_POST['nome'];
            $proprietario->email = $_POST['email'];
            $proprietario->telefone = $_POST['telefone'];
            $proprietario->dia_repasse = $_POST['dia_repasse'];
        } else {
            $mensagem = 'Todos os campos são obrigatórios.<br/><br/><a href="' . BASE_URL . 'proprietario/editar/'. $_POST['id'].'">Voltar</a>';
            MensagemController::index($mensagem);
            return;
        }

            $proprietarioDAO = new ProprietarioDAO;
            $erro = $proprietarioDAO->alterarProprietario($proprietario);
            
            if (!$erro[1]) {
                $mensagem = 'Proprietário atualizado com sucesso! <br/><br/><a href="' . BASE_URL . 'proprietario/listar">Voltar</a>';
                MensagemController::index($mensagem);
            } else {
                $mensagem = 'Proprietario não atualizado. O seguinte erro retornou: ' . $erro[2] . '.<br/><br/><a href="' . BASE_URL . 'proprietario/listar">Voltar</a>';
                MensagemController::index($mensagem);
            }

    }


    static function excluir($id)
    {
        $proprietarioDAO = new ProprietarioDAO;
        $erro = $proprietarioDAO->excluirProprietario($id[0]);

        if (!$erro[1]) {
            $mensagem = 'Proprietario excluído com sucesso!<br/><br/><a href="' . BASE_URL . 'proprietario/listar">Voltar</a>';
            MensagemController::index($mensagem);
        } else {
            $mensagem = 'O proprietario não pode ser excluído. O seguinte erro retornou: ' . $erro[2] . '.<br/><br/><a href="' . BASE_URL . 'proprietario/listar">Voltar</a>';
            MensagemController::index($mensagem);
        }
    }
}
