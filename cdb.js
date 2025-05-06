document.getElementById("investment-form").addEventListener("submit", function(event) {
    event.preventDefault();

    const initialInvestment = parseFloat(document.getElementById("initial-investment").value);
    const investmentPeriod = parseInt(document.getElementById("investment-period").value);
    const monthlyContribution = parseFloat(document.getElementById("monthly-contribution").value);
    const riskLevel = parseFloat(document.getElementById("risk-level").value);

    const cdbRate = 0.08; // Taxa de CDB pré-fixada de 8% ao ano
    const cdiRate = 0.10; // CDI 10% ao ano (para CDB pós-fixado)

    let finalAmount = initialInvestment;
    let totalContributions = initialInvestment;
    let months = investmentPeriod * 12;

    // Se o risco for alto, usamos CDB pós-fixado (CDI)
    let interestRate = riskLevel > 1 ? cdiRate : cdbRate;

    let monthlyRate = interestRate / 12;
    let monthlyAmounts = [initialInvestment];

    for (let i = 1; i <= months; i++) {
        finalAmount += monthlyContribution;
        finalAmount *= (1 + monthlyRate);
        totalContributions += monthlyContribution;

        monthlyAmounts.push(finalAmount);
    }

    document.getElementById("final-amount").textContent = `Valor Final: R$ ${finalAmount.toFixed(2)}`;
    document.getElementById("total-contributions").textContent = `Total Contribuído: R$ ${totalContributions.toFixed(2)}`;

    generateChart(monthlyAmounts);
});

function generateChart(monthlyAmounts) {
    const ctx = document.getElementById("investment-chart").getContext("2d");
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: Array.from({ length: monthlyAmounts.length }, (_, i) => i),
            datasets: [{
                label: 'Valor Acumulado (R$)',
                data: monthlyAmounts,
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Meses'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Valor (R$)'
                    },
                    ticks: {
                        callback: function(value) {
                            return `R$ ${value.toFixed(2)}`;
                        }
                    }
                }
            }
        }
    });
}
