<?php
if (isset($_POST['Cadastrar'])) {
    include_once('config.php');

    if (empty($_POST['nome'])) {
        header('Location: cadpj.html');
    } else {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cnpj = $_POST['cnpj'];
        $telefone = $_POST['telefone'];
        $senha = $_POST['senha'];

        // Verificar se o CNPJ já existe
        $queryCNPJ = "SELECT * FROM empresa WHERE cnpj = '$cnpj'";
        $resultCNPJ = mysqli_query($conexao, $queryCNPJ);

        // Verificar se o email já existe
        $queryEmail = "SELECT * FROM empresa WHERE email = '$email'";
        $resultEmail = mysqli_query($conexao, $queryEmail);

        if (mysqli_num_rows($resultCNPJ) > 0) {
            // CNPJ já cadastrado
            echo "<script>alert('CNPJ já cadastrado.'); window.location.href='cadpj.html';</script>";
        } elseif (mysqli_num_rows($resultEmail) > 0) {
            // Email já cadastrado
            echo "<script>alert('Email cadastrado, efetue o pagamento ou faça o login.'); window.location.href='cadpj.html';</script>";
        } else {
            // Inserir os dados no banco de dados
            $result = mysqli_query($conexao, 
            "INSERT INTO empresa(nome,email,cnpj,telefone,senha) 
            VALUES ('$nome','$email','$cnpj','$telefone','$senha')");
            header('Location: pagamentopj.html');
        }
    }
} else {
    header('Location: cadpj.html');
}
?>