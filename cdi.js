document.getElementById('calcular').addEventListener('click', () => {
    const valorInicial = parseFloat(document.getElementById('valorInicial').value);
    const taxa = parseFloat(document.getElementById('taxa').value) / 100;
    const taxaCdi = parseFloat(document.getElementById('taxaCdi').value) / 100;
    const periodo = parseInt(document.getElementById('periodo').value);
    const reinvestir = document.getElementById('reinvestir').value;

    if (isNaN(valorInicial) || isNaN(taxa) || isNaN(taxaCdi) || isNaN(periodo)) {
        alert('Preencha todos os campos corretamente.');
        return;
    }

    const taxaCdiMensal = (1 + taxaCdi) ** (1 / 12) - 1;

    const taxaEfetiva = taxa * taxaCdiMensal;

    let valorFinal = valorInicial;
    let totalJuros = 0;

    if (reinvestir === "sim") {
        for (let i = 0; i < periodo; i++) {
            const juros = valorFinal * taxaEfetiva;
            valorFinal += juros;
            totalJuros += juros;
        }
    } else {
        totalJuros = valorInicial * taxaEfetiva * periodo;
        valorFinal = valorInicial + totalJuros;
    }

    const resumo = `
        <strong>Resumo do Investimento:</strong><br>
        Valor Inicial: R$ ${valorInicial.toFixed(2)}<br>
        Taxa do CDB: ${(taxa * 100).toFixed(2)}% do CDI<br>
        CDI Anual: ${(taxaCdi * 100).toFixed(2)}%<br>
        Período: ${periodo} meses<br>
        Reinvestir Juros: ${reinvestir === "sim" ? "Sim" : "Não"}
    `;

    // Resultado
    const resultado = `
        <strong>Resultados:</strong><br>
        Rendimentos Totais: R$ ${totalJuros.toFixed(2)}<br>
        Valor Final: R$ ${valorFinal.toFixed(2)}
    `;

    document.getElementById('resumo').innerHTML = resumo;
    document.getElementById('resultado').innerHTML = resultado;
});
