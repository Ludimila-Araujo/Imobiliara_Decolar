<link rel="icon" href="imagens/decolar.png" type="image/png">
<?php
include_once("design/topo.php");
include_once("design/menu.php");

// Verifica se há uma query string vazia
if (empty($_SERVER["QUERY_STRING"])) {
    $var = "conteudo.php";
} else {
    $pg = $_GET['pg'];
    // Verifica se o arquivo existe e tem a extensão desejada
    if (file_exists("$pg.php") || file_exists("$pg.html")) {
        $var = "$pg.php"; // Prioriza o PHP se ambos existirem
    } else {
        $var = "conteudo.php"; // Padrão se não existir
    }
}

// Inclui o arquivo correspondente
include_once($var);
include_once("design/rodape.php");
?>
