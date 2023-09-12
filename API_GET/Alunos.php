<?php
require_once("../Connect.php");
header('Access-Control-Allow-Origin:*');

$con=connect();


if (!$con) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

$Alunoarray = array();

$sql = "SELECT * FROM aluno";

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Erro na consulta: " . mysqli_error($con));
}

while ($dados = mysqli_fetch_array($result)) {
    $aluno = $dados['nome_aluno'];
    $email_aluno = $dados['email_aluno'];
    $telefone = $dados['num_telefone'];
    $matricula = $dados['matricula'];
    $status = $dados['status_aluno'];
    
    $Alunoarray[] = array(
        'nome_aluno' => $aluno,
        'email_aluno' => $email_aluno,
        'num_telefone' => $telefone,
        'matricula'=>$matricula,
        'status_aluno' => $status
    );
}
echo json_encode($Alunoarray);
    

// Feche a conexão com o banco de dados
mysqli_close($con);
?>