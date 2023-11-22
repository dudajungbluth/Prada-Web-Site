function pag() {
    window.location.href = "index.html";
  }
  function user() {
    window.location.href = "usuario.html";
  }
  function roupas() {
    window.location.href = "roupas.html";
  }
  function perfil() {
    window.location.href = "perfil.html";
  }
  // FUNÇÃOZINHA PARA TROCAR O TEXTO DO BOTÃO
  function alterarTextoDoBotao() {
    var botao = document.getElementById("change-photo-btn");
    botao.value = "Atualizar foto de perfil";
}
alterarTextoDoBotao();




const form = document.querySelector('.formphoto');
const btn = document.querySelector('#change-photo-btn');
const error = document.querySelector('.errormensage');
const divImgElement = document.querySelector("#user-photo");
const imgElement = document.createElement('img');
divImgElement.appendChild(imgElement);


fetch('session.php').then(async res => {
    const data = await res.json();

    if (data.status == 'error') {
        location.href = 'usuario.html';
    }

    let user = data.user; 
    document.querySelector('#user').innerHTML = user.nome;
});


const button = document.querySelector('.logout');
const img = document.querySelector('#user')
button.addEventListener('click', () => {
    fetch('logout.php');
    location.href = 'usuario.html';
});




form.addEventListener('submit', async (e) => {

  e.preventDefault();
        
  const data = await fetch('upload.php', {
      method: 'POST',
      body: new FormData(form)
  }).then(res => res.json());
        
   console.log(data);

  if(data.status == "error"){
      error.innerHTML = data.message;
  }

   
   if(data.status == "success"){

    imgElement.src = `photosuser/${data.photo}`;

   }
});
