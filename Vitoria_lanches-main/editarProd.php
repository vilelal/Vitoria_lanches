<?php
require_once 'funcao.php';


$id = $_GET['id_prod'] ?? '';
 $string_conn = new Conexao();
$conn = $string_conn->getConexao();;

$sql = "SELECT * FROM tb_produto WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$produtoEditar = $result->fetch_assoc();

$stmt->close();
$conn->close();

if (!$produtoEditar) {
    header('Location: index.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
</head>
<body>
<body>
    <h1>Editar Tarefa</h1>
    
    <form method="post" action="editarProd.php">
        <input type="hidden" name="acao" value="atualizar">
        <input type="hidden" name="id_prod" value="<?= $produtoEditar['id'] ?>">
        
        <label for="nome_produto">Nome do produto:</label>
        <input type="text" id="nomeProd" name="nomeProd" value="<?= htmlspecialchars($produtoEditar['TB_PRODUTO_NOME']) ?>" required>
        
        <label for="descricao">Descrição do produto:</label>
        <textarea id="descricaoProd" name="descricaoProd" required><?= htmlspecialchars($produtoEditar['TB_PRODUTO_DESC']) ?></textarea>

        <label for="preco">Preço unitário:</label>
        <textarea id="preco_unit" name="preco_unit" required><?= htmlspecialchars($produtoEditar['TB_PRODUTO_PRECO_UNIT']) ?></textarea>
        

        

        
        <select name="id_tipoProd_filtro">
                <option value="" disabled selected>Selecione o tipo do produto</option>
                <?php foreach ($string_tipoProduto as $tipo_prod): ?>
                    <option value="<?= $tipo_prod['TB_TIPO_PRODUTO_ID'] ?> "><?= $tipo_prod['TB_TIPO_PRODUTO_DESC'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        
        <div class="acoes">
            <button type="submit">Atualizar Tarefa</button>
            <a href="gerenciarProd.php">Cancelar</a>
        </div>
    </form>
</body>
</html>