function validarCartao(cartao) {
    let soma = 0;
    let deveDobrar = false;

    for (let i = cartao.length - 1; i >= 0; i--) {
        let digito = parseInt(cartao.charAt(i));

        if (deveDobrar) {
            digito *= 2;
            if (digito > 9) digito -= 9;
        }

        soma += digito;
        deveDobrar = !deveDobrar;
    }

    return soma % 10 === 0;
}

function atualizarBotaoPagamento() {
    const metodo = document.querySelector('input[name="metodo"]:checked')?.value;
    const finalizarBtn = document.getElementById('finalizarBtn');

    if (metodo === 'pix') {
        finalizarBtn.disabled = false; 
    } else if (metodo === 'cartao') {
        const numCartao = document.getElementById('numcartao').value;
        if (numCartao.length === 16 && validarCartao(numCartao)) {
            finalizarBtn.disabled = false;
        } else {
            finalizarBtn.disabled = true;
        }
    }
}

document.querySelectorAll('input[name="metodo"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        const metodo = this.value;
        const cartaoFields = document.getElementById('cartaoFields');

        if (metodo === 'cartao') {
            cartaoFields.style.display = 'block';
        } else {
            cartaoFields.style.display = 'none';
        }

        atualizarBotaoPagamento();
    });
});

document.getElementById('numcartao').addEventListener('input', function() {
    atualizarBotaoPagamento();
});

document.addEventListener('DOMContentLoaded', function() {
    atualizarBotaoPagamento();
});