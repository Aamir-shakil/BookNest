<?php

class Review extends Model
{
    //model class for managing reviews in the database
    //adds a new review, retrieves reviews for a specific book, calculates the average rating for a book, and retrieves all reviews.
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

    public function getAllReviews()
{
    $stmt = $this->db->prepare('SELECT reviews.*, users.name AS user_name, books.title AS book_title 
                                FROM reviews 
                                JOIN users ON reviews.user_id = users.id 
                                JOIN books ON reviews.book_id = books.id 
                                ORDER BY reviews.created_at DESC');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Delete a review by ID
public function deleteReview($id)
{
    $stmt = $this->db->prepare('DELETE FROM reviews WHERE id = :id');
    return $stmt->execute(['id' => $id]);
}
}
?>