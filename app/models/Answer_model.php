<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class Answer_model extends Model
{

    public function __construct()
    {
        $this->has_soft_delete = false;
        $this->table = "answers";
    }

    public function get_by_question($questionId)
    {
        return $this->db->table('answers')->select("*")->where('question_id', $questionId)->get_all();
    }

}