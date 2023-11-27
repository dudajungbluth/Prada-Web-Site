<?php

require "conection.php";


// JS QUE CHAMAM ESSE PHP: 

// cadastroprodutos.js (parte do adm tbm)




$stmt = $conn->query('SELECT * FROM admin_xppd');

$adm = array();

while ($row = $stmt->fetch()) {
    $usuario = array(
        'user' => $row["username"],
        'senha' => $row["password"]
    );

    $adm[] = $usuario;
}

$output = array();

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $user = $_POST["username"];
    $senha = $_POST["password"];

    foreach ($adm as $usuario) {
        if ($usuario['user'] === $user && $usuario['senha'] === $senha) {
            $output["mensagem"] = "Login realizado com sucesso";
            $output["error"] = "permit";
            break; // Se encontrou o usuário, não precisa continuar verificando
        } else {
            $output["mensagem"] = "Credenciais incorretas";
            $output["error"] = "error";
        }
    }

    echo json_encode($output);
}
?>
