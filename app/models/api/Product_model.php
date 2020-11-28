<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_product_by_category($category_id){
          $products = $this->db->query("SELECT 
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
          
          
          FROM sma_products
          INNER JOIN sma_units ON sma_products.unit=sma_units.id
          WHERE sma_products.category_id = '$category_id' AND base_product_id IS NULL;");
        if (!is_null($products)) {
            return ['products' => $products->result()];
        } else {
            return array(
                'products' => []
            );
        }
    }
  
    public function get_product_by_subcategory($category_id,$sub_category_id){
          $products = $this->db->query("SELECT 
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
          
          
          FROM sma_products
          INNER JOIN sma_units ON sma_products.unit=sma_units.id
          WHERE sma_products.category_id = '$category_id' AND sma_products.subcategory_id ='$sub_category_id' AND base_product_id IS NULL");
        if (!is_null($products)) {
            return ( ['products' => $products->result()]);
        } else {
            return array(
                'products' => []
            );
        }
    }
    public function get_product_images($product_id){
        $product_images = $this->db->query("SELECT * FROM sma_product_photos WHERE product_id = '$product_id';");
         if (!is_null($product_images)) {
            return ( ['images' => $product_images->result()]);
        } else {
            return array(
                'images' => []
            );
        }
    }
    
    public function get_product_varients($product_id){
       $product_variants =  $this->db->query("SELECT 
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
          
          
          FROM sma_products
          INNER JOIN sma_units ON sma_products.unit=sma_units.id
          WHERE  sma_products.base_product_id = '$product_id'");
         if (!is_null($product_variants)) {
            return ( ['product_variants' => $product_variants->result()]);
        } else {
            return array(
                'product_variants' => []
            );
        } 
    }
    
    public function get_product_details(){
         $products = $this->db->query("SELECT * FROM sma_products WHERE base_product_id IS NULL ;")->result();
         return $products;
         
    }
    
}