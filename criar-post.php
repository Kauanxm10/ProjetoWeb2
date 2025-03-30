<?php
session_start();
if (!isset($_SESSION['logado'])) {
    require_once("./index.php");
}
$titulo = 'Criar Post';
?>

<?php require_once('./layouts/header.php'); ?>

<main class="container mt-4">
    <div class="card mx-auto" style="width: 50rem;">

        <div class="card-body">
        <h2 id="p2" class="card-title text-center">Novo Post</h2>
            <?php
            if (isset($_GET['erro'])) {
                if ($_GET['erro'] == 1) {
                    echo '<p class="msg-erro alert alert-danger">Campos obrigatórios não preenchidos (Nome e Texto)</p>';
                }
            }
            ?>

            <form method="post" action="./app/controllers/posts.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label id="t1" for="form-titulo" class="form-label">Título</label>
                    <input type="text" name="titulo" class="form-control" id="form-titulo" placeholder="Informe o título do post">
                </div>
                <div class="mb-3">
                    <label id="t1" for="form-texto" class="form-label">Texto</label>
                    <textarea name="texto" class="form-control" id="form-texto" rows="5" cols="8"></textarea>
                </div>
                <input type="hidden" name="op" value="salvar">
                <button id="bt1" type="submit" class="btn btn-primary">Post</button>
            </form>
        </div>
    </div>
</main>
<?php
    if (isset($_GET['erro'])) {
        if ($_GET['erro'] == 1) {
            echo '<p style="color: red; font-family: cursive;  font-size: 180%; text-align: center;">Insira um titulo ou texto</p>';
        }
    } elseif (isset($_GET['erro']) && $_GET['erro'] == 0) {
        echo '<p style="color: red; font-family: cursive;  font-size: 180%; text-align: center;">Algo deu errado.</p>';
    }

    
    ?>

<?php require_once('./layouts/footer.php'); ?>