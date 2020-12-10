<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
class Driver extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();	
		$this->load->library('Authorization_Token');
// 		$this->load->database();
         $this->load->api_model('Driver_model');
         
         $this->load->helper(array('form'));
         $this->load->library('form_validation');
	}
  
	

    public function registration_post()
    {

        $ExistanceDriver = $this->Driver_model->DriverExist($_POST['phoneno']);
        // print_r($ExistanceDriver);
        // exit;
        if(!empty($ExistanceDriver))
        {
         
            $final = array();
		$final['status'] = false;
		$final['msg'] = 'Phone no already Exist';
		$final['data'] = [$_POST['phoneno']];
 
		 return    $this->response($final);
        }
        $name = $_POST["name"];
        $profile_image = $_POST["image"];
                 $namafoto = time() . '-' . rand(0, 99999) . ".jpg";
                $path = "assets/driver/" . $namafoto;
                file_put_contents($path, base64_decode($profile_image));

                $foto =$_POST["image"];
                $path = "./assets/driver/$foto";


        $doc1 = $_POST["document1"];
                   $namafoto1 = time() . '-' . rand(0, 99999) . ".jpg";
                   $path1 = "assets/driver/" . $namafoto1;
                    file_put_contents($path1, base64_decode($doc1));
                   $foto1 =$_POST["document1"];
                   $path1 = "./assets/driver/$foto1";

        $doc2 = $_POST["document2"];
                   $namafoto2 = time() . '-' . rand(0, 99999) . ".jpg";
                   $path2 = "assets/driver/" . $namafoto2;
                    file_put_contents($path1, base64_decode($doc2));
                   $foto2 =$_POST["document2"];
                   $path2 = "./assets/driver/$foto2";
        $vehicle_name=$_POST['vehicle_name'];
        $vehicle_number=$_POST['vehicle_number'];
        $vehicle_color=$_POST['vehicle_color'];
        $delivery_range=$_POST['delivery_range'];
        $latitude=$_POST['latitude'];
        $longitude=$_POST['longitude'];
        $email=$_POST['email'];
        $password=sha1($_POST['password']);
        $phone=$_POST['phoneno'];
        $device_token=$_POST['device_token'];

        $data = [
            'name' => $name,
            'profile_image' => $namafoto,
            'document1' => $namafoto1,
            'document2' => $namafoto2,
            'vehicle_name' => $vehicle_name,
            'vehicle_number' => $vehicle_number,
            'vehicle_color' => $vehicle_color,
            'delivery_range' => $delivery_range,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'email' => $email,
            'password'=>$password,
            'phone_no' => $phone,
            'device_token' => $device_token
            
            ];
            $status_reg = $this->Driver_model->new_driver($data);
            $final = array();
            if($status_reg==1)
          {
           
		    $final['status'] = true;
		    $final['msg'] = 'user registered successfully';
		    $final['data'] = $data;
          }
            else
            {
                $final['status'] = false;
                $final['msg'] = 'user registeration failed';
                $final['data'] = $data;
            }
            $this->response($final); 


    }
    


    public function login_post()
    
    {  
        if( !isset($_POST['phoneno']) && !isset($_POST['password']) && !isset($_POST['device_token']) && !isset($_POST['latitude']) && !isset($_POST['longitude']))
        

        {
            $final = array();
                $final['status'] = false;
                $final['msg'] = 'fields missing';
                $final['data'] =  null;
                return $this->response($final);  
        }

           else
           {

        if(!$_POST['phoneno'] || !$_POST['password'] || !$_POST['device_token'] || !$_POST['latitude'] || !$_POST['longitude'])
        {
            $final = array();
                $final['status'] = false;
                $final['msg'] = 'fields null';
                $final['data'] = null;
                return $this->response($final);    
        }
        else
        {
        $phone = $_POST['phoneno'];
        $password = $_POST['password'];
        $rem_token = $_POST['device_token'];
        $latitude=$_POST['latitude'];
        $longitude=$_POST['longitude'];
		$token_data['phone'] = $phone;

        
        $user = $this->Driver_model->check_driver($phone,$password);

        if(sizeof($user['data']) > 0){
       
            if($user['data'][0]['approval']=='0')
            {
                $final = array();
                $final['status'] = false;
                $final['msg'] = 'Not approved by Admin';
                $final['data'] = null;
                return $this->response($final); 
            }
            

            // user already exist
                    // print_r($user['data'][0]);exit;
                    $data = [
                         'device_token' => $rem_token   
                        ];
                        $user_id = $user['data'][0]['id'];
        
                   $updatestatus=$this->Driver_model->update_driver($user_id,$rem_token,$latitude,$longitude);
                   if($updatestatus['status']=='1')
                   {
                    $token_data['user_id'] = $user_id;
                    $token_data['phone'] = $user['data'][0]['phone_no'];
                    $token_data['password'] = $user['data'][0]['password'];
                    $token_data['device_token'] = $user['data'][0]['device_token'];
                   }
                   else
                   {
                    $final = array();
                    $final['status'] = false;
                    $final['msg'] = 'Data updation failed';
                    // $final['data'] = ;
                    $this->response($final); 
                   }

        }
        else
                   {
                      $checkExistance=$this->Driver_model->check_driverphone($phone);
                      
                      if(empty($checkExistance['data']))
                      {

                      
                    $final = array();
                    $final['status'] = false;
                    $final['msg'] = 'Driver Doesnt Exist';
                    // $final['data'] = $ob;
                     return $this->response($final); 
                      }
                      else
                      {
                        $final = array();
                        $final['status'] = false;
                        $final['msg'] = 'Incorrect Password';
                        // $final['data'] = $ob;
                       return $this->response($final); 
                      }
                   }


        $user = $this->Driver_model->check_driver($phone,$password);
            
        $token_data['user_id'] = $user['data'][0]['id'];
        $token_data['phone'] = $user['data'][0]['phone_no'];
        $token_data['password'] = $user['data'][0]['password'];
        $token_data['device_token'] = $user['data'][0]['device_token'];
		$tokenData = $this->authorization_token->generateToken($token_data);
        $ExistanceDriver = $this->Driver_model->DriverExist($phone);
        // print_r($ExistanceDriver);
        // exit;
		$final = array();
		$final['status'] = true;
		$final['msg'] = 'Driver looged in successfully';
		$final['data'] = ['token' => $tokenData,'phone'=> $token_data['phone'],'name'=>$ExistanceDriver[0]['name'],'id'=>$ExistanceDriver[0]['id'],'profile_image'=>$ExistanceDriver[0]['profile_image'],'document1'=>$ExistanceDriver[0]['document1'],'document2'=>$ExistanceDriver[0]['document2'],'vehicle_name'=>$ExistanceDriver[0]['vehicle_name'],'vehicle_number'=>$ExistanceDriver[0]['vehicle_number'],'vehicle_color'=>$ExistanceDriver[0]['vehicle_color'],'delivery_range'=>$ExistanceDriver[0]['delivery_range'],'longitude'=>$ExistanceDriver[0]['longitude'],'email'=>$ExistanceDriver[0]['email'],'phone_no'=>$ExistanceDriver[0]['phone_no'],'device_token'=>$ExistanceDriver[0]['device_token'],'status'=>$ExistanceDriver[0]['status'],'approval'=>$ExistanceDriver[0]['approval'],'created_at'=>$ExistanceDriver[0]['created_at']];
 
        $this->response($final); 
    }
    }
	}
	
    public function driver_status_post()
    {

        $decodedToken = $this->authorization_token->validateToken($_POST['Authorization']);
	    $user_id = $decodedToken['data']->user_id;
	    if(!is_null($user_id)){

        $id=$user_id;
        $status=$_POST['status'];
        $latitude=$_POST['latitude'];
        $longitude=$_POST['longitude'];
        $user = $this->Driver_model->check_availDriver($id);  
       
        if($user!='1')
        {
            $final = array();
		$final['status'] = false;
		$final['msg'] = 'Driver not found';
		$final['data'] = null;
 
		$this->response($final); 
        } 
        else
        {
            $userUp = $this->Driver_model->update_driverData($id,$status,$latitude,$longitude); 
            if($userUp=='1')
            {
                $final = array();
                $final['status'] = true;
                $final['msg'] = 'Driver Updated';
                $final['data'] = null;
         
                $this->response($final); 
            }
            else
            {
                $final = array();
                $final['status'] = false;
                $final['msg'] = 'Driver Not updated';
                $final['data'] = null;
         
                $this->response($final); 
            }
        }
    }
    else{
        $this->response(['status' => false,'msg' => 'not a valid user', 'data' => null]);
     }

    }
    public function pendingorders_post()
    {
        $decodedToken = $this->authorization_token->validateToken($_POST['Authorization']);
	    $user_id = $decodedToken['data']->user_id;
	    if(!is_null($user_id)){
        $driverId=$user_id;
        $user = $this->Driver_model->check_availDriver($driverId);  
       
        if($user!='1')
        {
            $final = array();
		$final['status'] = false;
		$final['msg'] = 'Driver not found';
		$final['data'] = null;
 
		$this->response($final); 
        } 
        else
        {
            $userPending = $this->Driver_model->pending_order($driverId);
            if(empty($userPending))
            {
                $final = array();
                $final['status'] = false;
                $final['msg'] = 'No Pending Orders';
                $final['data'] = null;
         
                $this->response($final);
            }
            else
            {
                $final = array();
                $final['status'] = true;
                $final['msg'] = 'All Pending Orders';
                $final['data'] = $userPending;
         
                $this->response($final);
            }
        }
    }else{
        $this->response(['status' => false,'msg' => 'not a valid user', 'data' => null]);
     }
    }

    public function completedOrders_post()
    {
      
        $decodedToken = $this->authorization_token->validateToken($_POST['Authorization']);
	    $user_id = $decodedToken['data']->user_id;
	    if(!is_null($user_id)){
        $driverId=$user_id;
        $user = $this->Driver_model->check_availDriver($driverId);  
       
        if($user!='1')
        {
            $final = array();
		$final['status'] = false;
		$final['msg'] = 'Driver not found';
		$final['data'] = null;
 
		$this->response($final); 
        } 
        else
        {
            $userCompleted = $this->Driver_model->history_order($driverId);
            if(empty($userCompleted))
            {
                $final = array();
                $final['status'] = false;
                $final['msg'] = 'Never Assined any order';
                $final['data'] = null;
         
                $this->response($final);
            }
            else
            {
                $final = array();
                $final['status'] = true;
                $final['msg'] = 'All Completed Orders';
                $final['data'] = $userCompleted;
         
                $this->response($final);
            }
        }
    }else{
        $this->response(['status' => false,'msg' => 'not a valid user', 'data' => null]);
     }
    }
    public function orderStausChange_post()
    {
        $decodedToken = $this->authorization_token->validateToken($_POST['Authorization']);
	    $user_id = $decodedToken['data']->user_id;
	    if(!is_null($user_id)){

        $order_id=$_POST["order_id"];
        $order_status=$_POST["order_status"];
        $OrderExist = $this->Driver_model->orderExist($order_id);
        if(empty($OrderExist))
        {
            $final = array();
                $final['status'] = false;
                $final['msg'] = 'Order Not available';
                $final['data'] = $OrderExist;
         
                $this->response($final);
        }
        else
        {
            $UpdateOrder = $this->Driver_model->updateOrder($order_id,$order_status,$user_id);
            if($UpdateOrder=='1')
            {
                $final = array();
                $final['status'] = true;
                $final['msg'] = 'Order Status Changed';
                $final['data'] = $UpdateOrder;
         
                $this->response($final);
            }
            else
            {
                $final = array();
                $final['status'] = false;
                $final['msg'] = 'Order Status Change Failed Try Again';
                $final['data'] = $UpdateOrder;
         
                $this->response($final);
            }
        }

    }else{
        $this->response(['status' => false,'msg' => 'not a valid user', 'data' => null]);
     }
    }

    public function UpdateDriver_post()
    { 
        $decodedToken = $this->authorization_token->validateToken($_POST['Authorization']);
	    $user_id = $decodedToken['data']->user_id;
	    if(!is_null($user_id)){

        $id=$user_id;
        $name=$_POST["name"];
        
        $profile_image = $_POST["image"];
                 $namafoto = time() . '-' . rand(0, 99999) . ".jpg";
                $path = "assets/driver/" . $namafoto;
                file_put_contents($path, base64_decode($profile_image));

                $foto =$_POST["image"];
                $path = "./assets/driver/$foto";


        $doc1 = $_POST["document1"];
                   $namafoto1 = time() . '-' . rand(0, 99999) . ".jpg";
                   $path1 = "assets/driver/" . $namafoto1;
                    file_put_contents($path1, base64_decode($doc1));
                   $foto1 =$_POST["document1"];
                   $path1 = "./assets/driver/$foto1";

        $doc2 = $_POST["document2"];
                   $namafoto2 = time() . '-' . rand(0, 99999) . ".jpg";
                   $path2 = "assets/driver/" . $namafoto2;
                    file_put_contents($path1, base64_decode($doc2));
                   $foto2 =$_POST["document2"];
                   $path2 = "./assets/driver/$foto2";
        $vehicle_name=$_POST['vehicle_name'];
        $vehicle_number=$_POST['vehicle_number'];
        $vehicle_color=$_POST['vehicle_color'];
        $delivery_range=$_POST['delivery_range'];
        $latitude=$_POST['latitude'];
        $longitude=$_POST['longitude'];
        $email=$_POST['email'];
        $password=sha1($_POST['password']);
        $phone=$_POST['phoneno'];
        $device_token=$_POST['device_token'];
        
        $data = [
            'name' => $name,
            'profile_image' => $namafoto,
            'document1' => $namafoto1,
            'document2' => $namafoto2,
            'vehicle_name' => $vehicle_name,
            'vehicle_number' => $vehicle_number,
            'vehicle_color' => $vehicle_color,
            'delivery_range' => $delivery_range,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'email' => $email,
            'password'=>$password,
            'phone_no' => $phone,
            'device_token' => $device_token
            
            ];
            $userUpdate = $this->Driver_model->UpdateDriverProfile($id,$data);
           if($userUpdate=='1')
           {
            $final = array();
            $final['status'] = true;
            $final['msg'] = 'Driver Profile Updated Successfully';
            $final['data'] = $data;
     
            $this->response($final);
           }
           else
           {
            $final = array();
            $final['status'] = false;
            $final['msg'] = 'Driver Profile Updation Failed';
            $final['data'] = $data;
     
            $this->response($final);
           }
        }else{
            $this->response(['status' => false,'msg' => 'not a valid user', 'data' => null]);
         }
    }

    public function productDetails_post()
    {

        $decodedToken = $this->authorization_token->validateToken($_POST['Authorization']);
	    $user_id = $decodedToken['data']->user_id;
	    if(!is_null($user_id)){

        $id=$user_id;
        $productDetail = $this->Driver_model->productDetail($id);
        if(empty($productDetail))
        {
        $final = array();
            $final['status'] = false;
            $final['msg'] = 'Product not found';
            $final['data'] = null;
     
            $this->response($final);
        }
        else
        {
            $final = array();
            $final['status'] = true;
            $final['msg'] = 'Product found';
            $final['data'] = $productDetail;
     
            $this->response($final);
        }
    }else{
        $this->response(['status' => false,'msg' => 'not a valid user', 'data' => null]);
     }
    }
    

 
}