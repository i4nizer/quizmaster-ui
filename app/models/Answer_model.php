<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class Answer_model extends Model
{

    /** Init database access. */
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
    }

    public function create($question_id, $text, $is_correct)
    {
        # Transact allows rollback
        $this->db->transaction();
        
        # Set data for INSERT
        $data = [
            'question_id' => $question_id,
            'text' => $text,
            'is_correct' => $is_correct,
        ];

        # Do it
        $res = $this->db->table('answers')->insert($data);

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
    
    public function get_user_category_question_all($user_id, $category_id, $question_id, $text, $is_correct)
    {
        # Get all
        $res = $this->db->table('answers')->where('user_id = ? AND category_id = ? AND question_id = ?', [$user_id, $category_id, $question_id])->get_all();

        # Means if $res exists then return it, else return false
        return $res ? $res : false;
    }

    public function update_user_category_question_one($answer_id, $user_id, $category_id, $question_id, $text, $is_correct)
    {
        # Create update data
        $data = [];
        
        # Start a Transact
        $this->db->transaction();

        # Update it
        $res = $this->db->table('answers')->where('answer_id = ? AND user_id = ? AND category_id = ? AND question_id = ?', [$answer_id, $user_id, $category_id, $question_id])->update($data);

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

    public function delete_user_category_question_one($answer_id, $user_id, $category_id, $question_id)
    {
        # Delete Category
        $res = $this->db->table('answers')->where('answer_id = ? AND user_id = ? AND category_id = ? AND question_id = ?', [$answer_id, $user_id, $category_id, $question_id])->delete();

        # Give $res if it has else false
        return $res ? $res : false;
    }

}