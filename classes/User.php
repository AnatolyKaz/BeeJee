<?php 
namespace app;
use PDO;

 class User 
{
    protected $UserName ;
    protected $UserMail ;
    protected $taskText ;
    protected $sql;
    protected $query;
    protected $pdo;

    public function __construct($UserName , $UserMail , $taskText  , $pdo)
    {
        $this->UserName = $UserName;
        $this->UserMail = $UserMail;
        $this->taskText = $taskText;
        $this->pdo = $pdo;
    }
    public function InsertTask ()
    {
        
        $this->sql = "INSERT INTO `tasksList` (`userName`, `email`, `taskText`) VALUES (?, ?, ?)";
        $this->query = $this->pdo->prepare($this->sql);
        $this->query->execute([$this->UserName,$this->UserMail,$this->taskText]);
        echo 1 ;
    }
    public function TaskList ($sql)
    {
        $this->query = $this->pdo->query($sql);
        while ($task = $this->query->fetch(PDO::FETCH_OBJ)){
            echo "<div class='card mt-3' id='$task->taskId' >";
            if ($task->taskStatus == 1) {
                echo "<h5 class='userName card-header' style='background-color: green;'>$task->userName</h5>";
            }else {
                echo "<h5 class='userName card-header'>$task->userName</h5>";
            }
            echo "<div class='card-body'>
                <h5 class='card-title'>$task->email</h5>
                <p class='card-text'>$task->taskText</p>";
            if (isset($_COOKIE['login'])) {
                echo "";
                echo "<button type='button' task-id='$task->taskId' id='deleteTask' class='btn ml-3 btn-danger'>Удалить</button>";
                if ($task->taskStatus != 1) {
                echo "<button type='button' task-id='$task->taskId' id='newStatus' class='btn ml-3 btn-success'>Выполнено</button>";
                }
            }
            echo "</div></div>";
        }
                
    }

}