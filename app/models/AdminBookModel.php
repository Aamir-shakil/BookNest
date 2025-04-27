<?php
class AdminBookModel extends Model
{
    //adminBookModel class for managing book data in the database
    // This class extends the base Model class to inherit database connection functionality.
    public function getAllBooks()
    {
        $stmt = $this->db->query("SELECT * FROM books");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addBook($data)
    {
        $stmt = $this->db->prepare("INSERT INTO books (title, author, price) VALUES (:title, :author, :price)");
        $stmt->execute([$data['title'], $data['author'], $data['price']]);
    }

    public function updateBook($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE books SET title=?, author=?, price=? WHERE id=?");
        $stmt->execute([$data['title'], $data['author'], $data['price'], $id]);
    }

    public function deleteBook($id)
    {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id=?");
        $stmt->execute([$id]);
    }
}
?>