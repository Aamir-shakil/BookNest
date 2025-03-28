<?php
class Book extends Model{
      //Function to get all books
      public function getAllBooks() {
        $stmt = $this->db->prepare("SELECT * FROM books ORDER BY title ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function searchBooks($query, $filter) {
      $sql = "SELECT * FROM books";
      $params = [];

      if (!empty($query)) {
          if ($filter == 'title') {
              $sql .= " WHERE title LIKE :query";
          } elseif ($filter == 'author') {
              $sql .= " WHERE author LIKE :query";
          } else {
              $sql .= " WHERE title LIKE :query OR author LIKE :query";
          }
          $params['query'] = "%$query%";
      }

      $stmt = $this->db->prepare($sql);
      $stmt->execute($params);
      return $stmt->fetchAll();
  }
}


?>