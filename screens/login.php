<?php
include_once("../constante.php");
include_once("../includes/header.php");

?>

<div class="d-flex justify-content-center mt-5">
    <main class=" w-25 form-signin">
        <form action="<?= ROOT_PATH ?>src/loginUsuario.php" method="post">
            <h1 class="h3 mb-3 fw-normal"> Logar Senac - Blog</h1>

            <div class="  form-floating">
                <input type="email"
                    class="form-control"
                    placeholder="name@email.com"
                    name="txtEmail"
                    id="floatingEmail">
                <label for="floatingEmail">Email</label>
            </div>

            <div class="  form-floating">
                <input
                    type="password"
                    class="form-control"
                    placeholder="*****"
                    name="txtSenha"
                    id="floatingSenha">
                    <i id="olho" class="bi bi-eye"></i>
                <label for="floatingSenha">Senha</label>
            </div>

            <button type="submit" class="w-100 btn btn-lg btn-primary  mt-3 mb-2">Logar</button>
        </form>

        <div>
            <?php if (isset($mensagem)) { ?>
                <p class="alert <?= $cor ?> mt-2"><?= $mensagem ?></p>
            <?php } ?>
        </div>

        <a class="link -6" aria-current="page" href="<?= ROOT_PATH ?>./screens/cadastrar.php">Ja tenho o cadastro</a>

    </main>
</div>
</html>

<?php
include_once("../includes/footer.php")
?>