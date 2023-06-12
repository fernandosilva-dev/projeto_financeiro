<html>

<head>
  <title>Caixa</title>
  <meta charset="utf-8">
  <!-- Inclui as bibliotecas Bootstrap e jQuery -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
  <?php
 //Requer o uso do arquivo externo de configurações 
  require('configuracoes.php');
  //Realiza a conexão
  $vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
  if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}
  //Cria o código SQL
  $vSqlHistorico='SELECT id, nome FROM historicos';
  //Executa o código SQL
  $vExecucao=mysqli_query($vConexao, $vSqlHistorico);
  if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}
  //Fecha a conexão
  mysqli_close($vConexao);
    ?>
	
 <div class="container" style="padding-top:25px;">
  <div class="panel panel-info">
    <div class="panel-heading"><center><b>Filtrar Caixa</b></center></div>
    <div class="panel-body">

      <form method="post" action="caixa_filtrar_executar.php">

  <!-- campo DATA INICIAL -->

         <div class="form-group">
            <label for="vDataInicial">Data Inicial:</label>
            <input type="date" class="form-control" name="vDataInicial">
         </div>

   <!-- campo data final -->
         <div class="form-group">
             <label for="vDataFinal">Data Final:</label>
             <input type="date" class="form-control" name="vDataFinal">
         </div>
	     
		 <!-- campo MES -->
         <div class="form-group">
             <label for="vMes">Mês:</label>
             
<select class="form-control" name="vMes">
    <option value="">Nenhum</option>
	<option value="01">Janeiro</option>
	<option value="02">Fevereiro</option>
	<option value="03">Março</option>
	<option value="04">Abril</option>
	<option value="05">Maio</option>
	<option value="06">Junho</option>
	<option value="07">Julho</option>
	<option value="08">Agosto</option>
	<option value="09">Setembro</option>
	<option value="10">Outubro</option>
	<option value="11">Novembro</option>
	<option value="12">Dezembro</option>
</select>
         </div>
		 
		 <!-- campo HISTORICO -->
         <div class="form-group">
             <label for="vHistorico">Historicos:</label>
			 <select id="vHistorico" name="vHistorico" class="form-control">
         <option value=""> </option>
   
    
    <?php
    while($vTabela=mysqli_fetch_array($vExecucao)) 
      { echo '<option value="'.$vTabela['id'].'">'.utf8_encode($vTabela['nome']).'</option>';
      }
    ?>
    </select>
         </div>
		 
	     <div>
	        <center>
	        <button class="btn btn-info" type="submit" name="vBotao" value="confirmar"> Filtrar </button>
	        </center>
	     </div>
		 </div>
	  </form>
	</div>
</div>

</body>
</html>	