<?php
require_once 'funcao.php';
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    // Redireciona para a página de login se não estiver logado
    header('Location: login.php');
    exit;
}
$tipo_usuario = $_SESSION['user_tipo'];

$nome_usuario = $_SESSION['user_nome'];

$conn_string = new Conexao();
$conn = $conn_string->getConexao();

$string_tipoProduto = LerTipoProd();

$produtos = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_tipoProd_filtro'])) {
    $id_tipoProd = $_POST['id_tipoProd_filtro'];

    $produtos = LerProduto($id_tipoProd);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'criar_prod') {
    CadProduto($_POST['nomeProd'], $_POST['precoProd'], $_POST['descricaoProd'], $_POST['id_tipoProd']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    if ($acao === 'excluir') {
        DeleteProd($_POST['id_prod']);
    } 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produto</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>

    <header class="header">
        <nav class="cabecalho">
            <?php
            // Verifica se o usuario é adm
            if ($tipo_usuario == 'adm') {
                echo "<a href='relatorio.php'>Relatório</a>";
                echo "<a href='gerenciarProd.php'>Gerenciar produtos</a>";
                echo "<a href='logout.php'>Sair</a>";
            } else {
                echo "<a href='logout.php'>Sair</a>";
            }
            ?>
        </nav>
    </header>



    <h2>Painel de Administração</h2>
    <p>Aqui você pode ver informações restritas para administradores.</p>
    <div class="criarProd">

        <br>
        <form action="gerenciarProd.php" method="POST" class="form_criarProd">
            <input type="hidden" name="acao" value="criar_prod">

            Nome do produto: <input type="text" name="nomeProd" placeholder="Digite o seu nome" Required><br>

            preço do produto: <input type="text" name="precoProd" placeholder="Digite uma senha" Required><br>
            Descricão do produto: <input type="text" name="descricaoProd" placeholder="Digite a descrição do produto">
            <br>



            <select name="id_tipoProd">
                <option value="" disabled selected>Selecione o tipo do produto</option>
                <?php foreach ($string_tipoProduto as $tipo_prod): ?>
                    <option value="<?= $tipo_prod['TB_TIPO_PRODUTO_ID'] ?> "><?= $tipo_prod['TB_TIPO_PRODUTO_DESC'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <a href="tipoProd.php"> Adicionar um tipo de produto</a>
            <br>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
<center>
    <div class="filtrarProd">
        <form method="post" class="form-filtrar">

            <select name="id_tipoProd_filtro">
                <option value="" disabled selected>Selecione o tipo do produto</option>
                <?php foreach ($string_tipoProduto as $tipo_prod): ?>
                    <option value="<?= $tipo_prod['TB_TIPO_PRODUTO_ID'] ?> "><?= $tipo_prod['TB_TIPO_PRODUTO_DESC'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Buscar</button>
        </form>
        <h3>Produtos Encontrados</h3>
        <table>
            <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th>Descricao</th>
                <th>Tipo do produto</th>
                <th>Excluir produto</th>
                <th>Editar produto</th>
            </tr>
            <?php foreach ($produtos as $umprodutoporvez): ?>
                <tr>
                    <td><?= htmlspecialchars($umprodutoporvez['nome_produto']) ?></td>
                    <td>R$ <?= number_format($umprodutoporvez['preco'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($umprodutoporvez['descricao']) ?></td>
                    <td><?= htmlspecialchars($umprodutoporvez['tipoProduto']) ?></td>
                    <td>
                        <?php

                        echo "<form method='post' action='gerenciarProd.php' style='display:inline;' class='Exclusao'>";
                        echo "<input type='hidden' name='acao' value='excluir'>";
                        echo "<input type='hidden' name='id_prod' value='" . $umprodutoporvez['id_prod'] . "'>";
                        echo "<button type='submit'>Excluir</button>";
                        echo "</form>";


                        ?>
                    </td>
                    <td>
                        <?php

                        echo "<form method='POST' action='editarProd.php' style='display:inline;' class='Editar'>";
                        echo "<input type='hidden' name='acao' value='editar'>";
                        echo "<input type='hidden' name='id_prod' value='" . $umprodutoporvez['id_prod'] . "'>";
                        echo "<button type='submit'>Editar</button>";
                        echo "</form>";


                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    </center>
</body>

</html>