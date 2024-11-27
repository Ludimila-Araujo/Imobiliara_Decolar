import os

# Caminho da pasta com os arquivos PDF
pasta = 'DOCUMENTOS ESCANEADOS'

# Começa o conteúdo do HTML com as melhorias de design
html_content = """
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibir Documentos PDF</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #2c3e50;
            color: #333;
        }

        h1 {
            font-size: 28px;
            color: #343a40;
            text-align: center;
            margin: 20px 0;
            font-weight: 600;
        }

        #searchInput {
            width: 100%;
            max-width: 400px;
            padding: 12px;
            margin: 20px auto;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
            background-color: #fff;
            transition: border-color 0.3s ease;
            display: block;
        }

        #searchInput:focus {
            outline: none;
            border-color: #007bff;
        }

        #backButton {
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
            margin: 10px 20px;
            display: inline-block;
            transition: color 0.3s ease;
        }

        #backButton:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        #cadastrarContrato {
            display: inline-block;
            padding: 12px 20px;
            background-color: #0c1c34;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            margin: 10px auto;
            transition: background-color 0.3s ease;
        }

        #cadastrarContrato:hover {
            background-color: #218838;
        }

        /* Layout para os arquivos PDF */
        #fileList {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 30px;
            padding: 0;
            list-style-type: none;
        }

        .file-item {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .file-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .file-item a {
            text-decoration: none;
            color: #007bff;
            font-size: 16px;
            font-weight: 500;
            display: block;
            margin-top: 15px;
            transition: color 0.3s ease;
        }

        .file-item a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .file-icon {
            height: 100px;
            background: url('icons/pdf-icon.png') no-repeat center center;
            background-size: contain;
            margin-bottom: 10px;
        }

        /* Responsividade */
        @media screen and (max-width: 768px) {
            h1 {
                font-size: 24px;
            }

            #searchInput {
                font-size: 14px;
            }

            #fileList {
                grid-template-columns: repeat(2, 1fr);
            }

            .file-item {
                padding: 15px;
            }

            a {
                font-size: 14px;
            }
        }

        @media screen and (max-width: 480px) {
            #fileList {
                grid-template-columns: 1fr;
            }
        }

    </style>
</head>
<body>

    <!-- Botão Voltar no Canto Superior Esquerdo -->
    <a href="javascript:history.back()" id="backButton">Voltar</a>

    <h1 style="color:white;">Lista de Documentos PDF</h1>

    <!-- Botão Cadastrar Contrato Centralizado Abaixo do Título -->
    <a href="beckup/upload.html" id="cadastrarContrato">Cadastrar Contrato</a>

    <!-- Campo de Pesquisa -->
    <input type="text" id="searchInput" onkeyup="searchFiles()" placeholder="Pesquise por um documento...">

    <!-- Lista de Documentos -->
    <ul id="fileList">
"""

# Percorre todos os arquivos na pasta e gera a lista de documentos PDF
for arquivo in os.listdir(pasta):
    if arquivo.endswith(".pdf"):
        # Adiciona um link para abrir cada PDF em uma nova página dentro de uma caixa
        html_content += f'''
        <li class="file-item">
            <div class="file-icon"></div>
            <a href="{pasta}/{arquivo}" target="_blank">
                {arquivo}
            </a>
        </li>
        '''

# Fecha o HTML
html_content += """</ul>

    <script>
        // Função de pesquisa
        function searchFiles() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let ul = document.getElementById('fileList');
            let li = ul.getElementsByClassName('file-item');

            for (let i = 0; i < li.length; i++) {
                let a = li[i].getElementsByTagName('a')[0];
                let txtValue = a.textContent || a.innerText;

                if (txtValue.toLowerCase().indexOf(input) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>

</body>
</html>
"""

# Salva o conteúdo gerado em um arquivo HTML
with open('escaneados.html', 'w', encoding='utf-8') as f:
    f.write(html_content)

print("Arquivo escaneados.html gerado com sucesso!")
