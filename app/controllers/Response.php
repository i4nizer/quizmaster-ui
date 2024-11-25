<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class Response extends Controller
{

    /** Init model */
    public function __construct()
    {
        parent::__construct();
        $this->call->model('Response_model', 'res');
        $this->call->library('json');
    }

    /** */
    public function get($responseId)
    {
        $response = $this->res->find($responseId);
        $this->json->send($response);
    }

    /** */
    public function get_by_quiz($quizId)
    {
        $responses = $this->res->get_by_quiz($quizId);
        $this->json->send($responses);
    }

    public function post()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->json->read();
            $data["user_id"] = get_user_id();
            $res = $this->res->insert($data);

            if ($res) {
                $data["id"] = $res;
                $this->json->send($data);
            } 
            else $this->json->error("Failed to create response.", 500);
        } 
        else $this->json->error("Incorrect request method or no data provided.");
    }

    public function patch()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
            $data = $this->json->read();
            $res = $this->res->update($data['id'], $data);

            if ($res) $this->json->send($data);
            else $this->json->error("Failed to update response.", 500);
        } 
        else $this->json->error("Incorrect request method or no data provided.");
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $data = $this->json->read();
            $res = null;

            # delete all at quiz level
            if (isset($data['quiz_id'])) {
                $res = $this->res->raw('delete from responses where quiz_id = ?', [$data['quiz_id']]);
            }
            # delete all at question level
            elseif (isset($data['question_id'])) {
                $res = $this->res->raw('delete from responses where question_id = ?', [$data['question_id']]);
            }
            # delete specific
            elseif (isset($data['id'])) {
                $res = $this->res->delete($data['id']);
            }
            # bad
            else $this->json->error("Response ID is required.");

            if ($res) $this->json->send($data);
            else $this->json->error("Failed to delete response.", 500);
        } 
        else $this->json->error("Incorrect request method or no data provided.");
    }

}