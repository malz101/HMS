<?php

class Feedback extends Model {
    public function __construct(){
        parent::__construct();
    }

    public function addFeedback($data){
        $this->db->query('INSERT INTO feedback (issueID, comment, sender, date) 
                            VALUES (:issueID, :comment, :sender, :date);');
        $this->db->bind(':issueID', $data['iid']);
        $this->db->bind(':comment', $data['comment']);
        $this->db->bind(':sender', $data['uid']);
        $date = date("Y-m-d"); #in format "Y-m-d ", ie: "2019-11-24 "
        $this->db->bind(':date', $date);

        if ($this->db->execute()) {
            return true;
        }else{
            return false;
        }
    }

    public function loadFeedbackFromIssue($issueID){
        $issueID = filter_var($issueID, FILTER_SANITIZE_NUMBER_INT);

        $this->db->query('SELECT feedback_date.date AS date, feedback_comments.comment AS comment, feedback_comments.sender AS sender, feedback_comments.isRead AS isRead, feedback_comments.feedbackID AS feedbackID 
                            FROM feedback_date JOIN feedback_comments ON (feedback_date.feedbackID = feedback_comments.feedbackID AND feedback_comments.issueID = ' . $issueID . ')');
        
        $feedbacks = $this->db->resultSet;

        return $feedbacks;
    }

}