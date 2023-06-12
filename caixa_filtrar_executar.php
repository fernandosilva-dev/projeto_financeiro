<html>

<head>
  <title>Filtar Caixa</title>
  <meta charset="utf-8">
  <!-- Inclui as bibliotecas Bootstrap e jQuery -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- Estilos do campo de digitação do filtro -->
  <style>
  #vFiltro 
    {
    background-image: url('imagens/filtro.png');
    background-position: 0px 0px;
    background-repeat: no-repeat;
    width: 100%;
    font-size: 16px;
    padding: 12px 20px 12px 40px;
    border: 1px solid #ddd;
    margin-bottom: 12px;
    }
  </style>
</head>

<body>

<!-- Inicia a tag DIV com a classe CONTAINER do Bootstrap -->
<div class="container">
  <center><h2>FILTRAR CAIXA</h2></center>

<?php

//Requer o uso do arquivo externo de configurações 
require('configuracoes.php');

//Tabela CAIXA

//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

$vDataInicial=$_POST['vDataInicial'];
$vDataFinal=$_POST['vDataFinal'];
$vMes=$_POST['vMes'];
$vHistorico=$_POST['vHistorico'];


//Cria o código SQL tabela
$vSqlTabela='SELECT '.
      'caixa.id, '.
      'caixa.data, '.
      'historicos.nome as "historico", '.
      'caixa.receita, '.
      'caixa.despesa '.
      'FROM caixa, historicos '.
      'WHERE caixa.historico = historicos.id ';
      
      if ($vDataInicial<> '') 
      {
       $vSqlTabela= $vSqlTabela.
       'and caixa.data >= "'.$vDataInicial.'" ';
      }

      if ($vDataFinal<> '') 
      {
       $vSqlTabela= $vSqlTabela.
       'and caixa.data <= "'.$vDataFinal.'" ';
      }
      if ($vMes <> '') 
      {
       $vSqlTabela=$vSqlTabela. 
          'and MONTH(caixa.data)='.$vMes;
      }

      if ($vHistorico <> '') 
      {
       $vSqlTabela=$vSqlTabela. 
          'and caixa.historico='.$vHistorico;
      }


      $vSqlTabela=$vSqlTabela.
      ' ORDER BY caixa.data';
     



//Executa o código SQL para tabela
$vExecucao=mysqli_query($vConexao, $vSqlTabela);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Conta registros da tabela
$vCont=mysqli_num_rows($vExecucao);
if ($vCont==0) {die('<h2>Nenhum registro encontrado!</h2>');}
echo '<h2>Registros encontrados: '.$vCont.'<br><br>';


//Cria o código SQL TOTAIS
$vSqlTotais='SELECT '.
      'SUM(caixa.receita) as "soma_receita" , '.
      'SUM(caixa.despesa) as "soma_despesa" '.
      'FROM caixa, historicos '.
      'WHERE caixa.historico = historicos.id ';

      if ($vDataInicial<> '') 
      {
       $vSqlTotais= $vSqlTotais.
       'and caixa.data >= "'.$vDataInicial.'" ';
      }

      if ($vDataFinal<> '') 
      {
       $vSqlTotais= $vSqlTotais.
       'and caixa.data <= "'.$vDataFinal.'" ';
      }
      if ($vMes <> '') 
      {
       $vSqlTotais=$vSqlTotais. 
          'and MONTH(caixa.data)='.$vMes;
      }

      $vSqlTabela=$vSqlTabela.
      ' ORDER BY caixa.data';

      if ($vHistorico <> '') 
      {
       $vSqlTotais=$vSqlTotais. 
          'and caixa.historico='.$vHistorico;
      }

      $vSqlTotais=$vSqlTotais.
      ' ORDER BY caixa.data';


      //Executa o código SQL para tabela
$vExecucaoTotais=mysqli_query($vConexao, $vSqlTotais);
if (!$vExecucaoTotais) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Conta registros da tabela
$vCont=mysqli_num_rows($vExecucaoTotais);
if ($vCont==0) {die('<h2>Nenhum registro encontrado!</h2>');}

?>

  <!-- Inicia a tag TABLE com a classe TABLE do Bootstrap -->
  <table id="vTabela" class="table table-striped table-hover">
   
    <!-- Inicia o cabeçalho -->
    <thead>
      <!-- Cria uma linha no cabeçalho -->
      <tr>
        <!-- Cria colunas no cabeçalho -->
        <th title="Classificar" style="text-align:left; cursor:pointer" onclick="Ordenar(0)">Data</th>
        <th title="Classificar" style="text-align:left; cursor:pointer" onclick="Ordenar(1)">Histórico</th>
        <th title="Classificar" style="text-align:right; cursor:pointer" onclick="Ordenar(2)">Receita</th>
        <th title="Classificar" style="text-align:right; cursor:pointer" onclick="Ordenar(3)">Despesa</th>
      </tr>
    </thead>
    
    <!-- Inicia corpo de dados -->
    <tbody>
    
    <?php

    //Cria os registros (linhas) e campos (colunas) na tabela
    while($vTabela = mysqli_fetch_assoc($vExecucao)) 
         {
          $vData = date('d/m/Y', strtotime($vTabela['data']));
          $vHistorico = utf8_encode($vTabela['historico']);
          $vReceita = number_format($vTabela['receita'], 2, ',', '.');
          $vDespesa = number_format($vTabela['despesa'], 2, ',', '.');
          echo '<tr>
                  <td style="text-align:left; vertical-align:middle;">'.$vData.'</td>
                  <td style="text-align:left; vertical-align:middle;">'.$vHistorico.'</td>
                  <td style="text-align:right; vertical-align:middle;">'.$vReceita.'</td>
                  <td style="text-align:right; vertical-align:middle;">'.$vDespesa.'</td>
                </tr>';
         };

         //CARREGA OS CAMPOS DE TOTAIS
    $vTotais = mysqli_fetch_assoc($vExecucaoTotais);
    $vSomaReceita = $vTotais['soma_receita'];
    $vSomaDespesa = $vTotais['soma_despesa'];


    //Fecha a conexão
    mysqli_close($vConexao);

    ?>
    
    </tbody>

    <!-- Inicia o rodapé -->
    <tfoot>
      <!-- Cria uma linha no rodapé -->
      <tr>
         <!--Cria colunas no cabeçalho TOTAIS-->
        <th colspan="2" style="text-align:right;">Totais:</th>
        <th style="text-align:right;"><?php echo number_format($vSomaReceita, 2, ',', '.'); ?></th>
        <th style="text-align:right;"><?php echo number_format($vSomaDespesa, 2, ',', '.'); ?></th>
      </tr>
    </tfoot>

  </table>

</div>

<script>
//Função Javascript para FILTRAR os dados na tabela
function Filtrar()
  {
  //Declara e carrega as variáveis
  var input, filter, table, tr, td, i;
  input = document.getElementById("vFiltro");
  filter = input.value.toUpperCase();
  table = document.getElementById("vTabela");
  tr = table.getElementsByTagName("tr");
  //Realiza um laço na tabela e oculta as linhas que não correspondem ao critério do filtro
  for (i = 0; i < tr.length; i++) 
    {
    //Define a coluna que será filtrada
    td = tr[i].getElementsByTagName("td")[0];
    //Realiza o filtro na coluna definida ocultando ou exibindo a linha
    if (td) 
      {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) 
        {
        //Exibe a linha
        tr[i].style.display = "";
        } 
      else 
        {
        //Oculta a linha
        tr[i].style.display = "none";
        }
      }       
    }
  }
//Função Javascript para ORDENAR os dados na tabela
function Ordenar(n) 
  {
  //Declara e carrega as variáveis
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("vTabela");
  switching = true;
  //Defina a direção de classificação para ascendente
  dir = "asc";
  //Realiza um laço na tabela que fará a troca de posições das linhas
  while (switching)
    {
    //Inicia declarando que nenhuma troca será feita
    switching = false;
    rows = table.rows;
    //Percorre todas as linhas da tabela, exceto a primeiro que contém o cabeçalho
    for (i = 1; i < (rows.length - 1); i++)
      {
      //Inicia declarando que nenhuma troca será feita
      shouldSwitch = false;
      //Informa os dois elementos TD que você deseja comparar, um da linha atual e outro da próxima linha
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      //Verifica se as duas linhas devem mudar de lugar com base nas direções ascendente ou descendente
      if (dir == "asc") 
         {
         if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) 
            {
            //Se caso afirmativo, marca com um interrruptor de mudança e para o laço
            shouldSwitch= true;
            break;
            }
         } 
      else if (dir == "desc") 
         {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) 
           {
            //Se caso afirmativo, marca com um interrruptor de mudança e para o laço
           shouldSwitch = true;
           break;
           }
         }
      }
    if (shouldSwitch) 
       {
       //Se encontrar um interruptor marcado, faz a mudança e marca como alteração realizada
       rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
       switching = true;
       //Cada vez que uma mudança é feito, incrementa a cotagem em mais 1
       switchcount ++;      
       } 
    else 
       {
       //Se nenhuma mudança foi feita e a direção é "asc", define a direção para "desc" e executa o laço novamente
       if (switchcount == 0 && dir == "asc") 
          {
          dir = "desc";
          switching = true;
          }
       }
    }
  }
</script>

</body>

</html>