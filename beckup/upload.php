<?php
// Diretório onde os arquivos serão salvos
$targetDir = "C:\xampp\htdocs\decolar\decolar\DOCUMENTOS ESCANEADOS/"; // Certifique-se de que essa pasta existe

// Verifica se a pasta realmente existe
if (!is_dir($targetDir)) {
    die("Erro: O diretório 'DOCUMENTOS ESCANEADOS' não existe.");
}

// Verifica se a pasta é gravável
if (!is_writable($targetDir)) {
    die("Erro: O diretório 'DOCUMENTOS ESCANEADOS' não possui permissões de escrita.");
}

// Caminho completo do arquivo de destino
$targetFile = $targetDir . basename($_FILES["file"]["name"]);
$uploadOk = 1;

// Verifica se o arquivo é um PDF
$fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
if ($fileType != "pdf") {
    echo "Desculpe, apenas arquivos PDF são permitidos.";
    $uploadOk = 0;
}

// Verifica se houve algum erro na validação
if ($uploadOk == 0) {
    echo "Desculpe, seu arquivo não foi enviado.";
} else {
    // Se tudo estiver certo, tenta mover o arquivo enviado para o diretório de destino
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo "O arquivo " . htmlspecialchars(basename($_FILES["file"]["name"])) . " foi enviado com sucesso.";
    } else {
        // Exibe mensagem de erro mais detalhada se o upload falhar
        echo "Desculpe, houve um erro ao enviar seu arquivo. Verifique as permissões da pasta.";
        error_log("Erro ao mover o arquivo para o destino: " . $targetFile);
    }
}
?>



<!-- Botão para redirecionar para outra página -->
<a href="http://localhost/decolar/decolar/" style="
    display: inline-block; /* Faz o link se comportar como um bloco */
    padding: 10px 20px;
    background-color: #007bff; /* Cor do botão */
    color: white;
    text-decoration: none; /* Remove o sublinhado */
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
">Voltar para a Página</a>
