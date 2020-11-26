<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
class Category extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();	
         $this->load->api_model('Category_model');
       
	}
    
    public function index_get(){
      $cat = $this->Category_model->get_all_categories();
      if(sizeof($cat) > 0){
      foreach($cat as $itm){
        foreach($itm as $dat){
          if($dat->parent_id == '0' or $dat->parent_id == null or $dat->parent_id == ''){
              $categories[] = $dat;
          }
   
        }
      }
      }else{
          $categories = [];
      }
      $response = [
          'status' => true,
          'msg' => 'Catgeories',
          'data' => $categories
          
          ];
          $this->response($response);

    }
  
  
}