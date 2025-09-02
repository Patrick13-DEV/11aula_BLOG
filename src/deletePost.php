<?php
include_once("../constante.php");
include_once("../service/conexao.php");
include_once("../service/auth.php");

if($_SERVER['REQUEST_METHOD'] == "GET"){
    $postagemId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_SPECIAL_CHARS);
    try {
        $sql = "SELECT IMAGEM FROM posts WHERE ID_POST = :postagemId";
        $select = $conexao->prepare($sql);
        $select->bindParam(":postagemId", $postagemId);
        $select->execute();
        
        $POST = $select->fetch(PDO::FETCH_ASSOC);

        if($POST){
            $imagem = $POST['IMAGEM'];
        }

        if(!empty($imagem)){
            $caminhoImagem = "../img-posts/" . $imagem;
            if(file_exists($caminhoImagem)){
                unlink($caminhoImagem);
            }
        }

$sqldelete = "DELETE FROM posts WHERE ID_POST = :postagemId";
$delete = $conexao->prepare($sqldelete);
$delete->bindParam(":postagemId", $postagemId);


 if ($delete->execute()) {
    $_SESSION['mensagem'] = "Excluido com Sucesso";
    $_SESSION['cor'] = 'alert-sucess';
    header("Location:" . ROOT_PATH . "screens/postar.php");
    exit;

 } else {
    throw new Exception("ocorreu um erro");
}

} catch (Exception $e) {
   $_SESSION['mensagem'] = "erro ao Excluir" . $e->getMessage();
   $_SESSION['cor'] = 'alert-danger';
   header("Location:" . ROOT_PATH . "screens/postar.php");
   exit;
} finally {
    unset ($conexao);
}

}

?>