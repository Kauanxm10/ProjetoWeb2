<?php
session_start();
require_once('./app/models/Post.php');
$post = new Post();
$lista = $post->selecionarTodos();
require_once('./layouts/header.php');
?>


<section class="container mt-4">
    <div class="row">
        <?php foreach($lista as $index => $item) { ?>
            <?php if($index % 3 == 0) { ?>
            </div>
            <div class="row">
            <?php } ?>

            <div class="col-md-4 mb-4">
                <div class="card border-white">
                    <div class="card-body">
                        <h3 id="h31" class="card-title">
                            <?php echo $item->getTitulo(); ?>
                        </h3>
                        <p id="p2" class="card-text">
                            <?php echo substr($item->getTexto(), 0, 150).'...'; ?>
                        </p>
                        <p id="date1" class="card-text">
                            <?php echo $item->getData(); ?>
                            </small>
                        </p>
                        <a id="bt1" href="post.php?id=<?php echo $item->getId(); ?>" class="btn ">Ver mais detalhes</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<?php
if(isset($_GET['sucesso'])) {
    if($_GET['sucesso'] == 3) {
        echo '<p style="color: green; font-family: cursive;  font-size: 180%; text-align: center;">Login efetuado com sucesso.</p>';
    }
    if($_GET['sucesso'] == 1) {
        echo '<p style="color: green; font-family: cursive;  font-size: 180%; text-align: center;">Logout executado.</p>';
    }
    if($_GET['sucesso'] == 2) {
        echo '<p style="color: green; font-family: cursive;  font-size: 180%; text-align: center;">Cadastro realizado.</p>';
    }
    if($_GET['sucesso'] == 5) {
        echo '<p style="color: green; font-family: cursive;  font-size: 180%; text-align: center;">Usuario excluido com sucesso.</p>';
    }

}

if(isset($_GET['erro'])) {
    if($_GET['erro'] == 1) {
        echo '<p style="color: red;">Campos obrigatórios não preenchidos</p>';
    }
}
?>


<?php require_once("./layouts/footer.php"); ?>