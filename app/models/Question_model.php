<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class Question_model extends Model
{

    /** Init database access. */
    public function __construct()
    {
        $this->has_soft_delete = false;
        $this->table = "questions";
    }


    public function get_by_quiz($quizId)
    {
        return $this->db->table($this->table)->where("quiz_id", $quizId)->get_all();
    }
}