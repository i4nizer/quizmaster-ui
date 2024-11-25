<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class Response_model extends Model
{

    public function __construct()
    {
        $this->has_soft_delete = false;
        $this->table = "responses";
    }

    public function get_by_quiz($quizId)
    {
        return $this->db->table('responses')->select("*")->where('quiz_id', $quizId)->get_all();
    }
}
