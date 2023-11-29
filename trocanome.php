<?php

require 'conection.php';
session_start();


if (empty($_POST["newName"])) {
    echo json_encode(["error" => "Digite o novo nome"]);
    exit;
}

$con = ([
    "message" => "Pegando dados.",
    "status" => "success",
    "nome" => $_SESSION["user"]["nome"],
    "emailUsuario" => $_SESSION["user"]["email"],
]);


    $emailuser = $con['emailUsuario'];
    $newName = $_POST["newName"];


    $sql = 'UPDATE usuarios SET nome_user = ? WHERE email_user = ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$newName, $emailuser]);

    

    $response = array();
    if ($stmt->rowCount() > 0) {
        $response['status'] = 'success';
        $response['message'] = 'Nome atualizado com sucesso!';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Erro ao atualizar o nome ou o nome fornecido é o mesmo atual.';
    }


    echo json_encode($response);