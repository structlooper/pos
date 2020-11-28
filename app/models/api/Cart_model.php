<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cart_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
       
    }
    public function check_product_cart($u_id,$p_id){
        $status = 'ADDED';
         
        $user_cart = $this->db->query("SELECT 
          *
          FROM sma_user_cart
          WHERE user_id = '$u_id' AND cart_status = '$status';");
          
        if (sizeof($user_cart->result()) > 0) {
            $cart_id = $user_cart->result()[0]->cart_id;
            $user_cart_product = $this->db->query("SELECT 
          *
          FROM sma_user_cart_products
          WHERE cart_id = '$cart_id' AND product_id = '$p_id' AND variant_id IS NULL;");
          if(sizeof($user_cart_product->result()) > 0){
                $this->db->where('cart_id', $cart_id);
             $this->db->where('product_id', $p_id);
             $this->db->update('sma_user_cart_products', ['qty' => intval($user_cart_product->result()[0]->qty)+1]);
              return array('status' => 1);
          }else{
             return array(
                'status' => 0
            );  
          }
        } else {
            return array(
                'status' => 0
            );
        }
          
    }
    
    // public function check_product_variant_cart($u_id,$p_id,$v_id){
        
    //     $status = 'ADDED';
    //     $user_cart = $this->db->query("SELECT 
    //       *
    //       FROM sma_user_cart
    //       WHERE user_id = '$u_id' AND cart_status = '$status';");
    //     if (sizeof($user_cart->result()) > 0) {
    //         $cart_id = $user_cart->result()[0]->cart_id;
            
    //         $user_cart_product = $this->db->query("SELECT 
    //       *
    //       FROM sma_user_cart_products
    //       WHERE cart_id = '$cart_id' AND product_id = '$p_id' AND variant_id = '$v_id';");
          
    //       if(sizeof($user_cart_product->result()) > 0){
    //          $this->db->where('cart_id', $cart_id);
    //          $this->db->where('product_id', $p_id);
    //          $this->db->where('variant_id', $v_id);
    //          $this->db->update('sma_user_cart_products', ['qty' => intval($user_cart_product->result()[0]->qty)+1]);
    //           return array('status' => 1);
    //       }else{
    //          return array(
    //             'status' => 0
    //         );  
    //       }
    //     } else {
    //         return array(
    //             'status' => 0
    //         );
    //     }
          
    // }
    public function add_product_cart($u_id,$p_id,$qty){
         $status = 'ADDED';
        $user_cart = $this->db->query("SELECT 
          *
          FROM sma_user_cart
          WHERE user_id = '$u_id' AND cart_status = '$status';"); 
          if (sizeof($user_cart->result()) > 0) {
               $cart_id = $user_cart->result()[0]->cart_id;
              
          }else{
              $data = ['user_id' => $u_id,'created_at' => strtotime(date('Y-m-d H:i:s'))];
              $this->db->insert('sma_user_cart',$data);
              $cart_id = $this->db->insert_id();
              
          }
           $data = [
                   'cart_id' => $cart_id,
                   'product_id' => $p_id,
                   'qty' => $qty
                   ];
                   $this->db->insert('sma_user_cart_products',$data);
          if($this->db->affected_rows() == 1){
              return true;
          }else{
             return false;
          }
    }
    
    public function add_product_variant_cart($u_id,$p_id,$v_id,$qty){
       
         $status = 'ADDED';
        $user_cart = $this->db->query("SELECT 
          *
          FROM sma_user_cart
          WHERE user_id = '$u_id' AND cart_status = '$status';"); 
          if (sizeof($user_cart->result()) > 0) {
               $cart_id = $user_cart->result()[0]->cart_id;
              
          }else{
              $data = ['user_id' => $u_id,'created_at' => strtotime(date('Y-m-d H:i:s'))];
              $this->db->insert('sma_user_cart',$data);
              $cart_id = $this->db->insert_id();
              
          }
          
           $data = [
                   'cart_id' => $cart_id,
                   'product_id' => $p_id,
                   'variant_id' => $v_id,
                   'qty' => $qty
                   ];
                   $this->db->insert('sma_user_cart_products',$data);
          if($this->db->affected_rows() == 1){
              return true;
          }else{
             return false;
          }
    }
    
    public function get_cart_data($user_id){
       $status = 'ADDED';
        $user_cart = $this->db->query("SELECT 
          *
          FROM sma_user_cart
          WHERE user_id = '$user_id' AND cart_status = '$status';"); 
          $cart = $user_cart->result()[0];
          $data['cart_id'] = $cart->cart_id;
          $data['user_id'] = $cart->user_id;
        //   $data['note'] = $cart->note;
        //   $data['cart_status'] = $cart->cart_status;
          $data['created_at'] = date('Y-m-d H:m',$cart->created_at);
        
          $products = $this->db->query("
                  SELECT 
                  sma_products.id AS product_id,
                  sma_products.code,
                  sma_products.name ,
                  sma_units.name AS product_unit,
                  sma_products.cost ,
                  sma_products.price ,
                  sma_products.alert_quantity ,
                  sma_products.image ,
                  sma_products.tax_rate ,
                  sma_products.track_quantity ,
                  sma_products.details ,
                  sma_products.barcode_symbology ,
                  sma_products.product_details ,
                  sma_products.type ,
                  sma_products.slug ,
                  sma_products.category_id ,
                  sma_products.subcategory_id ,
                  sma_products.featured ,
                  sma_products.weight ,
                  sma_products.views ,
                  sma_products.second_name ,
                  sma_products.hide ,
                  sma_products.hide_pos 
                  FROM sma_user_cart_products  INNER JOIN sma_products ON sma_user_cart_products.product_id = sma_products.id 
                  INNER JOIN sma_units ON sma_products.unit=sma_units.id 
                  WHERE sma_user_cart_products.cart_id = '$cart->cart_id';
                  ")->result()[0]; 
          $data['items'] = count($products);
          
          $data['products'] = $products; 
            
        return $data;
          
    }
        public function check_product_user_cart($u_id,$p_id){
        $status = 'ADDED';
        
        $user_cart = $this->db->query("SELECT 
          *
          FROM sma_user_cart
          WHERE user_id = '$u_id' AND cart_status = '$status';");
          
        if (sizeof($user_cart->result()) > 0) {
            $cart_id = $user_cart->result()[0]->cart_id;
            $user_cart_product = $this->db->query("SELECT 
          *
          FROM sma_user_cart_products
          WHERE cart_id = '$cart_id' AND product_id = '$p_id' AND variant_id IS NULL;");
        
          if(sizeof($user_cart_product->result()) > 0){
              return array('status' => 1);
          }else{
             return array(
                'status' => 0
            );  
          }
        } else {
            return array(
                'status' => 0
            );
        }
          
    }
    // public function check_product_variant_user_cart($u_id,$p_id,$v_id){
    //     $status = 'ADDED';
        
    //     $user_cart = $this->db->query("SELECT 
    //       *
    //       FROM sma_user_cart
    //       WHERE user_id = '$u_id' AND cart_status = '$status';");
          
    //     if (sizeof($user_cart->result()) > 0) {
    //         $cart_id = $user_cart->result()[0]->cart_id;
    //         $user_cart_product = $this->db->query("SELECT 
    //       *
    //       FROM sma_user_cart_products
    //       WHERE cart_id = '$cart_id' AND product_id = '$p_id' AND variant_id = '$v_id';");
        
    //       if(sizeof($user_cart_product->result()) > 0){
    //           return array('status' => 1);
    //       }else{
    //          return array(
    //             'status' => 0
    //         );  
    //       }
    //     } else {
    //         return array(
    //             'status' => 0
    //         );
    //     }
          
    // }
    
    public function remove_product_from_cart($user_id,$product_id,$qty){
         $status = 'ADDED';
      
        $user_cart = $this->db->query("SELECT 
          *
          FROM sma_user_cart
          WHERE user_id = '$user_id' AND cart_status = '$status';"); 
          if (sizeof($user_cart->result()) > 0) {
               $cart_id = $user_cart->result()[0]->cart_id;
               $user_cart_product = $this->db->query("SELECT 
              *
              FROM sma_user_cart_products
              WHERE cart_id = '$cart_id' AND product_id = '$product_id' AND variant_id IS NULL;");
              
               if($qty == 0 or $user_cart_product->result()[0]->qty == 1){
                  
                   $this->db->where('cart_id', $cart_id);
                   $this->db->where('product_id', $product_id);
                   $this->db->where('variant_id', null);
                   $this->db->delete('sma_user_cart_products');
                   
                   return ['status' => true, 'msg' => 'Product deleted successfully'];
               }else{
                  $this->db->where('cart_id', $cart_id);
                  $this->db->where('product_id', $product_id);
                  $this->db->where('variant_id', null);
                  $this->db->update('sma_user_cart_products', ['qty' => intval($user_cart_product->result()[0]->qty)-1]);  
                  
                   return ['status' => true, 'msg' => 'Product count decreased successfully'];
                  
               }
             
          }else{
              
              return false;
              
          }
           
    }
    // public function remove_product_variant_from_cart($user_id,$product_id,$variant_id,$qty){
    //      $status = 'ADDED';
      
    //     $user_cart = $this->db->query("SELECT 
    //       *
    //       FROM sma_user_cart
    //       WHERE user_id = '$user_id' AND cart_status = '$status';"); 
    //       if (sizeof($user_cart->result()) > 0) {
    //           $cart_id = $user_cart->result()[0]->cart_id;
    //           $user_cart_product = $this->db->query("SELECT 
    //           *
    //           FROM sma_user_cart_products
    //           WHERE cart_id = '$cart_id' AND product_id = '$product_id' AND variant_id = '$variant_id';");
              
    //           if($qty == 0 or $user_cart_product->result()[0]->qty == 1){
                  
    //               $this->db->where('cart_id', $cart_id);
    //               $this->db->where('product_id', $product_id);
    //               $this->db->where('variant_id', $variant_id);
    //               $this->db->delete('sma_user_cart_products');
                   
    //               return ['status' => true, 'msg' => 'Product deleted successfully'];
    //           }else{
    //               $this->db->where('cart_id', $cart_id);
    //               $this->db->where('product_id', $product_id);
    //               $this->db->where('variant_id', $variant_id);
    //               $this->db->update('sma_user_cart_products', ['qty' => intval($user_cart_product->result()[0]->qty)-1]);  
                  
    //               return ['status' => true, 'msg' => 'Product count changed successfully'];
                  
    //           }
             
    //       }else{
              
    //           return false;
              
    //       }
           
    // }

}