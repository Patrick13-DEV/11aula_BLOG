<?php 
// conexao com o banco de dados

$dbHost = "localhost"; 
$dbNomeBanco= "blog_patrick"; //nome do banco de dados
$dbUser= "root"; ; // nome do root
$dbPassWord = ""; //senha
$dbPort = "3306"; // porta regular do mariaDB
// Nome da variaveis
//identifica so o banco de dados

// variavel que faz conexao com o banco de dados         new PDO()faz conexcao uma PHP com banco de dados

try {
    $conexao = new PDO("mysql:host=$dbHost; dbname=$dbNomeBanco; chartset= utf8", $dbUser, $dbPassWord);
} catch (PDOException $erro) {
   echo "Erro ao conectar ao banco de dados" . $erro -> getMessage() ; // lembrar de apagaro o get Message em PDOE 
}   
    


?>