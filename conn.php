<?php
   
    // Função para conectar ao banco de dados MySQL
    function conectarBanco() {
        $host = "localhost";
        $user = "root";
        $password = "Pe20082001.";
        $database = "BD_vitoria_lanches";
    
        // Criação da conexão
        $conn = new mysqli($host, $user, $password, $database);

        // Verifica se houve erro na conexão
        if ($conn->connect_error) {
            die("Erro na conexão: " . $conn->connect_error);
        }
    
        // Define o charset para evitar problemas com caracteres especiais
        $conn->set_charset("utf8mb4");
    
        return $conn;
    }

?>