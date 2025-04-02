<?php
class Book extends Model{
// Function to get all books
public function getAllBooks() {
    $stmt = $this->db->prepare("SELECT * FROM books ORDER BY title ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function searchBooks($query, $filter) {
    $sql = "SELECT * FROM books WHERE 1=1"; // preventing where from disrupting the query
    $params = [];

    if (!empty($query)) {
        if ($filter == 'title') {
            $sql .= " AND title LIKE ?";
            $params[] = "%$query%";
        } elseif ($filter == 'author') {
            $sql .= " AND author LIKE ?";
            $params[] = "%$query%";
        } else {
            // "All" filter - search in both title and author
            $sql .= " AND (title LIKE ? OR author LIKE ?)";
            $params[] = "%$query%";
            $params[] = "%$query%";
        }
    }

    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}


?>