<?php

// Author.php

class Author {
    private $conn;
    private $table_name = "authors";

    public $id;
    public $author;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT id, author FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readSingle() {
        $query = "SELECT id, author FROM " . $this->table_name . " WHERE id = ? LIMIT 1 OFFSET 0";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->author = $row['author'];
        } else {
            $this->author = null;
        }
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (author) VALUES (:author)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":author", $this->author);
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId(); // Get the last inserted ID
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET author = :author WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":author", $this->author);
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
}

?>