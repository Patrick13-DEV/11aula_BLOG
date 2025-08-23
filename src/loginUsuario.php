<?php
include_once("../constante.php");
include_once("../service/conexao.php");



if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['txtEmail']) && !empty($_POST['txtSenha'])) {
        try {
            $email = filter_input(INPUT_POST, 'txtEmail', FILTER_SANITIZE_EMAIL);
            $senha = filter_input(INPUT_POST, 'txtSenha', FILTER_SANITIZE_SPECIAL_CHARS);
            // CONSULTA AO BANCO DE DADOS VERIFICAR EMAIL 
            $sql = "SELECT email, senha, nome, ID_usuario, ISADMIN from usuarios where email = :email";
            $select = $conexao->prepare($sql);
            $select->bindParam(':email', $email);
            if ($select->execute() && $select->rowCount() > 0) {
                $login = $select->fetch(PDO::FETCH_ASSOC);

                if ($login['email'] && password_verify($senha, $login['senha'])) {
                    $_SESSION['logado'] = TRUE;
                    $_SESSION['idUser'] = $login['ID_usuario'];
                    $_SESSION['nomeUser'] = $login['nome'];

                    if ($login['ISADMIN'] === "admin") {
                        header("location: " . ROOT_PATH . "admin/index.php");
                        exit;
                    }else{
                        header("location:" . ROOT_PATH . "index.php");
                        exit;
                    }
                    }
                }
            $_SESSION['mensagem'] = "usuario/senha invalido";
            $_SESSION['cor'] = 'alert-danger';
            header("Location: " . ROOT_PATH . "screens/login.php");
            exit;
        } catch (Exception $e) {
            $_SESSION['mensagem'] = "Ocorreu um erro no banco de dados ";
            $_SESSION['cor'] = 'alert-danger';
            header("Location: " . ROOT_PATH . "screens/login.php");
            exit;
        } finally {
            unset($conexao);
        }
    } else {
        $_SESSION['mensagem'] = "Obrigatório preencher todos os campos";
        $_SESSION['cor'] = 'alert-danger';
        header("Location: " . ROOT_PATH . "screens/login.php");
        exit;
    }
}
