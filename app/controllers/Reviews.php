<?php

class Reviews extends Controller
{
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
            $reviewModel = $this->model('Review');
            $userId = $_SESSION['user_id'];
            $bookId = $_POST['book_id'];
            $rating = (int)$_POST['rating'];
            $reviewText = trim($_POST['review_text']);

            if ($rating >= 1 && $rating <= 5) {
                $reviewModel->addReview($userId, $bookId, $rating, $reviewText);
                header('Location: /book/show/' . $bookId);
                exit;
            } else {
                echo "Invalid rating.";
            }
        }
    }
}
?>
