<?php
    require_once 'funcao.php';

    $conn = conectarBanco();

    $string_tipoProduto = LerTipoProd();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produto</title>
</head>

<body>
    <form action="CadCliente.php" method="POST">
        <input type="hidden" name="acao" value="criar_prod">

        Nome do produto: <input type="text" name="nomeUsuario" placeholder="Digite o seu nome" Required><br>

        preço do produto: <input type="text" name="precoProd" placeholder="Digite uma senha" Required><br>
        Descricão do produto: <input type="text" name="descricaoProd" placeholder="Digite a descrição do produto">
        <br>

        

        <select name="id_tipoProd">
            <?php foreach ($string_tipoProduto as $tipo_prod): ?>
                <option value="<?= $tipo_prod['TB_TIPO_PRODUTO_ID'] ?> "><?= $tipo_prod['TB_TIPO_PRODUTO_DESC'] ?></option>
            <?php endforeach; ?>
        </select>
    
        <a href="tipoProd.php"> Adicionar um tipo de produto</a>
        <br>

        <button type="submit">Cadastrar</button>
    </form>
</body>

</html>