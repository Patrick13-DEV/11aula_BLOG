<?php








?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/signin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <title>Blog - login</title>
</head>

<body class="tetx-center">

    <main class="form-signin">
        <form action="" method="post">
            <h1 class="h3 mb-3 fw-normal"> Logar Senac - Blog</h1>



            <div class=" form-floating">
                <input type="text"
                    class="form-control"
                    placeholder="Nome"
                    name="txtNome"
                    id="floatingNome">
                <label for="floatingNome">Nome</label>
            </div>


            <div class=" form-floating">
                <input type="email"
                    class="form-control"
                    placeholder="name@email.com"
                    name="txtEmail"
                    id="floatingEmail">
                <label for="floatingEmail">Email</label>
            </div>

            <div class=" form-floating">
                <input
                    type="text"
                    class="form-control"
                    placeholder="*****"
                    name="txtSenha"
                    id="floatingSenha">
                <label for="floatingSenha">Senha</label>
            </div>

            <button type="submit" class="w-100 btn btn-lg btn-primary mb-2">Cadastrar</button>
        </form>
        <a class="link -6" aria-current="page" href="./cadastrar.php">Ja tenho o cadastro</a>
        <p class=" mt-5 mb-3 text-muted"> &copy; Turma 202400005 2025</p>



    </main>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>