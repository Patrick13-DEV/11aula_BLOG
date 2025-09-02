<?php
include_once("constante.php");
include_once("service/conexao.php");
include_once("includes/header.php");
 // conexao com o banke de dados para aparecer os posts de acordo com o ordem da data do post em forma descrecente
$sql = "SELECT * FROM posts ORDER BY DATAPOST DESC";
$select = $conexao->prepare($sql);
$select->execute();
$posts = $select->fetchAll(PDO::FETCH_ASSOC);
// isso é pra selecionar tudo do da tabela comentarios para o IDpost onde é igual o post da tabela//
$sqlcomentarios =" SELECT * FROM comentarios WHERE IDPOST = 18";
$select = $conexao->prepare($sqlcomentarios);
$select->execute();
$comentarios = $select->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container mt-5">
	<h2>Últimos Posts</h2>
	<div class="row"> 
		<?php foreach ($posts as $post) { ?>    <!-- isso e pra fazer o loop dos posts-->
			<div class="col-md-4 mb-4">
				<div class="card h-100">    
					<?php if (!empty($post['IMAGEM'])) { ?>   <!-- o ! e um operador logico de NOT e empty -->
						<img src="img-posts/<?= htmlspecialchars($post['IMAGEM']) ?>" class="card-img-top h-50 w-auto " alt="<?= htmlspecialchars($post['TITULO'])?>">
					<?php } ?>
					<div class="card-body">
						<h5 class="card-title"><?= htmlspecialchars($post['TITULO'])?></h5>
						<p class="card-text"><?= htmlspecialchars($post['RESUMO']) ?></p>
						<hr>
						<div class="card-text"><?=htmlspecialchars($post['DESCRICAO'])?></div>
						<a href="./screens/detalhespost.php?id=<?= $post['ID_POST'] ?>" class="col-12 btn btn-primary">Ver detalhes</a>
					</div>
					<div class="card-footer text-muted">
						<?= date('d/m/Y H:i', strtotime($post['DATAPOST'])) ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</main>
<?php include_once("includes/footer.php"); ?>
<?php

