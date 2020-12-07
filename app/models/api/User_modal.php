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
    
    public function user_add_address($user_id){
        $data['address_line_1'] = $_POST['address_line_1'];
        $data['address_line_2'] = $_POST['address_line_2'];
        $data['locality'] = $_POST['locality'];
        $data['map_address'] = $_POST['map_address'];
        $data['lat'] = $_POST['lat'];
        $data['lng'] = $_POST['lng'];
        $data['address_type'] = strtoupper($_POST['address_type']);
        $data['user_id'] = $user_id;
        $data['created_at'] = strtotime(date('Y-d-m H:i:s'));
        if($data['address_line_1'] == '' or $data['address_line_2'] == '' or $data['map_address'] == '' or $data['lat'] == '' or $data['lng'] == ''){
            return ['status' => 'false' , 'msg' => 'please provide all required fields' , 'data' => [] ];
        }
        $this->db->insert('sma_user_address',$data);
        $address_id = $this->db->insert_id();
        if(is_null($address_id)){
            return ['status' => false, 'msg' => 'address not insert,some internal issue' , 'data' => []];
        }
        $this->db->select('*');
        $this->db->from('sma_user_address');
        $this->db->where('address_id',$address_id);
        $address_data = $this->db->get()->result_array()[0];
        if(sizeof($address_data) == 0){
            return ['status' => true,'msg' => 'user address not saved', 'data' => []];
        }
        return ['status' => true , 'msg' => 'address saved successfully', 'data' => $address_data];
    }
    
    public function get_user_address($user_id){
        $this->db->select('*');
        $this->db->from('sma_user_address');
        $this->db->where('user_id',$user_id);
        $user_addresses = $this->db->get()->result_array();
        if(sizeof($user_addresses) == 0){
            return ['status' => false, 'msg' => 'please add address', 'data' => []];
        }
        return ['status' => true, 'msg' => 'user address' ,'data' => $user_addresses];
    }
    
    public function update_user_address($user_id){
        $address_id = $_POST['address_id'];
        if(is_null($address_id) or $address_id == ''){
            return ['status' => false,'msg' => 'please enter a valid address_id','data' => []];
        }
        $data['address_line_1'] = $_POST['address_line_1'];
        $data['address_line_2'] = $_POST['address_line_2'];
        $data['locality'] = $_POST['locality'];
        $data['map_address'] = $_POST['map_address'];
        $data['address_type'] = strtoupper($_POST['address_type']);
        $data['lat'] = $_POST['lat'];
        $data['lng'] = $_POST['lng'];
        $data['user_id'] = $user_id;
        $data['updated_at'] = strtotime(date('Y-d-m H:i:s'));
        if($data['address_line_1'] == '' or $data['address_line_2'] == '' or $data['map_address'] == '' or $data['lat'] == '' or $data['lng'] == ''){
            return ['status' => 'false' , 'msg' => 'please provide all required fields' , 'data' => [] ];
        }
        $this->db->where('user_id',$user_id);
        $this->db->where('address_id',$address_id);
        $this->db->update('sma_user_address',$data);
         if ($this->db->affected_rows() == 1) {
            $this->db->select('*');
            $this->db->from('sma_user_address');
            $this->db->where('user_id',$user_id);
            $this->db->where('address_id',$address_id);
            $address_data = $this->db->get()->result_array()[0];
            return ['status' => true,'msg' => 'address updated successfully','data' => $address_data];
         }else{
             return ['status' => false,'msg' => 'internal error' , 'data' => []];
         }
        
    }
    
    public function delete_user_address($user_id){
        $address_id = $_POST['address_id'];
        if(is_null($address_id) or $address_id == ''){
            return ['status' => false,'msg' => 'please enter a valid address_id','data' => []];
        }
        $this->db->where('user_id',$user_id);
        $this->db->where('address_id',$address_id);
        $this->db->delete('sma_user_address');
         if ($this->db->affected_rows() == 1) {
            return ['status' => true,'msg' => 'address deleted successfully','data' => []];
         }else{
            return ['status' => false,'msg' => 'internal error' , 'data' => []];
             
         }
    }
    
   public function get_user_orders($user_id){
        $this->db->select('*');
                $this->db->from('sma_sales');
                $this->db->where('customer_id',$user_id);
                $orders = $this->db->get()->result_array();
                
                if(sizeof($orders) == 0){
                    return [ 'status' => false,'msg' => 'no orders found' , 'data' => []];
                }
                foreach( $orders as $order){
                    $this->db->select('*');
                    $this->db->from('sma_sale_items');
                    $this->db->where('sale_id',$order['id']);
                    $order_products = $this->db->get()->result_array();
                 $new['id'] = $order['id'];   
                 $new['date'] = $order['date'];   
                 $new['reference_no'] = $order['reference_no'];   
                 $new['customer_id'] = $order['customer_id'];   
                 $new['customer'] = $order['customer'];   
                 $new['biller_id'] = $order['biller_id'];   
                 $new['biller'] = $order['biller'];   
                 $new['warehouse_id'] = $order['warehouse_id'];   
                 $new['note'] = $order['note'];   
                 $new['staff_note'] = $order['staff_note'];   
                 $new['total'] = $order['total'];   
                 $new['product_discount'] = $order['product_discount'];   
                 $new['order_discount_id'] = $order['order_discount_id'];   
                 $new['total_discount'] = $order['total_discount'];   
                 $new['order_discount'] = $order['order_discount'];   
                 $new['product_tax'] = $order['product_tax'];   
                 $new['order_tax_id'] = $order['order_tax_id'];   
                 $new['order_tax'] = $order['order_tax'];   
                 $new['total_tax'] = $order['total_tax'];   
                 $new['shipping'] = $order['shipping'];   
                 $new['grand_total'] = $order['grand_total'];   
                 $new['sale_status'] = $order['sale_status'];   
                 $new['payment_status'] = $order['payment_status'];   
                 $new['payment_term'] = $order['payment_term'];   
                 $new['due_date'] = $order['due_date'];   
                 $new['created_by'] = $order['created_by'];   
                 $new['updated_by'] = $order['updated_by'];   
                 $new['updated_at'] = $order['updated_at'];   
                 $new['total_items'] = $order['total_items'];   
                 $new['pos'] = $order['pos'];   
                 $new['paid'] = $order['paid'];   
                 $new['return_id'] = $order['return_id'];   
                 $new['surcharge'] = $order['surcharge'];   
                 $new['attachment'] = $order['attachment'];   
                 $new['return_sale_ref'] = $order['return_sale_ref'];   
                 $new['sale_id'] = $order['sale_id'];   
                 $new['return_sale_total'] = $order['return_sale_total'];   
                 $new['rounding'] = $order['rounding'];   
                 $new['suspend_note'] = $order['suspend_note'];   
                 $new['api'] = $order['api'];   
                 $new['shop'] = $order['shop'];   
                 $new['address_id'] = $order['address_id'];   
                 $new['reserve_id'] = $order['reserve_id'];   
                 $new['hash'] = $order['hash'];   
                 $new['manual_payment'] = $order['manual_payment'];   
                 $new['cgst'] = $order['cgst'];   
                 $new['sgst'] = $order['sgst'];   
                 $new['igst'] = $order['igst'];   
                 $new['payment_method'] = $order['payment_method'];   
                 $new['order_products'] = $order_products;   
                $b_new[] = $new;
                }
                $final_orders = $b_new;
                return ['status' => true, 'msg' => 'user orders', 'data' => array_reverse($final_orders)];
   }
   public function get_user_profile_details($user_id){
       $this->db->select('*');
       $this->db->from('sma_users');
       $this->db->where('id',$user_id);
       $user_details = $this->db->get()->result_array()[0];
       return [ 'status' => true, 'msg' => 'user details' , 'data' => $user_details];
   }
   public function update_user_profile_details($user_id){
        $data['username'] = $_POST['username'];
        $data['email'] = $_POST['email'];
        $data['first_name'] = $_POST['first_name'];
        $data['last_name'] = $_POST['last_name'];
        $data['gender'] = $_POST['gender'];
        if($data['username'] = '' or $data['email'] = '' or $data['first_name'] = '' or $data['gender'] = ''){
            return [ 'status' => false,'msg' => 'Please fill all required details','data' => []];
        }
        $this->db->where('id',$user_id);
        $this->db->update('sma_users',$data);
        $result = $this->get_user_profile_details($user_id);
        return ['status' => true,'msg'=>'user profile updated successfully' ,'data'=> $result['data']];
   }
}