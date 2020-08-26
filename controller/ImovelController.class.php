<?php

class ImovelController
{

    static function index()
    {
        $proprietarioDAO = new ProprietarioDAO;
        $data['proprietarios'] = $proprietarioDAO->listarProprietarios();

        Utils::redirect('imovel/listar', $data);
    }

    static function criar()
    {
        $proprietarioDAO = new ProprietarioDAO;
        $data['proprietarios'] = $proprietarioDAO->listarProprietarios();

        ViewController::view('templates/header');
        ViewController::view('imovel/criar', $data);
        ViewController::view('templates/footer');
    }

    static function salvar()
    {
        $imovel = new Imovel;
        $imovel->endereco = $_POST['endereco'];
        $imovel->numero = $_POST['numero'];
        $imovel->complemento = $_POST['complemento'];
        $imovel->bairro = $_POST['bairro'];
        $imovel->cidade = $_POST['cidade'];
        $imovel->estado = $_POST['estado'];
        $imovel->proprietario_id = $_POST['proprietario_id'];

        $imovelDAO = new ImovelDAO;
        $erro = $imovelDAO->cadastrarImovel($imovel);

        if (!is_array($erro)) {
            $mensagem = 'O imóvel foi criado com sucesso! <br/><br/><a href="' . BASE_URL . 'imovel/listar">Voltar</a>';
            MensagemController::index($mensagem);
        } else {
            $mensagem = 'O imóvel não foi criado. O seguinte erro retornou: ' . $erro[2] . '.<br/><br/><a href="' . BASE_URL . 'imovel/criar">Voltar</a>';
            MensagemController::index($mensagem);
        }
    }

    static function listar()
    {
        $imovelDAO = new ImovelDAO;
        $data['imoveis'] = $imovelDAO->listarImoveis();

        ViewController::view('templates/header');
        ViewController::view('imovel/listar', $data);
        ViewController::view('templates/footer');
    }

    static function editar($id)
    {
        $imovelDAO = new ImovelDAO;
        $data['imovel'] = $imovelDAO->buscarImovel($id[0]);

        $proprietarioDAO = new ProprietarioDAO;
        $data['proprietarios'] = $proprietarioDAO->listarProprietarios();

        ViewController::view('templates/header');
        ViewController::view('imovel/editar', $data);
        ViewController::view('templates/footer');
    }

    static function alterar()
    {
        $imovel = new Imovel;
        $imovel->id = $_POST['id'];
        $imovel->endereco = $_POST['endereco'];
        $imovel->numero = $_POST['numero'];
        $imovel->complemento = $_POST['complemento'];
        $imovel->bairro = $_POST['bairro'];
        $imovel->cidade = $_POST['cidade'];
        $imovel->estado = $_POST['estado'];
        $imovel->proprietario_id = $_POST['proprietario_id'];

        $imovelDAO = new ImovelDAO;
        $erro = $imovelDAO->alterarImovel($imovel);
        
        if (!$erro[1]) {
            $mensagem = 'Imóvel atualizado com sucesso! <br/><br/><a href="' . BASE_URL . 'imovel/listar">Voltar</a>';
            MensagemController::index($mensagem);
        } else {
            $mensagem = 'Imóvel não atualizado. O seguinte erro retornou: ' . $erro[2] . '.<br/><br/><a href="' . BASE_URL . 'imovel/listar">Voltar</a>';
            MensagemController::index($mensagem);
        }

    }


    static function excluir($id)
    {
        $imovelDAO = new ImovelDAO;
        $erro = $imovelDAO->excluirImovel($id[0]);

        if (!$erro[1]) {
            $mensagem = 'Imóvel excluído com sucesso!<br/><br/><a href="' . BASE_URL . 'imovel/listar">Voltar</a>';
            MensagemController::index($mensagem);
        } else {
            $mensagem = 'O imóvel não pode ser excluído. O seguinte erro retornou: ' . $erro[2] . '.<br/><br/><a href="' . BASE_URL . 'imovel/listar">Voltar</a>';
            MensagemController::index($mensagem);
        }
    }
}
