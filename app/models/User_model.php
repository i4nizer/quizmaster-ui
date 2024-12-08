<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class User_model extends Model
{

    public function __construct()
    {
        $this->has_soft_delete = false;
        $this->table = "users";
    }
    
}
