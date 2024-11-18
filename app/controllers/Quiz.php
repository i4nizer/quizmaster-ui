<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class Quiz extends Controller
{

    /** Init model */
    public function __construct()
    {
        parent::__construct();
        $this->call->model('Quiz_model', 'quiz');
    }

    /** Get quizzes of the currently logged-in user. */
    public function get($quizId = null)
    {
        # Get current user
        $userId = get_user_id();

        # Only get user's quizzes
        $quizzes = $quizId ? $this->quiz->get_user_quiz($userId, $quizId) : $this->quiz->get_user_quizzes($userId);

        # Respond like an api
        header('Content-Type: application/json');
        echo json_encode($quizzes ? $quizzes : []);
    }

    /** Create a quiz based on current user. */
    public function post()
    {
        # POST method specific
        if ($this->form_validation->submitted()) {

            # Get data
            $userId = get_user_id();
            $title = $this->io->post('title');
            $description = $this->io->post('description') ?? null;

            # Validate
            $this->form_validation
                ->name('title')
                ->required()
                ->min_length(2, 'Quiz title must not be less than 2 characters.')
                ->max_length(100, 'Quiz title must not be more than 100 characters.');

            # Check errors
            if ($this->form_validation->run() != false) {

                $quizId = $this->quiz->create($userId, $title, $description);

                # Send quiz on success
                if ($quizId) $this->json_quiz($quizId, $title, $description, $userId);

                # Send 500 status code on failed insert
                else $this->error('Failed to create new quiz.', 500);
            }
            # Send bad request on invalid
            else $this->error($this->form_validation->errors());
        }
        # Posted nothing
        else $this->error('No data provided.');
    }

    /** Update a quiz specific to the user. */
    public function patch()
    {
        # PATCH method only
        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {

            # Get patch data
            $raw = file_get_contents('php://input');
            $data = json_decode($raw, true);

            # Quiz ID required
            if (!isset($data['id'])) return $this->error('Quiz ID is required in the patch body.');

            # Nothing to update
            if (!isset($data['title']) && !isset($data['description'])) return $this->error('No data provided in the patch body.');

            # Validate title
            if (isset($data['title'])) {

                $type = gettype($data['title']);
                $error = '';

                if ($type !== 'string') $error = 'Quiz title must be type of string.';
                else if (strlen($data['title']) < 2) $error = 'Quiz title must not be less than 2 characters.';
                else if (strlen($data['title']) > 100) $error = 'Quiz title must not be more than 100 characters.';

                if ($error !== '') return $this->error($error);
            }

            # Validate description
            if (isset($data['description']) && gettype($data['description']) !== 'string') return $this->error('Quiz description must be type of string.');
            
            # Get data
            $userId = get_user_id();
            $quizId = $data['id'];
            $title = isset($data['title']) ? $data['title'] : null;
            $description = isset($data['description']) ? $data['description'] : null;

            # Apply patch
            $patched = $this->quiz->update_user_quiz($userId, $quizId, $title, $description);

            # Send quiz
            if ($patched) echo "Quiz updated successfully.";

            # Send 500 status code for failed update
            else $this->error('Failed to update quiz.', 500);
        }
        # Wrong method
        else $this->error('PATCH method must be used.');
    }

    /** Delete a quiz specific to the user. */
    public function delete()
    {
        # DELETE METHOD ONLY
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {   

            # Get patch data
            $raw = file_get_contents('php://input');
            $data = json_decode($raw, true);

            # Quiz ID required
            if (!isset($data['id']) && $data['id'] !== '') return $this->error('Quiz ID is required in delete body.');

            # Use user ID and quiz ID to delete
            $userId = get_user_id();
            $deleted = $this->quiz->delete_user_quiz($userId, $data['id']);

            # Send quiz
            if ($deleted) echo 'Quiz deleted successfully.';

            # Send 500 status code for failed delete
            else $this->error('Failed to delete quiz.', 500);
        }
        # Wrong method
        else $this->error('DELETE method must be used.');
    }



    /** Send an error response. */
    protected function error($msg, $code = 400)
    {
        http_response_code($code);
        echo $msg;
    }

    /** Craft and send json encoded quiz. */
    protected function json_quiz($quizId, $title, $description = null, $creatorId = null)
    {
        $quiz = [
            'id' => $quizId,
            'title' => $title,
        ];

        if ($description !== null) $quiz['description'] = $description;
        if ($creatorId !== null) $quiz['creator_id'] = $creatorId;

        header('Content-Type: application/json');
        echo json_encode($quiz);
    }
}
