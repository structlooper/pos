<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_modal extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function new_user($data){
        
        $this->db->insert('sma_users',$data);
        if ($this->db->affected_rows() == 1) {
            return array(
                'status'        => true,

            );
           
        } else {
             
            return array(
                'status' => false
            );
        }
                // echo json_encode(['data' => $user_address]);exit;

    
    }
     public function check_user($phone){
        
        // $id = $this -> db -> select('*') -> where('user_id', $user_id)
        $id = $this->db->query("SELECT * FROM sma_users WHERE `phone` = '$phone';");
        // -> get('user_address')
        // -> rows();
        // echo json_encode(['data' => $id]);exit;
        

        if (!is_null($id)) {
            return ['data' => $id->result()];

           
        } else {
            return array(
                'status' => false,
                'data' => []
            );
        }

    }
    public function update_user($user_id,$data){
        
         $this->db->where('id', $user_id);
        $this->db->update('sma_users', $data);
        if ($this->db->affected_rows() == 1) {
            return array(
                'status'        => true,

            );
        } else {
              
            return array(
                'status' => false
            );
        }
               
    }

}