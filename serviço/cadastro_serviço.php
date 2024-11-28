<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitação de Serviço</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        #backButton {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* Estilos do modal */
        .modal {
            display: none; /* Inicialmente escondido */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4); /* Fundo transparente */
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Fechar botão do modal */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Estilos do formulário */
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input[type="text"], input[type="tel"], input[type="date"], textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: vertical;
        }

        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background-color: #218838;
        }

        /* Estilos da tabela */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #0c1c34;
            color: white;
        }

        .delete-btn {
            padding: 5px 10px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }
        .center-button {
    display: block;
    margin: 0 auto;
    padding: 10px 20px;
    background-color: #0c1c34;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
    margin-bottom: 20px;
}
a.center-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #0c1c34;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
    text-align: center;
    margin: 20px auto; /* Centraliza o link com margem automática */
    transition: background-color 0.3s ease;
}

a.center-button:hover {
    background-color: #218838; /* Cor de hover */
}

    </style>
</head>
<body>

    <h2>Solicitação de Serviço</h2>

    <!-- Botão para abrir o modal -->
    <button class="center-button" id="openModalButton">Nova Solicitação</button>
    <!-- Botão para acessar as solicitações excluídas -->
<a href="http://localhost/decolar/decolar/servi%C3%A7o/excluidos.php" class="center-button">Visualizar Solicitações Excluídas</a>



    <!-- O Modal -->
    <div id="serviceModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Preencha os Dados da Solicitação</h3>
            <form id="serviceForm" action="" method="post">
                <label for="dataSolicitacao">Data de Solicitação:</label>
                <input type="date" id="dataSolicitacao" name="dataSolicitacao" required>

                <label for="cliente">Cliente (Nome do Contrato):</label>
                <input type="text" id="cliente" name="cliente" required>

                <label for="bairro">Bairro:</label>
                <input type="text" id="bairro" name="bairro" required>

                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" required>

                <label for="residencial">Nome do Residencial / Proprietário:</label>
                <input type="text" id="residencial" name="residencial" required>

                <label for="telefone">Telefone (Quem está no imóvel):</label>
                <input type="tel" id="telefone" name="telefone" required>

                <label for="solicitante">Solicitante do Serviço:</label>
                <input type="text" id="solicitante" name="solicitante" required>

                <label for="descricao">Descrição do Serviço:</label>
                <textarea id="descricao" name="descricao" rows="4" required></textarea>

                <button type="submit">Enviar Solicitação</button>
            </form>
        </div>
    </div>

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

    // Processa o formulário quando enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['delete_id'])) {
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
            echo "<p>Solicitação adicionada com sucesso!</p>";
        } else {
            echo "<p>Erro: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }

    // Exclui uma solicitação se o botão de excluir for pressionado
    // Exclui uma solicitação se o botão de excluir for pressionado
if (isset($_POST['delete_id'])) {
    $deleteId = $_POST['delete_id'];

    // Primeiro, vamos pegar os dados da solicitação antes de excluí-la
    $sql = "SELECT * FROM solicitacoes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $deleteId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Pega os dados da solicitação
        $row = $result->fetch_assoc();

        // Move os dados para a tabela de exclusões
        $sqlInsert = "INSERT INTO solicitacoes_excluidas (data_solicitacao, cliente_nome_contrato, bairro, endereco, nome_residencial_proprietario, telefone_imovel, solicitante_servico, descricao_servico) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param('ssssssss', $row['data_solicitacao'], $row['cliente_nome_contrato'], $row['bairro'], $row['endereco'], $row['nome_residencial_proprietario'], $row['telefone_imovel'], $row['solicitante_servico'], $row['descricao_servico']);
        $stmtInsert->execute();

        // Agora, exclui a solicitação da tabela original
        $sqlDelete = "DELETE FROM solicitacoes WHERE id = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param('i', $deleteId);
        if ($stmtDelete->execute()) {
            echo "<p>Solicitação movida para exclusões e excluída com sucesso!</p>";
        } else {
            echo "<p>Erro ao excluir: " . $stmtDelete->error . "</p>";
        }
    }

    // Fechar as declarações preparadas
    $stmt->close();
    $stmtInsert->close();
    $stmtDelete->close();
}

    

    // Consulta as solicitações e exibe na tabela
    $sql = "SELECT * FROM solicitacoes";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Lista de Solicitações</h2>";
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
                        <th>Ações</th>
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
                    <td>
                        <form method='post' action='' style='display:inline;'>
                            <input type='hidden' name='delete_id' value='{$row['id']}'>
                            <button type='submit' class='delete-btn'>Excluir</button>
                        </form>
                    </td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nenhuma solicitação encontrada.</p>";
    }

    $conn->close();
    ?>

    <script>
        // Obter elementos do DOM
        var modal = document.getElementById("serviceModal");
        var btn = document.getElementById("openModalButton");
        var span = document.getElementsByClassName("close")[0];

        // Abrir o modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // Fechar o modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Fechar o modal se o usuário clicar fora da janela
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>
</html>
