<?php require_once('./layouts/header.php'); ?>

<main class="container mt-5">
    <div class="card mx-auto" style="width: 30rem;">
        <div class="card-body">
            <h2 id="p2" class="card-title">Cadastre-se aqui</h2>

            <?php
            if (isset($_GET['erro'])) {
                if ($_GET['erro'] == 1) {
                    echo '<p class="msg-erro">Campos obrigatórios não preenchidos (Nome, E-mail)</p>';
                }
            }
            ?>

            <form name="form-contato" method="post" action="./app/controllers/usuarios.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label id="t1" for="form-nome" class="form-label"> Nome</label>
                    <input type="text" name="nome" id="form-nome" class="form-control" placeholder="Nome Completo" required />
                </div>

                <div class="mb-3">
                    <label id="t1" for="form-email" class="form-label"> E-mail</label>
                    <input type="email" name="email" id="form-email" class="form-control" placeholder="email@dominio.com" required />
                </div>

                <div class="mb-3">
                    <label id="t1" for="form-senha" class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control" placeholder="Use caracteres especiais e números na sua senha" required>
                </div>

                <div class="mb-3">
                    <label id="t1" for="form-foto" class="form-label"> Foto</label>
                    <input type="file" name="foto" class="form-control" accept="image/png,image/jpeg" required>
                </div>

                <input type="hidden" name="op" value="cadastrar">

                <div class="mb-3">
                    <button id="bt1" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require_once('./layouts/footer.php'); ?>
