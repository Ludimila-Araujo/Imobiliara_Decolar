<?php
// Função para formatar a data
function formatarData($data) {
    $meses = [
        'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 
        'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
    ];

    $dia = date("d", strtotime($data));
    $mes = $meses[date("n", strtotime($data)) - 1];
    $ano = date("Y", strtotime($data));

    return "$dia de $mes de $ano";
}

// Verifica se a data foi enviada pelo formulário
if (isset($_POST['data_pagamento'])) {
    $dataInput = $_POST['data_pagamento'];
    $dataFormatada = formatarData($dataInput);
} else {
    $dataFormatada = "Data não fornecida!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="icon" href="imagens/decolar.png" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /* Resetando margens e padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Estilo geral da página */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            min-height: 100vh; /* Garante que a altura mínima seja 100% da tela */
            padding: 0;
            margin: 0;
            position: relative;
        }

        /* Marca d'água com a imagem posicionada no centro da página */
        .watermark {
            position: absolute;
            top: 50%;
            left: 12%; /* Ajustando para que a imagem não ultrapasse a tela */
            transform: translate(-50%, -50%);
            z-index: -1; /* Coloca a marca d'água atrás do conteúdo */
        }

        .watermark img {
            width: 600%; /* Aumentando o tamanho da marca d'água */
            opacity: 0.05; /* Aumentando a transparência da imagem */
        }

        /* Topo do documento fixo no topo da página */
        .topo {
            padding: 20px;
            background-color: rgba(76, 175, 80, 0.4); /* Mais transparência no fundo */
            color: white;
            font-size: 1.5rem;
            text-align: center;
            z-index: 1;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            height: 80px; /* Altura do topo */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Rodapé fixo na parte inferior da página */
        .rodape {
            padding: 20px;
            background-color: rgba(76, 175, 80, 0.5); /* Transparência no rodapé */
            color: blue;
            font-size: 10px;
            text-align: center;
            z-index: 1;
            width: 100%;
            position: fixed;
            bottom: 0;
        }

        /* Estilo do rodapé */
        .rodape p {
            margin-top: 10px;
        }

        /* Estilo do conteúdo do recibo */
        .recibo {
            margin: 120px 30px 50px 30px; /* Ajustando o espaço superior para não sobrepor o topo fixo */
            padding-top: 100px; /* Espaço superior para não sobrepor o topo fixo */
            z-index: 2;
            text-align: justify;
            width: 100%;
        }

        .recibo h1 {
            text-align: center;
        }

        .recibo p {
            font-size: 1.2rem;
            text-align: justify;
            margin-bottom: 10px;
        }

        .recibo .campo {
            font-weight: bold;
        }
        

    </style>
</head>
<body>

    <!-- Marca D'água com Imagem -->
    <div class="watermark">
        <img src="logo.jpeg" alt="Marca d'água">
    </div>

    <!-- Topo fixo no topo -->
    <div class="topo">
        <a href="http://192.168.15.76/decolar/decolar/"><img src="logo.jpeg" alt="Logo"></a>
    </div>

    <!-- Conteúdo do Recibo -->
    <div class="recibo">
        <br><br><br><br><br>
        <h1 style="font-size: 50px;  text-transform: uppercase;"><b>RECIBO <?php $mes = $_POST['mes']; echo $mes; ?> </b></h1>

        <br><p><b>Decolar Imobiliária LTDA; CNPJ: 49.166.074/0001-91; CRECI 1205-J, Endereço: Centro Comercial Monte Ville - Av.Valdemar Naziazeno, 1220 - Ernesto Geisel, João Pessoa - PB, 58075-000, Sala 103. Contato/WhatsApp: (83) 9 8846-0931, Instagram: @DECOLARIMOBILIARIAPBJP, E-mail: junior_pbjp@hotmail.com</b>, declaro para os devidos fins que foi recebido da Senhora: <?php $nome = $_POST['nome']; echo $nome; ?>, CPF: <?php $cpf = $_POST['cpf']; echo $cpf; ?>, o valor de R$<?php $valor = $_POST['valor']; echo $valor; ?> , referente ao aluguel e caução do imóvel situado a <?php $localizacao = $_POST['localizacao']; echo $localizacao; ?></p><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

        <div style="text-align:center;">
                                    <img src="assinatura.jpeg" style="top: 50px; justify-content: flex;">
            <br>______________________________________________________________________<br><b>Edmilson da Silva Santos Júnior<b>
        </div>

        <div style="text-align:center;">
            <br><br><br>______________________________________________________________________<br><b><?php $nome = $_POST['nome']; echo $nome; ?></b>

                                </div>
                        <img src="gota.jpeg">
            <br><br><br><br><p style="text-align: right;"><?php echo $dataFormatada; ?></p>

    </div>

   <!-- Rodapé fixo na parte inferior -->
    <div class="rodape">
        <p>Decolar Imobiliária LTDA; CNPJ: 49.166.074/0001-91; CRECI 1205-J, Endereço: Centro Comercial Monte Ville - Av.Valdemar Naziazeno, 1220 - Ernesto Geisel, João Pessoa - PB, 58075-000, Sala 103. Contato/WhatsApp: (83) 9 8846-0931. Instagram: @DECOLARIMOBILIARIAPBJP, E-mail: junior_pbjp@hotmail.com</p>
    </div>
<script>
        // Quando a página for carregada, automaticamente abre a janela de impressão
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
