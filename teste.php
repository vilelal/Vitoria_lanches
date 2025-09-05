<?php
// Home.php
require_once 'funcao.php';
// A página verifica se o usuário está logado. Se não, ele é redirecionado.
if (!isset($logado) || !$logado) {
    header("Location: index.php"); // Redireciona para sua página de login
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($username); ?>!</h1>

    <?php if ($adm): ?>
        <h2>Painel de Administração</h2>
        <p>Você é um administrador. Aqui está o conteúdo especial para você.</p>
        <ul>
            <li><a href="#">Gerenciar Usuários</a></li>
            <li><a href="#">Ver Relatórios Secretos</a></li>
        </ul>
        <hr>
    <?php else: ?>
        <h2>Área de Usuário</h2>
        <p>Esta é a sua área restrita. Você não tem acesso às ferramentas de administrador.</p>
        <ul>
            <li><a href="#">Ver Perfil</a></li>
            <li><a href="#">Configurações da Conta</a></li>
        </ul>
        <hr>
    <?php endif; ?>

    <p><a href="logout.php">Sair</a></p>

</body>
</html>