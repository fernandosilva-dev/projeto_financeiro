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
<div class="container">
  <center><h2>Editar Usuários</h2></center>

  <?php
  //Requer o uso do arquivo externo de configurações 
  require('configuracoes.php');
  //Realiza a conexão
  $vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
  if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}
  //Cria o código SQL    
  $vSql='SELECT * FROM usuarios
         WHERE id = '.$_POST['vId'];
  //Executa o código SQL
  $vExecucao=mysqli_query($vConexao, $vSql);
  if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}
  //Acessa registro da consulta
  $vTabela=mysqli_fetch_array($vExecucao);
  $vId=$vTabela['id'];    
  $vNome=$vTabela['nome'];    
  $vSenha=$vTabela['senha'];    
  if ($vTabela['consultar']==1) {$vConsultar='checked';} else {$vConsultar='';}    
  if ($vTabela['inserir']==1) {$vInserir='checked';} else {$vInserir='';}    
  if ($vTabela['editar']==1) {$vEditar='checked';} else {$vEditar='';}    
  if ($vTabela['excluir']==1) {$vExcluir='checked';} else {$vExcluir='';}
  //Fecha a conexão
  mysqli_close($vConexao); 
  ?>

  <!-- Inicia a tag FORM com as classes do Bootstrap -->
  <form method="post" action="usuarios_editar_executar.php">
    <!-- Cria o controle de tela para o campo ID -->
    <input type="hidden" id="vId" name="vId" value="<?php echo $vId ?>">        
    <!-- Cria os controles de tela para o campo NOME -->
    <div class="form-group">
      <label for="vNome">Nome:</label>
      <input type="text" class="form-control" id="vNome" name="vNome" value="<?php echo $vNome ?>">
    </div>
    <!-- Cria os controles de tela para o campo SENHA -->
    <div class="form-group">
      <label for="vSenha">Senha:</label>
      <input type="password" class="form-control" id="vSenha" name="vSenha" value="<?php echo $vSenha ?>">
    </div>
    <!-- Cria painel para os controles de acesso -->
    <div class="panel panel-default">
      <div class="panel-heading"><b>Controles de Acesso:</b></div>
      <div class="panel-body">
        <div class="checkbox">
          <!-- Cria os controles de tela para o campo CONSULTAR -->
          <label class="checkbox-inline">
          <input type="checkbox" id="vConsultar" name="vConsultar" <?php echo $vConsultar ?>>Consultar
          </label>
          <!-- Cria os controles de tela para o campo INSERIR -->
          <label class="checkbox-inline">
          <input type="checkbox" id="vInserir" name="vInserir" <?php echo $vInserir ?>>Inserir
          </label>
          <!-- Cria os controles de tela para o campo EDITAR -->
          <label class="checkbox-inline">
          <input type="checkbox" id="vEditar" name="vEditar" <?php echo $vEditar ?>>Editar
          </label>
          <!-- Cria os controles de tela para o campo EXCLUIR -->
          <label class="checkbox-inline">
          <input type="checkbox" id="vExcluir" name="vExcluir" <?php echo $vExcluir ?>>Excluir
          </label>
        </div>
      </div>
    </div>
    <!-- Cria o botão para confirmar a inserção do registro -->
    <div class="form-group">
      <center>        
       <button class="btn btn-success" type="submit" name="vBotao" value="confirmar">Confirmar</button>
       <button class="btn btn-danger" type="submit" name="vBotao" value="cancelar">Cancelar</button>
      </center>
    </div>
  </form>
</div>

</body>
</html>