<?php 
namespace app;

use PDO;
use PDOException;

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