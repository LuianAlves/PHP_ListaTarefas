<?php

    // Objeto 01
    class Tarefa {
        // Atributos
        private $id;
        private $id_status;
        private $tarefa;
        private $data_cadastro;

        // Métodos Get Set

        public function __get($atributo) {
            return $this->$atributo;
        }
        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
            return $this; // Retornando apenas o $this,em tarefa_controller quando instanciarmos o Objeto [Tarefa] com $tarefa podemos fazer apenas uma ve
                          // Após acrescenta a instancia utilizar o ' -> ' e ascrecentar o prox, exemplo, 
                          // $tarefa->__set('id', $_POST['id']) -> __set('tarefa', $_POST['tarefa'])
        }
    }

    // Instanciando o Objeto [Tarefa] será feita a partir do script tarefa_controller.php
    

?>