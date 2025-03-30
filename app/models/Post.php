<?php
require_once('Conexao.php');
class Post
{
    private $id;
    private $id_usuario;
    private $titulo;
    private $data;
    private $texto;

    private $banco;

    public function __construct()
    {
        $this->banco = new Conexao();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }


    public function getData()
    {
        return $this->data;
    }

    public function getTexto()
    {
        return $this->texto;
    }
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setData($data)
    {
        $this->data = $data;
    }


    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }


    public function salvar()
    {
        $sql = 'INSERT INTO post ( id_usuario, titulo, data, texto) 
                    VALUES (:id_usuario, :titulo, :data, :texto)';
        $conexao = $this->banco->getConexao();
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
        $consulta->bindValue(':titulo', $this->titulo, PDO::PARAM_STR);
        $consulta->bindValue(':data', $this->data, PDO::PARAM_STR);
        $consulta->bindValue(':texto', $this->texto, PDO::PARAM_STR);
        $resultado = $consulta->execute();
        if ($resultado == false)
            return false;
        return true;
    }

    public function selecionarTodos()
    {
        //pegar a conexao propriamente dita:
        $conexao = $this->banco->getConexao();
        $sql = 'SELECT * FROM post';
        $resultados = $conexao->query($sql);
        $registros = $resultados->fetchAll(PDO::FETCH_CLASS, 'Post');
        return $registros;
    }

    public function selecionarPorId($id)
    {
        $conexao = $this->banco->getConexao();
        $sql = 'SELECT * FROM post WHERE id = :id';
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        if ($consulta->execute() == false)
            return false;
        return $consulta->fetchObject('Post');
    }

    public function selecionarPorIdUsuario($id_usuario)
    {
        $conexao = $this->banco->getConexao();
        $sql = 'SELECT * FROM post WHERE id_usuario = :id_usuario';
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        if ($consulta->execute() == false)
            return false;

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Post');
    }

    public function excluir($id)
    {
        $conexao = $this->banco->getConexao();
        //codigo abaixo vulneravel para SQL injection, corrija!
        $retornoConsulta = $conexao->exec('DELETE FROM post WHERE id = ' . $id);
        if ($retornoConsulta)
            return true;
        return false;
    }


    public function atualizar($id)
    {
        $sql = 'UPDATE post SET titulo = :titulo,  texto = :texto WHERE id = :id';
        $conexao = $this->banco->getConexao();
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(':titulo', $this->titulo, PDO::PARAM_STR);
        $consulta->bindValue(':texto', $this->texto, PDO::PARAM_STR);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $resultado = $consulta->execute();
        if ($resultado == false) return false;
        return true;
    }

}