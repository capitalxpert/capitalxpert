<?php
// Configurações do banco de dados
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'tcc';

// Conecta ao banco de dados
$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Gera um novo ID para o pagamento
$sqlId = "SELECT MAX(idpagoP) AS max_id FROM pagarpf";
$resultId = $conexao->query($sqlId);
$idpagoP = ($resultId->num_rows > 0) ? $resultId->fetch_assoc()['max_id'] + 1 : 1;

// Valida e sanitiza os dados do formulário
$email = $conexao->real_escape_string($_POST['email']);
$metodo = $conexao->real_escape_string($_POST['metodo']);
$valor = 20.00; // Valor fixo

// Dados adicionais para pagamento via Cartão
$numcartao = ($metodo === 'cartao') ? $conexao->real_escape_string($_POST['numcartao']) : null;
$tipoCartao = ($metodo === 'cartao') ? $conexao->real_escape_string($_POST['tipoCartao']) : null;

// Insere na tabela pagarpf usando prepared statements
$stmt = $conexao->prepare("INSERT INTO pagarpf (idpagoP, email, numcartao, metodo) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $idpagoP, $email, $numcartao, $metodo);

if ($stmt->execute()) {
    // Redireciona imediatamente após o processamento
    header("Location: login.html");
    exit; // Garante que o script seja interrompido após o redirecionamento
} else {
    die("Erro ao processar o pagamento. Tente novamente mais tarde.");
}

$stmt->close();
$conexao->close();
?>