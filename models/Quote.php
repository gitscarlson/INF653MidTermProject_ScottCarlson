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
            q.quote, 
            q.id
            FROM 
                {$this->table} q
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
             q.quote,
             q.id
             FROM 
                  {$this->table} q
             LEFT JOIN 
                 authors a ON author_id = a.id
             LEFT JOIN
                 categories c ON category_id = c.id
             WHERE
             q.id = ?";

        //Prepared statements
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt->bindParam(1, $this->id);

        //Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if( is_array($row) ) {

            $this->quote = $row['quote'];
            $this->author = $row['author'];
            $this->category = $row['category'];
            
        } else{
            return;
        }
        //Set properties
        //$this-id = $row['id'];
        

        }

        //Create Quote
        public function create() {
            //create query
            $query = "INSERT INTO {$this->table} (quote, author_id, category_id)
            VALUES (:quote, :author_id, :category_id)";

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->quote = htmlspecialchars(strip_tags($this->quote));

            //Bind data from above
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':category_id', $this->category_id);

            //execute query
            if ($stmt->execute()) {
                $lastId = $this->conn->lastInsertId();
                return true;
            }
            //print error if something goes wrong
            else{           
            printf("Error: %s. \n", $stmt->error);

            return false;
            }
        }

        //Delete Quote
        public function delete() {
            //Create delete query
            $query = "DELETE FROM {$this->table} WHERE id = :id";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind data from above
            $stmt->bindParam(':id', $this->id);

            //execute query
            if ($stmt->execute()) {
                return true;
            }
            //print error if something goes wrong
            else{           
            printf("Error: %s. \n", $stmt->error);

            return false;
            }

        }
    }


?>