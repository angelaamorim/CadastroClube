<?php
    //Registra no banco de dados o sócio que o usuário digitou previamente.
    function salvarSocio()
    {
        
        if (isset($_POST['socio']) && isset($_POST['nomeClube'] ) && !empty($_POST['socio'])){ // Verifica se está tudo setado e nenhum campo vazio.
            $socio = $_POST['socio'];
            $nomeClube = $_POST['nomeClube'];
            $connect = mysql_connect('127.0.0.1','root'); //Abre conexão com o banco.
            $db = mysql_select_db('futebol'); //Seleciona o banco.
            $query = "INSERT INTO SOCIO VALUES ('$socio', '$nomeClube')";
            mysql_query($query,$connect);
            if (mysql_affected_rows() == 1){ //Verifica se deu certo o query.
               echo "<p id='resposta'>Registro efetuado com sucesso</p>"; //Se der certo mostra mensagem de sucesso e as opções.
               echo "<a class= 'but' href='cadastrarClube.html'>Cadastrar Clube</a>"; 
               echo "<a class= 'but' href='listarClube.php'>Listar Clube</a>"; 
               echo "<a class= 'but' href='cadastrarSocio.php'>Cadastrar Sócio</a>"; 
               echo "<a class= 'but' href='listarSocio.php'>Listar Sócio</a>";
            }
            mysql_close($connect); //Fecha a conexão.
        }
        else { 
            if (!isset($_POST['clube'])){ //Verifica se não foi passado o parâmetro 'clube', para não mostrar a mensagem de requerimento na página Cadastrar Clube.
                echo "<p id='resposta'>Favor digitar o nome do sócio</p>";
                echo "<a class= 'but' href='cadastrarSocio.php'>Voltar</a>";
            }
        }
        
    }
    //Registra no banco de dados o clube que o usuário digitou previamente.
    function salvarClube()
    {
        
        if (isset($_POST['clube']) && !empty($_POST['clube'])){ //Verifica se foi setado e se o parâmetro não está vazio.
            $clube = $_POST['clube'];
            $connect = mysql_connect('127.0.0.1','root');
            $db = mysql_select_db('futebol');
            $query = "INSERT INTO CLUBE VALUES ('$clube')";
            mysql_query($query,$connect);
            if (mysql_affected_rows() == 1){
                echo "<p id='resposta'>Registro efetuado com sucesso</p>";
                echo "<a class= 'but' href='cadastrarClube.html'>Cadastrar Clube</a>";
                echo "<a class= 'but' href='listarClube.php'>Listar Clube</a>"; 
                echo "<a class= 'but' href='cadastrarSocio.php'>Cadastrar Sócio</a>"; 
                echo "<a class= 'but' href='listarSocio.php'>Listar Sócio</a>";
            }
            mysql_close($connect);
        }
        else {
            if (!isset($_POST['socio'])){ //Verifica se não foi passado o parâmetro 'clube', para não mostrar a mensagem de requerimento na página Cadastrar Socio.
                echo "<p id='resposta'>Favor digitar o nome do clube</p>";
                echo "<a class= 'but' href='cadastrarClube.html'>Voltar</a>";
            }
        }
        
    }
    //Cria dinamicamente o select na página de cadastramento de sócio.
    function listarClube()
    {
        $connect = mysql_connect('127.0.0.1','root');
        $db = mysql_select_db('futebol');
        $query = "SELECT * FROM CLUBE";
        $resultado = mysql_query($query,$connect);
        if(mysql_num_rows($resultado) == 0){ //Se o número de linhas na tabela for zero exibe mensagem, para não mostrar select vazio.
            echo "<p id='resposta'> Por favor cadastre um clube primeiro</p>";
            echo "<a class= 'but' href='cadastrarClube.html'>Cadastrar Clube</a>";
        }
        else{ //Se for maior que zero exibe dinamicamente o select com os clubes cadastrados.
            echo "<label>Nome:</label>";
            echo "<input type='text' name='socio'>&nbsp;&nbsp;&nbsp;";
            echo "<label>Clube:</label>";
            echo "<select name='nomeClube'>";
            while ($l = mysql_fetch_array($resultado)){
                $nomeClube = $l["nome"];
                echo "<option value='$nomeClube'>".$nomeClube."</option>";
            }
            echo "</select>";
            mysql_close($connect);
            echo "<br><br>";
            echo "<input class= 'but' type='submit' name='cadastrar' value='Salvar'>";
            echo "<a class= 'but' href='index.html'>Voltar</a>";
        }
        
    }
    //Lista os clubes em forma de uma tabela onde é possível excluir um por vez.
    function listarClubeExcluir()
    {
        
        $connect = mysql_connect('127.0.0.1','root');
        $db = mysql_select_db('futebol');
        $query = "SELECT * FROM CLUBE ORDER BY NOME"; //Ordena a consulta pelo clube.
        $resultado = mysql_query($query,$connect);
        if(mysql_num_rows($resultado) == 0){ //Se o número de linhas na tabela for zero exibe mensagem, não exibindo tabela vazia.
            echo "<p id='resposta'> Nenhum registro encontrado</p>";
        }
        else{
            echo "<center>";
            echo "    <table id='tabela' border=1px>";
            echo "        <tr>";
            echo "            <th><p>Clube</p></td>";
            echo "            <th><p>Ação</p></td>";
            echo "        </tr>";
            while ($l = mysql_fetch_array($resultado)){ //Cria a tabela dinamicamente.
                $nomeClube = $l["nome"];
                echo "        <tr>";
                echo "            <td id='colunaNome'>";
                echo "                <p>".$nomeClube."</p>"; 
                echo "            </td>";
                echo "            <td id='colunaExcluir'>";
                echo "                <a class= 'but' href='excluir.php?nomeClube=$nomeClube'>Excluir</a></p>";//cria uma coluna com um link para excluir, passando como parâmetro o nome do clube que irá ser excluído.
                echo "            </td>";
                echo "        </tr>";
            } 
            echo "    </table>";
            echo "</center>";
            mysql_close($connect);
        }
        
    }
    //Lista os sócios em forma de uma tabela onde é possível excluir um por vez.
    function listarSocioExcluir()
    {
        
        $connect = mysql_connect('127.0.0.1','root');
        $db = mysql_select_db('futebol');
        $query = "SELECT * FROM SOCIO ORDER BY CLUBE";
        $resultado = mysql_query($query,$connect);
        if(mysql_num_rows($resultado) == 0){ //Se o número de linhas na tabela for zero exibe mensagem, não exibindo tabela vazia.
            echo "<p id='resposta'> Nenhum registro encontrado</p>";
        }
        else{
            echo "<center>";
            echo "  <table id='tabela' border=1px>";
            echo "      <tr>";
            echo "          <th><p>Socio</p></td>";
            echo "          <th><p>Clube</p></td>";
            echo "          <th><p>Ação</p></td>";
            echo "      </tr>";
            while ($l = mysql_fetch_array($resultado)){
                $nomeSocio = $l["nome"];
                $nomeClube = $l["clube"];
                echo "      <tr>";
                echo "          <td id='colunaNome'>";
                echo "              <p>".$nomeSocio."</p>";
                echo "          </td>";
                echo "          <td id='colunaNome'>";
                echo "              <p>".$nomeClube."</p>";
                echo "          </td>";
                echo "          <td id='colunaExcluir'>";
                echo "              <a class= 'but' href='excluir.php?nomeSocio=$nomeSocio'>Excluir</a></p>"; //Cria uma coluna com um link para excluir, passando como parâmetro o nome do sócio que será excluído.
                echo "          </td>";
                echo "      </tr>";
            }
            echo "  </table>";
            echo "</center>";
            mysql_close($connect);
        }
        
    }
    //Exlui um sócio previamente cadastrado ao clicar no link excluir na listagem de clubes.
    function exluirSocio()
    {
        
        if (isset($_GET['nomeSocio'])){ //Verifica se foi setado o parâmetro 'nomeSocio'.
            $nome=$_GET['nomeSocio'];
            $connect = mysql_connect('127.0.0.1','root'); 
            $db = mysql_select_db('futebol'); 
            $queryUpdate = "SET SQL_SAFE_UPDATES=0;"; //Da um update na config de upadate caso haja conflito com a config do mysql.
            $query = "DELETE FROM SOCIO WHERE NOME='$nome';"; 
            mysql_query($queryUpdate,$connect); //Realiza o comando de update.
            mysql_query($query,$connect);
            if (mysql_affected_rows() == 1){
                echo "<p id='resposta'>Registro apagado com sucesso</p>";
            }
            mysql_close($connect);
        }
        
    }
    //Exlui um clube previamente cadastrado ao clicar no link excluir na listagem de clubes.
    function excluirClube()
    {
        
        if (isset ($_GET['nomeClube'])){
            $nome=$_GET['nomeClube'];
            $connect = mysql_connect('127.0.0.1','root');
            $db = mysql_select_db('futebol');
            $queryUpdate = "SET SQL_SAFE_UPDATES=0;"; //Da um update na config de upadate caso haja conflito com a config do MySQL.
            $query = "DELETE FROM CLUBE WHERE NOME='$nome';";
            mysql_query($queryUpdate,$connect); //Realiza o comando de update.
            mysql_query($query,$connect);
            if (mysql_affected_rows() == 1)
            {
                echo "<p id='resposta'>Registro apagado com sucesso</p>";
            }
            mysql_close($connect);
        }
        
    }
?>
