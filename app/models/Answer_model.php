<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class Category_model extends Model
{

    /** Init database access. */
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
    }

    /** Requires: question_id, text, is_correct */
    public function create($question_id, $text, $is_correct)
    {

    }
    
    /** Requires: user_id, category_id, question_id, text, is_correct */
    public function get_user_category_question_all(/** Put required params here */)
    {

    }

    /** Requires: answer_id, user_id, category_id, question_id, text, is_correct */
    public function update_user_category_question_one(/** Put required params here */)
    {

    }

    /** Requires: answer_id, user_id, category_id, question_id */
    public function delete_user_category_question_one(/** Put required params here */)
    {
        
    }

}