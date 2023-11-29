

let carro = []; // carrinho 

let produtoss = localStorage.getItem('carrinho');
carro = JSON.parse(produtoss);

console.log(carro)



let flagvalor = 0;  // total
for (let i in carro) {          // somatorio para o total
    let obj = carro[i]
    let precoverdadeiro = parseInt(obj.preco_prod);
    let quantverdadeiro = parseInt(obj.quantity);
    let t = precoverdadeiro * quantverdadeiro;
    flagvalor = flagvalor + t
}


const conteudo = document.querySelector('#totalapagar')
conteudo.insertAdjacentHTML('beforeend', `<h2>R$${flagvalor}</h2> `); // mostra valor no html


// cria a tabela dos produtos com o carrinho

let tabela = document.querySelector('.tabela')

tabela.innerHTML = ''; // Limpa a tabela antes de adicionar os novos elementos

carro.forEach(p => {
    let tr = document.createElement('tr');
    tr.innerHTML = `
          <td class="tabelanome">NOME:${p.nome_prod}</td>
          <td class="tabelapreco">PREÇO:${p.preco_prod}</td>
          <td class="tabelaquant">QUANTIDADE:${p.quantity}</td>
      `;
    tabela.appendChild(tr);
});

const nc = document.querySelector('#cardnumber')
const data = document.querySelector('#expirationDate')
const cvv = document.querySelector('#cvv')
const menssage = document.querySelector('.menssage')




// requisição 
const form = document.querySelector('form');
form.addEventListener('submit', (e) => {
    e.preventDefault();

    const formData = new FormData();
    formData.append('carro', JSON.stringify(carro));
    formData.append('total', flagvalor);

    const url = "pagamentosf.php";
    const options = {
        method: "POST",
        body: formData,
    }

    fetch(url, options).then((response) => {
        response.json().then((carrinhoData) => {
            if (carrinhoData.status == "sucesso") {
                menssage.innerHTML = carrinhoData.menssage
                localStorage.removeItem('carrinho'); // remove a chave carrinho do ls

                setTimeout(() => {
                    window.location.href = "roupas.html";
                }, 3000);

            }
        })
    })

});
