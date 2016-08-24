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
        <link rel="icon" type="image/png" href="/testeDataClick/images/bola.ico">
    </head>
    <body>
        <header>
            <h1>System Club</h1>
        </header>
        <div id='painel'>
                <p>Cadastrar Sócio</p><br>
            <form action="cadastrar.php" method="POST">
                <?php 
                    //Chama a função que monta dinamicamente o formulário para cadastro do sócio.
                    listarClube();
                ?>
            </form>
        </div>
    </body>
</html>