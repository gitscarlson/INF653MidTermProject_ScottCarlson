<?php
    class Author {
        //DB stuff
        private $conn;
        private $table = 'authors';

        //Author Properties
        public $id;
        public $author;

        //Constructor with DB

        public function __construct($db) {
            $this->conn = $db;
        }

        //Get Authors
        public function read() {
            //Create query
            $query = "SELECT 
            id, author
            FROM 
                {$this->table}
            ORDER BY id";

        //Prepared statements
        $stmt = $this->conn->prepare($query);

        //Execute query
        $stmt->execute();
        
        return $stmt;
            
        }

        //Get single Author

        public function read_single() {
             //Create query
             $query = "SELECT 
             author
             FROM 
                {$this->table}
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
            //$this->id = $row['id'];
            $this->author = $row['author'];
        
        }

        //Create Author
        public function create() {
            //create query
            $query = "INSERT INTO {$this->table} 
            SET author = :author";

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->author = htmlspecialchars(strip_tags($this->author));

            //Bind data from above
            $stmt->bindParam(':author', $this->author);

            //execute query
            if ($stmt->execute()) {
                return true;
            }

            //print error if something goes wrong
            printf("Error: %s. \n", $stmt->error)

            return false;
        }
    }


?>