let precoAtualSolana = 0; 
let historicoPrecos = [];
let etiquetasDatas = [];
let graficoSolana = null;

async function buscarPrecoSolana() {
    try {
        const resposta = await fetch('https://api.coingecko.com/api/v3/simple/price?ids=solana&vs_currencies=brl');
        const dados = await resposta.json();
        precoAtualSolana = dados.solana.brl; 
        document.getElementById('precoSolana').innerText = `Preço atual da Solana: R$ ${precoAtualSolana.toFixed(2)}`;
    } catch (erro) {
        document.getElementById('precoSolana').innerText = 'Erro ao buscar o preço da Solana. Tente novamente mais tarde.';
        console.error('Erro ao buscar preço da Solana:', erro);
    }
}

async function buscarHistoricoPrecos(dias = 30) {
    try {
        const resposta = await fetch(`https://api.coingecko.com/api/v3/coins/solana/market_chart?vs_currency=brl&days=${dias}`);
        const dados = await resposta.json();

        historicoPrecos = dados.prices.map(preco => preco[1]); 
        etiquetasDatas = dados.prices.map(preco => {
            const data = new Date(preco[0]);
            return `${data.getDate()}/${data.getMonth() + 1}`; 
        });

        console.log('Dados do Histórico:', historicoPrecos, etiquetasDatas);  

        renderizarGrafico(); 
    } catch (erro) {
        console.error('Erro ao buscar histórico de preços:', erro);
    }
}

function renderizarGrafico() {
    const contexto = document.getElementById('graficoPrecos').getContext('2d');

   
    if (historicoPrecos.length === 0 || etiquetasDatas.length === 0) {
        console.error('Não há dados suficientes para renderizar o gráfico.');
        return;
    }

 
    if (graficoSolana) {
        graficoSolana.destroy();
    }

    graficoSolana = new Chart(contexto, {
        type: 'line', 
        data: {
            labels: etiquetasDatas, 
            datasets: [
                {
                    label: 'Preço da Solana (R$)',
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
    console.log(`Período selecionado: ${periodoSelecionado}`); 
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

    const quantidadeSolana = totalInvestido / precoAtualSolana; 

    document.getElementById('resultado').innerHTML = `
        <p>Investimento total: R$ ${totalInvestido.toFixed(2)}</p>
        <p>Quantidade estimada de Solana: ${quantidadeSolana.toFixed(6)} SOL</p>
    `;
});

buscarPrecoSolana();
buscarHistoricoPrecos();  
