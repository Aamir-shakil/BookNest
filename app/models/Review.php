<?php

class Review extends Model
{
    public function addReview($userId, $bookId, $rating, $reviewText)
    {
        $stmt = $this->db->prepare('INSERT INTO reviews (user_id, book_id, rating, review_text) VALUES (:user_id, :book_id, :rating, :review_text)');
        return $stmt->execute([
            ':user_id' => $userId,
            ':book_id' => $bookId,
            ':rating' => $rating,
            ':review_text' => $reviewText
        ]);
    }

    public function getReviewsByBook($bookId)
    {
        $stmt = $this->db->prepare('SELECT reviews.*, users.name AS user_name FROM reviews JOIN users ON reviews.user_id = users.id WHERE book_id = :book_id ORDER BY created_at DESC');
        $stmt->execute([':book_id' => $bookId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAverageRating($bookId)
    {
        $stmt = $this->db->prepare('SELECT AVG(rating) as average_rating FROM reviews WHERE book_id = :book_id');
        $stmt->execute([':book_id' => $bookId]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['average_rating'];
    }
}
?>