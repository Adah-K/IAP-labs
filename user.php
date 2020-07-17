<?php

    include "Crud.php";

    class User implements Crud{

        private $user_id;
        private $first_name;
        private $last_name;
        private $city_name;

        function __construct($first_name, $last_name, $city_name){

            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->city_name = $city_name;

        }

        public function setUserId($user_id){

            $this->user_id = $user_id;

        }
    
        public function getUserId(){

            return $this->user_id;

        }

        public function save(){

            $fn = $this->first_name;
            $ln = $this->last_name;
            $city = $this->city_name;
            
            $res = false;

            $DBConnector = new DBConnector;
            $connection = $DBConnector->conn;

            try {

                $state = $connection->prepare("INSERT INTO `user`(`first_name`, `last_name`, `user_city`) VALUES (?,?,?)");
                $state->bind_param('sss', $fn,$ln,$city);

                if ($state->execute()) {
                    
                    $res = true;

                }

            } catch (Exception $e) {

                echo "An Error Occured";

            }

            return $res;

        }

        public function readAll(){

            $sql = "SELECT * FROM `user`";
            $connector = new DBConnector;
            $res = mysqli_query($connector->conn, $sql);
            return $res;

        }

        public function readUnique(){

            return null;
            
        }

        public function search(){

            return null;
            
        }

        public function update(){

            return null;
            
        }

        public function removeOne(){

            return null;
            
        }

        public function removeAll(){

            return null;
            
        }

        public function validateForm(){

            $fn = $this->first_name;
            $ln = $this->last_name;
            $city = $this->city_name;

            if($fn == "" || $ln == "" || $city = ""){
                return false;
            }
            return true;

        }

        public function createFormErrorSessions(){
            session_start();
            $_SESSION['form_errors'] = "All fields are required";
        }

    }

?>