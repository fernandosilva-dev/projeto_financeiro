<?php

/*
DEFINIÇÃO
---------
  FPDF é uma classe PHP que permite gerar arquivos PDF com PHP puro


DOCUMENTAÇÃO
------------
  http://www.fpdf.org/
  https://www.oficinadanet.com.br/artigo/php/gerando_pdfs_com_php_e_a_classe_fpdf_as_funcoes_da_biblioteca


FUNÇÕES
-------

  FPDF([orientação, unidade, formato)
  Cria o construtor da classe de relatório, utilizando os seguintes parâmetros:
   - orientação: é a forma de exibição da página, retrato (P) ou paisagem (L), onde o valor padrão é (P);
   - unidade: é a medida utilizada na montagem da página, sendo que seus valores podem ser ponto (pt), milímetro (mm), centímetro (cm) e polegada (in), onde o valor default é milímetro (mm);
   - formato: a página pode ser A3, A4, A5, Letter e Legal, onde o valor default para o formato da página é A4.

  
  AddPage(orientação, formato)
  Adiciona uma página ao documento, utilizando os seguintes parâmetros:
   - orientação: é a forma de colocação da página, normal (P) ou paisagem (L), onde o valor default é (P);
   - formato: a página pode ser A3, A4, A5, Letter e Legal, onde o valor default para o formato da página é A4;
   - Observação: caso os parâmetros não sejam passados, então os parâmetros a serem utilizados serão os especificados na classe construtora FPDF ou o valor default da mesma.


  AddFont(família, estilo, arquivo)
  Importa uma fonte TrueType, OpenType ou Type1 e a disponibiliza, sendo necessário gerar um arquivo de definição de fonte primeiro com o utilitário MakeFont; utiliza os seguintes parâmetros:
    - família: família de fontes, onde o nome pode ser escolhido arbitrariamente; se for um nome de família padrão, substituirá a fonte correspondente;
    - estilo: estilo de fonte, onde os valores possíveis são (sem distinção entre maiúsculas e minúsculas) string vazia para regular, B para negrito, I para itálico, BI ou IB para negrito itálico; o valor padrão é regular;
    - arquivo: o arquivo de definição de fonte onde, por padrão, o nome é construído a partir da família e do estilo, em letras minúsculas, sem espaço.

 
  SetFont(família, estilo, tamanho)
  Formata a fonte, utilizando os seguintes parâmetros:
   - família: fonte que pode ser utilizada (Courier, Helvetica, Arial, Times, Symbol, ZapfDingbats) ou inserir uma mediante AddFont();
   - estilo: estilo da fonte, que pode ser regular, negrito (B), itálico (I) ou sublinhado (U)
   - tamanho: tamanho da fonte em pontos. Seu valor default é 12.

  
  Image(arquivo, x, y, largura, altura, tipo, ancora)
  Exibe uma imagem, utilizando os seguintes parâmetros:
    - arquivo: nome e endereço do arquivo;
    - x: abscissa do canto superior esquerdo; se não especificado ou igual a nulo, a abscissa atual é usada;
    - y: ordenada do canto superior esquerdo. Se não especificado ou igual a nulo, a ordenada atual é usada;
    - largura: largura da imagem na página;
    - altura: altura da imagem na página;
    - tipo: formato de imagem, onde os valores possíveis são (sem distinção entre maiúsculas e minúsculas) JPG, JPEG, PNG e GIF; se não for especificado, o tipo é inferido da extensão do arquivo;
    - ancora: âncora para redirecionamento dentro do documento.


  Cell(largura, altura, conteúdo, borda , linha, alinhamento, fundo, ancora)
  Cria uma célula, utilizando os seguintes parâmetros:
   - largura: largura da célula; se colocarmos 0 a célula se estenderá até o lado direito da página, ocupando 100% da largura;
   - altura: altura da célula;
   - conteúdo: o texto que será inserido na célula;
   - borda: se for inserido 0 as bordas não serão exibidas, mas se for inserido 1 elas serão exibidas;
   - linha: informa onde será iniciada a escrita após chamada a função. Se for 0 fica à direita, 1 no início da próxima linha, 2 abaixo;
   - alinhamento: alinha o texto. (L) à esquerda, (C) centralizado e (R) alinhado à direita;
   - fundo: informa se a célula terá um background ou não, onde os valores para esse parâmetro são true ou false;
   - ancora: âncora para redirecionamento dentro do documento.


  Ln(altura)
  Cria uma linha, utilizando os seguintes parâmetros:
    - altura: informa a altura da linha.  


  Output(nome, destino)
  Envia o documento para exibição no navegador ou para gravação em arquivo, utilizando os seguintes parâmetros: 
   - nome: nome dado ao arquivo pdf que será gerado. Caso ele não seja especificado, então irá se chamar doc.pdf, o padrão da biblioteca;
   - destino: destino de envio do arquivo, onde (I) envia o arquivo para o navegador com a opção de 'salvar como', (D) envia o arquivo ao navegador para download, (F) salvar o arquivo em uma pasta local;

*/

//****************************
//CONEXÃO COM O BANCO DE DADOS
//****************************

//Requer o uso do arquivo externo de configurações 
require('configuracoes.php');

//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='SELECT 
         id,
         nome, 
         senha, 
         consultar, 
         inserir, 
         editar, 
         excluir
       FROM usuarios';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Fecha a conexão
mysqli_close($vConexao);

//***********************
//CONSTRUÇÃO DO RELATÓRIO
//***********************

//Carrega biblioteca
require_once("fpdf/fpdf.php");

class PDF extends FPDF
{
//Cabeçalho
function Header()
  {
    $this->Image('imagens/sistema/tabela.png', 30, 10, 40, 40);
    $this->SetFont('arial', 'B', 18);
    $this->Cell(0, 15, utf8_decode("Usuários"), 0, 1, 'C');
    $this->Cell(0, 15, "", "B", 1, 'C');
    $this->Ln(30);
  }

//Rodapé
function Footer()
  {
    $this->SetY(-50);
    $this->SetFont('Arial','',8);
    $this->Cell(0, 15, "", "B", 1, 'C');
    $this->Cell(0, 15, utf8_decode('Página ').$this->PageNo().' de {nb}', 0, 0, 'C');
  }
}

//Inicia a classe e implementa o objeto de relatório
$vRelatorio=new PDF("P", "pt", "A4");

//Inicia a página
$vRelatorio->AddPage();
$vRelatorio->AliasNbPages();
 
//Formata a fonte do cabeçalho da tabela 
$vRelatorio->SetFont('arial', 'B', 12);

//Formata a cor do texto e do fundo
$vRelatorio->SetTextColor(255,255,255);
$vRelatorio->SetFillColor(130,130,130);
//Publica as células do cabeçalho da tabela 
$vRelatorio->Cell(130, 20, 'Nome', 0, 0, "L", 1);
$vRelatorio->Cell(125, 20, 'Senha', 0, 0, "L", 1);
$vRelatorio->Cell(70, 20, 'Consultar', 0, 0, "C", 1);
$vRelatorio->Cell(70, 20, 'Inserir', 0, 0, "C", 1);
$vRelatorio->Cell(70, 20, 'Editar', 0, 0, "C", 1);
$vRelatorio->Cell(70, 20, 'Excluir', 0, 1, "C", 1);
 
//Formata a fonte das linhas da tabela
$vRelatorio->SetFont('arial', '', 12);

//Carrega as variáveis dos campos lógicos
$vSim='imagens/sistema/sim.png';
$vNao='imagens/sistema/nao.png';

//Constrói as linhas da tabela
while($vTabela=mysqli_fetch_array($vExecucao)) 
     {
      //Carrega as variáveis com os valores dos campos do registro atual
      $vNome=utf8_encode($vTabela['nome']);
      $vSenha=utf8_encode($vTabela['senha']);   
      if ($vTabela['consultar']==1) {$vConsultar=$vSim;} else {$vConsultar=$vNao;}
      if ($vTabela['inserir']==1) {$vInserir=$vSim;} else {$vInserir=$vNao;}
      if ($vTabela['editar']==1) {$vEditar=$vSim;} else {$vEditar=$vNao;}
      if ($vTabela['excluir']==1) {$vExcluir=$vSim;} else {$vExcluir=$vNao;}
      //Formata a cor do texto
      $vRelatorio->SetTextColor(0,0,0);
      //Publica os valores dos campos do registro atual
      $vRelatorio->Cell(130, 20, $vNome, 0, 0, "L");
      $vRelatorio->Cell(125, 20, $vSenha, 0, 0, "L");
      $vRelatorio->Cell(70, 20, $vRelatorio->Image($vConsultar, $vRelatorio->GetX()+30, $vRelatorio->GetY()+5, 10, 10), 0, 0, "C");
      $vRelatorio->Cell(70, 20, $vRelatorio->Image($vInserir, $vRelatorio->GetX()+30, $vRelatorio->GetY()+5, 10, 10), 0, 0, "C");
      $vRelatorio->Cell(70, 20, $vRelatorio->Image($vEditar, $vRelatorio->GetX()+30, $vRelatorio->GetY()+5, 10, 10), 0, 0, "C");
      $vRelatorio->Cell(70, 20, $vRelatorio->Image($vExcluir, $vRelatorio->GetX()+30, $vRelatorio->GetY()+5, 10, 10), 0, 1, "C");
     };

//Cria linhas para teste
//for($vCont=1; $vCont<=40; $vCont++)
//    $vRelatorio->Cell(0, 20, utf8_decode('Linha nº ').$vCont, 0, 1);

//Envia o relatório para o browser (parâmetro "I") ou salva em arquivo externo (parâmetro "D")
$vRelatorio->Output("tabela.pdf", "I");

?>
