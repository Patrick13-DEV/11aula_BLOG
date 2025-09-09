<?php
include_once("../constante.php");
include_once("../service/conexao.php");
include_once("../includes/header.php");
include_once("../service/auth.php");
$postagem = null;
$id = $_GET['id'];

$sql = "SELECT * FROM posts WHERE ID_POST = ?";
$select = $conexao->prepare($sql);
$select->execute([$id]);
$postagem = $select->fetch(PDO::FETCH_ASSOC);

?>
<main class="container mt-5">
    <h3>Fazer Comentário</h3>
    <div class="row offset-md-2">
        <div class="mb-3">
            <h3 class="display-3 text-body-secondary alert my-2"> <?= htmlspecialchars($postagem['TITULO'] ?? '') ?></h3>
        </div>
        <div class="mb-3 col-12">
            <img src="../img-posts/<?= htmlspecialchars($postagem["IMAGEM"] ?? "") ?>" alt="" class="img-form" style="object-fit: scale-down; width: 850px; height: 550px;">
        </div>
        <div class="mb-3">
            <p class="">Resumo do Post</p>
            <h2><?= htmlspecialchars($postagem['RESUMO'] ?? '') ?></h2>
        </div>
        <form action="<?= ROOT_PATH ?>src/AdicionarComentario.php" method="POST">
            <input type="hidden" name="txtUsuarioId" value="<?= htmlspecialchars($idUser) ?>">
            <input type="hidden" name="txtPostagemId" value="<?= htmlspecialchars($postagem['ID_POST'] ?? '') ?>">
            <div class="mb-3">
                <label for="txtComentario" class="form-label">Fazer Comentário</label>
                <textarea id="txtComentario" class="form-control" rows="5" name="txtConteudoPost" required></textarea>
            </div>
            <a type="button" class="btn btn-primary mb-3" href="<?= ROOT_PATH ?>index.php">Voltar</a>
            <button type="submit" class="btn btn-success mb-3">Comentar</button>
        </form>
    </div>

    <div>
        <?php if (isset($mensagem)) { ?>
            <p class="alert <?= $cor ?> mt-2"><?= $mensagem ?></p>
        <?php } ?>
    </div>

    <!-- Exibir comentários -->
    <div class="mt-5">
        <h4>Comentários</h4>
        <?php
        // Buscar comentários do post
        $sqlComentarios = "SELECT c.*, u.nome as IDUSUARIO FROM comentarios c INNER JOIN usuarios u ON c.IDUSUARIO = u.ID_usuario WHERE c.IDPOST = ? ORDER BY c.ID_COMENTARIO DESC";
        $stmtComentarios = $conexao->prepare($sqlComentarios);
        $stmtComentarios->execute([$postagem['ID_POST']]);
        $comentarios = $stmtComentarios->fetchAll(PDO::FETCH_ASSOC);
        if ($comentarios) {
            foreach ($comentarios as $comentario) {
        ?>
                <div class="card mb-2">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Por <?= htmlspecialchars($comentario['IDUSUARIO']) ?> em <?= date('d/m/Y H:i', strtotime($comentario['DATACOMENTARIO'])) ?></h6>
                        <p class="card-text"><?= nl2br(htmlspecialchars($comentario['COMENTARIO'])) ?></p>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '<p class="text-muted">Nenhum comentário ainda.</p>';
        }
        ?>
    </div>
</main>
<?php
include_once("../includes/footer.php");
?>