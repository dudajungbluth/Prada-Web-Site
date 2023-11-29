<?php


// RETORNA TODOS OS PAGAMENTOS FEITOS PELA MESMA PESSOA


require 'conection.php';
session_start();


$con = [
    "message" => "Pegando dados.",
    "status" => "success",
    "nome" => $_SESSION["user"]["nome"],
    "emailUsuario" => $_SESSION["user"]["email"],
];

$email = $con['emailUsuario'];

// Pega o id do usuário
$query = "SELECT id FROM usuarios WHERE email_user = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$email]);

$user = $stmt->fetch();

//PARA PODER PEGAR O NOME PELO ID
$sql="SELECT produtos.nome_prod, produtos.preco_prod, pedido.total FROM pagamento inner join produtos on produtos.id_prod = pagamento.prodrutos_idprodrutos inner join pedido on pedido.idpedido = pagamento.pedido_idpedido where pedido.usuarios_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$user['id']]);

$rows = $stmt->fetchAll();

$json_data = json_encode($rows);
echo $json_data;

?>
