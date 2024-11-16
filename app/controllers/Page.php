<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


/** Handle All Pages */
class Page extends Controller 
{

    public function __construct()
    {
        parent::__construct();

        if (! logged_in()) redirect('auth/login');
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
    
    public function user_settings()
    {
        $this->call->view('user/settings');
    }

}
