const questions = [
    { question: "1-O que são ações?", options: ["Investimentos em imóveis", "Partes de uma empresa", "Dinheiro guardado no banco", "Bens tangíveis"], answer: 1 },
    { question: "2-O que é uma renda fixa?", options: ["Investimento com retorno variável", "Investimento com retorno previsível", "Investimento em imóveis", "Investimento em ações"], answer: 1 },
    { question: "3-O que é uma ETF?", options: ["Fundo de Investimento Imobiliário", "Fundo de Índice", "Ação Individual", "Câmbio de moedas"], answer: 1 },
    { question: "4-O que significa diversificação de investimentos?", options: ["Concentrar todos os investimentos em um único ativo", "Distribuir investimentos entre diferentes ativos", "Investir em um único tipo de ativo", "Investir em ações apenas"], answer: 1 },
    { question: "5-Qual é o principal objetivo de um fundo de investimentos?", options: ["Oferecer segurança e rentabilidade fixa", "Reunir recursos de vários investidores para investir em ativos", "Investir em imóveis apenas", "Investir em ações de empresas grandes"], answer: 1 },
    { question: "6-Qual é a principal vantagem dos investimentos no exterior?", options: ["Maior segurança", "Diversificação e proteção contra inflação local", "Alta liquidez", "Baixo risco"], answer: 1 },
    { question: "7-O que são dividendos?", options: ["Lucro pago aos acionistas", "Comissões pagas a investidores", "Taxas de juros de empréstimos", "Taxas de administração de fundos"], answer: 0 },
    { question: "8-O que é um risco de mercado?", options: ["Risco de um ativo não gerar rentabilidade", "Risco de a empresa falir", "Risco relacionado a mudanças nos preços de ativos financeiros", "Risco de perder todo o investimento"], answer: 2 },
    { question: "9-O que são títulos públicos?", options: ["Papéis emitidos pelo governo para arrecadar recursos", "Ações de empresas privadas", "Imóveis adquiridos pelo governo", "Créditos de bancos privados"], answer: 0 },
    { question: "10-Qual é o objetivo de um plano de previdência privada?", options: ["Formar uma reserva financeira para aposentadoria", "Investir em ações de grandes empresas", "Ajudar o governo a financiar a educação", "Oferecer crédito pessoal aos investidores"], answer: 0 },
    { question: "11-O que é o efeito dos juros compostos?", options: ["Os juros aumentam apenas uma vez", "Os juros aumentam de acordo com o tempo e o valor investido", "Os juros diminuem com o tempo", "Os juros são fixos"], answer: 1 },
    { question: "12-Qual a diferença entre ações e fundos imobiliários?", options: ["Fundos imobiliários não geram dividendos", "Ações são emitidas por empresas e fundos imobiliários investem em imóveis", "Ações e fundos imobiliários são a mesma coisa", "Fundos imobiliários são mais arriscados que ações"], answer: 1 },
    { question: "13-O que é o home broker?", options: ["Uma plataforma de compra e venda de imóveis", "Uma plataforma de compra e venda de ações", "Uma ferramenta para realizar empréstimos", "Uma estratégia de investimentos"], answer: 1 },
    { question: "14-O que significa a sigla CDI?", options: ["Certificado de Depósito Internacional", "Certificado de Depósito Interbancário", "Comissão de Distribuição de Investimentos", "Controle de Dívida Intermediária"], answer: 1 },
    { question: "15-O que são commodities?", options: ["Ações de empresas", "Produtos agrícolas ou minerais negociados em mercados", "Imóveis de luxo", "Títulos públicos"], answer: 1 },
    { question: "16-O que é risco de crédito?", options: ["Risco de uma empresa não pagar suas dívidas", "Risco de mercado", "Risco de não conseguir vender um ativo", "Risco de inflação"], answer: 0 },
    { question: "17-O que é uma renda passiva?", options: ["Renda gerada sem a necessidade de trabalho ativo", "Renda gerada através de vendas de ativos", "Renda proveniente de um único emprego", "Renda do governo"], answer: 0 },
    { question: "18-Qual a diferença entre um fundo de investimento e um fundo imobiliário?", options: ["Fundo de investimento é para ações, e fundo imobiliário é para imóveis", "Ambos são para a mesma finalidade", "Fundo imobiliário é mais arriscado", "Fundo de investimento é menos rentável"], answer: 0 },
    { question: "19-O que significa volatilidade?", options: ["A variação no preço de um ativo", "O risco de perda de valor em um investimento", "A certeza de que um ativo terá retorno positivo", "O período de rentabilidade de um investimento"], answer: 0 },
    { question: "20-O que é o efeito manada?", options: ["Seguir a tendência do mercado sem análise crítica", "Fazer uma análise técnica de mercado", "Investir em imóveis", "Investir apenas em ações de empresas grandes"], answer: 0 },
    { question: "21-O que significa a diversificação?", options: ["Investir em uma única classe de ativos", "Investir em diferentes ativos para reduzir riscos", "Investir apenas em ações de empresas sólidas", "Investir em imóveis apenas"], answer: 1 },
    { question: "22-O que são os fundos imobiliários?", options: ["Investimentos em imóveis para aluguel", "Investimentos em ações", "Investimentos em câmbio", "Investimentos em commodities"], answer: 0 },
    { question: "23-O que é um investimento sustentável?", options: ["Investir em ativos que priorizam questões ambientais e sociais", "Investir apenas em ações de empresas públicas", "Investir apenas em imóveis", "Investir em commodities"], answer: 0 },
    { question: "24-O que é um fundo de índice?", options: ["Um fundo que busca replicar o desempenho de um índice de mercado", "Um fundo de renda fixa", "Um fundo que investe apenas em imóveis", "Um fundo de ações individuais"], answer: 0 },
    { question: "25-O que é o day trade?", options: ["Investir em ativos de longo prazo", "Comprar e vender ativos no mesmo dia", "Investir em imóveis", "Investir em criptomoedas"], answer: 1 },
    { question: "26-O que é um risco de inflação?", options: ["Risco de perda de valor de um ativo devido à inflação", "Risco de baixa rentabilidade", "Risco de falência de uma empresa", "Risco de investimentos no exterior"], answer: 0 },
    { question: "27-O que é a análise técnica de investimentos?", options: ["Estudo do histórico de preços e volume de negociação", "Análise de riscos de crédito", "Análise do perfil do investidor", "Estudo das finanças pessoais"], answer: 0 },
    { question: "28-O que é uma estratégia buy and hold?", options: ["Comprar ativos e manter por longo prazo", "Comprar e vender no mesmo dia", "Investir apenas em imóveis", "Comprar ativos para obter lucros rápidos"], answer: 0 },
    { question: "29-O que é a análise fundamentalista?", options: ["Análise baseada nos fundamentos financeiros de uma empresa", "Análise baseada em gráficos de preços", "Análise de comportamentos psicológicos do mercado", "Análise de indicadores macroeconômicos"], answer: 0 },
    { question: "30-O que é uma criptomoeda?", options: ["Uma moeda digital descentralizada", "Uma moeda controlada por um banco central", "Uma moeda que só pode ser usada para compras online", "Uma moeda emitida por governos para transações internacionais"], answer: 0 }
];

let currentQuestion = 0;
let score = 0;

const questionElement = document.getElementById('question');
const optionsContainer = document.getElementById('options-container');
const submitButton = document.getElementById('submit-button');
const resultContainer = document.getElementById('result');

function loadQuestion() {
    const question = questions[currentQuestion];
    questionElement.textContent = question.question;

    optionsContainer.innerHTML = '';
    question.options.forEach((option, index) => {
        const button = document.createElement('button');
        button.textContent = option;
        button.classList.add('option-btn');
        button.onclick = () => handleOptionClick(button, index);
        optionsContainer.appendChild(button);
    });
}

function handleOptionClick(button, index) {

    const buttons = document.querySelectorAll('.option-btn');
    buttons.forEach(btn => btn.classList.remove('selected'));
    button.classList.add('selected');

    if (index === questions[currentQuestion].answer) {
        score++;
    }
}

submitButton.onclick = () => {
    currentQuestion++;
    if (currentQuestion < questions.length) {
        loadQuestion();
    } else {
        showResult();
    }
};

function showResult() {
    questionElement.textContent = `Você acertou ${score} de ${questions.length} questões.`;
    optionsContainer.style.display = 'none';
    submitButton.style.display = 'none';
}

loadQuestion();
function showResult() {
    let message = '';
    
    if (score >= 0 && score <= 15) {
        message = "Precisa estudar mais, recomendamos nossos cursos e a leitura do conteúdo.";
    } else if (score >= 16 && score <= 25) {
        message = "Está no caminho, recomendamos fazer uma leitura dos nossos conteúdos.";
    } else if (score >= 26 && score <= 29) {
        message = "Olhe com mais atenção, você tem grande potencial!";
    } else if (score === 30) {
        message = "Parabéns! Você já está pronto para investir!";
    }

    questionElement.textContent = `Você acertou ${score} de ${questions.length} questões.`;
    resultContainer.textContent = message; 
    optionsContainer.style.display = 'none';
    submitButton.style.display = 'none';
}
