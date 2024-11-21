<?php
require_once '../config/db.php';

class Game
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Função para criar um novo jogo
    public function create($nome, $descricao, $preco, $id_jogo, $ano)
    {
        $sql = "INSERT INTO jogos (nome, descricao, preco, id_jogo, ano) VALUES (:nome, :descricao, :preco, :id_jogo, :ano)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':id_jogo', $id_jogo);
        $stmt->bindParam(':ano', $ano);
        return $stmt->execute();
    }

    // Função para listar todos os jogos
    public function list()
    {
        $sql = "SELECT * FROM jogos";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Função para buscar um jogo pelo ID
    public function getById($id_jogo)
    {
        $sql = "SELECT * FROM jogos WHERE id_jogo = :id_jogo";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_jogo', $id_jogo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Função para atualizar os dados de um jogo
    public function update($id_jogo, $nome, $descricao, $preco, $ano)
    {
        $sql = "UPDATE jogos SET nome = :nome, descricao = :descricao, preco = :preco, ano = :ano WHERE id_jogo = :id_jogo";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_jogo', $id_jogo);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':ano', $ano);
        $stmt->execute();
        return $stmt->rowCount();
    }

    // Função para deletar um jogo
    public function delete($id_jogo)
    {
        $sql = "DELETE FROM jogos WHERE id_jogo = :id_jogo";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_jogo', $id_jogo);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
?>
