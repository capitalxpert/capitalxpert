let precoAtualCardano = 0; 
let historicoPrecos = [];
let etiquetasDatas = [];
let graficoCardano = null;

async function buscarPrecoCardano() {
    try {
        const resposta = await fetch('https://api.coingecko.com/api/v3/simple/price?ids=cardano&vs_currencies=brl');
        const dados = await resposta.json();
        precoAtualCardano = dados.cardano.brl; 
        document.getElementById('precoBitcoin').innerText = `Preço atual da Cardano: R$ ${precoAtualCardano.toFixed(2)}`;
    } catch (erro) {
        document.getElementById('precoBitcoin').innerText = 'Erro ao buscar o preço da Cardano. Tente novamente mais tarde.';
    }
}

async function buscarHistoricoPrecos(dias = 30) {
    try {
        const resposta = await fetch(`https://api.coingecko.com/api/v3/coins/cardano/market_chart?vs_currency=brl&days=${dias}`);
        const dados = await resposta.json();

        historicoPrecos = dados.prices.map(preco => preco[1]); 
        etiquetasDatas = dados.prices.map(preco => {
            const data = new Date(preco[0]);
            return `${data.getDate()}/${data.getMonth() + 1}`; 
        });

        renderizarGrafico(); 
    } catch (erro) {
        console.error('Erro ao buscar histórico de preços:', erro);
    }
}

function renderizarGrafico() {
    const contexto = document.getElementById('graficoPrecos').getContext('2d');

    if (graficoCardano) {
        graficoCardano.destroy();
    }

    graficoCardano = new Chart(contexto, {
        type: 'line', 
        data: {
            labels: etiquetasDatas, 
            datasets: [
                {
                    label: 'Preço da Cardano (R$)',
                    data: historicoPrecos,
                    borderColor: '#3c3c3c',
                    backgroundColor: 'rgba(60, 60, 60, 0.1)',
                    borderWidth: 1,
                    fill: true,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                },
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Data',
                    },
                },
                y: {
                    title: {
                        display: true,
                        text: 'Preço (R$)',
                    },
                },
            },
        },
    });
}

document.getElementById('atualizarGrafico').addEventListener('click', () => {
    const periodoSelecionado = document.getElementById('periodoHistorico').value;
    buscarHistoricoPrecos(periodoSelecionado);
});

document.getElementById('calcular').addEventListener('click', () => {
   
    const investimentoInicial = parseFloat(document.getElementById('investimentoInicial').value) || 0;
    const aporteMensal = parseFloat(document.getElementById('aporteMensal').value) || 0;
    const periodoInvestimento = parseInt(document.getElementById('periodoInvestimento').value) || 0;

    if (investimentoInicial < 0 || aporteMensal < 0 || periodoInvestimento <= 0) {
        document.getElementById('resultado').innerText = 'Por favor, insira valores válidos.';
        return;
    }

    let totalInvestido = investimentoInicial; 
    for (let i = 0; i < periodoInvestimento; i++) {
        totalInvestido += aporteMensal; 
    }

    const quantidadeCardano = totalInvestido / precoAtualCardano; 

    document.getElementById('resultado').innerHTML = `
        <p>Investimento total: R$ ${totalInvestido.toFixed(2)}</p>
        <p>Quantidade estimada de Cardano: ${quantidadeCardano.toFixed(6)} ADA</p>
    `;
});

buscarPrecoCardano();
buscarHistoricoPrecos(); 
