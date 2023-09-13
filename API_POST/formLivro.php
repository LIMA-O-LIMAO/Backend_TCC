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

$Livro = $data->Livro;
$Autor = $data->Senha;
$Editora = $data->Editora;


$sql = "INSERT INTO livro (Nome_livro, Autor,Editora,Status) VALUES ('$Livro','$Autor','$Editora','Ativo')";


if (mysqli_query($con, $sql)) {
  http_response_code(200);
  echo json_encode(['message' => 'Inserção bem-sucedida']);
} else {
  http_response_code(500);
  echo json_encode(['message' => 'Erro na inserção: ' . mysqli_error($con)]);
}
?>
