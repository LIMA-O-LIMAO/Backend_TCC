<?php
require_once("../Connect.php");


header('Access-Control-Allow-Origin:*');
// Conexão com o banco de dados
$con=connect();

// Verifique a conexão
if (!$con) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

$teste = array();

$sql = "SELECT * FROM livro"; // Correção: "Select From * livro" deve ser "SELECT * FROM livro"

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Erro na consulta: " . mysqli_error($con));
}

while ($dados = mysqli_fetch_array($result)) {
    $livro = $dados['Nome_livro']; // Correção: 'livro' deve ser '$livro'
    $autor = $dados['Autor'];
    $editora = $dados['Editora'];
    $datai = $dados['data_inativacao'];
    $motivo = $dados['motivo'];
    $status = $dados['Status'];
    
    $teste[] = array(
        'livro' => $livro,
        'Autor' => $autor,
        'Editora' => $editora,
        'data_inativacao'=>$datai,
        'Motivo' => $motivo,
        'Status' => $status
    );
}
echo json_encode($teste);
    

// Feche a conexão com o banco de dados
mysqli_close($con);
?>
