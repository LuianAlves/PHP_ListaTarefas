<?php 

// CRUD 
    // Objeto 01
    class TarefaService { // Para realizar o CRUD junto ao Banco de Dados, este Objeto [TarefaService] precisa receber parametros referente a conexao do Banco de Dados e atribui-los á atributos internos
        // Atributos
        private $conexao; // Atributo referente ao Objeto [Conexao em conexao.php]
        private $tarefa;  // Atributo referente ao Objeto [Tarefa em tarefa.model.php]

        // Constructor receberá 2 parametros: ($conexao, $tarefa) ||        Utilizando a 'tipagem' do parametro, ou seja, nomeando os parametros junto ao nome das class do Objeto
        public function __construct(Conexao $conexao, Tarefa $tarefa) { //  permitirá que receberá só os dados referentes a este objeto, ocasionando assim em um erro caso venha dados diferentes
            $this->conexao = $conexao->conectar(); // Utilizar o metodo conectar() para enviar o link de conexao recebido  // Desta forma agora temos na instancia do Objeto [] atributos que representam a conexao
            $this->tarefa = $tarefa; // Desta forma agora temos na instancia do Objeto [] atributos que representam a tarefa
        }

        // Métodos
        public function inserir(){ // INSERT INTO || Create -> Possivel somente após a conexão ser feita
            $query = '
                insert into 
                    tb_tarefas(tarefa)
                values
                    (?)
            '; // Utilizando o prepare do PDO em [values(:tarefa)] para evitar o SQL INJECTION
            
            $stmt = $this->conexao->prepare($query); // conexao (é atribuindo dentro do __construct onde recebe todo o valor da instancia do Objeto [Conexao])
            $stmt->bindValue(1, $this->tarefa->__get('tarefa')); // 1° Parametro é o prepare do PDO e 2° parametro é referente á tarefa instanciada dentro do __construct [this->tarefa] que recebe todo o valor [$tarefa] da instancia do Objeto [Tarefa] 
            
            $stmt->execute(); // Executa a query
        }

        public function recuperar(){ // SELECT * FROM || Read
            $query = '           
                select 
                    t.id, s.status, t.tarefa 
                from 
                    tb_tarefas as t
                left join
                    tb_status as s on (t.id_status = s.id)
            '; // O left Join vai recuperar o id_status em [tb_tarefas] e cruzar-lo com o id em [tb_status]

            $stmt = $this->conexao->prepare($query); // Mesmo que não receba parametros e tenha problemas de SQL INJECTON é bom utilizar
            
            $stmt->execute(); // Executa a query
            
            return $stmt->fetchAll(PDO::FETCH_OBJ); // Utilizar o retorn para retornar um array de objetos atraves do metodo recuperar()
        }

        public function atualizar(){    // Update
            $query = '
                update 
                    tb_tarefas
                set
                    tarefa = ? 
                where
                    id = ?
            ';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1, $this->tarefa->__get('tarefa')); // 1° Parametro é o prepare do PDO e 2° parametro é referente á tarefa instanciada dentro do __construct [this->tarefa] que recebe todo o valor [$tarefa] da instancia do Objeto [Tarefa] 
            $stmt->bindValue(2, $this->tarefa->__get('id')); // 1° Parametro é o prepare do PDO e 2° parametro é referente á tarefa instanciada dentro do __construct [this->tarefa] que recebe todo o valor [$tarefa] da instancia do Objeto [Tarefa] 
            
            return $stmt->execute(); // Executa a query
        }

        public function remover(){      // Remove

            $query = '
                delete from
                    tb_tarefas
                where
                    id = ?
            ';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1, $this->tarefa->__get('id')); // ('id') é o atributo de tarefa que será recuperado e utilizado pelo bindValue

            $stmt->execute();

        }

        public function tarefaRealizada() {    // Marcando Tarefa como Realizada
            $query = '
                update 
                    tb_tarefas
                set
                    id_status = ? 
                where
                    id = ?
            ';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1, $this->tarefa->__get('id_status')); // 1° Parametro é o prepare do PDO e 2° parametro é referente á tarefa instanciada dentro do __construct [this->tarefa] que recebe todo o valor [$id_status] da instancia do Objeto [Tarefa] 
            $stmt->bindValue(2, $this->tarefa->__get('id')); // 1° Parametro é o prepare do PDO e 2° parametro é referente á tarefa instanciada dentro do __construct [this->tarefa] que recebe todo o valor [$tarefa] da instancia do Objeto [Tarefa] 
            
            return $stmt->execute(); // Executa a query
        }

        public function recuperarTarefasPendentes() { // Recuperando tarefas pendentes
            $query = '           
                select 
                    t.id, s.status, t.tarefa 
                from 
                    tb_tarefas as t
                left join
                    tb_status as s on (t.id_status = s.id)
                where
                    t.id_status = ?
            '; // O left Join vai recuperar o id_status em [tb_tarefas] e cruzar-lo com o id em [tb_status]

            $stmt = $this->conexao->prepare($query); // Mesmo que não receba parametros e tenha problemas de SQL INJECTON é bom utilizar
            $stmt->bindValue(1, $this->tarefa->__get('id_status'));
            $stmt->execute(); // Executa a query
            
            return $stmt->fetchAll(PDO::FETCH_OBJ); // Utilizar o return para retornar um array de objetos atraves do metodo recuperar()
        }
    }

    // Instanciando o Objeto [TarefaService] será feita a partir do script tarefa_controller.php

?>


<!-- 
    PDO STATEMENT 
    
    $stmt->bindValue(1, $this->tarefa->__get('id_status'));

    1° Parametro: Utilizando o valor [1] linka este valor com primeiro [?] na query, logo se tiver mais de um [?] utilizar o valor [2, 3 ...]

    2° Parametro: $this->tarefa Armazena o Objeto [Tarefa] que esta sendo encaminhado no __constructor, onde esse parametro $tarefa está sendo criando em tarefa_controller.php
       e encaminhado o valor de $tarefa para o __constructor de TarefaService tendo como valor setado id_status = 1

       __get('id_status') Recupera o valor id_status do Objeto associado ao atributo tarefa de TarefaService

 -->