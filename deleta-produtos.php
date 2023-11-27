<?php

require "conection.php";

// JS QUE CHAMAM ESSE PHP:

// cadastroprodutos.js



// Verificar se o ID foi fornecido
if (empty($_GET["id"])) {
    echo json_encode(["error" => "ID do produto não fornecido"]);
    exit;
}

$productId = $_GET["id"];

// Verificar se o produto com o ID existe no banco de dados
$sqlCheck = "SELECT id_prod FROM produtos WHERE id_prod = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->execute([$productId]);

// Verificar se a consulta retornou algum resultado
if ($stmtCheck->fetch()) {
    // O produto com o ID existe, agora podemos deletá-lo
    $sqlDelete = "DELETE FROM produtos WHERE id_prod = ?";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->execute([$productId]);

    echo json_encode(["success" => "Produto removido com sucesso"]);
    exit;
} else {
    // Produto com esse ID não foi encontrado
    echo json_encode(["error" => "Produto com esse ID não foi encontrado"]);
    exit;
}
?>
