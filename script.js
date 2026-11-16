document.getElementById('btnCalcular').addEventListener('click', async () => {
    const num1 = document.getElementById('num1').value;
    const num2 = document.getElementById('num2').value;
    const operacao = document.getElementById('operacao').value;
    const displayResultado = document.getElementById('resultado');

    try {
        const resposta = await fetch('calcular.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                num1: num1,
                num2: num2,
                operacao: operacao
            })
        });

        const dados = await resposta.json();

        if (dados.erro) {
            displayResultado.textContent = `Erro: ${dados.erro}`;
        } else {
            displayResultado.textContent = `Resultado: ${dados.resultado}`;
        }
    } catch (erro) {
        displayResultado.textContent = 'Erro na comunicação com o servidor.';
    }
});