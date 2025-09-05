<?php

Include_once 'funcao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $username = $_POST['nomeUsuario'];
$senha = $_POST['senhaUsuario'];

 VerificarUser($username, $senha);

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="login.php" method="POST">
        <input type="hidden" value="logar">
        Nome: <input type="text" name="nomeUsuario" placeholder="Digite o seu nome"  Required>

        Senha: <input type="text" name="senhaUsuario" placeholder="Digite uma senha" Required>

        <button type="submit">Entrar</button>
    </form>
    <a href="CadCliente.php">Não tem uma conta ainda? Clique aqui</a>
</body>
</html>