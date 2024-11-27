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

// Consulta as solicitações
$sql = "SELECT * FROM solicitacoes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table id='serviceTable'>
            <thead>
                <tr>
                    <th>Data de Solicitação</th>
                    <th>Cliente</th>
                    <th>Bairro</th>
                    <th>Endereço</th>
                    <th>Residencial/Proprietário</th>
                    <th>Telefone</th>
                    <th>Solicitante</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['data_solicitacao']}</td>
                <td>{$row['cliente_nome_contrato']}</td>
                <td>{$row['bairro']}</td>
                <td>{$row['endereco']}</td>
                <td>{$row['nome_residencial_proprietario']}</td>
                <td>{$row['telefone_imovel']}</td>
                <td>{$row['solicitante_servico']}</td>
                <td>{$row['descricao_servico']}</td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "Nenhuma solicitação encontrada.";
}

$conn->close();
?>
