<?php

class Database
{
    static $host = 'localhost'; // Host do banco
    static $db = 'api_db';      // Nome do banco de dados
    static $user = 'root';      // Usuário do banco de dados
    static $pass = '12345';          // Senha do banco de dados (em produção, configure adequadamente)

    static private $instance;

    /**
     * Retorna a instância única do PDO para o banco de dados MySQL.
     *
     * @return PDO
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            try {
                // Conexão com MySQL
                self::$instance = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=utf8mb4",
                    self::$user,
                    self::$pass,
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] // Configura modo de erro
                );
            } catch (PDOException $e) {
                // Exibe o erro de conexão
                echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
                exit;
            }
        }
        return self::$instance;
    }
}
