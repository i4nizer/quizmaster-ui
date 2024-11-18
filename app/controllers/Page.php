<?php
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

    public function user_dashboard()
    {
        $this->call->view('user/dashboard');
    }
    
    public function user_profile()
    {
        $this->call->view('user/profile');
    }

    public function user_quizzes()
    {
        $this->call->view('user/quizzes');
    }
    
    public function user_quizzes_quiz($quizId)
    {
        if (!$quizId) return redirect('user/quizzes');

        $this->call->view('user/quiz');
    }
    
    public function user_quizzes_quiz_category($quizId, $categoryId)
    {
        if (!$quizId) return redirect('user/quizzes');
        if (!$categoryId) return redirect("user/quizzes/quiz/$quizId");

        $this->call->view('user/category');
    }
    
    public function user_settings()
    {
        $this->call->view('user/settings');
    }

}
