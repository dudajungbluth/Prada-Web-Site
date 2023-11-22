<?php
require "conection.php";

// Verificar se o ID foi fornecido
if (!isset($_GET["id"])) {
    echo json_encode(["error" => "ID do produto nao fornecido"]);
    exit;
}

$productId = $_GET["id"];

$sql = "DELETE FROM produtos WHERE id_prod = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$productId]);

echo json_encode(["success" => "Produto removido com sucesso"]);
exit;
?>
