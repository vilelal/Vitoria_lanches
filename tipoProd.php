<?php
    require_once 'funcao.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $acao = $_POST['acao'] ?? '';

        if ($acao === 'criar_tipoProd') {
            CadTipoProd($_POST['tipoProduto']);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar tipo</title>
</head>
<body>

    <form action="tipoProd.php" method="POST">
        <input type="hidden" value="criar_tipoProd">
        Tipo do produto: <input type="text" name="tipoProduto" required>
        <button type="submit">Criar</button>
    </form>
</body>
</html>