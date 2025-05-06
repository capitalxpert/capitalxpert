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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investir na Aposentadoria</title>
    <link rel="stylesheet" href="aposentadorias.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

    <header>
    <div class="logo-container">
            <img src="logosemnome.png" alt="Logo" class="logo">
        </div>
        <nav>
            <ul>
                <li><a href="#"><i class="fas fa-home"></i> Início</a></li>
                <li><a href="#"><i class="fas fa-chart-line"></i> Inflação</a></li>
                <li><a href="#1"><i class="fas fa-unlock-alt"></i> Independência Financeira</a></li>
                <li><a href="#2"><i class="fas fa-heart"></i> Qualidade de Vida</a></li>
                <li><a href="#3"><i class="fas fa-clock"></i> Longo Prazo</a></li>
                <li><a href="#4"><i class="fas fa-wallet"></i> Rendimentos Passivos</a></li>
                <li><a href="#5"><i class="fas fa-graduation-cap"></i> Cursos</a></li>
                <li><a href="pagdecripto2.php" class="btn-sair"><i class="fas fa-arrow-left"></i> Voltar</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Seção 1: Inflação -->
        <p style="text-align: center;"><?php echo $nome; ?>! Aqui você aprenderá a investir estando na aposentadoria</p>
        <br>
        <section id="1" class="secao">
            <h2><i class="fas fa-arrow-up"></i> A Inflação e a Aposentadoria</h2>
            <p>A inflação é um dos maiores inimigos do seu dinheiro a longo prazo. Ao investir desde cedo, você consegue fazer seu dinheiro crescer de forma mais eficiente, protegendo-o da desvalorização que a inflação causa. Sem investimentos, sua renda vai perder poder de compra com o passar dos anos, o que pode prejudicar sua aposentadoria, já que os custos aumentam constantemente.</p>
        </section>

        <!-- Seção 2: Independência Financeira -->
        <section id="2" class="secao">
            <h2><i class="fas fa-unlock-alt"></i> Independência Financeira</h2>
            <p>Investir para a aposentadoria não é apenas sobre acumular dinheiro, mas sim sobre construir a liberdade financeira. Ao realizar investimentos que geram rendimentos passivos, você pode garantir que, ao se aposentar, terá uma fonte de renda constante, sem depender de trabalho ativo ou de uma aposentadoria pública que muitas vezes não é suficiente para manter o seu estilo de vida.</p>
        </section>

        <!-- Seção 3: Qualidade de Vida -->
        <section id="3" class="secao">
            <h2><i class="fas fa-heart"></i> Qualidade de Vida na Aposentadoria</h2>
            <p>Uma aposentadoria planejada com investimentos proporciona mais do que dinheiro para pagar as contas. Ela oferece a liberdade de escolher como você quer viver. Com o devido planejamento e o foco em investimentos seguros, você pode garantir uma aposentadoria tranquila, podendo viajar, cuidar de sua saúde, ou realizar sonhos que muitas vezes ficam de lado devido à falta de recursos financeiros.</p>
        </section>

        <!-- Seção 4: Longo Prazo -->
        <section id="4" class="secao">
            <h2><i class="fas fa-clock"></i> A Importância do Longo Prazo</h2>
            <p>Investir pensando no longo prazo é uma estratégia crucial para a aposentadoria. Quanto mais cedo você começar a investir, menos esforço será necessário para atingir seus objetivos financeiros. A força dos juros compostos fará com que seu dinheiro cresça de forma exponencial ao longo dos anos, o que pode significar a diferença entre uma aposentadoria confortável e uma vida financeira apertada após parar de trabalhar.</p>
        </section>

        <!-- Seção 5: Rendimentos Passivos -->
        <section id="5" class="secao">
            <h2><i class="fas fa-money-bill-wave"></i> Rendimentos Passivos</h2>
            <p>Os rendimentos passivos são a chave para uma aposentadoria tranquila. Ao investir em ativos como imóveis para aluguel, ações ou fundos imobiliários, você pode gerar uma renda constante que não exige seu trabalho diário. Essa renda passiva garantirá que você continue recebendo dinheiro enquanto estiver aposentado, permitindo que você mantenha o padrão de vida desejado sem precisar trabalhar.</p>
        </section>

        <section id="6" class="secao">
            <h2><i class="fas fa-graduation-cap"></i> Veja um curso explicativo</h2>
            <p>🔒 Assista ao Curso e aprenda o melhor de investir:</p>
            <br><a style="text-decoration: none; color: white;" href="curso.html" class="btn-sair"><i class="fas fa-arrow-left"></i>Curso</a>
        </section>
    </main>
</body>
</html>
