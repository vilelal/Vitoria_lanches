<?php
require_once 'funcao.php';


$conn_string = new Conexao();
$conn = $conn_string->getConexao();

$string_tipoProduto = LerTipoProd();

$produtos = [];
$tipoUsuarioAdm = $adm;

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
    } elseif ($acao === 'excluir') {
        EditProd($_POST);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produto</title>
    <link rel="stylesheet" href="styleGerenciar.css">
</head>

<body>
    <h2>Painel de Administração</h2>
    <p>Aqui você pode ver informações restritas para administradores.</p>
    <div class="criarProd">

        <h1>Criar Produto</h1>
        <br>
        <form action="gerenciarProd.php" method="POST">
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

    <div class="filtrarProd">
        <h2>Filtrar produto por categoria</h2>
        <form method="post">

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
            </tr>
            <?php foreach ($produtos as $umprodutoporvez): ?>
                <tr>
                    <td><?= htmlspecialchars($umprodutoporvez['nome_produto']) ?></td>
                    <td>R$ <?= number_format($umprodutoporvez['preco'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($umprodutoporvez['descricao']) ?></td>
                    <td><?= htmlspecialchars($umprodutoporvez['tipoProduto']) ?></td>
                    <td>
                        <?php
                        //ver se vai dar certo
                    
                        echo "<form method='post' action='gerenciarProd.php' style='display:inline;'>";
                        echo "<input type='hidden' name='acao' value='excluir'>";
                        echo "<input type='hidden' name='id_prod' value='" . $umprodutoporvez['id_prod'] . "'>";
                        echo "<button type='submit'>Excluir</button>";
                        echo "</form>";
                        ?>
                    </td>
                    <td>
                        <a href="editarProd.php">Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>