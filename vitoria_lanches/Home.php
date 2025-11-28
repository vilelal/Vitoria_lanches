<?php
    session_start();
        require_once 'funcao.php';

    //verifica se o usuario está logado
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    // Redireciona para a página de login se não estiver logado
    header('Location: login.php');
    exit;
}
    $tipo_usuario = $_SESSION['user_tipo'];

    $nome_usuario = $_SESSION['user_nome'];
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Vitoria Lanches</title>
<link rel="stylesheet" href="estilo.css">
</head>
<body>

    <header class="header">
        <nav class="cabecalho">
            <?php
        // Verifica se o usuario é adm
            if ($tipo_usuario == 'adm'){
                echo "<a href='relatorio.php'>Relatório</a>";
                echo "<a href='gerenciarProd.php'>Gerenciar produtos</a>";
                echo "<a href='logout.php'>Sair</a>";
            }else{
                echo "<a href='logout.php'>Sair</a>";
            }
            ?>
            </nav>
    </header>

    <?php
    if ($tipo_usuario == 'adm') {
        echo "<div class='area-adm'>";
        echo "<h1>Bem-vindo, Administrador(a) {$nome_usuario}</h1>";
        echo "<p>Aqui você poderá gerenciar produtos e acessar relatórios.</p>";
        echo "</div>";
    } else {
        echo "<div class='produtos-home'>";
        echo "<h2>Veja alguns produtos disponíveis</h2>";
        
        echo "</div>";
    }
    ?>

</body>
</html>