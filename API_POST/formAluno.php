<?php
require_once("../Connect.php");



header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

// Conexão com o banco de dados

$con=connect();
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  // Solicitação OPTIONS enviada para verificar as configurações CORS
  http_response_code(200);
  exit;
}

$data = json_decode(file_get_contents('php://input'));

if (!$data) {
  http_response_code(400);
  echo json_encode(['message' => 'Dados ausentes']);
  exit();
}

$nome = $data->Nome_aluno;

$sql = "INSERT INTO aluno (nome_aluno, num_telefone, email_aluno, status_aluno,matricula) VALUES ('$nome',231231321,'teste','ativo',0909009211)";

// Execute a consulta SQL
if (mysqli_query($con, $sql)) {
  http_response_code(200);
  echo json_encode(['message' => 'Inserção bem-sucedida']);
} else {
  http_response_code(500);
  echo json_encode(['message' => 'Erro na inserção: ' . mysqli_error($con)]);
}
?>
