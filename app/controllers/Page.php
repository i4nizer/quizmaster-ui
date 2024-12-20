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
    }

    public function index()
    {
        redirect('user/quizzes');
    }

    public function user_profile()
    {
        # get user
        $user = $this->db->raw('select * from users where id = ?', [get_user_id()])->fetch();
        
        # store data to pass
        $data = [
            'user' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'created_at' => $user['created_at'],
            ]
        ];

        $this->call->view('user/profile', $data);
    }

    public function user_leaderboards()
    {
        # get top 100 players with the highest quiz score
        $query = "
            SELECT 
                u.id AS user_id,
                u.username AS username,
                SUM(r.correct) AS total_score
            FROM users u
            JOIN responses r
            ON u.id = r.user_id
            WHERE r.correct = TRUE
            GROUP BY u.id, u.username
            ORDER BY total_score DESC
            LIMIT 100;
        ";
        
        $players = $this->db->raw($query)->fetchAll();
        $data['top_players'] = $players;

        $this->call->view('user/leaderboards', $data);
    }

    public function user_play($quizId = null)
    {
        if ($quizId === null) return redirect('user/quizzes');

        
        # find quiz
        $this->call->model('Quiz_model', 'quiz');
        
        $quiz = $this->quiz->find($quizId);
        if (!$quiz) return redirect('user/quizzes');

        # check visibility
        if ($quiz['visibility'] == 'Private' && get_user_id() != $quiz['creator_id']) return redirect('user/quizzes');
        
        # find quiz questions
        $this->call->model('Question_model', 'question');
        
        $questions = $this->question->raw("select * from questions where quiz_id = ?", [$quizId])->fetchAll();
        if (!$questions) return redirect('user/quizzes');

        $this->call->view('user/play', [ "quiz" => $quiz, "questions" => $questions ]);
    }

    public function user_quizzes()
    {
        $this->call->model('Quiz_model', 'quiz');

        # get all quizzes of user
        $userQuizzes = $this->db->table('quizzes')
            ->where('creator_id', get_user_id())
            ->where_null('deleted_at')
            ->get_all();

        # set data
        $data['user_quizzes'] = $userQuizzes;

        $this->call->view("user/quizzes", $data);
    }
    
    public function user_quizzes_quiz($quizId)
    {
        $this->call->model('Quiz_model', 'quiz');

        # get quiz
        $quiz = $this->quiz->find($quizId);
        $data["quiz"] = $quiz;
        
        if (gettype($quiz) !== "array") redirect("user/quizzes");
        else $this->call->view("user/quizzes/quiz", $data);
    }

    public function user_recent()
    {
        $this->call->model('Response_model', 'res');
        $data['quizzes'] = $this->res->raw("select distinct q.* from responses r inner join quizzes q on r.quiz_id = q.id");

        $this->call->view('user/recent', $data);
    }

}
