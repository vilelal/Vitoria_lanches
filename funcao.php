<?php
    require_once 'conn.php';

function CadUsuario($nome, $senha){
    $conn = conectarBanco();

    $sql = "INSERT INTO tb_usuarios (TB_USUARIOS_USERNAME, TB_USUARIOS_PASSWORD,TB_USUARIOS_TIPO) VALUES (?, ?, 'cliente')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$nome, $senha);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header('Location: login.php');
}

?>