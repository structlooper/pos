<?php

defined('BASEPATH') or exit('No direct script access allowed');

class App_settings extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }
    public function get_app_about_settings(){
        $this->db->select('*');
        $this->db->from('sma_app_settings');
        $app_settings = $this->db->get()->result_array();
        return ['status' => true,'msg' => 'app about','data' => $app_settings];
    }
}