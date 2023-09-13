<?php
require_once("../Connect.php");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');



$con=connect();
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
   http_response_code(200);
  exit;
}

$data = json_decode(file_get_contents('php://input'));

if (!$data) {
  http_response_code(400);
  echo json_encode(['message' => 'Dados ausentes']);
  exit();
}

$nome = $data->Bibliotecario;
$senha = $data->Senha;
$email = $data->Email;
$cpf = $data->CPF;

$sql = "INSERT INTO bibliotecario (nome_bibi, senha_bibi,email, CPF,Status_bibliotecario) VALUES ('$nome','$senha','$email','$cpf','Ativo')";


if (mysqli_query($con, $sql)) {
  http_response_code(200);
  echo json_encode(['message' => 'Inserção bem-sucedida']);
} else {
  http_response_code(500);
  echo json_encode(['message' => 'Erro na inserção: ' . mysqli_error($con)]);
}
?>
