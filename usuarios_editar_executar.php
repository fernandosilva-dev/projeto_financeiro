<html>

<head>
  <title>Editar Usuários</title>
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
  <div class="panel panel-info">
    <div class="panel-heading"><center><b>Editar Usuários</b></center></div>
    <div class="panel-body">
    <?php
    $vDestino = "'usuarios.php'";
    //Confere se o usuário cancelou a edição
    if ($_POST['vBotao'] == 'cancelar')
       {
        echo '<center>
               <p>Cancelada a edição de registro!</p>
               <button class="btn btn-danger" onclick="window.location.href='.$vDestino.'">Ok</button>
              </center>';
       }
    //Confere se o usuário confirmou a edição
    if ($_POST['vBotao'] == 'confirmar')
       {
        //Requer o uso do arquivo externo de configurações 
        require('configuracoes.php');
        //Realiza a conexão
        $vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
        if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}
        //Cria o código SQL 
        $vId=$_POST['vId'];
        $vNome=$_POST['vNome'];    
        $vSenha=$_POST['vSenha'];    
        if (isset($_POST['vConsultar'])) {$vConsultar=1;} else {$vConsultar=0;}    
        if (isset($_POST['vInserir'])) {$vInserir=1;} else {$vInserir=0;}    
        if (isset($_POST['vEditar'])) {$vEditar=1;} else {$vEditar=0;}    
        if (isset($_POST['vExcluir'])) {$vExcluir=1;} else {$vExcluir=0;}      
        $vSql='UPDATE usuarios
               SET nome = "'.$vNome.'", 
                   senha = "'.$vSenha.'", 
                   consultar = "'.$vConsultar.'", 
                   inserir = "'.$vInserir.'", 
                   editar = "'.$vEditar.'", 
                   excluir = "'.$vExcluir.'" 
               WHERE id = '.$vId;
        //Executa o código SQL
        $vExecucao=mysqli_query($vConexao, $vSql);
        if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}
        echo '<center>
               <p>Registro editado com sucesso!</p>
               <button class="btn btn-success" onclick="window.location.href='.$vDestino.'">Ok</button>
              </center>';
       //Fecha a conexão
       mysqli_close($vConexao);
       }
    ?>
    </div>
  </div>
</div>

</body>
</html>