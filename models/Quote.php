<?php
    class Quote {
        //DB stuff
        private $conn;
        private $table = 'quotes';

        //Quote Properties
        public $id;
        public $quote;
        public $category;
        public $author;

        //Constructor with DB

        public function __construct($db) {
            $this->conn = $db;
        }

        //Get Quotes
        public function read() {
            //Create query
            $query = "SELECT 
            a.author as author,
            c.category as category,
            q.quote
            FROM 
                $this->table q
            LEFT JOIN 
                authors a ON author_id = a.id
            LEFT JOIN
                categories c ON category_id = c.id";

        //Prepared statements
        $stmt = $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
            
        }

        //Get single quote

        public function read_single() {
             //Create query
             $query = "SELECT 
             a.author as author,
             c.category as category,
             q.quote
             FROM 
                  $this->table q
             LEFT JOIN 
                 authors a ON author_id = a.id
             LEFT JOIN
                 categories c ON category_id = c.id
             WHERE
             author_id = ? AND
             category_id = ?";

        //Prepared statements
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt->bindParam(1, $this->id);

        //Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Set properties
        //$this-id = $row['id'];
        $this->quote = $row['quote'];
        $this->author = $row['author'];
        $this->category = $row['category'];

        }
    }


?>