<html>

<!-- Cabeçalho de definições da página -->
<head>

  <!-- Definição o título da página -->
  <title>SGD - Sistema de Gerenciamento de Dados</title>

  <!-- Definição da codificação de caracteres -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!-- Estilos para a construção do menu com lista de itens -->
  <style>

  ul 
    {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
    font-family: Arial;
    font-size: 14px;
    }

  li a, .dropbtn 
    {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    }

  li a:hover, .menu_retratil:hover .dropbtn 
    {
    background-color: silver;
    color: black;
    }

  li.menu_retratil 
    {
    display: inline-block;
    text-align: left;
    }

  .active 
    {
    background-color: #4CAF50;
    } 

  .menu_retratil-item 
    {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    }

  .menu_retratil-item a 
    {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
    }

  .menu_retratil-item a:hover 
    {
    background-color: #f1f1f1
    }

  .menu_retratil:hover .menu_retratil-item 
    {
    display: block;
    }

</style>

</head>

<!-- Corpo da página -->
<body>

<!-- Inicia menu horizontal-->
<ul>
  <!-- Cria itens horizontais -->
  <li style="float:left"><a class="menu" href="pagina_inicial.php" target="conteudo">Página Inicial</a></li>
  
  <?php
  if (isset($_COOKIE[$vCookieLogin])and
     ($_COOKIE[$vCookieLogin]==1))
     {
      echo '<li style="float:left"><a class="menu" href="usuarios.php" target="conteudo">Usuários</a></li>
            <li style="float:left"><a class="menu" href="historicos.php" target="conteudo">Históricos</a></li>
            <li style="float:left"><a class="menu" href="caixa.php" target="conteudo">Caixa</a></li>';
     }       
  ?>

  <li style="float:right"><a class="active" href="login.php" target="conteudo">Área Restrita</a></li>
</ul>

</body>

</html>