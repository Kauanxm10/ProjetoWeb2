<?php
session_start();
if(!isset($_SESSION['logado'])) {
    header("Location: ./index.php");
    exit();
}

require_once("./app/models/Post.php");
$titulo = 'Editar Post';

if(!isset($_GET['id'])) {
    echo '<p class="alert alert-danger">ID não foi fornecido para a edição.</p>';
    exit();
}

$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

$posts = new Post();
$post = $posts->selecionarPorId($id);

if(!$post) {
    echo '<p class="alert alert-danger">Post não encontrado.</p>';
    exit();
}

require_once('./layouts/header.php');
?>

<main class="container mt-4">
    <div class="card mx-auto" style="width: 50rem;">
        <div class="card-body">
            <h2 id="p2" class="card-title text-center">Editar Post</h2>

            <form method="post" action="./app/controllers/posts.php" enctype="multipart/form-data"
                onsubmit="return confirmarEdicao();">
                <div class="mb-3">
                    <label id="t1" for="form-titulo" class="form-label">Título</label>
                    <input type="text" name="titulo" class="form-control" id="form-titulo"
                        placeholder="Informe o título do post" value="<?php echo $post->getTitulo(); ?>">
                </div>
                <div class="mb-3">
                    <label id="t1" for="form-texto" class="form-label">Texto</label>
                    <textarea name="texto" class="form-control" id="form-texto" rows="5"
                        cols="8"><?php echo $post->getTexto(); ?></textarea>
                </div>
                <input type="hidden" name="op" value="atualizar">
                <input type="hidden" name="id" value="<?php echo $post->getId(); ?>">
                <button id="bt1" type="submit" class="btn ">Atualizar</button>
            </form>
        </div>
    </div>
</main>

<script>
    function confirmarEdicao() {
        return confirm('Tem certeza que deseja atualizar este post?');
    }
</script>

<?php require_once('./layouts/footer.php'); ?>