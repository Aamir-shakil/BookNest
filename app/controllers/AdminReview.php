<?php

class AdminReview extends Controller
{
    private $reviewModel;

    public function __construct()
    {
        // Optional: Check if user is admin here
        $this->reviewModel = $this->model('Review');
    }

    // Show all reviews
    public function index()
    {
        $reviews = $this->reviewModel->getAllReviews();
        $this->view('admin/review', ['reviews' => $reviews]);
    }

    // Delete a review
    public function delete($id)
    {
        if ($this->reviewModel->deleteReview($id)) {
            $_SESSION['review_message'] = 'Review deleted successfully!';
        } else {
            $_SESSION['review_message'] = 'Failed to delete review.';
        }
        header('Location: /adminreview');
        exit;
    }
}
?>