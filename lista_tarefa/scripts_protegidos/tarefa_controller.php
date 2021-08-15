<?php 
    // Script responsavel por instanciar o Objeto [Tarefa] e, atraves do Objeto [TarefaService] utilizando o Objeto [Conexao], controlar a persistencia no Banco de Dados
    
    // Incluindo conexao.php | tarefa.model.php | tarefa.service php -> Porém este require estará sendo utilizado no tarefa_controller dentro do diretório público, então utilizar o caminho raiz dos scripts
    require "scripts_protegidos/tarefa.model.php";      // Quando estiver fora do diretório público é necessário utilizar o ../
    require "scripts_protegidos/tarefa.service.php";    // Quando estiver fora do diretório público é necessário utilizar o ../
    require "scripts_protegidos/conexao.php";           // Quando estiver fora do diretório público é necessário utilizar o ../

    // No if estamos utilizando o parametro 'acao' e no elfe if estamos utilizando a variavel $acao, porém para o php identificar precisamos utilizar esta variavel
    // OU SEJA - Receber parametro ?acao=inserir -> $acao = $_GET['acao]
    // SE NÃO - $acao = recuperar [valor recebido em todas_tarefas]
    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao; // Caso venha o parametro por GET atribuir o valor recebido do GET á variavel $acao, caso contrário, ou seja não recebe o parametro por GET a aplicação irá esperar pela variavel ação [acao = recuperar; criada em todas_tarefas]

    // Criando uma condição com base no parametro [?acao=inserir] em nova_tarefa
    if ($acao == 'inserir') { // Caso o parametro retorne true[acao=inserir] atribuirá este á variavel $acao
        // 1° Passo
        // Criar a instancia do Objeto [Tarefa] -> tarefa.model.php
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']); // utilizar o set para setar um valor no atributo $tarefa [utilizar 2 parametros: 1° é o nome do atributo e 2° o valor a ser adicionado que será o valor recido do forml via POST]

        // 2° Passo
        // Criar a instancia do Objeto [Conexao] -> conexao.php
        $conexao = new Conexao();

        // 3° Passo
        // Instancia do Objeto [TarefaService] || É este Objeto [TarefaService] que irá recuperar o Objeto [Conexao] e Objeto [Tarefa] para realização das operações junto ao Banco de Dados                                      
        $tarefaService = new TarefaService($conexao, $tarefa); // Receber como parametro $conexao e $tarefa, onde entra nos parametros do __construct em [tarefa.service.php]
        $tarefaService->inserir(); // Método recebe os parametros $conexao e $tarefa e executa eles a partir do '$stmt->execute()' criado em tarefa.service.php

        header('Location: nova_tarefa.php?inclusao=1'); // Esta header será realizada dentro do diretório público, logo não precisamos adicionar o caminho raiz
    
    } else if ($acao == 'recuperar') { // Esta variavel $acao foi criada em [todas_tarefas.php] e está disponivel aqui pois foi criada em cima do require, tornando possivel acessa-lá aqui
        // Caso não retorne parametro, a variavel $acao não receberá o parametro do GET portanto assim conterá o valor recebido em todas_tarefas.php
        
        $tarefa = new Tarefa(); // Instanciamos os 2 Objetos por conta do __constructor em tarefas.services onde espera os 2 parametros
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa); // Instanciando o Objeto [TarefaService] para ter acesso aos métodos do __constructor
        $tarefas = $tarefaService->recuperar(); // // Método recebe os parametros $conexao e $tarefa e executa eles a partir do ... criado em tarefa.service.php
        // Variavel $tarefas criada apenas nesse bloco, logo quando cair nessa condição esta variavel estará disponivel em todas_tarefas.php 
        // atraves do require e realizará o metodo recuperar() criado em tarefa.service.php;    
    
    } else if ($acao == 'atualizar') {
        
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_POST['id']) // Setando o id que existe dentro do Objeto [Tarefa] e no segundo parametro o valor será o id da super global POST
               -> // Como no metodo set colocamos return $this, não precisamos utilizar a instancia novamente, apenas o -> e acrescentar o novo __set
                 __set('tarefa', $_POST['tarefa']); // Setando tarefa que existe dentro do Objeto [Tarefa] e no segundo parametro o valor será a tarefa da super global POST
        
        $conexao = new Conexao();
        
        $tarefaService = new TarefaService($conexao, $tarefa);

        if($tarefaService->atualizar()) { // IF true entrará na condição
            
            if( isset($_GET['pag']) && $_GET['pag'] == 'index' ) {
                header('Location: index.php');
            } else {
                header('Location: todas_tarefas.php');
            }
        } 

    } else if ($acao == 'remover') {
        
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']); // Estamos recebendo o id via super global GET

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->remover();

        if( isset($_GET['pag']) && $_GET['pag'] == 'index' ) {
            header('Location: index.php');
        } else {
            header('Location: todas_tarefas.php');
        }

    } else if ($acao == 'tarefaRealizada') {

        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']) // Estamos recebendo o id via super global GET)
               -> __set('id_status', 2);  // Marcando id_status como 1: pendente e 2: realizado


        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->tarefaRealizada();

        if( isset($_GET['pag']) && $_GET['pag'] == 'index' ) {
            header('Location: index.php');
        } else {
            header('Location: todas_tarefas.php');
        }
        
    } else if ($acao == 'recuperarTarefasPendentes') {

        $tarefa = new Tarefa(); // Instanciamos os 2 Objetos por conta do __constructor em tarefas.services onde espera os 2 parametros
        $tarefa->__set('id_status', 1); // Setando no Objeto [Tarefa] o id_status como sendo 1
        
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa); // Instanciando o Objeto [TarefaService] para ter acesso aos métodos do __constructor
        $tarefas = $tarefaService->recuperarTarefasPendentes(); // // Método recebe os parametros $conexao e $tarefa e executa eles a partir do ... criado em tarefa.service.php
        // Variavel $tarefas criada apenas nesse bloco, logo quando cair nessa condição esta variavel estará disponivel em todas_tarefas.php 
        // atraves do require e realizará o metodo recuperar() criado em tarefa.service.php; 
    }


?>