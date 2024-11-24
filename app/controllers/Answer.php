<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class Answer extends Controller
{

    /** Init model */
    public function __construct()
    {
        parent::__construct();
        $this->call->model('Answer_model', 'ans');
        $this->call->library('json');
    }

    public function get($answerId)
    {
        $res = $this->ans->find($answerId);
        $this->json->send($res);
    }

    public function get_by_question($questionId)
    {
        $res = $this->ans->get_by_question($questionId);
        $this->json->send($res);
    }

    public function post()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->json->read();
            $res = $this->ans->insert($data);

            if ($res) {
                $data["id"] = $res;
                $this->json->send($data);
            } 
            else $this->json->error("Failed to create answer.", 500);
        } 
        else $this->json->error("Incorrect request method or no data provided.");
    }

    public function patch()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
            $data = $this->json->read();
            $res = $this->ans->update($data['id'], $data);

            if ($res) $this->json->send($data);
            else $this->json->error("Failed to update answer.", 500);
        } 
        else $this->json->error("Incorrect request method or no data provided.");
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $data = $this->json->read();
            $res = $this->ans->delete($data['id']);

            if ($res) $this->json->send($data);
            else $this->json->error("Failed to delete ans.", 500);
        } 
        else $this->json->error("Incorrect request method or no data provided.");
    }
}
