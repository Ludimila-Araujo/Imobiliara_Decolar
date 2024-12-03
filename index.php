<link rel="icon" href="imagens/decolar.png" type="image/png">
<?php
include_once("design/topo.php");
include_once("design/menu.php");


if (empty($_SERVER["QUERY_STRING"])) {
    $var = "conteudo.php";
} else {
    $pg = $_GET['pg'];
    
    if (file_exists("$pg.php") || file_exists("$pg.html")) {
        $var = "$pg.php"; 
    } else {
        $var = "conteudo.php"; 
    }
}


include_once($var);
include_once("design/rodape.php");
?>
