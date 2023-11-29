<?php

require "conection.php";
session_start();
$response = [];


// ve se tem usuario logado 
if (!isset($_SESSION["user"])) {
    $response["status"] = "sucesso";
    $response["menssage"] = "Compra bem-sucedida. Faça login para salvar suas compras no perfil.";
    echo json_encode($response);
    exit;
}




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

$total = $_POST['total'];

// Carrinho mandado com o append que foi transformado em array p php
$jsonCarro = $_POST['carro'];
$carro = json_decode($jsonCarro, true);

// Insert into 'pedido' table
$query = "INSERT INTO pedido (usuarios_id, total) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->execute([$user['id'], $total]);



// Pega o ultimo id do autoincrement
$pedidoId = $conn->lastInsertId();



// Insert para cada produto no carrinho no pagamento
foreach ($carro as $item) {
    $query = "SELECT id_prod FROM produtos WHERE nome_prod = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$item["nome_prod"]]); // PEGA O ID DO PRODUTO QUR TEM O MESMO NOME QUE TEM NO CARRINHO

    $prod = $stmt->fetch();


    $query = "INSERT INTO pagamento (pedido_idpedido, prodrutos_idprodrutos	) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$pedidoId, $prod['id_prod']]);
}

$response["status"] = "sucesso";
$response["menssage"] = "Compra bem-sucedida";
echo json_encode($response);
