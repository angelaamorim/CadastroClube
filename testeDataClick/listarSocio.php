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
        <link rel="icon" type="image/png" href="/testeDataClick/images/bola.ico" />
    </head>
    <body>
        <header>
            <h1>System Club</h1>
        </header>
        <div id="painel">
            <p>Listagem de Sócios Cadastrados</p><br>
            <?php 
                //Chama a função para listar os sócios registrados no banco de dados.
                listarSocioExcluir();
            ?>
            <br>
            <a class= 'but' href='cadastrarClube.html'>Cadastrar Clube</a> 
            <a class= 'but' href='listarClube.php'>Listar Clube</a> 
            <a class= 'but' href='cadastrarSocio.php'>Cadastrar Socio</a> 
            <a class= 'but' href='listarSocio.php'>Listar Sócio</a> 
        </div>
    </body>
</html>