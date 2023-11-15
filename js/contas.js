
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
function abrirCarrinho() {

  carrinhoDiv.style.display = "block";
}
function fecharCarrinho() {
  var carrinhoDiv = document.getElementById("carrinho");
  carrinhoDiv.style.display = "none";
}
/*query login */

var Lemail = document.querySelector('.login #email')
var Lsenha = document.querySelector('.login #password')
var botaolog = document.querySelector('.login .button')
/*query dos cadastro*/
var form = document.querySelector('.cadastro #boxlog')
var nome = document.querySelector('.cadastro #name');
var email = document.querySelector('.cadastro #email')
var senha = document.querySelector('.cadastro #password')
var senhac = document.querySelector('.cadastro #confirm')
var botaocad = document.querySelector('.cadastro .button');
var error = document.querySelector('.cadastro .error');
var carrinhoDiv = document.getElementById("carrinho");


// PROJETO PW PART 2:

// cadastro

form.addEventListener('submit', async e => {

  e.preventDefault();

  if (senha.value != senhac.value){
    error.innerHTML = 'As senhas não coincidem';
    senha.focus();
    return;
  }


  const data = await fetch('cadastrouser.php', {

    method: 'POST',

    body: new FormData(form)

  }).then(res => res.json());

  console.log(data);
  error.innerHTML = data.message;

  if (data.status == 'erro') {
    document.querySelector(`#${data.field}`).focus();
  }
  else if (data.status == "sucesso") {
    form.reset();
    nome.focus();
  }
});



// login

var Lform = document.querySelector('.login #boxlog')
Lform.addEventListener('submit', async e => {
  e.preventDefault();

  const ldata = await fetch('usuarios.php', {
    method: `POST`,
    body: new FormData(Lform),
  }).then(res => res.json());

  console.log(ldata);

  var lerror = document.querySelector('.login .error')
  if (ldata.status == 'erro') {
    lerror.innerHTML = ldata.message;
  }
  else if (ldata.status == "success") {
    window.location.href = 'perfil.html';
  }
  
});
