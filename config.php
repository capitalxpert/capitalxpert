<?php
// Faz a conexão com o banco de dados
$dbHost = 'localhost';   
$dbUsername = 'root';    
$dbPassword = '';        
$dbName = 'tcc';     

// Estabelece a conexão
$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Verifica se houve erro na conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
?>