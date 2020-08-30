<?php 
namespace app;

use PDO;
use PDOException;

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

class Connection
{
    public $DBHOST = 'localhost'; 
    public $DBNAME = 'todoList'; 
    public $DBUSER = 'root' ; 
    public $DBPASS = 'root'; 
   
    public $rowcount = 0; 
      
    public $pdo = 0; 
    
    public function Connect ()
    {
        $this->pdo = new PDO("mysql:host=". $this->DBHOST .";dbname=".
        $this->DBNAME, $this->DBUSER, $this->DBPASS);
        return $this->pdo;
    }
}




?>