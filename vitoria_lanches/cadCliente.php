<?php
require_once 'funcao.php';

    $conn = new Conexao();


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
    <title>Cadastro | Vitoria Lanches</title>
        <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <form action="CadCliente.php" method="POST" class="form-cad">
        <input type="hidden" name="acao" value="criar">

        Nome: <input type="text" name="nomeUsuario" placeholder="Digite o seu nome"  Required>

        Senha: <input type="text" name="senhaUsuario" placeholder="Digite uma senha" Required>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>