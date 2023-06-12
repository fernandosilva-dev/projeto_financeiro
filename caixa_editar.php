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
  <center><h2>Editar Históricos</h2></center>

  <?php
  //Requer o uso do arquivo externo de configurações 
  require('configuracoes.php');
  //Realiza a conexão
  $vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
  if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}
  //Cria o código SQL para Caixa   
  $vSqlCaixa='SELECT * FROM caixa
              WHERE id = '.$_POST['vId'];
  //Executa o código SQL para Caixa
  $vExecucaoCaixa=mysqli_query($vConexao, $vSqlCaixa);
  if (!$vExecucaoCaixa) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}
  //Acessa registro da consulta do Caixa
  $vTabelaCaixa=mysqli_fetch_array($vExecucaoCaixa);
  $vId=$vTabelaCaixa['id'];    
  $vData=$vTabelaCaixa['data'];    
  $vHistorico=$vTabelaCaixa['historico'];    
  $vReceita=$vTabelaCaixa['receita'];    
  $vDespesa=$vTabelaCaixa['despesa'];
  //Cria o código SQL para Históricos   
  $vSqlHistoricos='SELECT * FROM historicos';
  //Executa o código SQL para Históricos
  $vExecucaoHistoricos=mysqli_query($vConexao, $vSqlHistoricos);
  if (!$vExecucaoHistoricos) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));} 
  //Fecha a conexão
  mysqli_close($vConexao);
  ?>

  <form method="post" action="caixa_editar_executar.php">
    <!-- Campo ID -->
    <input type="hidden" id="vId" name="vId" value="<?php echo $vId ?>">        
    <!-- Campo DATA -->
    <div class="form-group">
     <label for="vData">Data:</label>
     <input type="date" class="form-control" id="vData" name="vData" value="<?php echo $vData ?>">
    </div>
    <!-- campo HISTÓRICO -->      
    <div class="form-group">
     <label for="vHistorico">Histórico:</label>
     <select class="form-control" id="vHistorico" name="vHistorico">
     <?php
     while($vTabelaHistoricos=mysqli_fetch_array($vExecucaoHistoricos)) 
       {
       if ($vTabelaCaixa['historico'] == $vTabelaHistoricos['id']) 
          {$vSelecionado='selected';} 
       else 
          {$vSelecionado='';}
       echo '<option value="'.$vTabelaHistoricos['id'].'" '.$vSelecionado.'>'.utf8_encode($vTabelaHistoricos['nome']).'</option>';      
       }
     ?>
     </select>
    </div>
    <!-- Campo RECEITA -->
    <div class="form-group">
     <label for="vReceita">Receita:</label>
     <input type="text" class="form-control" id="vReceita" name="vReceita" value="<?php echo $vReceita ?>">
    </div>
    <!-- Campo DESPESA -->
    <div class="form-group">
     <label for="vDespesa">Despesa:</label>
     <input type="text" class="form-control" id="vDespesa" name="vDespesa" value="<?php echo $vDespesa ?>">
    </div>
    <div class="form-group">
     <center>
      <button class="btn btn-success" type="submit" name="vBotao" value="confirmar">Confirmar</button>
      <button class="btn btn-danger" type="submit" name="vBotao" value="cancelar">Cancelar</button>
     </center>
    </div>
  </form>  

</body>
</html>

