<?php
include_once("../constante.php");
include_once("../service/conexao.php");
include_once("../service/auth.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUserUpdate = filter_input(INPUT_POST, "txtIdUser", FILTER_SANITIZE_SPECIAL_CHARS);
    $senhaUpdate = filter_input(INPUT_POST, "txtNovaSenha", FILTER_SANITIZE_SPECIAL_CHARS);
    $novaSenhaUpdate = filter_input(INPUT_POST, "txtConfirmarSenha", FILTER_SANITIZE_EMAIL);


    if ($senhaUpdate !== $novaSenhaUpdate) {
    }
    $senhaCriptografada = password_hash($senhaUpdate, PASSWORD_DEFAULT);

    try {
        $sql = "UPDATE usuarios SET SENHA = :senhaUpdate WHERE ID_usuario = :idUserUpdate";
        $updatePerfil = $conexao->prepare($sql);
        $updatePerfil->bindParam(":idUserUpdate", $idUserUpdate);
        $updatePerfil->bindParam(":senhaUpdate", $senhaCriptografada);


        if ($updatePerfil->execute()) {
            $_SESSION['mensagem'] = "Senha atualizada com sucesso";
            $_SESSION['cor'] = 'alert-success';
            header("Location: " . ROOT_PATH . "screens/perfil.php");
            exit;
        } else {
            throw new Exception("Ocorreu um erro ao atualizar a senha");
        }
    } catch (Exception $e) {
        $_SESSION['mensagem'] = "Ocorreu um erro ao atualizar a senha!";
        $_SESSION['cor'] = "alert-warning";
        header("Location: " . ROOT_PATH . "screens/perfil.php");
        exit;
    } finally {
        unset($conexao);
    }
}

?>

        