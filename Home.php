<?php
    require_once 'funcao.php';

    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';  

?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="header">
        <nav class="cabecalho">
            <a href="#" >Pedido</a>
            <a href="#" >Produtos</a>
            <?php
            if ($tipo == 'adm'){
            
            echo "<a href='relatorio.php' >Relatório</a>";
            echo "<a href='gerenciarProd.php' >Gerenciar produtos</a>";
        }
            ?>
            

            <a href="cadCliente.php">Cadastrar</a>
            <a href="login.php" >Entrar</a> 
        </nav>
    </header>

    <div class="produtos-home">
        <h2>Veja alguns produtos disponível</h2>

    </div>


</body>
</html>