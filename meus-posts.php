<?php
session_start();
require_once('./app/models/Post.php');
$id_usuario = $_SESSION['id'];
$posts = new Post();
$lista_posts = $posts->selecionarPorIdUsuario($id_usuario);

require_once('./layouts/header.php');
?>


<section class="container">
    <div class="row">

        <?php foreach($lista_posts as $item) { ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 id="h31" class="card-title">
                            <?php echo $item->getTitulo(); ?>
                        </h3>
                        <p id="p2" class="card-text">
                            <?php echo $item->getTexto(); ?>
                        </p>
                        <p id="date1" class="card-date">
                            <?php echo $item->getData(); ?>
                        </p>
                        <a id="bt1" href="post.php?id=<?php echo $item->getId(); ?>" class="btn ">Ver mais detalhes</a>
                        <a id="bt2" href="editar-post.php?id=<?php echo $item->getId(); ?>" class="btn ">Editar post</a>
                        <a id="bt3" href="javascript:void(0);" onclick="confirmarExclusao(<?php echo $item->getId(); ?>)"
                            class="btn">Excluir</a>


                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<?php
if(isset($_GET['sucesso'])) {
    if($_GET['sucesso'] == 1) {
        echo '<p style="color: green;  font-family: cursive;  font-size: 180%; text-align: center;">Post criado com sucesso</p>';
    }
    if($_GET['sucesso'] == 2) {
        echo '<p style="color: green;  font-family: cursive;  font-size: 180%; text-align: center;">Post editado com sucesso</p>';
    }
    if($_GET['sucesso'] == 3) {
        echo '<p style="color: green;  font-family: cursive;  font-size: 180%; text-align: center;">Post excluido com sucesso</p>';
    }
}
if(isset($_GET['erro'])) {
    if($_GET['erro'] == 0) {
        echo '<p style="color: red;  font-family: cursive;  font-size: 180%; text-align: center;">Algo deu errado</p>';
    }
    if($_GET['erro'] == 1) {
        echo '<p style="color: red;  font-family: cursive;  font-size: 180%; text-align: center;">Erro ao excluir o post</p>';
    }
}
?>
<script>
    function confirmarExclusao(id) {
        var resposta = confirm("Tem certeza de que deseja excluir esse post?");
        if (resposta) {
            window.location.href = "./app/controllers/posts.php?op=excluir&id=" + id;
        }
    }
</script>
<?php require_once('./layouts/footer.php'); ?>