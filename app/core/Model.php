<?php
/**
 * Base Model class
 * 
 * This class provides a database connection that can be used by all models.
 * It uses PDO for secure database interactions with exception handling enabled.
 */
class Model
{
    protected $db;

    public function __construct()
    {
        // Database connection settings
        $dsn = 'mysql:host=localhost;port=3306;dbname=misc;charset=utf8mb4';
        $username = 'root';
        $password = 'root';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch results as associative arrays
            PDO::ATTR_EMULATE_PREPARES => false, // Use real prepared statements
        ];

        try {
            $this->db = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }
}
