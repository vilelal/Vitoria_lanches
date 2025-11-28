<?php
require_once 'conn.php';

function CadUsuario($nome, $senha)
{
     $string_conn = new Conexao();
        $conn = $string_conn->getConexao();
    try {
        $sql = "INSERT INTO tb_usuarios (TB_USUARIOS_USERNAME, TB_USUARIOS_PASSWORD,TB_USUARIOS_TIPO) VALUES (?, ?, 'cliente')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nome, $senha);
        $stmt->execute();

        $stmt->close();
        $string_conn->fecharConexao();

        header('Location: login.php');
    } catch (Exception) {

        echo 'erro';
    }

}
function CadProduto($nome, $preco, $descricao, $tipoProd_id)
{
     $string_conn = new Conexao();
    $conn = $string_conn->getConexao();

    $sql = "INSERT INTO tb_produto (TB_PRODUTO_NOME,TB_PRODUTO_PRECO_UNIT,TB_PRODUTO_DESC, TB_TIPO_PRODUTO_ID) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsi", $nome, $preco, $descricao, $tipoProd_id);
    $stmt->execute();

    $stmt->close();
    $string_conn->fecharConexao();


    header('Location: gerenciarProd.php');
}

function LerProduto($id_tipoProd)
{
    $string_conn = new Conexao();
    $conn = $string_conn->getConexao();

    $sql = "SELECT 
            tb_produto.TB_PRODUTO_ID AS id_prod,  
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

    $stmt->close();
    $string_conn->fecharConexao();
    
    return $produtos;
}

function LerTipoProd()
{
    $string_conn = new Conexao();
    $conn = $string_conn->getConexao();
    $sql = "SELECT * FROM tb_tipo_produto";
    $tipo_produto = $conn->query($sql);

    $tipo_prod = [];

    while ($row = $tipo_produto->fetch_assoc()) {
        $tipo_prod[] = $row;
    }

   $string_conn->fecharConexao();
    return $tipo_prod;
}

function CadTipoProd($tipoProduto)
{
    $string_conn = new Conexao();
    $conn = $string_conn->getConexao();

    $sql = "INSERT INTO tb_tipo_produto (TB_TIPO_PRODUTO_DESC) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tipoProduto, );
    $stmt->execute();

    $stmt->close();
   $string_conn->fecharConexao();

    header('Location: gerenciarProd.php');
}

function DeleteProd($id_prod)
{
    $string_conn = new Conexao();
    $conn = $string_conn->getConexao();

    $sql = "DELETE FROM tb_produto WHERE TB_PRODUTO_ID = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id_prod);
    $stmt->execute();

    $stmt->close();
    $string_conn->fecharConexao();
    header('Location: gerenciarProd.php');
    exit();
}

function EditProd($dados)
{
        $string_conn = new Conexao();
        $conn = $string_conn->getConexao();
        $sql = "UPDATE tb_produto SET  TB_PRODUTO_NOME= ?, TB_TIPO_PRODUTO_ID  = ?, TB_PRODUTO_DESC = ?,  TB_PRODUTO_PRECO_UNIT = ? WHERE TB_PRODUTO_ID = ?";
        $stmt = $conn->prepare($sql);
    
        $stmt->bind_param("ssssi", $dados['nomeProd'], $dados['id_prod'], $dados['descricaoProd'], $dados['preco_unit']);
        $stmt->execute();
    
        $stmt->close();
        $conn->$string_conn->fecharConexao();
        header('Location: index.php');
        exit();
    
}


function VerificarUser($username, $senha) {
    $string_conn = new Conexao();
    $conn = $string_conn->getConexao();

    
    $sql = "SELECT TB_USUARIOS_ID, TB_USUARIOS_USERNAME, TB_USUARIOS_TIPO FROM tb_usuarios 
            WHERE TB_USUARIOS_USERNAME = ? AND TB_USUARIOS_PASSWORD = ?";

    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        return false; 
    }
    
    $stmt->bind_Param("ss", $username, $senha);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $usuario = $result->fetch_assoc();
        
        $stmt->close();

        $string_conn->fecharConexao(); 
        
        return $usuario; 
    } else {
        
        $stmt->close();
        $string_conn->fecharConexao();
        
        return false;
    }
}

?>