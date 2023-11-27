<?php
require "conection.php";


// JS QUE CHAMAM ESSE PHP: 

// index.js



// MOSTRA OS PRODUTOS NO HTML

$sql = "SELECT nome_prod, preco_prod, url_prod FROM produtos";

$result = $conn->query($sql);

$rows = array();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $rows[] = $row;
}

$json_data = json_encode($rows);
echo $json_data;
?>