<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
class Offers extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->api_model('Offers_model');

    }
    public function index_get(){
        $result = $this->offers_model->get_all_offers();
        $this->response($result);
    }
}