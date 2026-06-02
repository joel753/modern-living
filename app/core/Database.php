<?php
/**
 * CLASSE DATABASE - Gestion de la connexion PDO
 */

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
            
            $this->pdo = new PDO(
                $dsn,
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
            
            Logger::info('Connexion à la base de données réussie');
        } catch (PDOException $e) {
            Logger::error('Erreur de connexion BD: ' . $e->getMessage());
            die('Erreur de connexion à la base de données');
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }

    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            Logger::error('Erreur SQL: ' . $e->getMessage());
            throw $e;
        }
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}
?>