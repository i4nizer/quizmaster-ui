<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class Answer extends Controller
{

    /** Init model */
    public function __construct()
    {
        parent::__construct();
        $this->call->model('Answer_model', 'ans');
    }

    /**  */
    public function get()
    {
        
    }
    
    /**  */
    public function post()
    {
        
    }
    
    /**  */
    public function patch()
    {
        
    }
    
    /**  */
    public function delete()
    {
        
    }


    
    /** Send an error response. */
    protected function error($msg, $code = 400)
    {
        http_response_code($code);
        echo $msg;
    }

    /** Craft and send json encoded category. */
    protected function json_answer($answerId, $userId, $categoryId, $questionId, $text, $is_correct)
    {
        $category = [
            'id' => $answerId,
            'user_id' => $userId,
            'category_id' => $categoryId,
            'question_id' => $questionId,
            'text' => $text,
            'is_correct' => $is_correct,
        ];

        header('Content-Type: application/json');
        echo json_encode($category);
    }

}