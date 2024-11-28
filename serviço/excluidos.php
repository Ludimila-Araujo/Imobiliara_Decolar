<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitações Excluídas</title>
    <link rel="stylesheet" href="style.css"> <!-- Se você usar um arquivo CSS separado -->
    <style>
/* Estilo geral do corpo */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
}

/* Centraliza o conteúdo */
.center-content {
    width: 90%;
    max-width: 1200px;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Título */
h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 20px;
}

/* Estilo do botão de voltar */
.back-button {
    position: fixed; /* Fixa o botão no canto da tela */
    top: 20px; /* Distância do topo */
    left: 20px; /* Distância da esquerda */
    padding: 10px 20px;
    background-color: #0c1c34;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    z-index: 1000; /* Garantir que o botão esteja acima de outros elementos */
    transition: background-color 0.3s ease;
}

/* Efeito de hover para o botão de voltar */
.back-button:hover {
    background-color: #2980b9;
}

/* Estilo da tabela */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 14px;
}

/* Cabeçalho da tabela */
th {
    background-color: #0c1c34;
    color: white;
    padding: 12px;
    text-align: left;
    font-weight: bold;
}

/* Linhas da tabela */
td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
}

/* Linhas alternadas */
tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Foco da tabela */
tr:hover {
    background-color: #e0e0e0;
}

/* Estilo de mensagem de "nenhuma solicitação" */
p {
    text-align: center;
    font-size: 18px;
    color: #7f8c8d;
    margin-top: 30px;
}

    </style>
</head>
<body>

    <div class="center-content">
        <!-- Botão de Voltar -->
        <a href="javascript:history.back()" class="back-button">Voltar</a>

        <h2>Solicitações Excluídas</h2>

        <!-- Tabela para exibir as solicitações excluídas -->
        <?php
        // Conexão com o banco de dados
        $host = '127.0.0.1';
        $user = 'Decolar';
        $password = '@Jr123321';
        $database = 'servico';

        $conn = new mysqli($host, $user, $password, $database);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }

        // Consulta as solicitações excluídas
        $sql = "SELECT * FROM solicitacoes_excluidas ORDER BY data_exclusao DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
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
                            <th>Data de Exclusão</th>
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
                        <td>{$row['data_exclusao']}</td>
                      </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>Nenhuma solicitação excluída encontrada.</p>";
        }

        $conn->close();
        ?>

    </div>

</body>
</html>
