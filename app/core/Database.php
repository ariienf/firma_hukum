<?php
// ================= Kelas Database (PDO) =================
// Memakai prepared statement untuk mencegah SQL injection.

class Database
{
    private $pdo;
    private $stmt;

    public function __construct()
    {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $opt);
        } catch (PDOException $e) {
            die('Koneksi database gagal: ' . $e->getMessage());
        }
    }

    public function query($sql)
    {
        $this->stmt = $this->pdo->prepare($sql);
        return $this;
    }

    public function bind($param, $value)
    {
        $this->stmt->bindValue($param, $value);
        return $this;
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function resultSet()   // banyak baris
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    public function single()      // satu baris
    {
        $this->execute();
        return $this->stmt->fetch();
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}
