<?php

require "conection.php";


// JS QUE CHAMAM ESSE PHP: 

// cadastroprodutos.js


// Seleciona os produtos que ja tem para inserir na tabale da ADM
$sql = "SELECT nome_prod, preco_prod, id_prod FROM produtos";

$result = $conn->query($sql);

$rows = array();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $rows[] = $row;
}

// ENQUANTO AINDA TIVER LINHAS DE PRODUTOS O WHILE PERCORRE
// PDO::FETCH_ASSOC indica que a função deve retornar essa linha como um array associativo.

$json_data = json_encode($rows);
echo $json_data;
?>
