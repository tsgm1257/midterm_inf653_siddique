<?php

// Quote.php

class Quote {
    private $conn;
    private $table_name = "quotes";

    public $id;
    public $quote;
    public $author_id;
    public $category_id;
    public $author;
    public $category;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT q.id, q.quote, a.author, c.category FROM " . $this->table_name . " q JOIN authors a ON q.author_id = a.id JOIN categories c ON q.category_id = c.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readSingle() {
    $query = "SELECT q.id, q.quote, a.author, c.category FROM " . $this->table_name . " q JOIN authors a ON q.author_id = a.id JOIN categories c ON q.category_id = c.id WHERE q.id = ? LIMIT 1 OFFSET 0"; // Modified line
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $this->quote = $row['quote'];
        $this->author = $row['author'];
        $this->category = $row['category'];
    } else {
        $this->quote = null;
        $this->author = null;
        $this->category = null;
    }
}

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (quote, author_id, category_id) VALUES (:quote, :author_id, :category_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":quote", $this->quote);
        $stmt->bindParam(":author_id", $this->author_id);
        $stmt->bindParam(":category_id", $this->category_id);
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId(); // Retrieve the last inserted ID
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET quote = :quote, author_id = :author_id, category_id = :category_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":quote", $this->quote);
        $stmt->bindParam(":author_id", $this->author_id);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":id", $this->id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    
    public function readByAuthor($author_id) {
        $query = "SELECT q.id, q.quote, a.author, c.category FROM " . $this->table_name . " q JOIN authors a ON q.author_id = a.id JOIN categories c ON q.category_id = c.id WHERE q.author_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $author_id);
        $stmt->execute();
        return $stmt;
    }
    
    public function readByCategory($category_id) {
        $query = "SELECT q.id, q.quote, a.author, c.category FROM " . $this->table_name . " q JOIN authors a ON q.author_id = a.id JOIN categories c ON q.category_id = c.id WHERE q.category_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $category_id);
        $stmt->execute();
        return $stmt;
    }
    
    public function readByAuthorAndCategory($author_id, $category_id) {
        $query = "SELECT q.id, q.quote, a.author, c.category FROM " . $this->table_name . " q JOIN authors a ON q.author_id = a.id JOIN categories c ON q.category_id = c.id WHERE q.author_id = ? AND q.category_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $author_id);
        $stmt->bindParam(2, $category_id);
        $stmt->execute();
        return $stmt;
    }
    
    public function readOne($id){
        $query = "SELECT q.id, q.quote, a.author, c.category FROM " . $this->table_name . " q JOIN authors a ON q.author_id = a.id JOIN categories c ON q.category_id = c.id WHERE q.id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }
}
?>