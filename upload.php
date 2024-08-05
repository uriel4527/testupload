<?php
header('Content-Type: application/json');

$response = [
    'success' => false,
    'message' => 'Erro desconhecido.'
];

// Verifica se um arquivo foi enviado
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Verifica se não houve erros no upload
    if ($file['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/'; // Pasta onde o arquivo será salvo
        $uploadFile = $uploadDir . basename($file['name']);

        // Move o arquivo para o diretório desejado
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            $response['success'] = true;
            $response['message'] = 'Arquivo enviado com sucesso!';
        } else {
            $response['message'] = 'Falha ao mover o arquivo.';
        }
    } else {
        $response['message'] = 'Erro no upload: ' . $file['error'];
    }
} else {
    $response['message'] = 'Nenhum arquivo enviado.';
}

echo json_encode($response);
