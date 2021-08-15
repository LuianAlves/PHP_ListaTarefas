<?php 

    // CLASS DE CONEXÃO COM O BANCO DE DADOS

    // Objeto
    class Conexao {
        // Atributos de conexão
        private $host = 'localhost'; // Host do Banco de Dados
        private $port = '3308'; // Porta do Host || Só utilizei pois a porta padrão 3306 segue o BD MariaDB
        private $dbname = 'php_pdo'; // Nome do Bando de Dados
        private $user = 'root';      // Nome do Usuário do Banco de Dados
        private $pass = '';          // Senha do Banco de Dados

        // Métodos
        public function conectar() {
            try { // Iniciando a conexão com o Banco utilizando o PDO

                $conexao = new PDO ( // 1° parametro: dsn (mysql:localhost;port:3308;dbname=root) | 2° parametro: user (root) | 3° parametro: senha ('')
                    "mysql:host=$this->host;port=$this->port;dbname=$this->dbname", // DSN - Utilizar o $this para recuperar o valor do atributo $host, $port e $dbname
                    "$this->user", // USER - Utilizar o $this para recuperar o valor do atributo $user
                    "$this->pass"  // SENHA - Utilizar o $this para recuperar o valor do atributo $senha
                );

                // Retorna a variavel $conexao quando o método conectar() for executado
                return $conexao;

            } catch (PDOException $erro) { // catch recebe o error de PDOException
                echo '<p>' . $erro->getMessage() . '</p>';
            }
        }
    }

    // Instancia do Objeto será feita a partir do script tarefa_controller.php



?>