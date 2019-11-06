<?php

    class Todo {
        protected $conn;
        protected $action = '';
        private $sql;
        private $todo = array();
        private $row;
        public static $result = array('error'=>false);
       

        public function connect(){
            $this->conn = mysqli_connect('localhost', 'root', '', 'todo_list');

            if(!$this->conn){
                echo 'Connection error: ' . mysqli_connect_error();
            }
        }

        public function createTable(){
            $this->sql = $this->conn->query("CREATE TABLE IF NOT EXISTS todo (
                id int NOT NULL AUTO_INCREMENT,
                title varchar(255) NOT NULL,
                compleated int NOT NULL,
                PRIMARY KEY (id)
                );");
        }

        public function get(){
            if(isset($_GET['action'])){
                $this->action = $_GET['action'];
            }
        }

        public function read(){
            if($this->action == 'read'){
                $this->sql = $this->conn->query("SELECT * FROM todo");
                $this->todo = array();
                while($this->row = $this->sql->fetch_assoc()){
                    array_push($this->todo, $this->row);
                }
                Todo::$result['todo'] = $this->todo;
            }
        }

        public function create(){
            if($this->action == 'create'){
                $title = $_POST['title'];
                $this->sql = $this->conn->query("INSERT INTO todo (title) values('$title')");
                
            }
        }

        public function delete(){
            if($this->action == 'delete'){
                $id = $_POST['id'];
                $this->sql = $this->conn->query("DELETE FROM todo WHERE id='$id'");
            }
        }

        public function makeCompleated(){
            if($this->action == 'compleated'){
                $id = $_POST['id'];
                $this->sql = $this->conn->query("UPDATE todo SET compleated = 1 WHERE id='$id'");
            }
        }

        public function makeUnCompleated(){
            if($this->action == 'makeU'){
                $id = $_POST['id'];
                $this->sql = $this->conn->query("UPDATE todo SET compleated = 0 WHERE id='$id'");
            }
        }

        public function deleteCompleated(){
            if($this->action == 'deleteC'){
                $this->sql = $this->conn->query("DELETE FROM todo WHERE compleated = 1");
            }
        }

        public function filterActive(){
            if($this->action == 'factive'){
                $this->sql = $this->conn->query("SELECT * FROM todo WHERE compleated = 0");
                $this->todo = array();
                while($this->row = $this->sql->fetch_assoc()){
                    array_push($this->todo, $this->row);
                }
                Todo::$result['todo'] = $this->todo;
            }
        }

        public function filterCompleated(){
            if($this->action == 'fcompleated'){
                $this->sql = $this->conn->query("SELECT * FROM todo WHERE compleated = 1");
                $this->todo = array();
                while($this->row = $this->sql->fetch_assoc()){
                    array_push($this->todo, $this->row);
                }
                Todo::$result['todo'] = $this->todo;
            }
        }


        public function close_conn(){
            $this->conn->close();
        }
    }

    $todoOne = new Todo();
    echo $todoOne->connect();
    $todoOne->createTable();
    $todoOne->get();
    $todoOne->read();
    $todoOne->create();
    $todoOne->delete();
    $todoOne->makeCompleated();
    $todoOne->makeUnCompleated();
    $todoOne->deleteCompleated();
    $todoOne->filterActive();
    $todoOne->filterCompleated();
    echo json_encode(Todo::$result);
    $todoOne->close_conn();

?>