<?php
session_start(); 

include_once('config.php');

if (isset($_POST['Entrar'])) {

    if (empty($_POST['cnpj']) || empty($_POST['senha'])) {
        echo "<script>alert('Por favor, preencha todos os campos!'); window.location.href='login2.html';</script>";
        exit();
    } else {

        $cnpj = $_POST['cnpj'];
        $senha = $_POST['senha'];

        $query = "SELECT e.senha FROM empresa e 
                  JOIN pagarpj pj ON pj.cnpj = e.cnpj 
                  WHERE pj.cnpj = ?";
        $stmt = mysqli_prepare($conexao, $query);
        mysqli_stmt_bind_param($stmt, "s", $cnpj); 
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            if ($user['senha'] === $senha) {

                $_SESSION['cnpj'] = $cnpj; 
                header('Location: pagdecripto2.php'); 
                exit();
            } else {
                echo "<script>alert('Senha incorreta!'); window.location.href='login2.html';</script>";
                exit();
            }
        } else {
            echo "<script>alert('CNPJ não encontrado!'); window.location.href='login2.html';</script>";
            exit();
        }
    }
}
?>
