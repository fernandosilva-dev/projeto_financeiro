<html>

<?php

//Requer o uso do arquivo externo de configurações 
require('configuracoes.php');

//Verifica se o cookie LOGIN existe
if (!isset($_COOKIE[$vCookieLogin]))
   //Cria cookie
   {setcookie($vCookieLogin, '0', $vCookieTempo);}

//Verifica se o cookie CONSULTA existe
if (!isset($_COOKIE[$vCookieConsultar]))
   //Cria cookie
   {setcookie($vCookieConsultar, '0', $vCookieTempo);}

//Verifica se o cookie INSERIR existe
if (!isset($_COOKIE[$vCookieInserir]))
   //Cria cookie
   {setcookie($vCookieInserir, '0', $vCookieTempo);}

//Verifica se o cookie EDITAR existe
if (!isset($_COOKIE[$vCookieEditar]))
   //Cria cookie
   {setcookie($vCookieEditar, '0', $vCookieTempo);}

//Verifica se o cookie EXCLUIR existe
if (!isset($_COOKIE[$vCookieExcluir]))
   //Cria cookie
   {setcookie($vCookieExcluir, '0', $vCookieTempo);}

?>

<!-- Cabeçalho da página -->
<head>

  <!-- Definição o título da página -->
  <title>SGD - Sistema de Gerenciamento de Dados</title>

  <!-- Definição da codificação de caracteres -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <style>
    .cabecalho 
      {
      position:fixed;
      left: 0;
      top: 0;
      width: 100%;
      }

    .conteudo 
      {
      position:fixed;
      left: 0;
      top: 7%;
      width: 100%;
      height:83%;
      }

    .rodape 
      {
      position:fixed;
      left: 0;
      bottom: 0;
      width: 100%;
      background-color: grey;
      color: white;
      font-family: arial;
      font-size:14px;
      text-align: center;
      }
  </style>

</head>

<!-- Corpo da página  -->
<body>
 
  <!-- Conteúdo -->
  <iframe name="conteudo" src="pagina_inicial.php" class="conteudo" frameborder="0" scrolling="auto"></iframe>

  <!-- Cabeçalho -->
  <div class="cabecalho">
    <?php include('cabecalho.php'); ?>
  </div> 

  <!-- Rodapé -->
  <div class="rodape">
    <?php include('rodape.php'); ?>
  </div>

</body>

</html>