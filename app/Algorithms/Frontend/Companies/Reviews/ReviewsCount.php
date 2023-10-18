<?php

namespace App\Algorithms\Frontend\Companies\Reviews;

class ReviewsCount {

    private $reviewsRow;
    private $reviewsHierarchy;

    private $reviewsAndComplaintsCount = 0;

    private $reviewsCount = 0;

    private $complaintAllCount = 0;
    private $complaintAnswerCount = 0;

    public function __construct($reviewsRow)
    {

        $this->reviewsRow = $reviewsRow;
        $this->convertToHierarchy();
    }

    public function getAllReviewsCount()
    {
        return $this->reviewsCount;
    }

    public function getAllReviewsAndComplaints()
    {
        return $this->reviewsAndComplaintsCount;
    }

    public function getAllHierarchyReviews()
    {
        return $this->reviewsHierarchy;
    }

    public function getHierarchyReviewsByPaginate($page, $paginate)
    {
        if ($page && $paginate) {
            return [];
        }
        return $this->reviewsHierarchy;
    }

    public function getComplaintAllCount()
    {
        return $this->complaintAllCount;
    }


    public function getReviewsCount()
    {
        return $this->reviewsCount;
    }

    public function complaintAnswerCount()
    {
        return $this->complaintAnswerCount;
    }


    /**** private methods ****/
    private function convertToHierarchy()
    {
        $reviews = $this->reviewsRow;

        $reviewsAndComplaintsArr = [];
        $reviewsAllArr = [];
        $complaintAllArr = [];
        $complaintAnswerArr = [];

        $count = count($reviews);
        $i = 0;

        while ($i <= $count - 1) {
            foreach ($reviews as $key => $value) {

                if (!isset($reviews[$i])) continue;

                // считаем отзывы и жалобы по отдельности и вмести
                if ($this->isReview($reviews[$i])) {
                    $reviewsAllArr [$reviews[$i]->id] = true;
                    $reviewsAndComplaintsArr [$reviews[$i]->id] = true;
                } elseif ($this->isComplaint($reviews[$i])) {
                    $complaintAllArr [$reviews[$i]->id] = true;
                    $reviewsAndComplaintsArr [$reviews[$i]->id] = true;
                }

                // формируем вложенность
                if ($value->id == $reviews[$i]->parent_id) {
                    $reviewsAllArr [$reviews[$i]->id] = true;
                    $reviews[$key]->child [] = $reviews[$i];

                    if ($reviews[$key]->rating <= 2 && $reviews[$i]->off_answer == true) {
                        $complaintAnswerArr [$reviews[$i]->id] = true;
                        // ответ на жалобу
                        $reviews[$key]->complain_result = true;
                    }

                    unset($reviews[$i]);
                }
            }
            $i++;
        }


        $this->reviewsAndComplaintsCount = count ($reviewsAndComplaintsArr);
        $this->complaintAllCount = count($complaintAllArr);
        $this->complaintAnswerCount = count($complaintAnswerArr);
        $this->reviewsCount = count($reviewsAllArr);

        $this->reviewsHierarchy = $reviews;
    }


    private function isReview($review)
    {
        if ($review->rating > 2 && $review->off_answer == false && (bool) $review->parent_id == null)  {
            return true;
        }

        return false;
    }

    private function isComplaint($review)
    {
        if ($review->rating <= 2 && $review->off_answer == false && (bool) $review->parent_id == null) {
            return true;
        }

        return false;
    }

    public function isOfficialAnswer($review)
    {
        return (bool) $review->off_answer;
    }

}