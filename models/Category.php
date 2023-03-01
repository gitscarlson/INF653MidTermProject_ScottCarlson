<?php
    class Category {
        //DB stuff
        private $conn;
        private $table = 'categories';

        //Category Properties
        public $id;
        public $author;

        //Constructor with DB

        public function __construct($db) {
            $this->conn = $db;
        }

        //Get Categories
        public function read() {
            //Create query
            $query = "SELECT 
            id, category
            FROM 
                $this->table
            ORDER BY id";

        //Prepared statements
        $stmt = $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
            
        }

        //Get single Category

        public function read_single() {
             //Create query
             $query = "SELECT 
             category
             FROM 
                $this->table
             WHERE
             id = ?";

        //Prepared statements
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt->bindParam(1, $this->id);

        //Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Set properties
        $this-id = $row['id'];
        $this-author = $row['category'];
        

        }
    }


?>