<?php
include_once("../service/conexao.php");
include_once("../constante.php");
include_once("../service/auth.php");

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['txtConteudoPost'])) {

        $comentario = filter_input(INPUT_POST, "txtConteudoPost", FILTER_SANITIZE_SPECIAL_CHARS);
        $idpost = filter_input(INPUT_POST, "txtPostagemId", FILTER_SANITIZE_SPECIAL_CHARS);
        $idusuario = filter_input(INPUT_POST, "txtUsuarioId", FILTER_SANITIZE_SPECIAL_CHARS);


    try {
            $sql = "INSERT INTO comentarios (COMENTARIO,IDPOST, IDUSUARIO) VALUES (:comentario, :id_post, :id_usuario)";
            $insert = $conexao->prepare($sql);
            $insert->bindParam(":comentario", $comentario);
            $insert->bindParam(":id_post", $idpost);
            $insert->bindParam(":id_usuario", $idusuario);

            if ($insert->execute() && $insert->rowCount() > 0){
                $_SESSION['mensagem'] = "Cadastrado com Sucesso!";
                $_SESSION['cor'] = 'alert-success';
                header("Location: " . ROOT_PATH . "screens/detalhesPost.php?id=".$idpost);
                exit;
            } else {
                throw new Exception("Ocorreu um erro ao cadastrar!");
            }
            
        } catch (Exception $e) {
            $_SESSION['mensagem'] = "Ocorreu um erro" . $e;
            $_SESSION['cor'] = 'alert-danger';
           header("Location: " . ROOT_PATH . "screens/detalhesPost.php?id=".$idpost);
exit;
        } finally {
            unset($conexao);
        }

    } else {
        $_SESSION['mensagem'] = "Obrigatório preencher todos os campos";
        $_SESSION['cor'] = 'alert-danger';
        header("Location: " . ROOT_PATH . "screens/detalhesPost.php?id=".$idpost);
        exit;
    }
}



?>