<?php 
define('DIR_PATH', realpath(dirname(__FILE__))); // mostra o caminho todo do arquivo
define('ROOT_PATH','http://172.17.34.253:1200/projetos/202400005/alunos/patrick/11aula_BLOG/');
// garante que o a sessao esteja iniciada
if (session_status()===PHP_SESSION_NONE){
    session_start();
}
//inicializador as variaveis de sessao
$mensagem = $_SESSION['mensagem'] ?? null;
$cor = $_SESSION['cor'] ?? null;
unset($_SESSION['mensagem']);
unset($_SESSION['cor']);


$logado = $_SESSION['logado'] ?? FALSE;
$idUser = $_SESSION['idUser'] ?? FALSE;
$nomeUser = $_SESSION['nomeUser'] ?? "";
