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

    /** GET all categories (USER) */
    public function get()
    {
        # Invoke getAll()
        $categories = $this->cat->getAll();

        # Make a header indicating that I will send a JSON
        header('Content-Type: application/json');

        # Now send the JSON after encoding it from an assoc array
        echo json_encode($categories);
    }

    /** POST a category (ADMIN) */
    public function post()
    {
        # Check if POST is made
        if ($this->form_validation->submitted()) {

            # Get data
            $name = $this->io->post('name');
            $description = $this->io->post('description') ?? null;

            # Validate (requires category name)
            $this->form_validation
                ->name('name')
                ->required()
                ->min_length(2, 'Category name must not be less than 2 characters.')
                ->max_length(100, 'Category name must not be more than 100 characters.');

            # Check for errors
            if ($this->form_validation->run() != false) {

                # Let's save the category
                $categoryId = $this->cat->create($name, $description);

                # If all goods
                if ($categoryId) {

                    # Send the category details
                    $this->json_category($categoryId, $name, $description);
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

    /** PATCH category (ADMIN) */
    public function patch()
    {
        # MAYBE ENOUGH SINCE WE GONNA USE USER ONLY YET
        # LETS PROCEED TO ROUTES
    }






    /** Send an error response. */
    protected function error($msg, $code = 400)
    {
        http_response_code($code);
        echo $msg;
    }

    /** Craft and send json encoded category. */
    protected function json_category($categoryId, $name, $description = null)
    {
        $category = [
            'id' => $categoryId,
            'name' => $name,
        ];

        if ($description !== null) $category['description'] = $description;

        header('Content-Type: application/json');
        echo json_encode($category);
    }


}