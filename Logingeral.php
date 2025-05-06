<?php
session_start(); // Iniciar a sessão

// Inclui a conexão com o banco de dados
include_once('config.php');

// Verifica se o formulário de login foi enviado
if (isset($_POST['Entrar'])) {
    // Verifica se os campos de email e senha foram preenchidos
    if (empty($_POST['email']) || empty($_POST['senha'])) {
        echo "<script>alert('Por favor, preencha todos os campos!'); window.location.href='login.html';</script>";
        exit();
    } else {
        // Obtém os dados do formulário
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Consulta para verificar o email e a senha
        $query = "SELECT p.senha FROM pessoa p 
                  JOIN pagarpf pf ON pf.email = p.email 
                  WHERE pf.email = '$email'";
        $result = mysqli_query($conexao, $query);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Verifica se a senha fornecida corresponde à senha armazenada
            if ($user['senha'] === $senha) {
                // Senha correta, faz o login
                $_SESSION['email'] = $email; // Armazena o email na sessão
                header('Location: pagdecripto.php'); // Redireciona para a página principal
                exit();
            } else {
                echo "<script>alert('Senha incorreta!'); window.location.href='login.html';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Email não encontrado!'); window.location.href='login.html';</script>";
            exit();
        }
    }
}
?>
