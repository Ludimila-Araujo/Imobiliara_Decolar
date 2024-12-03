<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculos de Aluguel</title>
    <style>
        
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            margin: 0 auto;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            font-family: Arial, sans-serif;
            font-size: 14px;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="number"], input[type="checkbox"], input[type="submit"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #0c1c34;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        h2 {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .result {
            margin-top: 20px;
            font-size: 16px;
            color: #333;
            text-align: center;
        }

        .back-btn {
            margin-top: 20px;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .back-btn:hover {
            background-color: #218838;
        }

        .form-container {
            display: none;
        }
    </style>
</head>
<body>
    <h2>Escolha o tipo de Cálculo</h2>
    <form id="form-selector">
        <label for="calculo">Selecione o cálculo desejado:</label>
        <select id="calculo" name="calculo" onchange="mostrarFormulario()">
            <option value="multa">Cálculo de Multa de Atraso</option>
            <option value="aluguel">Cálculo Completo de Aluguel</option>
        </select>
    </form>

    <!-- Formulário 1 - Cálculo da Multa -->
    <div id="multa-form" class="form-container">
        <h2>Multa de 12% referente ao atraso do pagamento do aluguel</h2>
        <form method="POST" action="">
            <label for="aluguel-multa">Valor do Aluguel:</label>
            <input type="number" name="aluguel" id="aluguel-multa" step="0.01" required>
            <input type="submit" value="Calcular">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['aluguel'])) {
            $aluguel = $_POST['aluguel'];
            $multa = $aluguel * 0.12;
            echo "<div class='result'><h3>O valor da multa é: R$ " . number_format($multa, 2, ',', '.') . "</h3></div>";
            echo "<div class='result'><h3>O valor total a pagar é: R$ " . number_format($multa + $aluguel, 2, ',', '.') . "</h3></div>";
            echo "<button class='back-btn' onclick='window.location.href=\"\"'>Calcular Novamente</button>";
        }
        ?>
    </div>

    
    <div id="aluguel-form" class="form-container">
        <h2>Formulário de Cálculo de Aluguel</h2>
        <form method="POST" action="">
            <label for="aluguel">Aluguel do Imóvel:</label>
            <input type="number" id="aluguel" name="aluguel" required><br><br>

            <label for="contrato">Tempo de Contrato:</label>
            <input type="number" id="contrato" name="contrato" required><br><br>

            <label for="restante">Tempo Restante:</label>
            <input type="number" id="restante" name="restante" required><br><br>

            <label for="checkbox">Tem Acréscimo referente aos 10 dias:</label>
            <input type="checkbox" id="checkbox" name="checkbox"><br><br>

            <label for="iptu">IPTU:</label>
            <input type="number" id="iptu" name="iptu"><br><br>

            <input type="submit" value="Enviar">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $aluguel = isset($_POST['aluguel']) ? (float)$_POST['aluguel'] : 0;
            $contrato = isset($_POST['contrato']) ? (float)$_POST['contrato'] : 1; 
            $restante = isset($_POST['restante']) ? (float)$_POST['restante'] : 0;
            $iptu = isset($_POST['iptu']) ? (float)$_POST['iptu'] : 0;
            $checkbox = isset($_POST['checkbox']) ? true : false;

            
            $resultado = ($aluguel * 3 / $contrato) * $restante;

            
            if ($checkbox) {
                $resultado += $aluguel;
            }

            
            if ($iptu > 0) {
                $resultado += $iptu;
            }

            
            echo "<div class='result'><h3>O resultado final é: R$ " . number_format($resultado, 2, ',', '.') . "</h3></div>";
        }
        ?>
    </div>

    <script>
        
        function mostrarFormulario() {
            var selecionado = document.getElementById("calculo").value;
            if (selecionado == "multa") {
                document.getElementById("multa-form").style.display = "block";
                document.getElementById("aluguel-form").style.display = "none";
            } else {
                document.getElementById("aluguel-form").style.display = "block";
                document.getElementById("multa-form").style.display = "none";
            }
        }

        
        mostrarFormulario();
    </script>
</body>
</html>
