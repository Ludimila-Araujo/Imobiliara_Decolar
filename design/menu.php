<style>
    nav {
        background-color: #333;
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center; 
        align-items: center;
    }

    nav ul li {
        margin: 0 15px; 
    }

    nav ul li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 20px;
        text-decoration: none;
    }

    nav ul li a:hover {
        background-color: #111;
    }

    
    nav::after {
        content: "";
        display: table;
        clear: both;
    }
</style>
</head>
<body>

    <nav>
        <ul>
            <li><a href="?pg=conteudo">Inicio</a></li>
            <li><a href="?pg=multa">Multas</a></li>
            <li><a href="?pg=serviço/cadastro_serviço">Ordem.Serviço</a></li>
            <li><a href="recibo/xd.html">Recibo</a></li>
            <li><a href="escaneados.html">Contratos.Escaneados</a></li>

        </ul>
    </nav>

</body>
</html>
