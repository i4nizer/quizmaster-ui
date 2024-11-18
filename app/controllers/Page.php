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

        # Get quiz of the user
        $userId = get_user_id();
        $res = $this->quiz->get_user_one($userId, $quizId);

        # User doesn't exists
        // if (!$res) {
        //     echo "No Quizzes Found";
        //     return;
        // }        

        $this->call->view('user/quizzes/quiz');
    }
    
    public function user_settings()
    {
        $this->call->view('user/settings');
    }

}
