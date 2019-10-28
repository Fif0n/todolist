<?php

    class Todo {
        protected $conn;
        
        // public function __construct(){
            
        // }
        public function connect(){
            $this->conn = mysqli_connect('localhost', 'fifon', 'test1234', 'todo_list');

            if(!$this->conn){
                echo 'Connection error: ' . mysqli_connect_error();
            }

        }
    }

    $todoOne = new Todo();
    echo $todoOne->connect();

?>