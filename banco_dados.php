<?php


// *** DEFINE CONFIGURAÇÕES DE PÁGINA E DE ACESSO AO BANCO DE DADOS ***

//Informa a tabela de códigos de caracteres
header('Content-type:text/html; charset=utf-8');

//Requer o uso do arquivo externo de configurações 
require('configuracoes.php');


// *** CRIA BASE DE DADOS ***


//Realiza a conexão

$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='CREATE DATABASE IF NOT EXISTS financeiro;';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Base de dados FINANCEIRO disponível para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);


// *** CRIA TABELA USUÁRIOS***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='CREATE TABLE IF NOT EXISTS usuarios
         (
         id INT(10) NOT NULL AUTO_INCREMENT, 
         nome VARCHAR(40), 
         senha VARCHAR(40), 
         consultar BOOLEAN,
         inserir BOOLEAN,
         editar BOOLEAN,
         excluir BOOLEAN,
         PRIMARY KEY (id)
         ); ';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Tabela USUÁRIOS disponível para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);


// *** INSERE REGISTROS TABELA USUÁRIOS***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='INSERT INTO usuarios
        (nome, senha, consultar, inserir, editar, excluir)
       VALUES
        ("chico", "aaa", "1", "0", "0", "0"),
        ("maite", "bbb", "1", "1", "0", "0"),
        ("cleo", "ccc", "1", "1", "1", "0"),
        ("admin", "admin", "1", "1", "1", "1");';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Registros em USUÁRIOS disponíveis para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);


// *** CRIA TABELA HISTORICOS***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='CREATE TABLE IF NOT EXISTS historicos
         (
         id INT(10) NOT NULL AUTO_INCREMENT, 
         nome VARCHAR(40),
         PRIMARY KEY (id)
         ); ';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Tabela HISTORICOS disponível para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);


// *** INSERE REGISTROS TABELA USUÁRIOS***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='INSERT INTO historicos
        (nome)
       VALUES
        ("Nenhum"),
        ("Salário"),
        ("Corsan"),
        ("CEEE"),
        ("Honorários"),
        ("Mercado"),
        ("Transporte");';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Registros em HISTÓRICO disponíveis para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);


// *** CRIA TABELA CAIXA***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='CREATE TABLE IF NOT EXISTS caixa
         (
         id INT(10) NOT NULL AUTO_INCREMENT, 
         data date,
         historico int(10),
         receita float(10,2),
         despesa float(10,2),
         PRIMARY KEY (id)
         ); ';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Tabela CAIXA disponível para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);


// *** INSERE REGISTROS TABELA CAIXA***


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='INSERT INTO caixa
        (data, historico, receita, despesa)
       VALUES
        ("2021-01-01", "1", "5000", "0"),
        ("2021-01-02", "2", "0", "80.5"),
        ("2021-01-03", "3", "0", "120"),
        ("2021-01-04", "4", "1000", "0"),
        ("2021-01-05", "5", "0", "500"),
        ("2021-01-06", "6", "0", "200");';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Exibe mensagem
echo '<p>Registros em HISTÓRICO disponíveis para uso.</p>';

//Fecha a conexão
mysqli_close($vConexao);

?>
