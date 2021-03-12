<?php

class FeedbackController {
    private $db;

    public function __construct(){
        $this->db =  new Database;
    }

    public function addFeedback($data){
        $this->db->query('INSERT INTO feedback (issueID) VALUES (:issueID);');
        $this->db->bind(':issueID', $data['issueID']);

        if ($this->db->execute()) {
            return true;
        }else{
            return false;
        }

        $this->db->query('SELECT * FROM feedback ORDER BY feedbackID DESC LIMIT 1;');
        $feedback = $this->db->single();

        $this->db->query('INSERT INTO feedback_comments (issueID, feedbackID, comment, sender) 
                            VALUES (:issueID, :feedback_id, :comment, :feedback_sender);');

        $this->db->bind(':issueID', $data['issueID']);
        $this->db->bind(':feedback_id', $feedback['feedback_id']);
        $this->db->bind(':comment', $data['comment']);
        $statement->bind(':feedback_sender', $data['HMemberIDnum']);

        if ($this->db->execute()) {
            return true;
        }else{
            return false;
        }

        $this->db->query('INSERT INTO feedback_date (issueID, feedbackID, date) 
                            VALUES (:issueID, :feedback_id, :date);');
        $date = date("m d Y"); #in format "m d Y", ie: "11 24 2019"
        $this->db->bind(':issueID', $data['issueID']);
        $this->db->bind(':feedback_id', $feedback['feedback_id']);
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

        // foreach($feedbacks as $f){
        //     $feedbackObj = new Feedback($f['comment'], $issueID);
        //     $feedbackObj->setDate($f['date']);
        //     $feedbackObj->setFeedbackID($f['feedbackID']);
        //     $feedbackObj->setSender($f['sender']);
        //     $feedbackObj->setRead($f['isRead']);
            
        //     $this->feedback[] = $feedbackObj;
        // }
        return $feedbacks;
    }

//     public function sendFeedback(){
//         return $this->feedback;
//     }

//     public function clearFeedback(){
//         $this->feedback = [];
//     }
// }