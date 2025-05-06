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
$sqlId = "SELECT MAX(idpagarpj) AS max_id FROM pagarpj";
$resultId = $conexao->query($sqlId);
$idpagarpj = ($resultId->num_rows > 0) ? $resultId->fetch_assoc()['max_id'] + 1 : 1;

// Valida e sanitiza os dados do formulário
$cnpj = $conexao->real_escape_string($_POST['cnpj']);
$metodo = $conexao->real_escape_string($_POST['metodo']);
$valor = 20.00; // Valor fixo

// Dados adicionais para pagamento via Cartão
$numcartao = ($metodo === 'cartao') ? $conexao->real_escape_string($_POST['numcartao']) : null;
$tipoCartao = ($metodo === 'cartao') ? $conexao->real_escape_string($_POST['tipoCartao']) : null;

// Insere na tabela pagarpj usando prepared statements
$stmt = $conexao->prepare("INSERT INTO pagarpj (idpagarpj, cnpj, numcartao, metodo) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $idpagarpj, $cnpj, $numcartao, $metodo);

if ($stmt->execute()) {
    // Redireciona imediatamente após o processamento
    header("Location: login2.html");
    exit; // Garante que o script seja interrompido após o redirecionamento
} else {
    die("Erro ao processar o pagamento. Tente novamente mais tarde.");
}

$stmt->close();
$conexao->close();
?>