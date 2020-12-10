<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Driver_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function new_driver($data){
        
        $this->db->insert('sma_drivers',$data);

        $return_Data=0;
        if ($this->db->affected_rows() == 1) {
            $return_Data=1;
            return $return_Data;
           
        } else {
             
            $return_Data=0;
            return $return_Data;
        }
                // echo json_encode(['data' => $user_address]);exit;

    
    }
    public function DriverExist($data)
    {
        
        $result=$this->db->query("SELECT * FROM `sma_drivers` WHERE `phone_no`='$data'")->result_array();
        return $result;
    }

    public function driverAllData($id)
    {

    }
    
     public function check_driver($phone,$password){
        $Encryptedpass=sha1($password);

       // echo $password;
        // $id = $this -> db -> select('*') -> where('user_id', $user_id)
        $id = $this->db->query("SELECT * FROM `sma_drivers` WHERE `phone_no` =$phone && `password` ='$Encryptedpass'");
        // -> get('user_address')
        // -> rows();
        // echo json_encode(['data' => $id]);exit;
        

        if (!is_null($id)) {
            return ['data' => $id->result_array()];

           
        } else {
            return array(
                'status' => false,
                'data' => []
            );
        }

    }public function check_driverphone($phone){
        

       // echo $password;
        // $id = $this -> db -> select('*') -> where('user_id', $user_id)
        $id = $this->db->query("SELECT * FROM `sma_drivers` WHERE `phone_no` =$phone");
        // -> get('user_address')
        // -> rows();
        // echo json_encode(['data' => $id]);exit;
        

        if (!is_null($id)) {
            return ['data' => $id->result_array()];

           
        } else {
            return array(
                'status' => false,
                'data' => []
            );
        }

    }
    public function update_driver($user_id,$rem_token,$latitude,$longitude){
        
        $this->db->query("UPDATE `sma_drivers` SET `device_token`='$rem_token' , `latitude`='$latitude' , `longitude`='$longitude' WHERE `id`=$user_id");
        if ($this->db->affected_rows() == 1) {

            return array(
                'status'=> '1',

            );
        } else {
              
            return array(
                'status' => '0'
            );
        }
               
    }
    public function check_availDriver($id)
    {
 // $id = $this -> db -> select('*') -> where('user_id', $user_id)
        $data = $this->db->query("SELECT * FROM sma_drivers WHERE `id` = '$id'")->result_array();
 // -> get('user_address')
 // -> rows();
 // echo json_encode(['data' => $id]);exit;
 
        
        if (!empty($data)) 
        {
                 return $data='1';

    
        } 
        else
        {
                return $data='0';
        }
        
    }

    public function update_driverData($id,$status,$latitude,$longitude)
    {
        
        $data=$this->db->query("UPDATE `sma_drivers` SET `latitude`='$latitude',`longitude`='$longitude',`status`='$status' WHERE `id`=$id");

        if ($data=='1') {

            return $response='1';
        } else {
              
            return $response='0';
        }
    }
    public function pending_order($id)
    {
        $sendData=array();
        $assinedOrder=$this->db->query("SELECT * FROM `sma_deliveries` WHERE `delivered_by`='$id'")->result_array();
        
        if(empty($assinedOrder))
        {
            return array();
         }
        else
        {
            foreach($assinedOrder as $orders)
            {
               
                
                if($orders['status']=='ASSIGNED')
                {
                   
                    $pendingOrder=$this->db->query("SELECT * FROM `sma_sales` WHERE `id`=' $orders[sale_id]'")->result_array();
                    $orderId=$pendingOrder[0]['id'];
                    $ordercustomer_id=$pendingOrder[0]['customer_id'];
                    $orderuser=$this->db->query("SELECT * FROM `sma_users` WHERE `id`='$ordercustomer_id'")->result_array();
                    foreach($orderuser as $userarray)
                    {
                        $userAddressID=$pendingOrder[0]['address_id'];
                        // print_r($userAddressID);
                        // exit;
                        $userAddress=$this->db->query("SELECT * FROM `sma_user_address` WHERE `address_id`='$userAddressID'")->result_array();
                        $userarray['address_line_1']=$userAddress[0]['address_line_1'];
                        $userarray['address_line_2']=$userAddress[0]['address_line_2'];
                        $userarray['map_address']=$userAddress[0]['map_address'];
                        $userarray['lat']=$userAddress[0]['lat'];
                        $userarray['lng']=$userAddress[0]['lng'];
                        $userarray['locality']=$userAddress[0]['locality'];
                        $userarray['address_type']=$userAddress[0]['address_type'];
                        

                        $updatedUserarray=$userarray;

                    }

                    $orderProducts=$this->db->query("SELECT * FROM `sma_sale_items` WHERE `sale_id`='$orderId'")->result_array();
                   foreach($orderProducts as $productArray)
                   {
                    //    print_r($productArray);
                    //    exit;
                    //    print_r($productArray['id']);
                    $orderProductsImage=$this->db->query("SELECT * FROM `sma_product_photos` WHERE `product_id`='$productArray[product_id]'")->result_array();
                    
                    $productArray['image']=$orderProductsImage[0]['photo'];
                    $newarray[]=$productArray;
                   }
                    $pendingOrder[0]['products']=$newarray;
                    $pendingOrder[0]['user']=$updatedUserarray;
                    $sendData[]=$pendingOrder[0];
                }
                
            }
                return $sendData;

        }

    }

    public function history_order($id)
    {
        $sendData=array();
        $assinedOrder=$this->db->query("SELECT * FROM `sma_deliveries` WHERE `delivered_by`='$id'")->result_array();
        if(empty($assinedOrder))
        {
            return array();
         }
        else
        {
            foreach($assinedOrder as $orders)
            {
                if($orders['status']=='DELIVERED')
                {
                   
                    $pendingOrder=$this->db->query("SELECT * FROM `sma_sales` WHERE `id`=' $orders[sale_id]'")->result_array();
                    $orderId=$pendingOrder[0]['id'];
                    $ordercustomer_id=$pendingOrder[0]['customer_id'];
                    $orderuser=$this->db->query("SELECT * FROM `sma_users` WHERE `id`='$ordercustomer_id'")->result_array();
                    foreach($orderuser as $userarray)
                    {
                        $userAddressID=$pendingOrder[0]['address_id'];
                        // print_r($userAddressID);
                        // exit;
                        $userAddress=$this->db->query("SELECT * FROM `sma_user_address` WHERE `address_id`='$userAddressID'")->result_array();
                        $userarray['address_line_1']=$userAddress[0]['address_line_1'];
                        $userarray['address_line_2']=$userAddress[0]['address_line_2'];
                        $userarray['map_address']=$userAddress[0]['map_address'];
                        $userarray['lat']=$userAddress[0]['lat'];
                        $userarray['lng']=$userAddress[0]['lng'];
                        $userarray['locality']=$userAddress[0]['locality'];
                        $userarray['address_type']=$userAddress[0]['address_type'];
                        

                        $updatedUserarray=$userarray;

                    }

                    $orderProducts=$this->db->query("SELECT * FROM `sma_sale_items` WHERE `sale_id`='$orderId'")->result_array();
                   foreach($orderProducts as $productArray)
                   {
                    //    print_r($productArray);
                    //    exit;
                    //    print_r($productArray['id']);
                    $orderProductsImage=$this->db->query("SELECT * FROM `sma_product_photos` WHERE `product_id`='$productArray[product_id]'")->result_array();
                    
                    $productArray['image']=$orderProductsImage[0]['photo'];
                    $newarray[]=$productArray;
                   }
                    $pendingOrder[0]['products']=$newarray;
                    $pendingOrder[0]['user']=$updatedUserarray;
                    $sendData[]=$pendingOrder[0];
                }
                
            }
                 return $sendData;
                 
        }

    }
    public function orderExist($id)
    {
        $existOrder=$this->db->query("SELECT * FROM `sma_sales` WHERE `id`='$id'")->result_array();
        return $existOrder;
    }
    public function updateOrder($id,$order_status,$user_id)
    {
        // print_r($order_status);
        // exit;

        $saleid=$this->db->query("SELECT * FROM `sma_deliveries` WHERE `id`='$id'")->result();
        
        
        if($order_status=='ASSIGNED')
        {
            $status="ASSIGNED";
        }
        else if($order_status=='ACCEPTED')
        {
            $status="RECEIVED";
        }
        else if($order_status=='PICKED')
        {
            $status="OUTFORDELIVERY.";
        }
        else if($order_status=='DELIVERED')
        {
            $status="DELIVERED.";
        }
        else
        {
                return false;
        }
        $saleId=$saleid[0]->sale_id;

    $data=$this->db->query("UPDATE `sma_sales` SET `sale_status`='$status' WHERE `id`=$saleId");

    $data=$this->db->query("UPDATE `sma_deliveries` SET `status`='$order_status' WHERE `id`=$id &&  `received_by`=$user_id");
    if ($data=='1') {

        return $response='1';
    } else {
          
        return $response='0';
    }
  }
  public function UpdateDriverProfile($id,$data)
  {
      $this->db->where('id',$id);
      return $this->db->update('sma_drivers',$data);
  }
  public function productDetail($id)
  {
      return $this->db->query("SELECT * FROM `sma_products` WHERE `id`=$id")->result_array();
  }
}



