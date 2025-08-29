<?php
require_once 'funcao.php';

    $conn = conectarBanco();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $acao = $_POST['acao'] ?? '';

        if ($acao === 'criar') {
            CadUsuario($_POST['nomeUsuario'],$_POST['senhaUsuario']);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
</head>
<body>
    <form action="CadCliente.php" method="POST">
        <input type="hidden" name="acao" value="criar">

        Nome: <input type="text" name="nomeUsuario" placeholder="Digite o seu nome"  Required>

        Senha: <input type="text" name="senhaUsuario" placeholder="Digite uma senha" Required>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>