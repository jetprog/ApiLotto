<?php

    class db{

        //Attributes
        private $dbhost = 'localhost';
        private $dbUser = 'root';
        private $dbpass = '';
        private $dbname = 'Lotto509';



        //Function to connect
        public function connect(){

            $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
            $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnection;

        }


    }