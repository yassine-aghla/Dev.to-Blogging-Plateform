<?php
use Dotenv\Dotenv;

require '../vendor/autoload.php'; 

class Database
{
    private $pdo;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();
        $dsn = "mysql:host=" . $_ENV['DB_SERVER'] . ";dbname=" . $_ENV['DB_NAME'] . ";charset=utf8";
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,      
            PDO::ATTR_EMULATE_PREPARES   => false,                 
        ];

        try {
            
            $this->pdo = new PDO($dsn, $username, $password, $options);
            echo "Connected successfully";
        } catch (PDOException $e) {
           
            die("Connection failed: " . $e->getMessage());
        }
    }

    
    public function getConnection()
    {
        return $this->pdo;
    }
}


$db = new Database();
$pdo = $db->getConnection();
?>
