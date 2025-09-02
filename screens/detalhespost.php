<?php
include_once("../constante.php");
include_once("../service/conexao.php");
include_once("../includes/header.php");
include_once("../service/auth.php");
$postagem = null;
$id=$_GET['id'];

$sql = "SELECT * FROM posts WHERE ID_POST = ?";
$select = $conexao->prepare($sql);
$select->execute([$id]);
$postagem = $select->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $postagemId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    ##-------------------------------------
    ## SELECT Postagem por IDPostagem
    $comentarios = [];
    ##-------------------------------------    
    $sql = "SELECT p.*, u.nome as nomeUsuario
        FROM posts p        
        INNER JOIN usuarios u
        ON p.usuario_id = u.usuario_id
        WHERE p.postagem_id = :postagemId
        ORDER BY postagem_id DESC";
    $select = $conexao->prepare($sql);
    $select->bindParam(':postagemId', $postagemId);}






?>

<main class="container mt-5">
    <form action="<?= ROOT_PATH ?>index.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idPost" value="<?= htmlspecialchars($postagem['ID_POST'] ?? '') ?>">
        <h3>Fazer Comentário</h3>
        <div class="row offset-md-2">

            <div class="mb-3">
                <h3 class="display-3 text-body-secondary alert my-2"> <?=htmlspecialchars($postagem['TITULO'] ?? '') ?></h3>
            </div>


            <div class="mb-3 col-12">
                <img src="../img-posts/<?= htmlspecialchars($postagem["IMAGEM"] ?? "") ?>" alt="" class="img-form" style="object-fit: scale-down; width: 850px; height: 550px;">
            </div>


            <div class="mb-3">
                <p class="">Resumo do Post</p>
                <h2><?=htmlspecialchars($postagem['RESUMO'] ?? '') ?></h2>
            </div>

            <div class="mb-3">
                <label for="txtConteudoPost" class="form-label">Comentar</label>
                <textarea id="txtConteudoPost" class="form-control" rows="10" name="txtConteudoPost" required></textarea>
            </div>

            <a type="button" class="btn btn-primary mb-3" href="<?= ROOT_PATH ?>index.php">Voltar</a>
            <button type="submit" class="btn btn-success mb-3">Comentar</button>
        </div>
    </form>
    <div>
        <?php if (isset($mensagem)) { ?>
            <p class="alert <?= $cor ?> mt-2"><?= $mensagem ?></p>
        <?php } ?>
    </div>
</main>
<?php
include_once("../includes/footer.php");
?>
