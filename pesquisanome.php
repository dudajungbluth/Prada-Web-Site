<?php

require "conection.php";

$name = $_GET["name"];
$stmt = $conn->prepare("SELECT * FROM produtos WHERE nome_prod LIKE CONCAT ('%', ?, '%')");
$stmt->execute([ $name ]);
$selectedProducts = $stmt->fetchAll();

header("Content-Type: application/json");
echo json_encode($selectedProducts);