<?php
session_start();

if (!isset($_SESSION['cnpj'])) {
    header('Location: login2.html');
    exit();
}

$cnpj = $_SESSION['cnpj'];
include_once('config.php');

$query = "SELECT p.nome FROM empresa p 
          JOIN pagarpj pf ON pf.cnpj = p.cnpj 
          WHERE pf.cnpj = '$cnpj'";
$result = mysqli_query($conexao, $query);

if ($user = mysqli_fetch_assoc($result)) {
    $nome = $user['nome'];
} else {
    echo "Erro ao recuperar dados!";
    exit();
}
if (isset($_POST['excluirConta'])) {
    mysqli_begin_transaction($conexao);

    try {
        $queryPagarpj = "DELETE FROM pagarpj WHERE cnpj = ?";
        $stmtPagarpj = mysqli_prepare($conexao, $querypagarpj);
        mysqli_stmt_bind_param($stmtPagarpj, 's', $cnpj);
        mysqli_stmt_execute($stmtPagarpj);

        $queryempresa = "DELETE FROM empresa WHERE cnpj = ?";
        $stmtempresa = mysqli_prepare($conexao, $queryempresa);
        mysqli_stmt_bind_param($stmtempresa, 's', $cnpj);
        mysqli_stmt_execute($stmtempresa);

        mysqli_commit($conexao);

        session_destroy();
        header('Location: login.html');
        exit();
    } catch (Exception $e) {

        mysqli_rollBack($conexao);
        echo "Erro ao excluir conta. Tente novamente mais tarde.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Conta</title>
    <style>
        :root {
            --color-primary-1: #010525; 
            --color-primary-2: #000f31;
            --color-primary-3: #f8d477;
            --color-primary-4: #ffe100;
            --color-primary-5:rgb(255, 255, 255);
            --color-primary-6: #cc5200; 
            --color-neutral-0: #e9a209;
            --color-neutral-1: #ffffff;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--color-primary-2);
            color: var(--color-primary-3);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 500px;
            width: 100%;
            padding: 20px;
            background-color: var(--color-primary-1);
            border-radius: 10px;
            box-shadow: 0px 0px 12px 4px rgb(255, 119, 0);
            text-align: center;
        }

        h1 {
            color: var(--color-neutral-1);
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: var(--color-primary-5);
            margin-bottom: 20px;
        }

        button {
            width: 100%;
            padding: 15px;
            background-color: #ff6200;
            border: none;
            border-radius: 5px;
            color: var(--color-neutral-1);
            font-size: 18px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: var(--color-primary-6); 
        }

        a {
            display: block;
            margin-top: 15px;
            color: var(--color-primary-4);
            text-decoration: none;
            font-size: 16px;
        }

        a:hover {
            color: var(--color-primary-6);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Excluir Conta</h1>
        <p>Tem certeza que deseja excluir sua conta, <?php echo $nome; ?>? Essa ação é irreversível!</p>
        
        <form method="POST" action="excluirConta.php">
            <button type="submit" name="excluirConta">Excluir Conta</button>
        </form>
        
        <p><a href="pagdecripto2.php">Voltar</a></p>
    </div>
</body>
</html>
