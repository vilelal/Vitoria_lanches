<?php
require_once 'conn.php';
require_once 'dados.php';

function CadUsuario($nome, $senha)
{
    $conn = conectarBanco();
    try {
        $sql = "INSERT INTO tb_usuarios (TB_USUARIOS_USERNAME, TB_USUARIOS_PASSWORD,TB_USUARIOS_TIPO) VALUES (?, ?, 'cliente')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nome, $senha);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        header('Location: login.php');
    } catch (Exception) {

        echo 'erro';
    }

}
function CadProduto($nome, $preco, $descricao, $tipoProd_id)
{
    $conn = conectarBanco();

    $sql = "INSERT INTO tb_produto (TB_PRODUTO_NOME,TB_PRODUTO_PRECO_UNIT,TB_PRODUTO_DESC, TB_TIPO_PRODUTO_ID) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsi", $nome, $preco, $descricao, $tipoProd_id);
    $stmt->execute();

    $stmt->close();
    $conn->close();


    header('Location: gerenciarProd.php');
}

function LerProduto($id_tipoProd)
{
    $conn = conectarBanco();

    $sql = "SELECT 
            tb_produto.TB_PRODUTO_NOME AS nome_produto, 
            tb_produto.TB_PRODUTO_PRECO_UNIT AS preco,
            tb_produto.Tb_PRODUTO_DESC AS descricao,
            tb_tipo_produto.TB_TIPO_PRODUTO_DESC AS tipoProduto
        FROM 
            tb_produto 
        INNER JOIN 
            tb_tipo_produto ON tb_produto.TB_TIPO_PRODUTO_ID = tb_tipo_produto.TB_TIPO_PRODUTO_ID
        Where 
            tb_tipo_produto.TB_TIPO_PRODUTO_ID = ?";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_tipoProd);
    $stmt->execute();
    $result = $stmt->get_result();





    while ($row = $result->fetch_assoc()) {
        $produtos[] = $row;
    }
    $conn->close();
    $stmt->close();
    return $produtos;
}

function LerTipoProd()
{
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

function CadTipoProd($tipoProduto)
{
    $conn = conectarBanco();

    $sql = "INSERT INTO tb_tipo_produto (TB_TIPO_PRODUTO_DESC) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tipoProduto, );
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header('Location: gerenciarProd.php');
}

function DeleteProd()
{

}


function VerificarUser($username, $senha)
{

    $conn = conectarBanco();
  

    $sql = "SELECT * FROM tb_usuarios WHERE TB_USUARIOS_USERNAME = ? AND TB_USUARIOS_PASSWORD = ?";

    $stmt= $conn->prepare($sql);
    $stmt->bind_Param("ss" , $username,$senha);

    $stmt->execute();

    $result = $stmt->get_result();

    $tipo = null;

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();



    if($usuario['TB_USUARIOS_TIPO'] == 'adm')
    {
        echo "<form id='loginForm' method='POST' action='home.php'>";
        echo "<input type='hidden' name='tipo' value='adm'>";
         echo '<script>document.getElementById("loginForm").submit();</script>';

        echo "</form>";
       
        
        
    }
    else{
    header("Location: Home.php");
}
    

    
  } else {
    echo "<script>";
    echo "alert('falha no login')  ";
    echo "</script>";
  }


  $stmt->close();
  $conn->close();

}

?>