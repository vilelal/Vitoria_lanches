<?php
    require_once 'conn.php';

function CadUsuario($nome, $senha){
    $conn = conectarBanco();
try{
    $sql = "INSERT INTO tb_usuarios (TB_USUARIOS_USERNAME, TB_USUARIOS_PASSWORD,TB_USUARIOS_TIPO) VALUES (?, ?, 'cliente')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$nome, $senha);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header('Location: login.php');
}catch(Exception)
{

    echo 'erro';
}

}
function CadProduto(){
    $conn = conectarBanco();

    //if($_SERVER['REQUEST_METHOD']=== 'POST' && !empty($_POST['id_cat'])){
        $sql = "SELECT 
        produtos.nome_prod AS nome_produto, 
        produtos.TB_preco_produto AS preco, 
        categorias.nome_cat AS nome_categoria 
    FROM 
        produtos 
    INNER JOIN 
        categorias ON produtos.id_cat = categorias.id_cat
    Where 
        categorias.id_cat = ?"; 
}

function LerTipoProd(){
    $conn = conectarBanco();
    $sql = "SELECT * FROM tb_tipo_produto";
    $tipo_produto = $conn->query($sql);

    $tipo_prod = [];
   
        while ($row = $tipo_produto->fetch_assoc()) {
            $tipo_prod[] = $row;
        }
    
    $conn->close();
    return $tipo_prod;
}

function CadTipoProd($tipoProduto){
    $conn = conectarBanco();
    
        $sql = "INSERT INTO tb_tipo_produto (TB_TIPO_PRODUTO_DESC) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss",$tipoProduto, );
        $stmt->execute();
    
        $stmt->close();
        $conn->close();
    
}


?>