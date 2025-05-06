<?php
session_start(); // Iniciar a sessão

// Verifica se o usuário está logado
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email']; // Recupera o email da sessão

    // Inclui a conexão com o banco de dados
    include_once('config.php');

    // Consulta para obter o nome do usuário
    $query = "SELECT p.nome FROM pessoa p 
              JOIN pagarpf pf ON pf.email = p.email 
              WHERE pf.email = '$email'";
    $result = mysqli_query($conexao, $query);

    // Verifica se a consulta foi bem-sucedida e se o nome foi encontrado
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $nome = $user['nome']; // Atribui o nome recuperado do banco de dados
    } else {
        echo "Erro ao recuperar dados do banco!";
        exit();
    }
} else {
    // Se não estiver logado, redireciona para a página de login
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
</head>
<body>
    <p>Olá, <?php echo $nome; ?>!</p>
    <p>Bem-vindo à sua página principal!</p>
</body>
</html>
