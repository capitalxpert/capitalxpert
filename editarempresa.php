<?php
session_start();

if (!isset($_SESSION['cnpj'])) {
    header('Location: login2.html');
    exit();
}

$cnpj = $_SESSION['cnpj'];
include_once('config.php');

$query = "SELECT nome, telefone FROM empresa WHERE cnpj = '$cnpj'";
$result = mysqli_query($conexao, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "Erro ao recuperar os dados do usuário.";
    exit();
}

$dados = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);

    $updateQuery = "UPDATE empresa SET nome='$nome', telefone='$telefone' WHERE cnpj='$cnpj'";
    
    if (mysqli_query($conexao, $updateQuery)) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar os dados.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <style>
        :root {
    --color-primary-1: #000f31;
    --color-primary-2:  #010525;
    --color-primary-3: #f8d477;
    --color-primary-4: #ffe100;
    --color-primary-5: rgb(255, 255, 255);
    --color-primary-6: #ff6200;
    --color-neutral-0: #e9a209;
    --color-neutral-1: #ffffff;
}

body {
    font-family: Arial, sans-serif;
    background-color: var(--color-primary-2);
    color: var(--color-neutral-1);
    margin: 0;
    text-align: center;
    align-items: center;
    padding: 0;
}

h2 {
    text-align: center;
    color: var(--color-primary-4);
    margin-top: 30px;
}

form {
            background-color: var(--color-primary-1);
            padding: 20px;
            box-shadow: 0 4px 15px rgba(255, 98, 0, 0.7); 
            margin: 20px;
            border-radius: 32px;
            width: 80%; 
            max-width: 350px; 
            margin-left: auto;
            margin-right: auto;
        }

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5    px;
    color: var(--color-neutral-1);
}

input[type="text"] {
    width: 75%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ff6200;  
    border-radius: 12px;
    background-color: var(--color-primary-5);
    color: var(--color-primary-1);
}

input[type="text"]:focus {
    border-color: var(--color-primary-6); 
    outline: none;
}

button[type="submit"] {
    width: 70%;
    align-items: center;
    padding: 12px;
    background-color: var(--color-primary-6); 
    color: var(--color-neutral-1);
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

div a button {
    background-color: var(--color-primary-6);  
    color: var(--color-neutral-1);
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    padding: 10px 20px;
    transition: background-color 0.3s;
}



    </style> 
</head>
<body>
    <h2 style="color: #ff6200; font-size: 32px;" >Editar Perfil</h2>
    <form method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($dados['nome']); ?>" required>
        
        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?php echo htmlspecialchars($dados['telefone']); ?>" required>
        
        <button type="submit">Salvar Alterações</button>
    </form>
    <div style="text-align: right; margin: 20px;">
    <a href="pagdecripto2.php">
        <button style="padding: 10px 20px; font-size: 16px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
            voltar
        </button>
    </a>
</div>
</body>
</html>
