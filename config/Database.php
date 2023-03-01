<?php
    class Database {
        //DB params 
        private $host = 'postgres://scarlson:WIWKyDcO3fYkV3loRwGKCVfarLDmIWjb@dpg-cfv14dhmbjsj9ann1ib0-a.oregon-postgres.render.com/quotesdb_ej24';
        private $port = '5432';
        private $db_name = 'quotesdb_ej24';
        private $username = 'my_blog_hnuq_user';
        private $password = '8w6gsvxlYWuyp69vsbsjbE9TTRt6fkap';
        private $conn;

        public function __construct() {
            $this->username = getenv('USERNAME');
            $this->password = getenv('PASSWORD');
            $this->dbname = getenv('DBNAME');
            $this->host = getenv('HOST');
            $this->port = getenv('PORT');
        }

        //DB connect
        public function connect () {
            if ($this->conn) {
                return $this->conn;
            } else {
                $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";

                try {
                    $this->conn = new PDO($dsn, $this->username, $this->password);
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    retun $this->conn;  
                } catch(PDOException $e) {
                    echo 'Connection Error: ' . $e->getMessage();
                }
            }
        }
    }

?>
