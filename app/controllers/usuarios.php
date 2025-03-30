<?php
require_once('../models/Usuario.php');
session_start();
$opcao = $_REQUEST['op'];

$usuarios = new Usuario();
switch ($opcao) {
    case 'cadastrar':
        cadastrar();
        break;
    case 'editar':
        editar();
        break;
    case 'atualizar':
        if (isset($_SESSION['id'])) {
            $secao = $_SESSION['id'];
            $usuario = $usuarios->selecionarPorIdUsuario($secao);
            atualizar($secao);
        } else {
        }
        break;

    case 'excluir':
        if (isset($_SESSION['id'])) {
            $secao = $_SESSION['id'];
            excluir($secao);
        } else {
        }
        break;
}
function cadastrar()
{
    if (empty($_POST['email']) || empty($_POST['senha'])) {
        header('Location: ../../register.php?erro=1');
        return false;
    }


    $nome = filter_var($_POST['nome'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $senha = sha1($_POST['senha'] . $email);

    $foto = uploadArquivoUsuario('foto', 'usuarios');
    if ($foto === false) {
        return false;
    }

    
    $usuario = new Usuario();
    $usuario->setNome($nome);
    $usuario->setEmail($email);
    $usuario->setSenha($senha);
    $usuario->setFoto($foto);

  
    if ($usuario->salvar()) {
        header('Location: ../../index.php?sucesso=2');
        return true;
    } else {
        header('Location: ../../register.php?erro=0');
        return false;
    }
}

function uploadArquivoUsuario($indiceArquivo, $diretorio)
{

    if ($_FILES[$indiceArquivo]['size'] <= 2000000) {

        $tiposValidos = ['image/png', 'image/jpeg'];
        $tipo = mime_content_type($_FILES[$indiceArquivo]['tmp_name']);

        if (in_array($tipo, $tiposValidos)) {

            $nomefoto = trim($_FILES[$indiceArquivo]['name']);
            $nomefoto = str_replace(' ', '-', $nomefoto);
            $nomefoto = preg_replace('/[^a-zA-Z0-9-.]/', '', $nomefoto);
            $partesNome = explode('.', $nomefoto);
            // var_dump($partesNome);
            $aleatorio = mt_rand(1111111, 9999999);
            $nomefoto = $partesNome[0] . $aleatorio . $partesNome[1];
            // echo 'novo nome.' . $partesNome[1];
            // exit;

            $mover = move_uploaded_file(
                $_FILES[$indiceArquivo]['tmp_name'],
                "../../assets/img/$diretorio/" . $nomefoto
            );

            if ($mover) {
                return $nomefoto;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    return false;
}

function atualizar($id)
{
    if (!$id) {
      
        return false;
    }
    //validacao de campos obrigatórios
    if (empty($_POST['email'])) {

        return false;
    }
    //sanitization + persistence
    $nome = filter_var($_POST['nome'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (empty($nome))
        $nome = '';
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $usuarios = new Usuario();
    $usuario = $usuarios->selecionarPorIdUsuario($id);

    $usuario->setNome($nome);
    $usuario->setEmail($email);


    if (!empty($_POST['nova_senha'])) {
        $senha = sha1($_POST['nova_senha'] . $email); 
        $usuario->setSenha($senha);
    }
   
    $foto = uploadArquivoUsuario('foto', 'usuarios');
    if ($foto === false) {
        header('Location: ../../editar-cadastro.php?erro=2');
        return false;
    }
    $usuario->setFoto($foto);

    if ($usuario->atualizar() == false) {
        header('Location: ../../editar-cadastro.php?erro=3');
        return false;
    }
    header('Location: ../../minha-conta.php?sucesso=3');
    return true;
}

function excluir($id)
{
    $usuarios = new Usuario();
    $usuario = $usuarios->selecionarPorIdUsuario($id);

    if ($usuario->excluir($id)) {
        // Exclusão bem-sucedida

        session_destroy();
        header('Location: ../../index.php?sucesso=5');
        return true;
    } else {
        // Falha na exclusão
        header('Location: ../../minha-conta.php?erro=0');
        return false;
    }


}