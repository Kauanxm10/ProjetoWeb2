<!DOCTYPE html>
<html lang="PT-br">

<head>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <title>Blog</title>
</head>


<body class="b1">
    <header>
        <nav class="navbar bg-body-tertiary " id="navcor">
            <div id="nav" class="container-fluid">
                <img src="01.png" alt="Logo">
                <a class="navbar-brand" id="navc" href="./index.php">Midnight Gospel</a>
                <button style="color: aliceblue;" class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div style="background: linear-gradient(to bottom, #78125c , #05778f)" class="offcanvas-header">
                        <h5 style="color: aliceblue;" class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div id="menu" class="offcanvas-body"
                        style=" background: linear-gradient(to bottom, #05778f, #78125c )">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <?php
                            if(isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
                                ?>
                                <li class="nav-item">
                                    <a id="a" class="nav-link" aria-current="page" href="./criar-post.php">Criar Post</a>
                                </li>
                                <li class="nav-item">
                                    <a id="a" class="nav-link" href="./meus-posts.php">Meus Posts</a>
                                </li>
                                <li class="nav-item">
                                    <a id="a" class="nav-link" href="./minha-conta.php">Minha Conta</a>
                                </li>
                                <li class="nav-item">
                                    <a id="a" class="nav-link"
                                        href="./app/controllers/autenticacao.php?op=logout">logOut</a>
                                </li>
                                <?php
                            } else {
                                ?>
                                <li class="nav-item">
                                    <a id="a" class="nav-link" aria-current="page" href="./login.php">Entrar</a>
                                </li>
                                <li class="nav-item">
                                    <a id="a" class="nav-link" href="./register.php">Registrar-se</a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <br>
        <h2 id="t22">"Porque se estás só, sabes que outros estão sós. Encontra outra pessoa só."</h2>


    </header>