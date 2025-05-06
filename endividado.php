<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: login.html');
    exit();
}

$email = $_SESSION['email'];
include_once('config.php');

$query = "SELECT p.nome FROM pessoa p 
          JOIN pagarpf pf ON pf.email = p.email 
          WHERE pf.email = '$email'";
$result = mysqli_query($conexao, $query);

if ($user = mysqli_fetch_assoc($result)) {
    $nome = $user['nome'];
} else {
    echo "Erro ao recuperar dados!";
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <style>
        :root {
    --color-background: #000631;
    --color-primary: #ff6200;
    --color-secondary: #010525;
    --color-text: #ffffff;
    --color-light: #fff;
}

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background-color: var(--color-background);
    color: var(--color-text);
    line-height: 1.6;
}

/* Cabeçalho */
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: white;
    background-color: var(--color-secondary);
    padding: 15px 10%;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 1000;
}

.logo {
    color: var(--color-light);
    font-size: 24px;
    font-weight: bold;
}

nav ul {
    list-style: none;
    display: flex;
}

nav ul li {
    margin: 0 15px;
}

nav ul li a {
    text-decoration: none;
    color: var(--color-light);
    font-size: 16px;
    font-weight: 600;
    transition: color 0.3s ease;
}

nav ul li a:hover {
    background-color: var(--color-primary);
    color: #ffffff; 
    border: none;
    padding: 8px 20px;
    border-radius: 12px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 0px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    transition: background-color 0.7s ease;
}

.btn-sair {
    background-color: var(--color-primary);
    padding: 8px 15px;
    border-radius: 5px;
    font-size: 16px;
    transition: background 0.3s ease;
}

.btn-sair:hover {
    background-color: #e55400;
}

/* Conteúdo */
.container {
    width: 90%;
    max-width: 1000px;
    margin: 100px auto 0;
    padding: 20px;
}

.header {
    text-align: center;
    margin-bottom: 30px;
}

.header h1 {
    color: white;
    font-size: 36px;
    margin-bottom: 10px;
}

.header p {
    font-size: 18px;
    color: #ffffff;
}

/* Seções */
.secao {
    background-color: #010525;
    padding: 20px;
    border-radius: 24px;
    margin-bottom: 60px;
    box-shadow: 0px 0px 12px 4px rgb(255, 119, 0);
    text-align: center;
}
.secao2 {
    background-color: #010525;
    padding: 20px;
    border-radius: 24px;
    margin-bottom: 60px;
    text-align: center;
}

.secao h2 {
    color: var(--color-primary);
    font-size: 24px;
    margin-bottom: 10px;
}

.secao p {
    font-size: 16px;
    color: var(--color-text);
}

/* Responsividade */
@media (max-width: 768px) {
    header {
        flex-direction: column;
        text-align: center;
    }

    nav ul {
        flex-direction: column;
        margin-top: 10px;
    }

    nav ul li {
        margin: 10px 0;
    }

    .container {
        margin-top: 140px;
    }
}
.logo-container {
    margin-top: -30px;
    margin-bottom: -40px;
    text-align: left;
}

.logo {
    max-width: 120px;
    height: auto;
}

    </style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investimentos para Endividados</title>
    <script defer src="script.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

    <header>
    <div class="logo-container">
            <img src="logosemnome.png" alt="Logo" class="logo">
        </div>
        <nav>
            <ul>
                <li><a href="#">Início</a></li>
                <li><a href="#0"><i class="fas fa-chart-line"></i> Organizar Finanças</a></li>
                <li><a href="#1"><i class="fas fa-money-bill-wave"></i> Pagar Dívidas</a></li>
                <li><a href="#2"><i class="fas fa-shield-alt"></i> Criar Reserva</a></li>
                <li><a href="#3"><i class="fas fa-coins"></i> Investimentos Seguros</a></li>
                <li><a href="#4"><i class="fas fa-coins"></i> Curso</a></li>
                <li><a href="pagdecripto.php" class="btn-sair"><i class="fas fa-arrow-left"></i> Voltar</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
    <p style="text-align: center;"><?php echo $nome; ?>! Aqui você aprenderá a investir estando endividado(a)</p>
    <br>
        <section id="0" class="secao">
            <h1 style="text-align: center;"><i class="fas fa-hand-holding-usd"></i> Como Investir Mesmo Estando Endividado?</h1>
            <p>Muitas pessoas acreditam que investir só é possível quando já se tem uma boa estabilidade
                financeira, mas a verdade é que qualquer um pode começar a organizar suas finanças e dar os primeiros
                passos para um futuro mais seguro. Se você está endividado, a prioridade deve ser sair dessa situação 
                antes de buscar retornos financeiros. Aqui, você aprenderá um passo a passo completo para quitar suas dívidas,
                criar uma reserva de emergência e escolher os melhores investimentos de forma segura.</p>
        </section>

        <section id="1" class="secao">
            <h2><i class="fas fa-chart-line"></i> 1. Organize suas Finanças</h2>
            <p>📌 O primeiro passo para sair das dívidas e começar a investir é entender sua situação financeira.</p>
            <p>📊 <b>Liste todas as suas dívidas:</b> Anote quanto deve, para quem deve, os juros cobrados e os prazos de pagamento.</p>
            <p>📉 <b>Registre todas as suas receitas e despesas:</b> Use planilhas financeiras ou aplicativos para controle.</p>
            <p>🔎 <b>Corte gastos desnecessários:</b> Revise despesas e elimine gastos não essenciais.</p>
            <p>📅 <b>Defina metas financeiras:</b> Tenha objetivos claros para manter o foco na recuperação financeira.</p>
        </section>

        <section id="2" class="secao">
            <h2><i class="fas fa-money-bill-wave"></i> 2. Pague as Dívidas Prioritárias</h2>
            <p>🚨 Priorize dívidas com juros altos, como cartão de crédito e cheque especial.</p>
            <p>📞 <b>Negocie suas dívidas:</b> Busque parcelamentos com juros reduzidos ou descontos.</p>
            <p>🔄 <b>Use a estratégia do efeito bola de neve:</b> Método Avalanche (pagar juros altos primeiro) ou Bola de Neve (pagar menores primeiro).</p>
            <p>📊 <b>Consolidação de Dívidas:</b> Juntar tudo em um único empréstimo com juros menores pode ser uma alternativa.</p>
        </section>

        <section id="3" class="secao">
            <h2><i class="fas fa-shield-alt"></i> 3. Crie um Fundo de Emergência</h2>
            <p>🏦 <b>O que é um fundo de emergência?</b> Um valor guardado para cobrir gastos inesperados.</p>
            <p>💰 <b>Quanto guardar?</b> O ideal é ter entre 3 a 6 meses de despesas fixas.</p>
            <p>📍 <b>Onde guardar?</b> Tesouro Selic, CDB com liquidez diária e Fundos DI são boas opções.</p>
            <p>⚠ <b>Não use a reserva para gastos desnecessários!</b> Esse dinheiro é para emergências reais.</p>
        </section>

        <section id="4" class="secao">
            <h2><i class="fas fa-coins"></i> 4. Escolha Investimentos Seguros</h2>
            <p>🔒 Evite riscos no começo. Se está saindo das dívidas, prefira investimentos seguros.</p>
            <p>💼 <b>Melhores opções:</b></p>
            <ul>
                <p>✅ Tesouro Selic</p>
                <p>✅ CDBs de Bancos Grandes</p>
                <p>✅ Fundos de Renda Fixa</p>
                <p>✅ LCI e LCA</p>
            </ul>
            <p>📈 <b>Quando investir em renda variável?</b> Apenas depois de quitar dívidas e ter uma reserva de emergência.</p>
            <p>⚠ <b>Cuidado com promessas de dinheiro fácil!</b> Fuja de pirâmides financeiras e promessas irreais.</p>
        </section>
        <section id="5" class="secao">
            <h2><i class="fas fa-coins"></i> 5. Veja um curso explicativo</h2>
            <p>🔒 Assista ao Curso e aprenda o melhor de investir:</p>
            <br><a style="text-decoration: none; color: white;" href="curso.html" class="btn-sair"><i class="fas fa-arrow-left"></i>Curso</a>

        </section>
        
    </main>

</body>
</html>
