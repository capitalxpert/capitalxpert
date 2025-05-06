<?php
if (isset($_POST['Cadastrar'])) {
    // Abre a Conexão com Banco de Dados
    include_once('config.php');

    // Verifica se o nome da disciplina está em branco 
    if (empty($_POST['nome'])) {
        // Se estiver, irá voltar para pedir os dados novamente
        header('Location: cadpf.html');
    } else {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $cep = $_POST['cep'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $bairro = $_POST['bairro'];
        $ruanumero = $_POST['ruanumero'];
        $senha = $_POST['senha'];

        // Verificar se o email já existe
        $queryEmail = mysqli_prepare($conexao, "SELECT * FROM pessoa WHERE email = ?");
        mysqli_stmt_bind_param($queryEmail, "s", $email);
        mysqli_stmt_execute($queryEmail);
        $resultEmail = mysqli_stmt_get_result($queryEmail);

        // Verificar se o CPF já existe
        $queryCPF = mysqli_prepare($conexao, "SELECT * FROM pessoa WHERE cpf = ?");
        mysqli_stmt_bind_param($queryCPF, "s", $cpf);
        mysqli_stmt_execute($queryCPF);
        $resultCPF = mysqli_stmt_get_result($queryCPF);

        // Mensagens de erro
        if (mysqli_num_rows($resultEmail) > 0) {
            echo "<script>alert('Email já cadastrado, efetue o pagamento ou faça o login.'); window.location.href='cadpf.html';</script>";
        } elseif (mysqli_num_rows($resultCPF) > 0) {
            echo "<script>alert('CPF já cadastrado.'); window.location.href='cadpf.html';</script>";
        } else {
            // Insere dados das variáveis na tabela pessoas do banco de dados 
            $result = mysqli_query($conexao, 
            "INSERT INTO pessoa(nome,email,cpf,telefone,cep,cidade,estado,bairro,ruanumero,senha) 
            VALUES ('$nome','$email','$cpf','$telefone','$cep','$cidade','$estado','$bairro','$ruanumero','$senha')");
            header('Location: pagamento.html');
        }
    }
} else {
    header('Location: cadpf.html');
}
?>