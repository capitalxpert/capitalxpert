const dadosMoeda = [
    { moeda: "USD", pais: "Estados Unidos" },
    { moeda: "EUR", pais: "União Europeia" },
    { moeda: "JPY", pais: "Japão" },
    { moeda: "GBP", pais: "Reino Unido" },
    { moeda: "AUD", pais: "Austrália" },
    { moeda: "CAD", pais: "Canadá" },
    { moeda: "CHF", pais: "Suíça" },
    { moeda: "CNY", pais: "China" },
    { moeda: "BRL", pais: "Brasil" },
    { moeda: "INR", pais: "Índia" },
    { moeda: "MXN", pais: "México" },
    { moeda: "KRW", pais: "Coreia do Sul" },
    { moeda: "NZD", pais: "Nova Zelândia" },
    { moeda: "SGD", pais: "Cingapura" },
    { moeda: "HKD", pais: "Hong Kong" },
    { moeda: "ARS", pais: "Argentina" },
    { moeda: "VND", pais: "Vietnã" },
    { moeda: "RUB", pais: "Rússia" },
    { moeda: "ZAR", pais: "África do Sul" },
    { moeda: "TRY", pais: "Turquia" },
    { moeda: "SEK", pais: "Suécia" },
    { moeda: "NOK", pais: "Noruega" },
    { moeda: "DKK", pais: "Dinamarca" },
    { moeda: "PLN", pais: "Polônia" },
    { moeda: "KRW", pais: "Coreia do Sul" },
    { moeda: "SAR", pais: "Arábia Saudita" },
    { moeda: "AED", pais: "Emirados Árabes Unidos" },
    { moeda: "EGP", pais: "Egito" },
    { moeda: "CLP", pais: "Chile" },
    { moeda: "COP", pais: "Colômbia" },
    { moeda: "KWD", pais: "Kuwait" },
    { moeda: "BHD", pais: "Bahrein" }
];

const urlApi = 'https://v6.exchangerate-api.com/v6/e124609c5aa714eed62b3779/latest/BRL';

async function buscarTaxasMoeda() {
    try {
        const resposta = await fetch(urlApi);
        const dados = await resposta.json();

        if (dados.result === "success") {
            
            dadosMoeda.forEach(item => {
                if (dados.conversion_rates[item.moeda]) {
                    item.taxa = (1 / dados.conversion_rates[item.moeda]).toFixed(4);
                }
            });

            gerarTabela();
        } else {
            console.error('Erro ao buscar as taxas de câmbio: ', dados.error);
        }
    } catch (erro) {
        console.error('Erro ao buscar taxas de câmbio:', erro);
    }
}

function gerarTabela() {
    const corpoTabela = document.querySelector("#tabelaMoeda tbody");
    corpoTabela.innerHTML = ""; 

    dadosMoeda.forEach(item => {
        const linha = document.createElement("tr");
        linha.innerHTML = `
            <td>${item.moeda}</td>
            <td>${item.pais}</td>
            <td>${item.taxa}</td>
        `;
        corpoTabela.appendChild(linha);
    });
}

function ordenarTabela(indiceColuna) {
    const tabela = document.getElementById("tabelaMoeda");
    const linhas = Array.from(tabela.rows).slice(1);

    let linhasOrdenadas;
    if (tabela.rows[0].cells[indiceColuna].classList.contains("sorted-asc")) {
        linhasOrdenadas = linhas.sort((a, b) => compareLinhas(b, a, indiceColuna));
        tabela.rows[0].cells[indiceColuna].classList.remove("sorted-asc");
        tabela.rows[0].cells[indiceColuna].classList.add("sorted-desc");
    } else {
        linhasOrdenadas = linhas.sort((a, b) => compareLinhas(a, b, indiceColuna));
        tabela.rows[0].cells[indiceColuna].classList.remove("sorted-desc");
        tabela.rows[0].cells[indiceColuna].classList.add("sorted-asc");
    }

    linhasOrdenadas.forEach(linha => tabela.appendChild(linha));
}

function compareLinhas(a, b, indiceColuna) {
    const textoA = a.cells[indiceColuna].innerText;
    const textoB = b.cells[indiceColuna].innerText;

    if (indiceColuna === 2) { 
        return parseFloat(textoB) - parseFloat(textoA);
    } else { 
        return textoA.localeCompare(textoB);
    }
}

window.onload = function() {
    const elementoUltimaAtualizacao = document.getElementById("ultimaAtualizacao");
    const dataAtual = new Date();
    const dataFormatada = dataAtual.toLocaleDateString('pt-BR', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });

    elementoUltimaAtualizacao.textContent = dataFormatada;
    buscarTaxasMoeda(); 
};

setInterval(buscarTaxasMoeda, 600000);
