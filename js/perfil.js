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
let imgElement = document.createElement('img');
divImgElement.appendChild(imgElement);
const fileInput = document.querySelector('input[type="file"]');
const mensage = document.querySelector('.mensage');



fetch('session.php').then(async res => {
    const data = await res.json();

    if (data.status == 'error') {
        location.href = 'usuario.html';
    }

    let user = data.user;

    console.log(data.user);

    document.querySelector('#user').innerHTML = user.nome;

    imgElement.src = `photosuser/${user.foto}`;
    imgElement.classList.add("small-photo");



});


const button = document.querySelector('.logout');
button.addEventListener('click', () => {
    fetch('logout.php');
    location.href = 'usuario.html';
    
});


window.addEventListener('DOMContentLoaded', async () => {
 
  form.addEventListener('submit', async (e) => {
      e.preventDefault();
      
      const data = await fetch('upload.php', {
          method: 'POST',
          body: new FormData(form)
      }).then(res => res.json());
      
      console.log(data);
  
      if (data.status == "error") {
          error.innerHTML = data.message;
      }
  
      if (data.status == "success") {

          imgElement.src = `photosuser/${data.photo}`;
          imgElement.classList.add("small-photo");
          fileInput.value = "";


          console.log("Iniciando manipulação da mensagem");

          setTimeout(() => {
            console.log("Iniciando transição de opacidade");
            mensage.style.transition = "opacity 1s";
            mensage.style.opacity = "0";
        
            // Limpar a mensagem após a transição
            
            setTimeout(() => {
                console.log("Transição concluída. Limpando mensagem.");
                mensage.innerHTML = "";
                mensage.style.transition = ""; // Resetar a transição
                mensage.style.opacity = ""; // Resetar a opacidade
            }, 1000); // Tempo igual à duração da transição (1 segundo)
        }, 3000); // Tempo para começar a transição (3 segundos)

        mensage.innerHTML = "Foto atualizada com sucesso!";
        console.log("Mensagem definida:", mensage.innerHTML)
        
    }
});
});