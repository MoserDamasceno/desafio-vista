<?php

class ContratoController
{

    static function index()
    {
        Utils::redirect('contrato/listar');
    }

    static function criar()
    {
        $imovelDAO = new imovelDAO;
        $data['imoveis'] = $imovelDAO->listarImoveis();

        $clienteDAO = new clienteDAO;
        $data['clientes'] = $clienteDAO->listarClientes();

        $proprietarioDAO = new ProprietarioDAO;
        $data['proprietarios'] = $proprietarioDAO->listarProprietarios();

        ViewController::view('templates/header');
        ViewController::view('contrato/criar', $data);
        ViewController::view('templates/footer');
    }

    static function salvar()
    {
        if (!empty($_POST['imovel_id']) &&  !empty($_POST['proprietario_id']) &&  !empty($_POST['locatario_id'])) {
            $contrato = new Contrato;
            $contrato->imovel_id = $_POST['imovel_id'];
            $contrato->proprietario_id = $_POST['proprietario_id'];
            $contrato->locatario_id = $_POST['locatario_id'];
            $contrato->inicio = $_POST['inicio'];
            $contrato->taxa_administracao = str_replace(',', '.', $_POST['taxa_administracao']);
            $contrato->valor_aluguel = str_replace(',', '.', $_POST['valor_aluguel']);
            $contrato->condominio = str_replace(',', '.', $_POST['condominio']);
            $contrato->iptu = str_replace(',', '.', $_POST['iptu']);
            $contrato->calcularDataFim();
        } else {
            $mensagem = 'Erro ao criar contrato: Verifique os campos obrigatórios.<br/><br/><a href="' . BASE_URL . 'contrato/criar">Voltar</a>';
            MensagemController::index($mensagem);
            return;
        }

        $contratoDAO = new ContratoDAO;
        $erro = $contratoDAO->cadastrarContrato($contrato);

        $mensalidadeDAO = new MensalidadeDAO;
        $mensalidade = new Mensalidade;
        for ($i=1; $i < 13; $i++) {
            $mes = date('Y-m-d', strtotime("+$i month", strtotime($contrato->inicio)));
            $mensalidade->contrato_id = $erro;
            $mensalidade->calcularMensalidade($contrato);
            $mensalidade->mes = $mes;
            
            $resmen = $mensalidadeDAO->cadastrarMensalidade($mensalidade);
        }

        $repasseDAO = new RepasseDAO;
        $repasse = new Repasse;
        for ($i = 1; $i < 13; $i++) {
            $mes = date('Y-m-d', strtotime("+$i month", strtotime($contrato->inicio)));
            $repasse->contrato_id = $erro;
            $repasse->calcularRepasse($contrato);
            $repasse->mes = $mes;

            $resmen = $repasseDAO->cadastrarRepasse($repasse);
        }


        if (!is_array($erro)) {
            $mensagem = 'Contrato cadastrado com sucesso! <br/><br/><a href="' . BASE_URL . 'contrato/listar">Voltar</a>';
            MensagemController::index($mensagem);
        } else {
            $mensagem = 'Contrato não cadastrado. O seguinte erro foi retornado: ' . $erro[2] . '.<br/><br/><a href="' . BASE_URL . 'contrato/criar">Voltar</a>';
            MensagemController::index($mensagem);
        }
    }

    static function listar()
    {
        $contratoDAO = new ContratoDAO;
        $data['contratos'] = $contratoDAO->listarContratos();

        ViewController::view('templates/header');
        ViewController::view('contrato/listar', $data);
        ViewController::view('templates/footer');
    }

    static function editar($id)
    {
        $imovelDAO = new imovelDAO;
        $data['imoveis'] = $imovelDAO->listarImoveis();

        $clienteDAO = new clienteDAO;
        $data['clientes'] = $clienteDAO->listarClientes();

        $proprietarioDAO = new ProprietarioDAO;
        $data['proprietarios'] = $proprietarioDAO->listarProprietarios();

        $contratoDAO = new ContratoDAO;
        $data['contrato'] = $contratoDAO->buscarContrato($id[0]);

        ViewController::view('templates/header');
        ViewController::view('contrato/editar', $data);
        ViewController::view('templates/footer');
    }

    static function alterar()
    {
        if (!empty($_POST['imovel_id']) &&  !empty($_POST['proprietario_id']) &&  !empty($_POST['locatario_id'])) {
            $contrato = new Contrato;
            $contrato->id = $_POST['id'];
            $contrato->imovel_id = $_POST['imovel_id'];
            $contrato->proprietario_id = $_POST['proprietario_id'];
            $contrato->locatario_id = $_POST['locatario_id'];
            $contrato->inicio = $_POST['inicio'];
            $contrato->taxa_administracao = str_replace(',', '.', $_POST['taxa_administracao']);
            $contrato->valor_aluguel = str_replace(',', '.', $_POST['valor_aluguel']);
            $contrato->condominio = str_replace(',', '.', $_POST['condominio']);
            $contrato->iptu = str_replace(',', '.', $_POST['iptu']);
            $contrato->calcularDataFim();
        } else {
            $mensagem = 'Verifique os campos obrigatórios.<br/><br/><a href="' . BASE_URL . 'contrato/editar/' . $_POST['id'] . '">Voltar</a>';
            MensagemController::index($mensagem);
            return;
        }

        $contratoDAO = new ContratoDAO;
        $erro = $contratoDAO->alterarContrato($contrato);

        if (!$erro[1]) {
            $mensagem = 'Contrato atualizado com sucesso! <br/><br/><a href="' . BASE_URL . 'contrato/listar">Voltar</a>';
            MensagemController::index($mensagem);
        } else {
            $mensagem = 'Contrato não atualizado. O seguinte erro retornou: ' . $erro[2] . '.<br/><br/><a href="' . BASE_URL . 'contrato/editar/' . $_POST['id'] . '">Voltar</a>';
            MensagemController::index($mensagem);
        }
    }


    static function excluir($id)
    {
        $contratoDAO = new ContratoDAO;
        $erro = $contratoDAO->excluirContrato($id[0]);

        if (!$erro[1]) {
            $mensagem = 'Contrato excluído com sucesso!<br/><br/><a href="' . BASE_URL . 'contrato/listar">Voltar</a>';
            MensagemController::index($mensagem);
        } else {
            $mensagem = 'O contrato não pode ser excluído. O seguinte erro retornou: ' . $erro[2] . '.<br/><br/><a href="' . BASE_URL . 'contrato/listar">Voltar</a>';
            MensagemController::index($mensagem);
        }
    }

    static function mensalidades($contrato)
    {
        $contratoDAO = new ContratoDAO;
        $data['contrato'] = $contratoDAO->buscarContrato($contrato[0]);

        $mensalidadeDAO = new MensalidadeDAO;
        $data['mensalidades'] = $mensalidadeDAO->buscarMensalidadesContrato($contrato[0]);



        ViewController::view('templates/header');
        ViewController::view('contrato/mensalidades', $data);
        ViewController::view('templates/footer');

    }
    
    static function pagar_mensalidade($mensalidade)
    {
        $mensalidadeDAO = new MensalidadeDAO;
        $erro = $mensalidadeDAO->pagarMensalidade($mensalidade[0]);
        $mensalidade = $mensalidadeDAO->buscarMensalidade($mensalidade[0]);

        if (!$erro[1]) {
            $mensagem = 'Mensalidade paga com sucesso!<br/><br/><a href="' . BASE_URL . 'contrato/mensalidades/'.$mensalidade->contrato_id.'">Voltar</a>';
            MensagemController::index($mensagem);
        } else {
            $mensagem = 'A mensalidade não pode ser marcada como paga. O seguinte erro retornou: ' . $erro[2] . '.<br/><br/><a href="' . BASE_URL . 'contrato/mensalidades/' . $mensalidade->contrato_id . '">Voltar</a>';
            MensagemController::index($mensagem);
        }
    }

    static function repasses($contrato)
    {
        $contratoDAO = new ContratoDAO;
        $data['contrato'] = $contratoDAO->buscarContrato($contrato[0]);

        $repasseDAO = new RepasseDAO;
        $data['repasses'] = $repasseDAO->buscarRepassesContrato($contrato[0]);



        ViewController::view('templates/header');
        ViewController::view('contrato/repasses', $data);
        ViewController::view('templates/footer');
    }

    static function pagar_repasse($repasse)
    {
        $repasseDAO = new RepasseDAO;
        $erro = $repasseDAO->pagarRepasse($repasse[0]);
        $repasse = $repasseDAO->buscarRepasse($repasse[0]);

        if (!$erro[1]) {
            $mensagem = 'Repasse pago com sucesso!<br/><br/><a href="' . BASE_URL . 'contrato/repasses/' . $repasse->contrato_id . '">Voltar</a>';
            MensagemController::index($mensagem);
        } else {
            $mensagem = 'A repasse não pode ser marcada como pago. O seguinte erro retornou: ' . $erro[2] . '.<br/><br/><a href="' . BASE_URL . 'contrato/repasses/' . $repasse->contrato_id . '">Voltar</a>';
            MensagemController::index($mensagem);
        }
    }
}
