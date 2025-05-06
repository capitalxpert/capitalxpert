let salario = 0;
let totalGastos = 0;
let gastos = [];
const listaGastos = document.getElementById("lista-gastos");
const saldoRestante = document.getElementById("saldo-restante");
const progress = document.getElementById("progress");
const percentSalario = document.getElementById("percent-salario");

const ctxGastos = document.getElementById("graficoGastos").getContext("2d");
const ctxCategorias = document.getElementById("graficoCategorias").getContext("2d");

let categorias = {
    "Alimentação": 0,
    "Transporte": 0,
    "Lazer": 0,
    "Saúde": 0,
    "Outros": 0
};

const cores = {
    "Alimentação": "#ff79c6",
    "Transporte": "#f1fa8c",
    "Lazer": "#8be9fd",
    "Saúde": "#ffb86c",
    "Outros": "#bd93f9"
};

const graficoGastos = new Chart(ctxGastos, {
    type: "bar",
    data: {
        labels: [],
        datasets: [{
            label: "Valor dos Gastos",
            data: [],
            backgroundColor: [],
            borderColor: "#282a36",
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Gastos Individuais",
                color: "#ff6200",
                font: {
                    size: 16
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: "#44475a"
                },
                ticks: {
                    color: "#fff"
                }
            },
            x: {
                grid: {
                    color: "#44475a"
                },
                ticks: {
                    color: "#fff"
                }
            }
        }
    }
});

const graficoCategorias = new Chart(ctxCategorias, {
    type: "pie",
    data: {
        labels: ["Alimentação", "Transporte", "Lazer", "Saúde", "Outros"],
        datasets: [{
            label: "Distribuição por Categoria",
            data: [0, 0, 0, 0, 0],
            backgroundColor: [
                "#ff79c6", "#f1fa8c", "#8be9fd", "#ffb86c", "#bd93f9"
            ],
            borderColor: "#282a36",
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: "bottom",
                labels: {
                    color: "#fff"
                }
            },
            title: {
                display: true,
                text: "Distribuição por Categoria",
                color: "#ff6200",
                font: {
                    size: 16
                }
            }
        }
    }
});

function definirSalario() {
    salario = parseFloat(document.getElementById("salario").value) || 0;
    atualizarSaldo();
}

function adicionarAporte() {
    let aporte = parseFloat(document.getElementById("aporte").value) || 0;
    if (aporte > 0) {
        salario += aporte;
        atualizarSaldo();
    }
}

function adicionarGasto() {
    let descricao = document.getElementById("descricao").value;
    let valor = parseFloat(document.getElementById("valor").value) || 0;
    let categoria = document.getElementById("categoria").value;

    if (descricao && valor > 0) {
        totalGastos += valor;
        gastos.push({ descricao: `${descricao} (${categoria})`, valor, categoria });
        categorias[categoria] += valor;

        atualizarListaGastos();
        atualizarSaldo();
        atualizarGraficoGastos();
        atualizarGraficoCategorias();
    }
}

function atualizarListaGastos() {
    listaGastos.innerHTML = "";
    gastos.forEach((gasto, index) => {
        let li = document.createElement("li");
        li.textContent = `${gasto.descricao}: R$ ${gasto.valor.toFixed(2)}`;

        let btnRemover = document.createElement("button");
        btnRemover.textContent = "Remover";
        btnRemover.classList.add("remove-btn");
        btnRemover.onclick = () => removerGasto(index);

        li.appendChild(btnRemover);
        listaGastos.appendChild(li);
    });
}

function removerGasto(index) {
    totalGastos -= gastos[index].valor;
    categorias[gastos[index].categoria] -= gastos[index].valor;
    gastos.splice(index, 1);
    atualizarListaGastos();
    atualizarSaldo();
    atualizarGraficoGastos();
    atualizarGraficoCategorias();
}

function atualizarSaldo() {
    let saldo = salario - totalGastos;
    saldoRestante.textContent = `Saldo restante: R$ ${saldo.toFixed(2)}`;
    saldoRestante.style.color = saldo < 0 ? "red" : "#50fa7b";

    progress.style.width = `${(totalGastos / salario) * 100}%`;
    let percentual = (totalGastos / salario) * 100;
    percentSalario.textContent = `${percentual.toFixed(2)}% do salário utilizado`;
}

function atualizarGraficoGastos() {
    graficoGastos.data.labels = gastos.map(gasto => gasto.descricao);
    graficoGastos.data.datasets[0].data = gastos.map(gasto => gasto.valor);
    graficoGastos.data.datasets[0].backgroundColor = gastos.map(gasto => cores[gasto.categoria] || "#fff");
    graficoGastos.update();
}

function atualizarGraficoCategorias() {
    graficoCategorias.data.datasets[0].data = Object.values(categorias);
    graficoCategorias.update();
}