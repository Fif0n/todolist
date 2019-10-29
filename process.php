<?php

    class Todo {
        protected $conn;
        protected $action = '';
        private $sql;
        private $users = array();
        private $row;
        public static $result;
        private $title;
        private $id;
        // public function __construct(){
            
        // }
        public function connect(){
            $this->conn = mysqli_connect('localhost', 'fifon', 'test1234', 'todo_list');

            if(!$this->conn){
                echo 'Connection error: ' . mysqli_connect_error();
            }


        }
        public function get(){
            if(isset($_GET['action'])){
                $this->action = $_GET['action'];
            }
        }
        public function read(){
            if($this->action == 'read'){
                $this->sql = $this->conn->query("SELECT * FROM todo");
                while($this->row = $this->sql->fetch_assoc()){
                    array_push($this->users, $this->row);
                }
                return Todo::$result['users'] = $this->users;
            }
        }
        public function create(){
            
            
            if($this->action == 'create'){
                $this->title = $_POST['title'];
                $this->sql = $this->conn->query("INSERT INTO todo (title) values('$this->title')");
                
            }
        }
        public function delete(){
            
           
            if($this->action == 'delete'){
                $this->id = $_POST['id'];
                $this->sql = $this->conn->query("DELETE FROM todo WHERE id='$this->id'");
            }
        }
        public function close_conn(){
            $this->conn->close();
        }
    }

    $todoOne = new Todo();
    echo $todoOne->connect();
    $todoOne->get();
    $todoOne->read();
    $todoOne->create();
    $todoOne->delete();
    echo json_encode(Todo::$result);
    $todoOne->close_conn();

?>