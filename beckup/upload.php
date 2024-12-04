<?php
$targetDir = "C:\xampp\htdocs\decolar\decolar\DOCUMENTOS ESCANEADOS/";

if (!is_dir($targetDir)) {
    die("Erro: O diretório 'DOCUMENTOS ESCANEADOS' não existe.");
}

if (!is_writable($targetDir)) {
    die("Erro: O diretório 'DOCUMENTOS ESCANEADOS' não possui permissões de escrita.");
}

$targetFile = $targetDir . basename($_FILES["file"]["name"]);
$uploadOk = 1;

$fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
if ($fileType != "pdf") {
    echo "Desculpe, apenas arquivos PDF são permitidos.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Desculpe, seu arquivo não foi enviado.";
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo "O arquivo " . htmlspecialchars(basename($_FILES["file"]["name"])) . " foi enviado com sucesso.";
    } else {
        echo "Desculpe, houve um erro ao enviar seu arquivo. Verifique as permissões da pasta.";
        error_log("Erro ao mover o arquivo para o destino: " . $targetFile);
    }
}
?>

<a href="http://localhost/decolar/decolar/" style="
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
">Voltar para a Página</a>
