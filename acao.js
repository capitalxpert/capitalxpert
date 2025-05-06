document.addEventListener('DOMContentLoaded', () => {
  const chaveApi = 'cua0qt9r01qkpes3uk5gcua0qt9r01qkpes3uk60';
  const acoes = [
      { nome: "Apple", simbolo: "AAPL" },
      { nome: "Google", simbolo: "GOOGL" },
      { nome: "Amazon", simbolo: "AMZN" },
      { nome: "Microsoft", simbolo: "MSFT" },
      { nome: "Tesla", simbolo: "TSLA" },
      { nome: "Netflix", simbolo: "NFLX" },
      { nome: "NVIDIA", simbolo: "NVDA" },
      { nome: "Intel", simbolo: "INTC" },
      { nome: "S&P 500 ETF", simbolo: "SPY" },
      { nome: "Johnson & Johnson", simbolo: "JNJ" },
      { nome: "Coca-Cola", simbolo: "KO" },
      { nome: "Disney", simbolo: "DIS" },
      { nome: "Berkshire Hathaway", simbolo: "BRK.A" },
      { nome: "Visa", simbolo: "V" },
      { nome: "Pfizer", simbolo: "PFE" },
      { nome: "Walmart", simbolo: "WMT" },
      { nome: "Exxon Mobil", simbolo: "XOM" },
      { nome: "PepsiCo", simbolo: "PEP" },
      { nome: "Adobe", simbolo: "ADBE" },
      { nome: "PayPal", simbolo: "PYPL" },
      { nome: "Bristol-Myers Squibb", simbolo: "BMY" },
      { nome: "Nike", simbolo: "NKE" },
      { nome: "Lockheed Martin", simbolo: "LMT" },
      { nome: "McDonald's", simbolo: "MCD" },
      { nome: "Home Depot", simbolo: "HD" },
      { nome: "Caterpillar", simbolo: "CAT" },
      { nome: "General Electric", simbolo: "GE" },
  ];

  // Carregar saldo e ações do usuário
  let saldoUsuario = parseFloat(localStorage.getItem('saldo')) || 1000;
  let acoesCompradas = JSON.parse(localStorage.getItem('acoes')) || [];

  // Atualiza o saldo na página
  document.getElementById("user-balance").textContent = saldoUsuario.toFixed(2);

  // Função para buscar o preço da ação
  async function buscarPrecoAcao(simbolo) {
      const url = `https://finnhub.io/api/v1/quote?symbol=${simbolo}&token=${chaveApi}`;

      try {
          const resposta = await fetch(url);
          if (!resposta.ok) {
              throw new Error(`Erro na requisição: ${resposta.status}`);
          }
          const dados = await resposta.json();

          if (dados.c) {
              return dados.c;  
          } else {
              console.error(`Nenhum dado encontrado para o símbolo: ${simbolo}`);
              return null;
          }
      } catch (erro) {
          console.error("Erro ao buscar os dados:", erro);
          return null;
      }
  }

  // Função para atualizar os preços das ações na tela
  async function atualizarPrecosAcoes() {
      const divMercadoAcao = document.getElementById("stocks-container");
      const mensagemCarregando = document.getElementById("loading-message");

      mensagemCarregando.style.display = "block";
      divMercadoAcao.innerHTML = "";

      const promessasPreco = acoes.map(async (acao) => {
          const preco = await buscarPrecoAcao(acao.simbolo);
          return { acao, preco };
      });

      const resultados = await Promise.all(promessasPreco);

      resultados.forEach(({ acao, preco }) => {
          const divAcao = document.createElement("div");
          divAcao.classList.add("stock");

          const nomeAcao = document.createElement("div");
          nomeAcao.classList.add("stock-name");
          nomeAcao.textContent = `${acao.nome} (${acao.simbolo})`;

          const precoAcao = document.createElement("div");
          precoAcao.classList.add("stock-price");
          precoAcao.textContent = preco ? `R$ ${preco.toFixed(2)}` : "Atualizando os valores, aguarde";

          // Botões de compra e venda
          const btnComprar = document.createElement("button");
          btnComprar.textContent = `Comprar`;
          btnComprar.onclick = () => comprarAcao(acao.simbolo, preco);

          const btnVender = document.createElement("button");
          btnVender.textContent = `Vender`;
          btnVender.onclick = () => venderAcao(acao.simbolo, preco);

          divAcao.appendChild(nomeAcao);
          divAcao.appendChild(precoAcao);
          divAcao.appendChild(btnComprar);
          divAcao.appendChild(btnVender);
          divMercadoAcao.appendChild(divAcao);
      });

      mensagemCarregando.style.display = "none";
  }

  // Função para comprar uma ação
  function comprarAcao(simbolo, preco) {
      if (saldoUsuario >= preco) {
          saldoUsuario -= preco;
          acoesCompradas.push({ simbolo, preco });
          localStorage.setItem('saldo', saldoUsuario);
          localStorage.setItem('acoes', JSON.stringify(acoesCompradas));
          alert(`Você comprou uma ação de ${simbolo} por R$ ${preco.toFixed(2)}. Saldo restante: R$ ${saldoUsuario.toFixed(2)}`);
          document.getElementById("user-balance").textContent = saldoUsuario.toFixed(2);
          mostrarAcoesCompradas();
      } else {
          alert('Saldo insuficiente para comprar essa ação.');
      }
  }

  // Função para vender uma ação
  function venderAcao(simbolo, preco) {
      const index = acoesCompradas.findIndex(acao => acao.simbolo === simbolo);
      if (index !== -1) {
          saldoUsuario += preco;
          acoesCompradas.splice(index, 1);  // Remove a ação vendida
          localStorage.setItem('saldo', saldoUsuario);
          localStorage.setItem('acoes', JSON.stringify(acoesCompradas));
          alert(`Você vendeu uma ação de ${simbolo} por R$ ${preco.toFixed(2)}. Saldo atual: R$ ${saldoUsuario.toFixed(2)}`);
          document.getElementById("user-balance").textContent = saldoUsuario.toFixed(2);
          mostrarAcoesCompradas();
      } else {
          alert('Você não possui essa ação para vender.');
      }
  }

  // Função para mostrar as ações compradas pelo usuário
  function mostrarAcoesCompradas() {
      const divAcoesCompradas = document.getElementById("acoes-compradas");
      divAcoesCompradas.innerHTML = "<h2>Ações compradas:</h2>";

      if (acoesCompradas.length > 0) {
          acoesCompradas.forEach(({ simbolo, preco }) => {
              const divAcao = document.createElement("div");
              divAcao.textContent = `${simbolo} - R$ ${preco.toFixed(2)}`;
              divAcoesCompradas.appendChild(divAcao);
          });
      } else {
          divAcoesCompradas.textContent = "Você não comprou nenhuma ação ainda.";
      }
  }

  // Atualiza os preços das ações a cada 2 minutos
  setInterval(atualizarPrecosAcoes, 120000);

  // Inicializa a página
  atualizarPrecosAcoes();
  mostrarAcoesCompradas();
  
});