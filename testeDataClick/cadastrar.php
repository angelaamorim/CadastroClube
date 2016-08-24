<?php
    //Pede o arquivo que contém todas as funções necessárias para o sistema.
    require_once './salvar.php'; 
?>
<html>
    <head>
        <title>System Club</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="estilo.css">
        <link rel="icon" type="image/png" href="/futebol/images/bola.ico" />
    </head>
    <body>
        <header>
            <h1>System Club</h1>
        </header>
        <div id="painel">
            <?php 
                //Chama as funções para registrar no banco de dados o sócio ou clube digitado.
                salvarSocio();
                salvarClube();
            ?>
        </div>
    </body>
</html>