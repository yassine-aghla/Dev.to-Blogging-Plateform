<?php
use Dotenv\Dotenv;

require __DIR__ . '/../../vendor/autoload.php';


class Database
{
    private static $pdo;

    public static function getConnection()
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
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
            
            self::$pdo = new PDO($dsn, $username, $password, $options);
            // echo "Connected successfully";
        } catch (PDOException $e) {
           
            die("Connection failed: " . $e->getMessage());
        }

        return self::$pdo;
    }

    
    // public static function getConnection()
    // {
    //     return self::$pdo;
    // }
}


$db = new Database();
$pdo = $db->getConnection();

$sql = "SELECT id, name FROM categories";
$stmt = $pdo->query($sql);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT id, name FROM tags";
$stmt = $pdo->query($sql);
$tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

