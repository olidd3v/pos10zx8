<?php

class Trans_model extends CI_Model
{
    public function insert($trans)
    {            
        // users is the name of the db table you are inserting in
        return $this->db->insert('trans', $trans);
    }

    public function get_by_id($id){
      $data = array();
      $this->db->where('code', $id);
      $query = $this->db->get('trans');
      $res   = $query->result();        
      return $res;
    }
}