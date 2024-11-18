<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class Question extends Controller
{

    /** Init model */
    public function __construct()
    {
        parent::__construct();
        $this->call->model('Question_model', 'question');
    }

    /** GET all categories of logged-in user */
    public function get($category_id)
    {
        # Currently logged in user
        $user_id = get_user_id();

        # Get all categories of the user
        $questions = $this->question->get_user_category_questions($user_id, $category_id);

        # Make a header indicating that I will send a JSON
        header('Content-Type: application/json');

        # Now send the JSON after encoding it from an assoc array
        echo json_encode($questions ? $questions : []);
    }

    /** POST a category */
    public function post()
    {
        # Check if POST is made
        if ($this->form_validation->submitted()) {

            # Get data
            $userId = get_user_id();
            $categoryId = $this->io->post('category_id');
            $number = $this->io->post('number');
            $text = $this->io->post('text');

            # Validate (requires category name)
            $this->form_validation
                ->name('text')
                ->required()
                ->min_length(2, 'Question text must not be less than 2 characters.')
                ->max_length(100, 'Question text must not be more than 100 characters.');

            # Check for errors
            if ($this->form_validation->run() != false) {

                # Let's save the category
                $questionId = $this->question->create($userId, $categoryId, $number, $text);

                # If all goods
                if ($questionId) {

                    # Send the category details
                    $this->json_question($questionId, $userId, $categoryId, $number, $text);
                }
                # Internal/DB error
                else $this->error('Failed to create new category.', 500);
            }
            # Means bad request
            else $this->error($this->form_validation->errors());
        }
        # Wrong method
        else $this->error('Request method must be POST.');
    }

    /** PATCH category */
    public function patch()
    {
        # Check if PATCH method
        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {

            # Get patch data
            $raw = file_get_contents('php://input');
            $data = json_decode($raw, true);

            # Require: id, user_id, name
            if (!isset($data['id']) && !$data['id']) return $this->error('Question Id is required.');
            
            # Nothing to update
            if (!isset($data['user_id'])) return $this->error('User Id is required.');

            # Nothing to update
            if (!isset($data['category_id'])) return $this->error('Category Id is required.');

            # Nothing to update
            if (!isset($data['number'])) return $this->error('number is required.');

            # Nothing to update
            if (!isset($data['text'])) return $this->error('text is required.');

            # Needs further validation of name & description

            # Get data
            $questionId = $data['id'];
            $userId = get_user_id();
            $categoryId = $data['category_id'];
            $number = isset($data['number']) ? $data['number'] : null;
            $text = isset($data['text']) ? $data['text'] : null;

            # Apply patch
            $patched = $this->question->update_user_category($questionId, $userId, $categoryId, $number, $text);

            # Send patched
            if ($patched) echo "Question updated successfully.";

            # Send 500 status code for failed update
            else $this->error('Failed to update question.', 500);
        }
        # Wrong method
        else $this->error('PATCH method must be used.');
    }

    /** DELETE a category specific to the user. */
    public function delete()
    {
        # DELETE METHOD ONLY
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

            # Get patch data
            $raw = file_get_contents('php://input');
            $data = json_decode($raw, true);

            # Category ID required
            if (!isset($data['id']) && $data['id'] !== '') return $this->error('Question ID is required in delete body.');
            
            # Quiz ID required
            if (!isset($data['category_id']) && $data['category_id'] !== '') return $this->error('Category ID is required in delete body.');

            # Use user ID and category ID to delete
            $userId = get_user_id();
            $deleted = $this->question->delete_user_category($data['id'], $userId, $data['category_id'] );

            # Send deleted
            if ($deleted) echo 'Question deleted successfully.';

            # Send 500 status code for failed delete
            else $this->error('Failed to delete question.', 500);
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

    /** Craft and send json encoded category. */
    protected function json_question($questionId, $userId, $categoryId, $number, $text)
    {
        $question = [
            'user_id' => $userId,
            'id' => $categoryId,
            'number' => $number,
            'text' => $text,
        ];

        header('Content-Type: application/json');
        echo json_encode($question);
    }

    

}