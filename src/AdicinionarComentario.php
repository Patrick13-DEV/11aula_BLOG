<?php
include_once("../service/conexao.php");
include_once("../constante.php");
include_once("../service/auth.php");
 
// Verifica se a requisição é POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recebe os dados do formulário
    $usuarioId = filter_input(INPUT_POST, "txtUsuarioId", FILTER_SANITIZE_NUMBER_INT);
    $postagemId = filter_input(INPUT_POST, "txtPostagemId", FILTER_SANITIZE_NUMBER_INT);
    $conteudo = trim(filter_input(INPUT_POST, "txtConteudoPost", FILTER_SANITIZE_SPECIAL_CHARS));
 
    // Verifica se os campos obrigatórios estão preenchidos
    if ($usuarioId && $postagemId && !empty($conteudo)) {
        // Monta a query de inserção
        $sql = "INSERT INTO comentarios (ID_POST, TITULO, DESCRICAO, DATA_POST)
                VALUES (:usuarioId, :postagemId, :conteudo, NOW())";
 
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
        $stmt->bindParam(':postagemId', $postagemId, PDO::PARAM_INT);
        $stmt->bindParam(':conteudo', $conteudo, PDO::PARAM_STR);
 
        if ($stmt->execute()) {
            // Redireciona de volta para o post
            header("Location: " . ROOT_PATH . "screens/detalhesPost.php?id=" . $postagemId);
            exit();
        } else {
            echo "Erro ao inserir comentário.";
        }
    } else {
        echo "Todos os campos são obrigatórios.";
    }
} else {
    echo "Método não permitido.";
}
 