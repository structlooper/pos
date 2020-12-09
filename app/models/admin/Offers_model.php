<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Offers_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_offers(){
        $this->db->select('*');
        $this->db->from('sma_offers');
        return $this->db->get()->result_array();
    }
    public function save_new_offer(){
        $title = $_POST['offer_title'];
        $desc = $_POST['offer_desc'];
        $file = $_FILES['offer_image'];
        if(gettype($file) == NULL or sizeof($file) == 0 ){
            return ['status' => 0, 'msg' => 'image is not valid'];
        }else{
            $tempname = $_FILES["offer_image"]["tmp_name"];
            $filename = rand(10,10000).$_FILES['offer_image']['name'];
            $folder = "banners/offers/".$filename;
            if (move_uploaded_file($tempname, $folder))  {
                $data['offer_title'] = $title;
                $data['offer_desc'] = $desc;
                $data['offer_amount'] = $_POST['offer_amount'];
                $data['offer_type'] = $_POST['offer_type'];
                $data['offer_desc'] = $desc;
                $data['offer_image'] = base_url($folder);
                $data['created_at'] = date('Y-m-d H:i:s');
                $this->db->insert('sma_offers',$data);
                $banner_id = $this->db->insert_id();
                if(!is_null($banner_id)){
                    return ['status' => 1 , 'msg' => 'offer saved successfully'];
                }else{
                    return ['status' => 0, 'msg' => 'internal issue offer not saved'];
                }
            }else{
                return ['status' => 0, 'msg' => 'Failed to upload image'];
            }
        }
    }
    public function get_offer_by_id($id){
        $this->db->select('*');
        $this->db->from('sma_offers');
        $this->db->where('offer_id',$id);
        $offer_details = $this->db->get()->result_array()[0];
        return $offer_details;
    }
    public function update_offer($id){
        $title = $_POST['offer_title'];
        $file = $_FILES["offer_image"];
        // print_r(($file['name']));exit;
        if(gettype($file['name']) == NULL or $file['name'] == "" or sizeof($file) == 0 ){
            $image = $_POST['current_image'];
        }else{
            $tempname = $_FILES["offer_image"]["tmp_name"];
            $filename = rand(10,10000).$_FILES['offer_image']['name'];
            $folder = "banners/offers/".$filename;
            if (move_uploaded_file($tempname, $folder))  {
                $image= base_url($folder);
            }else{
                return ['status' => 0, 'msg' => 'Failed to upload image'];
            }
        }

        $data['offer_title'] = $title;
        $data['offer_amount'] = $_POST['offer_amount'];
        $data['offer_type'] = $_POST['offer_type'];
        $data['offer_desc'] = $_POST['offer_desc'];
        $data['offer_image'] = $image;
        $this->db->where('offer_id',$id);
        $this->db->update('sma_offers',$data);
        if($this->db->affected_rows() == 1){
            return ['status' => 1 , 'msg' => 'offer updated successfully'];
        }else{
            return ['status' => 0, 'msg' => 'internal issue offer not updated'];
        }
    }

    public function remove_offer_on_products($offer_id){
        $this->db->where('offer_id',$offer_id);
        $this->db->delete('sma_offer_products');
        if($this->db->affected_rows() == 1){
            return ['status' => 1 ];
        }else{
            return ['status' => 0, ];
        }
    }
    public function delete_offer($id){
        $result = $this->remove_offer_on_products($id);
        $this->db->where('offer_id',$id);
        $this->db->delete('sma_offers');
        if($this->db->affected_rows() == 1){
            return ['status' => 1,'msg' => 'Offer deleted successfully' ];
        }else{
            return ['status' => 0, 'msg' => 'internal error offer not deleted'];
        }
    }

}