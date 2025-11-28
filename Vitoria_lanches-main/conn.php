<?php
   // Classe para conectar ao banco de dados MySQL

    Class Conexao{
        private $host = "localhost" ;
        private $user = "root";
        private $password = "Pe20082001.";
        private $database = "BD_vitoria_lanches";
        private $conexao;

        public function __construct(){
            
            $this->conexao = new mysqli($this->host, $this->user, $this->password, $this->database);
              
            if ($this->conexao->connect_error) {
            die("Erro na conexão: " . $this->conexao->connect_error);
            
            
        }
        $this->conexao->set_charset("utf8mb4");
        }

    public function getConexao() {
        return $this->conexao;
    }

    public function fecharConexao() {
        if ($this->conexao) {
            $this->conexao->close();
        }
    }

}
?>