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
    public function create($name, $description = null)
    {
        # Transact allows rollback
        $this->db->transaction();
        
        # Set data for INSERT
        $data = [
            'name' => $name,
            'description' => $description,
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

    /** RETRIEVE all categories */
    public function getAll()
    {
        # Get all
        $res = $this->db->table('categories')->get_all();

        # Means if $res exists then return it, else return false
        return $res ? $res : false;
    }

    /** UPDATE a category */
    public function updateOne($categoryId, $name, $description = null)
    {
        # Create update data
        $data = [ 'name' => $name ];
        
        # Description is optional so only if it exists, add it
        if ($description != null) $data[ 'description' ] = $description;

        # Start a Transact
        $this->db->transaction();

        # Update it
        $res = $this->db->table('categories')->where('id', $categoryId)->update($data);

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
    public function deleteOne($categoryId)
    {
        # Delete Category
        $res = $this->db->table('categories')->where('id', $categoryId)->delete();

        # Give $res if it has else false
        return $res ? $res : false;
    }


}