<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class Question_model extends Model
{

    /** Init database access. */
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
    }

    public function create($user_id, $category_id, $number, $text)
    {
        # Transact allows rollback
        $this->db->transaction();
        
        # Set data for INSERT
        $data = [
            'user_id' => $userId,
            'category_id' => $categoryId,
            'number' => $number,
            'text' => $text,
        ];

        # Do it
        $res = $this->db->table('questions')->insert($data);

        # If $res is not null means all goods
        if ($res) {
            
            # Commit and return the id of the category
            $this->db->commit();
            return $this->db->last_id();
        } 
        # If $res is null means not inserted
        else {

            # Unsuccessful, rollback then return false
            $this->db->roll_back();
            return false;
        }
    }

    public function get_user_category_all($user_id, $category_id)
    {
        # Get all
        $res = $this->db->table('questions')->where('user_id = ? and category_id = ?', [$user_id, $category_id])->get_all();

        # Means if $res exists then return it, else return false
        return $res ? $res : false;
    }

    public function update_user_one($user_id, $category_id, $number = null, $text = null)
    {
        # Create update data
        $data = [];
        
        # Description is optional so only if it exists, add it
        if ($number != null) $data[ 'number' ] = $number;
        if ($text != null) $data[ 'text' ] = $text;
        
        # Start a Transact
        $this->db->transaction();

        # Update it
        $res = $this->db->table('questions')->where('user_id = ? AND category_id = ?', [$user_id, $category_id])->update($data);

        # If $res is not null means all goods
        if ($res) {

            # Commit and return the id of the category
            $this->db->commit();
            return $this->db->last_id();
        }
        # If $res is null means not inserted
        else {

            # Unsuccessful, rollback then return false
            $this->db->roll_back();
            return false;
        }
    }

    public function delete_user_one($question_id, $user_id, $category_id)
    {
        # Delete Category
        $res = $this->db->table('questions')->where('id = ? AND user_id = ? AND category_id = ?', [$question_id, $user_id, $category_id])->delete();

        # Give $res if it has else false
        return $res ? $res : false;
    }

}