<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


class Quiz_model extends Model
{

    /** Init database access. */
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
    }

    /** Create a quiz. */
    public function create($userId, $title, $description)
    {
        $this->db->transaction();
        $data = [
            'title' => $title,
            'description' => $description,
            'creator_id' => $userId,
        ];

        $res = $this->db->table('quizzes')->insert($data);

        if ($res) {
            $this->db->commit();
            return $this->db->last_id();
        } else {
            $this->db->roll_back();
            return false;
        }
    }

    /** Get all quizzes. */
    public function get_all($deleted = false)
    {
        if ($deleted) return $this->db->table('quizzes')->where_not_null('deleted_at')->get_all();
        else return $this->db->table('quizzes')->where_null('deleted_at')->get_all();
    }

    /** Get specific quiz. */
    public function get_one($quizId, $deleted = false)
    {
        if ($deleted) return $this->db->table('quizzes')->where('id', $quizId)->where_not_null('deleted_at')->get();
        else return $this->db->table('quizzes')->where('id', $quizId)->where_null('deleted_at')->get();
    }

    /** Get all quizzes created by the user. */
    public function get_user_all($userId, $deleted = false)
    {
        if ($deleted) return $this->db->table('quizzes')->where('creator_id', $userId)->where_not_null('deleted_at')->get_all();
        else return $this->db->table('quizzes')->where('creator_id', $userId)->where_null('deleted_at')->get_all();
    }

    /** Get a specific quiz created by the user. */
    public function get_user_one($userId, $quizId, $deleted = false)
    {
        if ($deleted) return $this->db->table('quizzes')->where('id = ? AND creator_id', [$quizId, $userId])->where_not_null('deleted_at')->get();
        else return $this->db->table('quizzes')->where('id = ? AND creator_id', [$quizId, $userId])->where_null('deleted_at')->get();
    }

    /** Modifies specific user's quiz. */
    public function update_user_one($userId, $quizId, $title = null, $description = null)
    {
        $this->db->transaction();
        $data = [];

        if ($title !== null) $data['title'] = $title;
        if ($description !== null) $data['description'] = $description;

        $res = $this->db->table('quizzes')->where('creator_id = ? AND id = ?', [$userId, $quizId])->update($data);

        if ($res) {
            $this->db->commit();
            return true;
        } else {
            $this->db->roll_back();
            return false;
        }
    }

    /** Marks the tuple as deleted. */
    public function delete_user_one($userId, $quizId)
    {
        $this->db->transaction();
        $data = ['deleted_at' => date('Y-m-d H:i:s')];

        $res = $this->db->table('quizzes')->where('creator_id = ? AND id = ?', [$userId, $quizId])->update($data);

        if ($res) {
            $this->db->commit();
            return true;
        } else {
            $this->db->roll_back();
            return false;
        }
    }
}
