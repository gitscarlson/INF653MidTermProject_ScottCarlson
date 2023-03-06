<?php
    class Database {
        //DB params 
        //private $host = 'localhost';
        //private $port = '5432';
        //private $db_name = 'quotesdb';
        //private $username = 'postgres';
        //private $password = 'EmmntYY4!';
        //private $conn;

        //DB params for Render
        private $host;
        private $port;
        private $dbname;
        private $username;
        private $password;
        private $conn;


         public function __construct() {
             $this->username = getenv('USERNAME');
             $this->password = getenv('PASSWORD');
             $this->dbname = getenv('DBNAME');
             $this->host = getenv('HOST');
             $this->port = getenv('PORT');

         }

        //DB connect for Render - NEW
         public function connect () {
             if ($this->conn) {
                 return $this->conn;
             } else {
                 $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname};";

                 try {
                     $this->conn = new PDO($dsn, $this->username, $this->password);
                     $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                     return $this->conn;  
                 } catch(PDOException $e) {
                     echo 'Connection Error: ' . $e->getMessage();
                 }
             }
         }

         /*
        //DB Connect for localhost
        public function connect() {
            $this->conn = null;
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";

            try {
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOexception $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
            return $this->conn;
        }
        */
    }

?>
