<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class Category_model extends Model
{

    /** Init database access. */
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
    }

    /** Create category */
    public function create($userId, $quizId, $name)
    {
        # Transact allows rollback
        $this->db->transaction();
        
        # Set data for INSERT
        $data = [
            'user_id' => $userId,
            'quiz_id' => $quizId,
            'name' => $name,
        ];

        # Do it
        $res = $this->db->table('categories')->insert($data);

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

    /** RETRIEVE all categories of the user. */
    public function get_user_all($userId)
    {
        # Get all
        $res = $this->db->table('categories')->where('user_id', $userId)->get_all();

        # Means if $res exists then return it, else return false
        return $res ? $res : false;
    }

    /** RETRIEVE all categories of a quiz of the user. */
    public function get_user_quiz_all($userId, $quizId)
    {
        # Query
        $res = $this->db->table('categories')->where('user_id = ? AND quiz_id = ?', [$userId, $quizId])->get_all();

        # Means if $res exists then return it, else return false
        return $res ? $res : false;
    }

    /** UPDATE a category */
    public function update_user_one($userId, $quizId, $categoryId, $name = null)
    {
        # Create update data
        $data = [];
        
        # Description is optional so only if it exists, add it
        if ($name != null) $data[ 'name' ] = $name;
        
        # Start a Transact
        $this->db->transaction();

        # Update it
        $res = $this->db->table('categories')->where('id = ? AND user_id = ? AND quiz_id = ?', [$categoryId, $userId, $quizId])->update($data);

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

    /** Hard Delete Category */
    public function delete_user_one($userId, $quizId, $categoryId)
    {
        # Delete Category
        $res = $this->db->table('categories')->where('id = ? AND user_id = ? AND quiz_id = ?', [$categoryId, $userId, $quizId])->delete();

        # Give $res if it has else false
        return $res ? $res : false;
    }


}