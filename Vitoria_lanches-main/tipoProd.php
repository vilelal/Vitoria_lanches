<?php
    require_once 'funcao.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $acao = $_GET['acao'] ?? '';

        if ($acao === 'criar_tipoProd') {
            CadTipoProd($_GET['tipoProduto']);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar tipo</title>
        <link rel="stylesheet" href="style.css">
</head>
<body>

    <form action="tipoProd.php" method="GET">
        <input type="hidden" name="acao" value="criar_tipoProd">
        Tipo do produto: <input type="text" name="tipoProduto" required required style="text-transform: uppercase;">
        <button type="submit">Criar</button>
    </form>
</body>
</html>