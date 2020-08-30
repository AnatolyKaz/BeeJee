<?php

namespace app;
use PDO;

 class Admin
{

    protected $login;
    protected $password;
    protected $error;
    protected $hash = "svbar49929y2fhwudhnveiv";
    protected $sql;
    protected $user;
    protected $query;
    protected $pdo;

    public function __construct($login = null, $password = null, $pdo)
    {
        $this->login = $login;
        $this->password = $password;
        $this->pdo = $pdo;
    }

    
    public function Authorization()
    {
        $this->password = md5($this->password.$this->hash);
        $this->sql = "SELECT * FROM `authAdmin` WHERE `AdminLogin` = ?  && `AdminPass` = ? ";
        $this->query = $this->pdo->prepare($this->sql);
        $this->query->execute([$this->login ,$this->password]);

        $this->user = $this->query -> fetch(PDO::FETCH_OBJ);

        if($this->user == ''){
            echo 'Такого пользователя еще нет)';
        } else {
            echo 'Готово';
            setcookie('login',$this->login, time()+3600*24*30 , "/");
        }
    }
    public function Register ()
    {
        $this->password = md5($this->password.$this->hash);
        $this->sql = "INSERT INTO `authAdmin` (`AdminLogin`, `AdminPass`) VALUES (?, ?)";
        $this->query = $this->pdo->prepare($this->sql);
        $this->query->execute([$this->login,$this->password]);
        echo 'Готово';
    }
    public function Exit()
    {
        setcookie('login',$this->login, time()-3600*24*30 , "/");
        unset($_COOKIE['login']);    
    }
    public function GetTask ($taskId)
    {
        $this->sql = "SELECT * FROM `tasksList` WHERE `taskId`= ?";
        $this->query = $this->pdo->prepare($this->sql);
        $this->query->execute([$taskId]);
        $task = $this->query->fetch(PDO::FETCH_OBJ);
        echo "<div class='card mt-3' id='$task->taskId' >";
        if ($task->taskStatus == 1) {
            echo "<h5 class='userName card-header' style='background-color: green;'>$task->userName</h5>";
        }else {
            echo "<h5 class='userName card-header'>$task->userName</h5>";
        }
        echo "<div class='card-body'>
            <h5 class='card-title'>$task->email</h5>
            <p class='card-text'>$task->taskText</p>";
        echo "</div></div>";
    }

    public function NewStatus ($taskId)
    {
        $this->sql = "UPDATE `tasksList` SET `taskStatus` = 1 WHERE `taskId`= ? ";
        $this->query = $this->pdo->prepare($this->sql);
        $this->query->execute([$taskId]);
    }
    public function DeleteTask($taskId)
    {
        $this->sql = "DELETE FROM  `tasksList` WHERE `taskId`= ? ";
        $this->query = $this->pdo->prepare($this->sql);
        $this->query->execute([$taskId]);
    }
    public function EditTaskList ()
    {
        $this->sql = "SELECT * FROM `tasksList` ";
        $this->query = $this->pdo->query($this->sql);
        while ($task = $this->query->fetch(PDO::FETCH_OBJ)){
            echo "<div class='card mt-3' id='$task->taskId' >";
            if ($task->taskStatus == 1) {
                echo "<h5 class='userName card-header' style='background-color: green;'>$task->userName</h5>";
            }else {
                echo "<h5 class='userName card-header'>$task->userName</h5>";
            }
            echo "<div class='card-body'>
                <h5 class='card-title'>$task->email</h5>
                <textarea class='form-control' name='editTaskText' id='editTaskText'>$task->taskText</textarea> ";
                echo "<button type='button' task-id='$task->taskId' id='saveEdit' class='btn ml-3 mt-3 btn-danger'>Сохранить</button>";
            echo "</div></div>";
        }
    }
    public function SaveEditText ($taskId,$editText)
    {
        $this->sql = "UPDATE `tasksList` SET `taskText` = ? WHERE `taskId`= ? ";
        $this->query = $this->pdo->prepare($this->sql);
        $this->query->execute([$editText,$taskId]);
    }
}