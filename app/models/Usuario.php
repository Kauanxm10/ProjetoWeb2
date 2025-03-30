<?php
require_once('Conexao.php');

class Usuario
{
    private $id; //nao tem setId()
    private $nome;
    private $email;
    private $senha;
    private $foto;
    private $banco;

    public function __construct()
    {
        $this->banco = new Conexao();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function verificarCredenciais($email, $senha)
    {
        $sql = 'SELECT * FROM usuario WHERE email = :email AND senha = :senha';
        $conexao = $this->banco->getConexao();
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(':email', $email, PDO::PARAM_STR);
        $consulta->bindValue(':senha', $senha, PDO::PARAM_STR);
        if ($consulta->execute() == false) return false;
        return $consulta->fetchObject('Usuario');
    }

    public function salvar()
    {
        $sql = 'INSERT INTO usuario (nome, email, senha, foto) VALUES (:nome, :email, :senha, :foto)';
        $conexao = $this->banco->getConexao();
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(':nome', $this->nome, PDO::PARAM_STR);
        $consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
        $consulta->bindValue(':senha', $this->senha, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);

        try {
            $resultado = $consulta->execute();
            return $resultado;
        } catch (PDOException $e) {
            // Log or display the error message
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    
    public function selecionarPorIdUsuario($id)
    {
        $conexao = $this->banco->getConexao();
        $sql = 'SELECT * FROM usuario WHERE id = :id';
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        if ($consulta->execute() == false) return false;
        return $consulta->fetchObject('Usuario');
    }

    public function atualizar()
    {
        $sql = 'UPDATE usuario SET nome = :nome, email = :email, senha = :senha, foto = :foto WHERE id = :id';
        $conexao = $this->banco->getConexao();
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(':nome', $this->nome, PDO::PARAM_STR);
        $consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
        $consulta->bindValue(':senha', $this->senha, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);
        $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
        $resultado = $consulta->execute();
        if ($resultado == false) return false;
        return true;
    }

    public function excluir($id)
{
    $conexao = $this->banco->getConexao();
    $sql = 'DELETE FROM usuario WHERE id = :id';
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(':id', $id, PDO::PARAM_INT);
    $resultado = $consulta->execute();
    
    if ($resultado == false) {
        return false; // ou tratar o erro de exclusão de alguma forma
    }

    return true;
}

}
