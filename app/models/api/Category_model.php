<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_all_categories(){
        $catgories = $this->db->query("SELECT * FROM sma_categories");
        if (!is_null($catgories)) {
            return ['Categories' => $catgories->result()];
        } else {
            return array(
                'Categories' => []
            );
        }
    }
    
    public function get_all_sub_categories($category_id){
        // print_r($category_id);exit;
        $catgories = $this->db->query("SELECT * FROM sma_categories WHERE `parent_id` = '$category_id';");
        if (!is_null($catgories)) {
            return ['Categories' => $catgories->result()];
        } else {
            return array(
                'Categories' => []
            );
        }
    }
    public function check_category_by_id($category_id)
    {
        
         $catgories = $this->db->query("SELECT * FROM sma_categories WHERE `id` = '$category_id';");
        if (!is_null($catgories)) {
            return ['Categories' => $catgories->result()];
        } else {
            return array(
                'Categories' => []
            );
        }
    }
}