

document.addEventListener('DOMContentLoaded', async () => {

    let produtos = await fetch('tabelaprodutos.php').then(res => res.json());
    console.log(produtos)

    produtos.forEach(p => {
        const tr = document.createElement('tr');

        tr.innerHTML = `
            <td>${p.nome_prod}</td>
            <td>${p.preco_prod}</td>
        `;

        const deletbutton = document.createElement('td');
        deletbutton.innerHTML = 'remover';

    
        tr.appendChild(deletbutton);
        tabeladiv.querySelector('.tabelaprodutos').appendChild(tr);
    });
});
