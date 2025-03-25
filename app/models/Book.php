<?php
class Book extends Model{
      //Function to get all books
      public function getAllBooks() {
        $stmt = $this->db->prepare("SELECT * FROM books ORDER BY title ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>