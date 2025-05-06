let precoAtualBitcoin = 0; 
let historicoPrecos = [];
let etiquetasDatas = [];
let graficoBitcoin = null; 

async function buscarPrecoBitcoin() {
    try {
        const resposta = await fetch('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=brl');
        const dados = await resposta.json();
        precoAtualBitcoin = dados.bitcoin.brl; 
        document.getElementById('precoBitcoin').innerText = `Preço atual do Bitcoin: R$ ${precoAtualBitcoin.toFixed(2)}`;
    } catch (erro) {
        document.getElementById('precoBitcoin').innerText = 'Erro ao buscar o preço do Bitcoin. Tente novamente mais tarde.';
    }
}

async function buscarHistoricoPrecos(dias = 30) {
    try {
        const resposta = await fetch(`https://api.coingecko.com/api/v3/coins/bitcoin/market_chart?vs_currency=brl&days=${dias}`);
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

// Função para renderizar o gráfico
function renderizarGrafico() {
    const contexto = document.getElementById('graficoPrecos').getContext('2d');

    if (graficoBitcoin) {
        graficoBitcoin.destroy();
    }

    graficoBitcoin = new Chart(contexto, {
        type: 'line', 
        data: {
            labels: etiquetasDatas, 
            datasets: [
                {
                    label: 'Preço do Bitcoin (R$)',
                    data: historicoPrecos,
                    borderColor: '#f7931a',
                    backgroundColor: 'rgba(247, 147, 26, 0.1)',
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

   
    const quantidadeBitcoin = totalInvestido / precoAtualBitcoin; 

    
    document.getElementById('resultado').innerHTML = `
        <p>Investimento total: R$ ${totalInvestido.toFixed(2)}</p>
        <p>Quantidade estimada de Bitcoin: ${quantidadeBitcoin.toFixed(6)} BTC</p>
    `;
});


buscarPrecoBitcoin();
buscarHistoricoPrecos(); 
