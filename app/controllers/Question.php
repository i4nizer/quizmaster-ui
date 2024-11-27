<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class Question extends Controller
{

    /** Init model */
    public function __construct()
    {
        parent::__construct();
        $this->call->model('Question_model', 'question');
        $this->call->library('json');
    }

    /** */
    public function get($questionId)
    {
        $question = $this->question->find($questionId);
        $this->json->send($question);
    }

    /** */
    public function get_by_quiz($quizId)
    {
        $questions = $this->question->get_by_quiz($quizId);
        $this->json->send($questions);
    }

    public function post()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = $this->json->read();
            $res = $this->question->insert($data);

            if ($res) {
                $data["id"] = $res;
                $this->json->send($data);
            }
            else $this->json->error("Failed to create question.", 500);
        }
        else $this->json->error("Incorrect request method or no data provided.");
    }

    public function patch()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PATCH')
        {
            $data = $this->json->read();
            $res = $this->question->update($data['id'], $data);

            if ($res) {
                $res = $this->question->find($data['id']);
                $this->json->send($res);
            }
            else $this->json->error("Failed to update question.", 500);
        }
        else $this->json->error("Incorrect request method or no data provided.");
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') 
        {
            $data = $this->json->read();
            $res = $this->question->delete($data['id']);

            if ($res) $this->json->send($data);
            else $this->json->error("Failed to delete question.", 500);
        } 
        else $this->json->error("Incorrect request method or no data provided.");
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

                # get the question first
                $question = $this->question->find($data['id']);

                # delete existing image file
                if ($question["image"] && file_exists($question["image"])) unlink($question["image"]);

                # add the file url
                $res = $this->question->update($data['id'], $data);

                $question["image"] = $data["image"];
                if ($res) $this->json->send($question);
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

            # get question
            $data = $this->json->read();
            $question = $this->question->find($data['id']);

            # remove file
            if (file_exists($question["image"])) unlink($question["image"]);

            # update question
            $res = $this->question->update($data['id'], [ "image" => "" ]);

            $question['image'] = "";
            if ($res) $this->json->send($question);
            else $this->json->error("Failed to remove uploaded image.");

        } else $this->json->error('DELETE method must be used.');
    }

}