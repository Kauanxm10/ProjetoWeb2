<?php
session_start();
require_once('./app/models/Usuario.php');
$usuarios = new Usuario();
if (isset($_SESSION['id'])) {
    $secao = $_SESSION['id'];
    $usuario = $usuarios->selecionarPorIdUsuario($secao);
} else {
}
require_once('./layouts/header.php');
?>
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 300px;">
        <img class="card-img rounded-circle border "
            src="./assets/img/usuarios/<?= $usuario->getFoto() ?>" alt="Foto do Usuario">
        <div class="card-body text-center">
            <h5 id="name1" class="card-title mb-1">
                <?= $usuario->getNome() ?>
            </h5>
            <p id="name1" class="card-text mb-1">
                <?= $usuario->getEmail() ?>
            </p>
            <a id="bt3" href="./app/controllers/usuarios.php?op=excluir&id=<?php echo $usuario->getId(); ?>" class="btn ">Excluir</a>
            <a id="bt2" href="editar-cadastro.php?id=<?php echo $usuario->getId(); ?>" class="btn ">Editar</a>
        </div>
    </div>
</div>
<?php
if (isset($_GET['sucesso'])) {
    if ($_GET['sucesso'] == 1) {
        echo '<p class="text-success">Usuário excluído com sucesso.</p>';
    }
}

if (isset($_GET['erro'])) {
    if ($_GET['erro'] == 0) {
        echo '<p class="text-danger">Falha ao excluir os dados</p>';
    }
}
?>

<?php require_once("./layouts/footer.php"); ?>
