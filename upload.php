<?php

require('conection.php');
session_start();

// JS QUE CHAMAM ESSE PHP: 

// perfil.js



if (empty($_FILES["foto"]["name"])) {
    echo json_encode([
        "message" => "Selecione uma foto por favor",
        "status" => "error"
    ]);
    exit;
}

//$_FILES é utilizada para recuperar informações 
//sobre arquivos enviados para o servidor por meio de formulários HTML


if (isset($_FILES["foto"])) {
    $file = $_FILES["foto"];

    if ($file["error"] == UPLOAD_ERR_INI_SIZE || $file["size"] > 1000000) {
        echo json_encode([
            "message" => "Arquivo excedeu limite de tamanho.",
            "status" => "error",
            "error_code" => $file["error"],
        ]);
        exit;
    }

    // pathinfo() é usada para obter informações sobre o caminho do arquivo
    // strtolower() é usada para converter a extensão do arquivo para letras minúsculas.

    $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    $supported_extensions = ["jpg", "jpeg", "png", "webp"]; // Array

    if (!in_array($extension, $supported_extensions)) {
        echo json_encode([
            "message" => "Esse tipo de arquivo nao é valido.",
            "status" => "error",
        ]);
        exit;
    }


    // gera um nome de arquivo único para o arquivo que foi enviado
    $fileName = md5(microtime()) . "." . $extension;
    //microtime() retorna o tempo em que o arquivo foi enviado, incluindo microssegundos.
    // md5() é usada para calcular o hash MD5 da string resultante de microtime().


    //move_uploaded_file é usada para mover um arquivo enviado para a pasta.
    if (!move_uploaded_file($file["tmp_name"], "photosuser/$fileName")) {
        echo json_encode([
            "message" => "Erro ao enviar arquivo.",
            "status" => "error",
        ]);
        exit;
    
} 
}
$con = ([
    "message" => "Arquivo enviado com sucesso.",
    "status" => "success",
    "fileName" => $fileName,
    "emailUsuario" => $_SESSION["user"]["email"],
]);

    $uploadStatus = "success"; // Defina a variável de status para uso posterior




// Verifique se o upload foi bem-sucedido

// Inserir a foto no banco de dados de acordo com a pessoa que escolheu a fto

if ($uploadStatus == "success") {
    // Use as variáveis definidas em upload.php
    $name = $con['fileName']; // Recupere o nome do arquivo da resposta JSON
    $emailuser = $con['emailUsuario']; // Recupere o e-mail do usuário da resposta JSON


    $sql = 'UPDATE usuarios SET img_user = ? WHERE email_user = ?';
    $stmt = $conn->prepare($sql);

    // Execute a declaração preparada
    $stmt->execute([$name, $emailuser]);

    // Verifique se a consulta foi executada com sucesso
    $rowCount = $stmt->rowCount();

    if ($rowCount > 0) {
        echo json_encode([
            "photo" => $fileName,
            "status" => "success",
        ]);
        exit;
    } else {
        echo json_encode([
            "message" => "Erro ao atualizar o caminho da imagem no banco de dados.",
            "status" => "error",
        ]);

    }

    // Feche a declaração preparada
    $stmt->closeCursor();
} else {
    echo json_encode([
        "message" => "Nenhum arquivo foi enviado ou erro no upload.",
        "status" => "error",
    ]);
    exit;
}


    
