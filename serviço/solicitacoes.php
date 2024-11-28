<?php
$servername = "localhost";
$username = "root";
$password = "sua_senha";
$dbname = "solicitacoes_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'create':
        $stmt = $conn->prepare("INSERT INTO solicitacoes (dataSolicitacao, cliente, bairro, endereco, residencial, telefone, solicitante, descricao) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $_POST['dataSolicitacao'], $_POST['cliente'], $_POST['bairro'], $_POST['endereco'], $_POST['residencial'], $_POST['telefone'], $_POST['solicitante'], $_POST['descricao']);
        $stmt->execute();
        echo json_encode(["id" => $stmt->insert_id]);
        break;

    case 'read':
        $result = $conn->query("SELECT * FROM solicitacoes");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($data);
        break;

    case 'update':
        $input = json_decode(file_get_contents('php://input'), true);
        $stmt = $conn->prepare("UPDATE solicitacoes SET dataTermino = ? WHERE id = ?");
        $stmt->bind_param("si", $input['dataTermino'], $input['id']);
        $stmt->execute();
        echo json_encode(["success" => true]);
        break;

    case 'delete':
        $input = json_decode(file_get_contents('php://input'), true);
        $stmt = $conn->prepare("DELETE FROM solicitacoes WHERE id = ?");
        $stmt->bind_param("i", $input['id']);
        $stmt->execute();
        echo json_encode(["success" => true]);
        break;
}

$conn->close();
?>
