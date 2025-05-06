<?php
session_start();

if (!isset($_SESSION['cnpj'])) {
    header('Location: login2.html');
    exit();
}

$cnpj = $_SESSION['cnpj'];
include_once('config.php');

$query = "SELECT p.nome FROM empresa p 
          JOIN pagarpj pj ON pj.cnpj = p.cnpj 
          WHERE pj.cnpj = '$cnpj'";
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
  <title>Portal Educacional para Empresas</title>
  <link rel="stylesheet" href="estilo.css">
  <script defer src="script.js"></script>
</head>
<body>
  <header>
    <div class="logo-container">
      <img src="logosemnome.png" alt="Logo" class="logo">
    </div>
    <nav>
      <ul>
        <li><a href="#">Início</a></li>
        <li><a href="#inicio">Organização Financeira</a></li>
        <li><a href="#organizacao">Quitar Dívidas</a></li>
        <li><a href="#dividas">Reserva Empresarial</a></li>
        <li><a href="#reserva">Investimentos Seguros</a></li>
        <li><a href="#cursos">Cursos</a></li>
        <li><a href="pagdecripto2.php" class="btn-sair">Voltar</a></li>
      </ul>
    </nav>
  </header>

  <main class="container">
    <section id="inicio" class="secao">
      <h1>Bem-vindo ao Portal Educacional Corporativo</h1>
      <p> Olá! <?php echo $nome; ?>, aqui você aprenderá como sua empresa pode se organizar financeiramente, sair das dívidas, criar uma reserva estratégica e investir de forma segura, mesmo enfrentando dificuldades.</p>
    </section>

    <section id="organizacao" class="secao">
      <h2>1. Organize as Finanças da Sua Empresa</h2>
      <p>📌 Antes de pensar em investir, é essencial entender a real situação financeira da empresa.</p>
      <p>- Faça um raio-X completo do seu negócio: identifique todas as receitas, custos fixos e variáveis, dívidas e obrigações fiscais.</p>
      <p>- Use ERPs para automatizar a gestão e melhorar a tomada de decisão.</p>
      <p>- Crie um DRE mensal e acompanhe seu fluxo de caixa com regularidade.</p>
      <p>- Separe finanças pessoais das empresariais. Essa divisão traz clareza e segurança fiscal.</p>
    </section>

    <section id="dividas" class="secao">
      <h2>2. Quite as Dívidas Prioritárias e Negocie com Inteligência</h2>
      <p>📉 Identifique quais são as dívidas que mais impactam o seu fluxo de caixa.</p>
      <p>- Priorize impostos e dívidas bancárias com juros altos.</p>
      <p>- Renegocie com fornecedores e bancos apresentando seu plano financeiro.</p>
      <p>- Avalie a possibilidade de consolidar dívidas em um único financiamento com melhores condições.</p>
      <p>- Considere a antecipação de recebíveis como alternativa para gerar caixa imediato.</p>
    </section>

    <section id="reserva" class="secao">
      <h2>3. Crie uma Reserva Financeira Corporativa</h2>
      <p>🏦 Toda empresa deve manter um fundo para imprevistos.</p>
      <p>- Comece guardando 5% da receita mensal, mesmo que seja pouco.</p>
      <p>- Invista em ativos conservadores com liquidez: Tesouro Selic, CDB com liquidez diária, Fundos DI.</p>
      <p>- Revise a reserva a cada semestre para garantir que ela esteja compatível com o tamanho e riscos do seu negócio.</p>
      <p>- Nunca utilize essa reserva para gastos corriqueiros.</p>
    </section>

    <section id="investimentos" class="secao">
      <h2>4. Escolha Investimentos Seguros para sua Empresa</h2>
      <p>🔒 Evite aplicações de alto risco no início, principalmente se ainda está regularizando suas contas.</p>
      <p>- Prefira investimentos conservadores que protejam o capital e acompanhem a inflação.</p>
      <p>- Exemplos: Tesouro Selic, LCI/LCA, Fundos de Renda Fixa, CDBs de bancos grandes.</p>
      <p>- Evite aplicações especulativas ou com promessas de "ganhos fáceis". Isso pode comprometer sua empresa.</p>
    </section>

    <section id="cursos" class="secao">
      <h2>5. Cursos de Educação Financeira Empresarial</h2>
      <p>🎓 Invista no conhecimento da sua equipe. Uma gestão capacitada é a base para crescimento sólido.</p>
      <p>- Oferecemos cursos online sobre fluxo de caixa, controle de estoque, formação de preços, e investimentos corporativos.</p>
      <p>- Acesse o conteúdo completo clicando no link abaixo:</p> <br>
      <a style="text-decoration:none; color: white;" class="btn-sair" href="curso.html">Ir para o Curso</a>
    </section>
  </main>
</body>
</html>
