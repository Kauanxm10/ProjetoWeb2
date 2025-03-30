<?php
session_start();
require_once('./app/models/Usuario.php');
$usuarios = new Usuario();
if(isset($_SESSION['id'])) {
    $secao = $_SESSION['id'];
    $usuario = $usuarios->selecionarPorIdUsuario($secao);
} else {
}
require_once('./layouts/header.php');
?>

<main class="container mt-5">
    <div class="card mx-auto" style="width: 30rem;">
        <div class="card-body">
            <h2 id="p2" class="card-title">Alterar seus dados</h2>

            <form name="form-contato" method="post" action="./app/controllers/usuarios.php"
                enctype="multipart/form-data">
                <div class="mb-3">
                    <label  id="t1" for="form-nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="form-nome" class="form-control" size="20"
                        placeholder="Nome Completo" value="<?php echo $usuario->getNome(); ?>">
                </div>

                <div class="mb-3">
                    <label  id="t1" for="form-email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="form-email" class="form-control" size="20"
                        placeholder="email@dominio.com" value="<?php echo $usuario->getEmail(); ?>">
                </div>

                <div class="mb-3">
                    <label  id="t1" for="form-senha" class="form-label">Nova senha</label>
                    <input type="password" name="nova_senha" class="form-control"
                        placeholder="Usar caracteres especiais e números em sua senha" size="20">
                </div>

                <div class="mb-3">
                    <label  id="t1" for="form-foto" class="form-label">Foto</label>
                    <input type="file" name="foto" class="form-control" accept="image/png,image/jpeg" required>
                    <input type="hidden" name="op" value="atualizar">
                </div>

                <div class="mb-3">
                    <button id="bt1" class="btn btn-primary">Enviar</button>
                </div>
            </form>
           
        </div>
    </div>
</main>

<?php
if(isset($_GET['sucesso'])) {
    if($_GET['sucesso'] == 3) {
        echo '<p style="color: green; font-family: cursive;  font-size: 180%; text-align: center;">Dados atualizados com sucesso.</p>';
    }
}

if(isset($_GET['erro'])) {
    if($_GET['erro'] == 2) {
        echo '<p style="color: red; font-family: cursive;  font-size: 180%; text-align: center;">Erro ao atualizar cadastro.</p>';
    }
    if($_GET['erro'] == 3) {
        echo '<p style="color: red;">Insira uma foto do usuário.</p>';
    }
}
?>

<?php require_once('./layouts/footer.php'); ?>