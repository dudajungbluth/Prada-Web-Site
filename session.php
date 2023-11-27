<?php

session_start();


// JS QUE CHAMAM ESSE PHP: 

// perfil.js


// VERIFICA SE A SESSÃO EXISTE

if (!isset($_SESSION["user"])) {
    echo json_encode([
        "status" => "error",
        "message" => "Sessão não existe"
    ]);
    exit;
}

echo json_encode([
    "status" => "success",
    "message" => "Usuário logado",
    "user" => $_SESSION["user"]
]);