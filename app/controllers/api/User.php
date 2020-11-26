<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
class User extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();	
		$this->load->library('Authorization_Token');
// 		$this->load->database();
         $this->load->api_model('User_modal');
         
         $this->load->helper(array('form'));
         $this->load->library('form_validation');
	}
  
	public function user_post()
	{  
		$array  = array('status'=>'ok','data'=>1);
		$this->response($array); 
	}
	public function record_post()
	{  
		$array  = array('status'=>'ok','data'=>'post api');
		$this->response($array); 
	}
	
	public function login_post()
	{   
		$phone = $_POST['phone'];
		$rem_token = $_POST['device_token'];
		$token_data['phone'] = $phone;

        $user = $this->User_modal->check_user($phone);
        if(sizeof($user['data']) > 0){
            // user already exist
                    // print_r($user['data'][0]);exit;
                    $data = [
                         'device_token' => $rem_token
                        ];
                        $user_id = $user['data'][0]->id;
                   $this->User_modal->update_user($user_id,$data);
                    $token_data['user_id'] = $user_id;
                    $token_data['phone'] = $user['data'][0]->phone;
                    $token_data['device_token'] = $user['data'][0]->device_token;

        }else{
            // new user register
            $data = [
                'phone' => $phone,
                'group_id' => 7,
                'created_on' => 1605689243,
                'password' => 'null',
                'username' => 'null',
                'email' => 'null',
                'device_token' => $rem_token,
                'created_on' => strtotime(date('Y-m-d H:i:s'))
                ];
                
            $data = $this->User_modal->new_user($data);
            // echo json_encode(['debug' => $phone]);exit;
            $user = $this->User_modal->check_user($phone);
            $token_data['user_id'] = $user['data'][0]->id;
            $token_data['phone'] = $user['data'][0]->phone;
            $token_data['device_token'] = $user['data'][0]->device_token;
			

        }
		$tokenData = $this->authorization_token->generateToken($token_data);

		$final = array();
		$final['status'] = true;
		$final['msg'] = 'user looged in successfully';
		$final['data'] = ['token' => $tokenData,'phone'=> $token_data['phone']];
 
		$this->response($final); 

	}
	public function verify_post()
	{  
		$headers = $this->input->request_headers(); 
		$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);

		$this->response($decodedToken);  
	}


 
}