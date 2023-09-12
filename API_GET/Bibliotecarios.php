<?php
require_once("../Connect.php");
header('Access-Control-Allow-Origin:*');

$con = connect();
if (!$con) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

$bibliotecarioarray = array();
$sql = "SELECT * FROM bibliotecario"; // Correção: "Select From * livro" deve ser "SELECT * FROM livro"
$result = mysqli_query($con, $sql);

if (!$result) {
    die("Erro na consulta: " . mysqli_error($con));
}

while ($dados = mysqli_fetch_array($result)) {
    $bibliotecario = $dados['nome_bibi']; // Correção: 'livro' deve ser '$livro'
    $CPF= $dados['CPF'];
    $email=$dados['email'];
    $status=$dados['Status_bibliotecario'];

    $bibliotecarioarray[] = array(
        'nome_bibi' => $bibliotecario,
        'CPF' => $CPF,
        'email' => $email,
        'Status_bibliotecario' => $status,
    
    );
}
echo json_encode($bibliotecarioarray);


// Feche a conexão com o banco de dados
mysqli_close($con);
?>