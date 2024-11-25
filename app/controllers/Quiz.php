<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class Quiz extends Controller
{

    /** Init model */
    public function __construct()
    {
        parent::__construct();
        $this->call->model('Quiz_model', 'quiz');
        $this->call->library('json');
    }

    /** Get quiz of the currently logged-in user. */
    public function get($quizId)
    {
        $quiz = $this->quiz->find($quizId);
        $this->json->send($quiz);
    }

    /** Create a quiz based on current user. */
    public function post()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $raw = $this->json->read();

            $userId = get_user_id();
            $title = $raw['title'];
            $description = $raw['description'] ?? "";
            $visibility = $raw['visibility'] ?? "Public";

            $data = [
                "title" => $title,
                "description" => $description,
                "visibility" => $visibility,
                "creator_id" => $userId,
            ];

            $quizId = $this->quiz->insert($data);

            $data["id"] = $quizId;
            if ($quizId) $this->json->send($data);
            else $this->json->error('Failed to create new quiz.', 500);
        }
        else $this->json->error('No data provided.');
    }

    /** Update a quiz specific to the user. */
    public function patch()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {

            $raw = $this->json->read();
            
            if (!isset($raw['id'])) return $this->json->error('Quiz ID is required.');
            
            $patched = $this->quiz->update($raw['id'], $raw);
            $data['id'] = $raw['id'];

            if ($patched) $this->json->send($data);
            else $this->json->error('Failed to update quiz.', 500);
        }
        else $this->json->error('PATCH method must be used.');
    }

    /** Delete a quiz specific to the user. */
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {   

            $data = $this->json->read();

            if (!isset($data['id'])) return $this->json->error('Quiz ID is required in delete body.');

            $deleted = $this->quiz->delete($data['id']);

            if ($deleted) echo 'Quiz deleted successfully.';
            else $this->json->error('Failed to delete quiz.', 500);
        }
        else $this->json->error('DELETE method must be used.');
    }

    /** */
    public function upload()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->call->library('upload', $_FILES['file']);

            $dir = 'public/images';
            $this->upload
                ->max_size(5)
                ->set_dir($dir)
                ->is_image()
                ->encrypt_name();

            if ($this->upload->do_upload()) {

                $filename = $this->upload->get_filename();
                $data = [
                    "id" => $this->io->post('id'),
                    "image" => $dir . "/" . $filename,
                ];

                # get the quiz first
                $quiz = $this->quiz->find($data['id']);

                # delete existing image file
                if ($quiz["image"] && file_exists($quiz["image"])) unlink($quiz["image"]);

                # add the file url
                $res = $this->quiz->update($data['id'], $data);

                $quiz["image"] = $data["image"];
                if ($res) $this->json->send($quiz);
                else $this->json->error("Failed to upload the image.", 500);
            }
            else {

                $errors = $this->upload->get_errors();
                $this->json->send($errors, 500);
            }
        } else $this->json->error('POST method must be used.');
    }

    public function unload()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

            # get quiz
            $data = $this->json->read();
            $quiz = $this->quiz->find($data['id']);

            # remove file
            if (file_exists($quiz["image"])) unlink($quiz["image"]);

            # update quiz
            $res = $this->quiz->update($data['id'], [ "image" => "" ]);

            $quiz['image'] = "";
            if ($res) $this->json->send($quiz);
            else $this->json->error("Failed to remove uploaded image.");

        } else $this->json->error('DELETE method must be used.');
    }

}
