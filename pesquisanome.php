<?php

require "conection.php";


// JS QUE CHAMAM ESSE PHP: 

// index.js


$name = $_GET["name"];
$stmt = $conn->prepare("SELECT * FROM produtos WHERE nome_prod LIKE CONCAT ('%', ?, '%')");
$stmt->execute([ $name ]);
$selectedProducts = $stmt->fetchAll();
// fetchAll() retorna todas as linhas que ele encontra

echo json_encode($selectedProducts);