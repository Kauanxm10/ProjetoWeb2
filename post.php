<?php
session_start();
require_once('./app/models/Post.php');
require_once('./app/models/Usuario.php');


$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);


$posts = new Post();
$post = $posts->selecionarPorId($id);

if ($post) {

    $id_usuario_post = $post->getIdUsuario(); 


    $usuarios = new Usuario();
    $usuario = $usuarios->selecionarPorIdUsuario($id_usuario_post);

    require_once('./layouts/header.php');
?>

<main class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-4">
                <div class="card-body">
                    <h2 id="h31" class="card-title">
                        <?php echo $post->getTitulo(); ?>
                    </h2>
                    <p id="p2" class="card-text">
                        <?php echo $post->getTexto(); ?>
                    </p>
                    <p id="date1" class="card-date">
                        <?php echo $post->getData(); ?>
                    </p>
                    <?php if ($usuario) { ?>
                        <p id="a" class="mb-2">Postado por: <?php echo $usuario->getNome(); ?></p>
                    <?php } else { ?>
                        <p class="mb-2">Autor desconhecido</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php 
} else {
    require_once('./layouts/header.php');
?>
    <div class="alert alert-warning mt-4">
        <p>Nenhum post encontrado </p>
    </div>
<?php 
}
require_once('./layouts/footer.php');
?>