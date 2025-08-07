<?php
//arquivo de conexao ao banco de dados

include_once("../service/conexao.php");

session_start();
$_SESSION['mensagem'] = null;



if ($_SERVER['REQUEST_METHOD']=== 'POST'){
    

    if (!empty($_POST['txtNome'])   &&   !empty($_POST['txtEmail']) && !empty($_POST['txtSenha'])) {

$nome= filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_SPECIAL_CHARS);

$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);



try {
    $sql = "INSERT INTO usuarios (nome , email , senha) VALUES (:nome, :email, :senha)";
    $insert = $conexao -> prepare($sql);
$insert -> bindParam(":nome" , $nome);
$insert -> bindParam(":email" , $email);
$insert -> bindParam(":senha" , $senhaCriptografada);

// bloco de verificaçao indo para tela de login
if($insert-> execute() && $insert-> rowCount()>0) {
 $_SESSION['mensagem'] = "Cadastro com Sucesso";
 header("Location:" . ROOT_PATH . "screens/login.php" );
 exit;
} else{
throw new Exception("Ocorreu um erro ao cadastrar"); //se nao mostra esse erro

}

} 

catch (Exception $e) {
    $_SESSION['mensagem'] = "ocorreu um erro ai cadastrar / usuario já cadastrado";
   header("Location:" . ROOT_PATH . "screens/cadastrar.php" );
 exit;

 
} finally {
    unset($conexao);
}


    } else {

        $_SESSION['mensagem'] = "Obrigatório preencher todos os campos";
        header("Location:" . ROOT_PATH . "screens/cadastrar.php");
        exit;
    }

}
?>