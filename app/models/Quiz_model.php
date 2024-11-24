<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class Quiz_model extends Model
{

    /** Init database access. */
    public function __construct()
    {
        $this->table = "quizzes";
    }

}
