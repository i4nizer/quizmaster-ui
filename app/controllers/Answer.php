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
    public function get($category_id, $question_id, $text, $is_correct)
    {
        # Currently logged in user
        $user_id = get_user_id();

        # Get all categories of the user
        $answers = $this->ans->get_user_category_question_all($user_id, $category_id, $question_id, $text, $is_correct);

        # Make a header indicating that I will send a JSON
        header('Content-Type: application/json');

        # Now send the JSON after encoding it from an assoc array
        echo json_encode($answers ? $answers : []);
    }
    
    /**  */
    public function post()
    {
         # Check if POST is made
         if ($this->form_validation->submitted()) {

            # Get data
            $userId = get_user_id();
            $categoryId = $this->io->post('categoryId');
            $questionId = $this->io->post('questionId');
            $text = $this->io->post('text');
            $iscorrect = $this->io->post('iscorrect');

            # Validate (requires category name)
            /*$this->form_validation
                ->name('text')
                ->required()
                ->min_length(2, 'Question text must not be less than 2 characters.')
                ->max_length(100, 'Question text must not be more than 100 characters.');*/

            # Check for errors
            if ($this->form_validation->run() != false) {

                # Let's save the category
                $answerId = $this->ans->create($userId, $categoryId, $questionId, $text, $iscorrect);

                # If all goods
                if ($answerId) {

                    # Send the category details
                    $this->json_answer($answerId, $userId, $categoryId, $questionId, $text, $iscorrect);
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
    
    /**  */
    public function patch()
    {
        # Check if PATCH method
        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {

            # Get patch data
            $raw = file_get_contents('php://input');
            $data = json_decode($raw, true);

            # Require: id, user_id, name
            if (!isset($data['id']) && !$data['id']) return $this->error('Answer Id is required.');
            
            # Nothing to update
            if (!isset($data['user_id'])) return $this->error('User Id is required.');

            # Nothing to update
            if (!isset($data['category_id'])) return $this->error('Category Id is required.');

            # Nothing to update
            if (!isset($data['question_id'])) return $this->error('Question Id is required.');

            # Nothing to update
            if (!isset($data['text'])) return $this->error('Text is required.');

            # Nothing to update
            if (!isset($data['iscorrect'])) return $this->error('Iscorrect is required.');

            # Needs further validation of name & description

            # Get data
            $answerId = $data['id'];
            $userId = get_user_id();
            $categoryId = $data['category_id'];
            $questionId = $data['question_id'];
            $text = isset($data['text']) ? $data['text'] : null;
            $iscorrect = isset($data['iscorrect']) ? $data['iscorrect'] : null;

            # Apply patch
            $patched = $this->ans->update_user_one($answerId, $userId, $categoryId, $questionId, $text, $iscorrect);

            # Send patched
            if ($patched) echo "Answer updated successfully.";

            # Send 500 status code for failed update
            else $this->error('Failed to update answer.', 500);
        }
        # Wrong method
        else $this->error('PATCH method must be used.');
    }
    
    /**  */
    public function delete()
    {
      # DELETE METHOD ONLY
      if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

        # Get patch data
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);

        # Category ID required
        if (!isset($data['id']) && $data['id'] !== '') return $this->error('Answer ID is required in delete body.');

         # Category ID required
         if (!isset($data['userId']) && $data['userId'] !== '') return $this->error('User ID is required in delete body.');
        
        # Quiz ID required
        if (!isset($data['categoryId']) && $data['categoryId'] !== '') return $this->error('Category ID is required in delete body.');

         # Quiz ID required
         if (!isset($data['questionId']) && $data['questionId'] !== '') return $this->error('Question ID is required in delete body.');
         
        # Use user ID and category ID to delete
        $userId = get_user_id();
        $deleted = $this->question->delete_user_one($data['id'], $userId, $data['category_id'] );

        # Send deleted
        if ($deleted) echo 'Answer deleted successfully.';

        # Send 500 status code for failed delete
        else $this->error('Failed to delete answer.', 500);
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