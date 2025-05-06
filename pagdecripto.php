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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investimentos em Criptomoedas</title>
    <link rel="stylesheet" href="pagprincipa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<div class="barra-lateral">
    <div class="logo">
        <i class="fas fa-coins"></i>
        <span>capitalXpert</span>
    </div>
    <ul>
        <li class="plataforma">
            <i class="fas fa-bars" id="menu-icon"></i>
            <a href="javascript:void(0)" onclick="togglePlataforma()">Minha Plataforma</a>
        </li>
        <div id="menu-plataforma" style="display: none;">
            <li><i class="fas fa-user"></i><a href="editarpessoa.php">Editar Perfil</a></li>
            <li><i class="fas fa-trash"></i><a href="excluirconta.php">Excluir Conta</a></li>
            <li><i class="fas fa-sign-out-alt"></i><a href="logout.php">Sair da conta</a></li>
            <li><i class="fas fa-exclamation-circle"></i><a href="endividado.php">Endividado?</a></li>
            <li><i class="fa-solid fa-book-open"></i><a href="questionario.html">Questionário</a></li>
            <li><i class="fas fa-user-clock"></i><a href="#aposentadoria-div">Aposentadoria</a></li>
            <li><i class="fas fa-calculator"></i><a href="planilha.html">Controle de Gastos</a></li>

            <li class="plataforma">
                <a href="javascript:void(0)" onclick="toggleSeguro()">
                    Seguro &nbsp;<i class="fas fa-chevron-down" id="seta-seguro" style="font-size: 14px;"></i>
                </a>
            </li>
            <div id="menu-seguro" style="display: none;">
                <li><i class="fas fa-car"></i><a href="#">Automobilístico</a></li>
                <li><i class="fas fa-heart"></i><a href="#">De vida</a></li>
                <li><i class="fa-solid fa-house"></i><a href="#">Imobiliário</a></li>
            </div>

            <li class="plataforma">
                <a href="javascript:void(0)" onclick="toggleRenda()">
                    Renda Fixa &nbsp;<i class="fas fa-chevron-down" id="seta-renda" style="font-size: 14px;"></i>
                </a>
            </li>
            <div id="menu-renda" style="display: none;">
                <li><a href="#renda-fixa-geral">Geral <i class="fas fa-info-circle"></i></a></li>
<li><a href="cdi.html">CDI <i class="fas fa-piggy-bank"></i></a></li>
<li><a href="cdb.html">CDB <i class="fas fa-file-alt"></i></a></li>
<li><a href="ipca.html">IPCA <i class="fas fa-percent"></i></a></li>
<li><a href="selic.html">Selic <i class="fas fa-trophy"></i></a></li>
<li><a href="lci.html">LCI <i class="fas fa-building"></i></a></li>
<li><a href="lca.html">LCA <i class="fas fa-tractor"></i></a></li>
<li><a href="selic.html">Poupança <i class="fas fa-wallet"></i></a></li>
            </div>

            <li><i class="fas fa-dollar"></i><a href="#acoes">Ações</a></li>
            <li><i class="fa-regular fa-copyright"></i><a href="#cripto">Criptomoedas</a></li>
        </div>
    </ul>
</div>

<div class="conteudo">
    <div class="parte-superior">
        <div class="texto">
            <p>Olá, <?php echo $nome; ?>! Bem-vindo à sua página de Investimentos em Criptomoedas.</p>
            <h1>Invista em Criptomoedas e Transforme seu Futuro!</h1>
            <p>O mercado de criptomoedas oferece novas oportunidades de investimentos. Entenda as vantagens e como começar agora mesmo.</p>
        </div>
        <div class="imagem">
            <img src="fotoinicio.jpg" alt="Imagem de Criptomoedas">
        </div>
    </div>
    <div id="aposentadoria-div" class="secao quadrado">
        <h2><i class="fas fa-calendar-check"></i> Aposentadoria</h2>
        <p>Investir desde cedo garante um futuro financeiramente estável. Conheça os melhores investimentos para sua aposentadoria.</p>
        <ul>
            <p>💰 <strong>Inflação:</strong> O dinheiro perde valor ao longo do tempo, e investir ajuda a proteger seu poder de compra.</p>
            <p>🏠 <strong>Independência financeira:</strong> Com investimentos, você não dependerá exclusivamente do governo ou familiares para viver.</p>
            <p>🌟 <strong>Qualidade de vida:</strong> Garantir uma aposentadoria confortável, sem abrir mão dos seus desejos e necessidades.</p>
            <p>📅 <strong>Longo prazo:</strong> Quanto antes começar a investir, menor será o esforço necessário para acumular um bom patrimônio.</p>
            <p>📈 <strong>Rendimentos passivos:</strong> Investimentos inteligentes podem gerar uma renda extra, permitindo que você viva tranquilamente.</p>
        </ul>
        <br><a href="aposentadoria.php" class="btn-saiba-mais">Saiba mais <i class="fas fa-arrow-right"></i></a>
    </div>
    <div id="seguro-imobiliario" class="secao quadrado">
        <h2>Seguro Imobiliário</h2>
        <p>Proteja seu imóvel e invista com segurança.</p>
    </div>

    <div id="seguro-carro" class="secao quadrado">
        <h2>Seguro Automobilístico</h2>
        <p>Evite surpresas com um seguro veicular adequado.</p>
    </div>

    <div id="seguro-vida" class="secao quadrado">
        <h2>Seguro de Vida</h2>
        <p>Garanta proteção financeira para sua família.</p>
    </div>

    <div id="renda-fixa-geral" class="secao quadrado">
        <h2>Renda Fixa</h2>
        <p>Investimentos com menor risco e retorno previsível. Exemplos incluem CDI, CDB, IPCA e Selic.</p>
    </div>

    <div id="acoes" class="secao quadrado">
        <h2>Ações</h2>
        <p>Falar sobre ações aqui.</p>
    </div>

    <div id="cripto" class="secao quadrado">
        <h2>Criptomoedas</h2>
        <p>Falar sobre cripto aqui.</p>
    </div>
</div>

<script>
    function togglePlataforma() {
        var menu = document.getElementById('menu-plataforma');
        var plataformaItem = document.querySelector('.plataforma');
        
        menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';

        var icon = document.getElementById('menu-icon');
        if (menu.style.display === 'block') {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
            plataformaItem.classList.add('ativa');
        } else {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
            plataformaItem.classList.remove('ativa');
        }
    }

    function toggleSeguro() {
        var menu = document.getElementById('menu-seguro');
        var icon = document.getElementById('seta-seguro');

        menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';

        if (menu.style.display === 'block') {
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        } else {
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    }

    function toggleRenda() {
        var menu = document.getElementById('menu-renda');
        var icon = document.getElementById('seta-renda');

        menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';

        if (menu.style.display === 'block') {
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        } else {
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    }
</script>

</body>
</html>
