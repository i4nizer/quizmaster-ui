<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class Category extends Controller
{

    /** Init model */
    public function __construct()
    {
        parent::__construct();
        $this->call->model('Category_model', 'cat');
    }

    /** GET all categories of logged-in user */
    public function get()
    {
        # Currently logged in user
        $userId = get_user_id();

        # Get all categories of the user
        $categories = $this->cat->get_user_categories($userId);

        # Make a header indicating that I will send a JSON
        header('Content-Type: application/json');

        # Now send the JSON after encoding it from an assoc array
        echo json_encode($categories ? $categories : []);
    }

    /** Get all categories of a quiz of logged-in user */
    public function get_quiz($quizId)
    {
        # Currently logged in user
        $userId = get_user_id();

        # Get all categories of a quiz of a user
        $categories = $this->cat->get_user_quiz_categories($userId, $quizId);

        # Make a header indicating that I will send a JSON
        header('Content-Type: application/json');

        # Now send the JSON after encoding it from an assoc array
        echo json_encode($categories ? $categories : []);
    }
    
    /** Get all categories of a quiz of logged-in user */
    public function get_quiz_category($quizId, $categoryId)
    {
        # Currently logged in user
        $userId = get_user_id();

        # Get all categories of a quiz of a user
        $category = $this->cat->get_user_quiz_category($userId, $quizId, $categoryId);

        # Make a header indicating that I will send a JSON
        header('Content-Type: application/json');

        # Now send the JSON after encoding it from an assoc array
        echo json_encode($category ? $category : []);
    }

    /** POST a category */
    public function post()
    {
        # Check if POST is made
        if ($this->form_validation->submitted()) {

            # Get data
            $userId = get_user_id();
            $quizId = $this->io->post('quiz_id');
            $name = $this->io->post('name');
            $description = $this->io->post('description');
            $description = $description ? $description : null;

            # Validate (requires category name)
            $this->form_validation
                ->name('name')
                ->required()
                ->min_length(2, 'Category name must not be less than 2 characters.')
                ->max_length(100, 'Category name must not be more than 100 characters.');

            # Check for errors
            if ($this->form_validation->run() != false) {

                # Let's save the category
                $categoryId = $this->cat->create($userId, $quizId, $name, $description);

                # If all goods
                if ($categoryId) {

                    # Send the category details
                    $this->json_category($userId, $quizId, $categoryId, $name, $description);
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
            if (!isset($data['id']) && !$data['id']) return $this->error('Category ID is required.');
            
            # Nothing to update
            if (!isset($data['name']) && !isset($data['description'])) return $this->error('No data provided in the patch body.');

            # Needs further validation of name & description

            # Get data
            $userId = get_user_id();
            $quizId = $data['quiz_id'];
            $categoryId = $data['id'];
            $name = isset($data['name']) ? $data['name'] : null;
            $description = isset($data['description']) ? $data['description'] : null;

            # Apply patch
            $patched = $this->cat->update_user_category($userId, $quizId, $categoryId, $name, $description);

            # Send patched
            if ($patched) echo "Category updated successfully.";

            # Send 500 status code for failed update
            else $this->error('Failed to update category.', 500);
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
            if (!isset($data['id']) && $data['id'] !== '') return $this->error('Category ID is required in delete body.');
            
            # Quiz ID required
            if (!isset($data['quiz_id']) && $data['quiz_id'] !== '') return $this->error('Quiz ID is required in delete body.');

            # Use user ID and category ID to delete
            $userId = get_user_id();
            $deleted = $this->cat->delete_user_category($userId, $data['quiz_id'], $data['id']);

            # Send deleted
            if ($deleted) echo 'Category deleted successfully.';

            # Send 500 status code for failed delete
            else $this->error('Failed to delete category.', 500);
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
    protected function json_category($userId, $quizId, $categoryId, $name, $description = null)
    {
        $category = [
            'id' => $categoryId,
            'user_id' => $userId,
            'quiz_id' => $quizId,
            'name' => $name,
            'description' => $description ?? '',
        ];

        header('Content-Type: application/json');
        echo json_encode($category);
    }


}