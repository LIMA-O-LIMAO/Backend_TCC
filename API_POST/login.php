<?php
require_once("../Connect.php");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

$con = connect();

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

$nome = $data->Usuario;
$senha = $data->Senhas;


$sql = "SELECT * FROM bibliotecarios WHERE nome_bibi = '$nome'";

$result = mysqli_query($con, $sql);

if (!$result) {
  http_response_code(500);
  echo json_encode(['message' => 'Erro na consulta SQL']);
  exit();
}


if (mysqli_num_rows($result) === 1) {
  $row = mysqli_fetch_assoc($result);
  $hashedSenha = $row['senha_bibi'];

  if (password_verify($senha, $hashedSenha)) {

    http_response_code(200);
    echo json_encode(['message' => 'Login bem-sucedido']);
  } else {

    http_response_code(401);
    echo json_encode(['message' => 'Senha incorreta']);
  }
} else {

  http_response_code(404);
  echo json_encode(['message' => 'Usuário não encontrado']);
}
?>
