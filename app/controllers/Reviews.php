<?php

class Reviews extends Controller
{
      /**
     * Add a new review for a book.
     * 
     * - Ensures the request is a POST request and the user is logged in.
     * - Validates the rating value.
     * - Stores the review in the database via the Review model.
     * - Redirects to the books page upon success.
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
            $reviewModel = $this->model('Review');
            $userId = $_SESSION['user_id'];
            $bookId = $_POST['book_id'];
            $rating = (int) $_POST['rating'];
            $reviewText = trim($_POST['review_text']);
            
             // Validate the rating is between 1 and 5
            if ($rating >= 1 && $rating <= 5) {
                if ($reviewModel->addReview($userId, $bookId, $rating, $reviewText)) {
                    // Set success message in session
                    $_SESSION['review_success'] = 'Review added successfully!';
                    header('Location: /books'); // Redirect back to browsing books
                    exit;
                } else {
                    echo "Failed to add review.";
                }
            } else {
                echo "Invalid rating.";
            }
        }
    }
}
?>