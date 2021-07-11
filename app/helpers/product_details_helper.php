<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('get_product_details')) {
    function get_product_details($product_id)
    {
        $CI = get_instance();
        $CI->load->api_model('Product_model');
        $result = $CI->Product_model->get_product_details_by_id($product_id);
        return $result['data'];
    }
    
}
if (!function_exists('sendMail')) {
   function sendmail($to, $subject, $message, $attachment=null)
    {
        $config = array(
            'protocol' =>  'smtp',
            'smtp_crypto' => 'tls',
            'smtp_host' => 'email-smtp.ap-south-1.amazonaws.com',
            'smtp_port' => '587',
            'smtp_user' => 'AKIA3UZ5TYY65YRRJIPZ',
            'smtp_pass' => 'BC9U7oQlidEnQOleLsYZQgCQvAbSOiTAx4eo5mNbrUqD',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('contact@icslms.com', HEAD_NAME);
        $this->email->reply_to('contact@icslms.com', HEAD_NAME);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send(FALSE)){
            return TRUE;
        }else{
            echo $this->email->print_debugger();
        }
    }   
}
