<?php
require "conection.php";

$sql = "SELECT nome_prod, preco_prod, id_prod FROM produtos";

$result = $conn->query($sql);

$rows = array();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $rows[] = $row;
}

$json_data = json_encode($rows);
echo $json_data;
?>
