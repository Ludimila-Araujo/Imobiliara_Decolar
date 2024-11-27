<?php
// Conexão com o banco de dados
$host = '127.0.0.1'; // ou o endereço do seu servidor
$user = 'Decolar';
$password = '@Jr123321';
$database = 'servico';

$conn = new mysqli($host, $user, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Recebe os dados do formulário
$dataSolicitacao = $_POST['dataSolicitacao'];
$cliente = $_POST['cliente'];
$bairro = $_POST['bairro'];
$endereco = $_POST['endereco'];
$residencial = $_POST['residencial'];
$telefone = $_POST['telefone'];
$solicitante = $_POST['solicitante'];
$descricao = $_POST['descricao'];

// Insere os dados na tabela
$sql = "INSERT INTO solicitacoes (data_solicitacao, cliente_nome_contrato, bairro, endereco, nome_residencial_proprietario, telefone_imovel, solicitante_servico, descricao_servico) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ssssssss', $dataSolicitacao, $cliente, $bairro, $endereco, $residencial, $telefone, $solicitante, $descricao);

if ($stmt->execute()) {
    echo "Solicitação adicionada com sucesso!";
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
