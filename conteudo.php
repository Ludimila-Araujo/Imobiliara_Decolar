<?php
// Conexão com o banco de dados (substitua os valores de acordo com seu banco)
$host = '127.0.0.1';
$dbname = 'lembrete';
$username = 'Decolar';
$password = '@Jr123321';
$conn = new mysqli($host, $username, $password, $dbname);

// Verifique a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Processa o envio do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['principiador'])) {
    $principiador = $_POST['principiador'];
    $data = $_POST['data'];
    $data_final = $_POST['data_final'];
    $assunto = $_POST['assunto'];

    // Prepara e executa a inserção dos dados no banco
    $stmt = $conn->prepare("INSERT INTO exemplo_tabela (principiador, data, data_final, assunto) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $principiador, $data, $data_final, $assunto);

    if ($stmt->execute()) {
        echo "";
    } else {
        echo "Erro ao enviar os dados: " . $stmt->error;
    }
    $stmt->close();
}

// Exclui um registro
if (isset($_GET['delete'])) {
    $id_to_delete = $_GET['delete'];

    // Deleta o registro com o ID fornecido
    $delete_sql = "DELETE FROM exemplo_tabela WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id_to_delete);

    if ($stmt->execute()) {
        echo "";
    } else {
        echo "Erro ao excluir o registro: " . $stmt->error;
    }
    $stmt->close();
}

// Recupera e exibe os dados após a inserção
$sql = "SELECT * FROM exemplo_tabela ORDER BY data DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Registro</title>
    <style>
        /* Estilo para o botão que abre o formulário */
.open-form-btn {
    background-color: #0c1c34;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
    display: block;  /* Faz o botão se comportar como um bloco */
    margin: 20px auto; /* Centraliza o botão horizontalmente */
}

        /* Estilo para o modal (formulário flutuante) */
        /* Estilo para o modal (formulário flutuante) */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.3);
    padding-top: 50px;
    overflow: auto; /* Permite rolagem caso o conteúdo seja maior que a tela */
}

/* Estilo do conteúdo do modal */
.modal-content {
    background-color: #fff;
    margin: 50px auto;
    padding: 20px;
    border-radius: 8px;
    width: 40%;
    max-height: 80%; /* Garante que o modal não ultrapasse 80% da altura da tela */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow-y: auto; /* Permite rolagem no conteúdo do modal */
    animation: scaleIn 0.3s ease-out forwards;
}

/* Animação de entrada */
@keyframes scaleIn {
    0% { transform: scale(0.9); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}

/* Estilo para o botão de fechar */
.close {
    color: #aaa;
    float: right;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #000;
}

/* Estilo do título do formulário */
.modal-content h2 {
    font-size: 20px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

/* Estilo dos campos de input e textarea */
input[type="text"],
input[type="date"],
textarea {
    width: 100%;
    padding: 8px;
    margin: 6px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    transition: border 0.3s ease;
}

input[type="text"]:focus,
input[type="date"]:focus,
textarea:focus {
    border-color: #4CAF50;
    outline: none;
}

/* Estilo para o botão de envio */
button[type="submit"] {
    background-color: #0c1c34;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #0c1c34;
}

/* Estilo para as labels */
label {
    font-size: 14px;
    font-weight: bold;
    color: #555;
    display: block;
    margin-bottom: 4px;
}

/* Estilo do texto dentro do formulário */
textarea {
    height: 100px;
    resize: vertical;
}

/* Adicionando um pouco de espaçamento entre os campos */
form {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

        /* Estilo para as post-its */
        .post-it {
            width: 250px;
            height: 250px;
            margin: 20px;
            padding: 10px;
            background-color: #f9eb9c;
            border: 2px solid #f7d000;
            border-radius: 5px;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            display: inline-block;
            vertical-align: top;
            position: relative;
        }

        /* Estilo para as informações do título do post-it */
        .post-it-header {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .post-it-header span {
            display: block;
            font-size: 12px;
            color: #555;
        }

        /* Estilo para o assunto do post-it */
        .post-it-body {
            font-size: 14px;
            color: #333;
            height: 140px;
            overflow-y: auto;
            margin-top: 10px;
        }

        /* Estilo para o link de exclusão */
        .delete-link {
            position: absolute;
            bottom: 10px;
            right: 10px;
            color: red;
            font-weight: bold;
            text-decoration: none;
        }

        .delete-link:hover {
            color: darkred;
        }

        /* Estilo para a tabela de post-its */
        .post-it-container {
            display: flex;
            flex-wrap: wrap;
        }
        .lapo{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="lapo">
    <h1>BOM DIA ADMINISTRATIVO</h1>
    <h3>ESSA PARTE INICIAL SERVE PARA GUARDAR OS LEMBRETES DO DIA</h3>
    <H6>TODOS AS INFORMAÇÕES QUE NECESSITAM SER LEMBRADAS SERÃO EXIBIDAS AQUI.<br>DESSA FORMA, É POSSIVEL MANTER UMA MAIOR ORGANIZAÇÃO TANTO PARA O CRIADOR DO DOCUMENTO QUANTO PARA OS VISUALIZADORES POSTERIORES.</H6>
    </div>
    <!-- Botão para abrir o modal -->
    <button class="open-form-btn" onclick="openForm()">Abrir Formulário</button>

    <!-- Modal (formulário flutuante) -->
    <div id="formModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeForm()">&times;</span>
            <h2>Adicionar Novo Registro</h2>
            <form method="POST" action="">
                <label for="principiador">Principiador:</label><br>
                <input type="text" id="principiador" name="principiador" required><br><br>

                <label for="data">Data:</label><br>
                <input type="date" id="data" name="data" required><br><br>

                <label for="data_final">Data Final:</label><br>
                <input type="date" id="data_final" name="data_final"><br><br>

                <label for="assunto">Assunto:</label><br>
                <textarea id="assunto" name="assunto" required></textarea><br><br>

                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>

    <h2>Informações Registradas</h2>

    <!-- Exibe os "post-its" com as informações registradas no banco de dados -->
    <div class="post-it-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='post-it'>";
                echo "<div class='post-it-header'>";
                echo "<span><strong>Principiador:</strong> " . htmlspecialchars($row['principiador']) . "</span>";
                echo "<span><strong>Data:</strong> " . htmlspecialchars($row['data']) . "</span>";
                echo "<span><strong>Data Final:</strong> " . htmlspecialchars($row['data_final']) . "</span>";
                echo "</div>";
                echo "<div class='post-it-body'>" . nl2br(htmlspecialchars($row['assunto'])) . "</div>";
                echo "<a class='delete-link' href='?delete=" . $row['id'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este registro?\")'>Excluir</a>";
                echo "</div>";
            }
        } else {
            echo "<p>Nenhum dado encontrado</p>";
        }
        ?>
    </div>

    <?php
    // Fechar conexão
    $conn->close();
    ?>

    <script>
        // Função para abrir o formulário (modal)
        function openForm() {
            document.getElementById("formModal").style.display = "block";
        }

        // Função para fechar o formulário (modal)
        function closeForm() {
            document.getElementById("formModal").style.display = "none";
        }

        // Fechar o modal se o usuário clicar fora dele
        window.onclick = function(event) {
            if (event.target == document.getElementById("formModal")) {
                closeForm();
            }
        }
    </script>
</body>
</html>