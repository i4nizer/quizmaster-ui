<?php

use function PHPSTORM_META\type;

defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


/** Handle All Pages */
class Page extends Controller 
{

    public function __construct()
    {
        parent::__construct();
        if (! logged_in()) return redirect('auth/login');

        $this->call->model('Quiz_model', 'quiz');
    }

    public function index()
    {
        $this->call->view('home');
    }

    public function user_profile()
    {
        $this->call->view('user/profile');
    }

    public function user_quizzes($quizId = null)
    {
        # normal
        if ($quizId === null) {
            $this->call->view("user/quizzes");
            return;
        }

        # create quiz
        if ($quizId == -1) {
            $data = [
                'creator_id' => get_user_id(),
                'title' => "",
                'description' => "",
                'visibility' => 'Public'
            ];
            
            $quizId = $this->quiz->insert($data);
            redirect("user/quizzes/$quizId");
                
            return;
        }

        # get quiz
        $quiz = $this->quiz->find($quizId);
        $data["quiz"] = $quiz;
        
        if (gettype($quiz) !== "array") redirect("user/quizzes");
        else $this->call->view("user/quizzes/quiz", $data);
    }

}
