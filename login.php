<?php
$titulo = 'Página de Login';
require_once("./layouts/header.php");
?>


<?php
// Display error messages if any
if(isset($_GET['erro']) && $_GET['erro'] == 1) {
    echo '<p style="color: red; font-family: cursive;  font-size: 180%; text-align: center;"">Campos Obrigatorios.</p>';
} elseif(isset($_GET['erro']) && $_GET['erro'] == 2) {
    echo '<p style="color: red; font-family: cursive;  font-size: 180%; text-align: center;"">Senha ou E-mail invalidos.</p>';
}
?>



<?php require_once("./layouts/footer.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Login Form</title>
</head>

<body>
    <div class="container mt-5">
        <div class="card mx-auto" style="width: 30rem;">
            <div class="card-body">
                <h3 id="p2" class="card-title text-center">Login</h3>
                <form action="./app/controllers/autenticacao.php" method="post">
                    <div class="mb-3">
                        <label id="t1" for="email" class="form-label">Email</label>
                        <input class="form-control" type="email" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label id="t1" class="form-label" for="senha">Senha</label>
                        <input class="form-control" type="password" id="senha" name="senha" required>
                    </div>
                    <input type="hidden" name="op" value="login">

                    <button id="bt1" class="btn btn-primary" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>