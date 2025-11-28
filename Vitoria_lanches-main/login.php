<?php

include_once 'funcao.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['nomeUsuario'];
    $senha = $_POST['senhaUsuario'];


    $usuarioLogado = VerificarUser($username, $senha);
    if ($usuarioLogado !== false) {
        
        $_SESSION['logado'] = true;
        $_SESSION['user_id'] = $usuarioLogado['TB_USUARIOS_ID'];
        $_SESSION['user_nome'] = $usuarioLogado['TB_USUARIOS_USERNAME'];
        $_SESSION['user_tipo'] = $usuarioLogado['TB_USUARIOS_TIPO'];

        header("Location: home.php");
        exit;
    } else {
    trigger_error("Falha no login. Nome de usuário ou senha incorretos.", E_USER_WARNING);
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Vitoria Lanches</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
   <form action="login.php" method="POST" class="form-login">
        
        <label for="nomeUsuario">Nome:</label>
        <input type="text" id="nomeUsuario" name="nomeUsuario" placeholder="Digite o seu nome" required>

        <label for="senhaUsuario">Senha:</label>
        <input type="password" id="senhaUsuario" name="senhaUsuario" placeholder="Digite uma senha" required> 

        <button type="submit">Entrar</button>
    </form>
    <a href="CadCliente.php">Não tem uma conta ainda? Clique aqui</a>
</body>

</html>