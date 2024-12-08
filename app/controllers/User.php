<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class User extends Controller
{

    /** Init model */
    public function __construct()
    {
        parent::__construct();
        $this->call->model('User_model', 'user');
        $this->call->library('json');
    }

    /** Just for editing username */
    public function patch()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
            # get current user
            $user = $this->user->find(get_user_id());
            
            # get data
            $data = $this->json->read();

            # nothing is changed
            if ($user['username'] == $data['username']) return $this->json->send($user);

            # apply change
            $res = $this->user->update(get_user_id(), ['username' => $data['username']]);
            $user['username'] = $data['username'];

            if ($res) $this->json->send($user);
            else $this->json->error("Failed to update user.", 500);
        } 
        else $this->json->error("Incorrect request method or no data provided.");
    }


}