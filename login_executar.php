<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Login</title>
  <meta charset="utf-8">
  <!-- Inclui as bibliotecas Bootstrap e jQuery -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<!-- Inicia a tag DIV com a classe CONTAINER do Bootstrap -->
<div class="container" style="padding-top:25px;">
  <div class="panel panel-success">
    <div class="panel-heading"><center><b>Login</b></center></div>
    <div class="panel-body">
    <?php
    //Requer o uso do arquivo externo de configurações 
    require('configuracoes.php');
    $vDestino = "'index.php'";
    //Confere se o usuário cancelou a inserção
    if ($_POST['vBotao'] == 'cancelar')
       {
        setcookie($vCookieLogin, '0', $vCookieTempo);
        echo '<center>
               <p>Cancelado acesso ao gerenciamento de dados.</p>
               <button class="btn btn-danger" onclick="window.top.location.href='.$vDestino.'">Ok</button>
              </center>';
       }
    //Confere se o usuário confirmou a inserção
    if ($_POST['vBotao'] == 'confirmar')
       {
        //Realiza a conexão
        $vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
        if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}
        //Cria o código SQL
        $vSql='SELECT nome, senha, consultar, inserir, editar, excluir             
               FROM usuarios
               WHERE (nome = "'.$_POST['vNome'].'") AND
                     (senha = "'.$_POST['vSenha'].'")
              ';
        //Executa o código SQL
        $vExecucao=mysqli_query($vConexao, $vSql);
        if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}
        //Verifica usuário e senha       
        $vTabela=mysqli_fetch_array($vExecucao);
        $vCont=mysqli_num_rows($vExecucao);
        if ($vCont==1) 
            {
             setcookie($vCookieLogin, '1', $vCookieTempo);
             setcookie($vCookieConsultar, $vTabela['consultar'], $vCookieTempo);
             setcookie($vCookieInserir, $vTabela['inserir'], $vCookieTempo);
             setcookie($vCookieEditar, $vTabela['editar'], $vCookieTempo);
             setcookie($vCookieExcluir, $vTabela['excluir'], $vCookieTempo);
             echo '<center>
                    <p>Bem-vindo '.$_POST['vNome'].'!</p>
                    <button class="btn btn-success" onclick="window.top.location.href='.$vDestino.'">Ok</button>
                   </center>';
            }
        else
           {
            setcookie($vCookieLogin, '0', $vCookieTempo);
            die('<center>
                  <p>Usuário ou senha inválidos.</p>
                  <button class="btn btn-danger" onclick="window.top.location.href='.$vDestino.'">Ok</button>
                 </center>');
           }
       //Fecha a conexão
       mysqli_close($vConexao);
       }
    ?>
    
</body>

</html>