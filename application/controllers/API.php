<?php

$http_origin = $_SERVER['HTTP_ORIGIN'];
header("Access-Control-Allow-Origin:  $http_origin");
// header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');
require(APPPATH.'/libraries/REST_Controller.php');
require APPPATH . 'libraries/Format.php';
 // use namespace
use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller{
    var $serverIp = 'http://localhost/mjbackend/';
  
    public function __construct()
    {
        parent::__construct();
        $imageServer = 'http://localhost/mjbackend/uploads/';
        $this->config->set_item('imageServer', $imageServer);
         // $this->load->library('session');
    }


    //register user
    public function registerUser_post(){
    $params = json_decode(file_get_contents('php://input'), TRUE);
        $name= $params['name'];
        $email=$params['email'];     
        $username=$params['username'];       
        $result = $this->user_model->register($name,$email,$username);
        $this->response($result, 200);      
   }


    //user login
    function login_post(){
        $params = json_decode(file_get_contents('php://input'), TRUE);
        $username = $params['username'];
        $password = $params['password'];
        $result = $this->user_model->login($username,$password);
        if($result->value){
            $this->session->set_userdata('userData', $result);
        }
        $this->response($result, 200);  
    }

    function getUserDetails_get(){
        $obj = new stdClass();
        if($this->session->userData){
         $result = $this->session->userData;
         $this->response($result, 200); 
        }else{
        $obj->value=false;
        $obj->message="User Not Logged in";
        $this->response($obj, 200); 
        }
    }

    function logout_get(){
        $this->session->sess_destroy();
        $obj->value = true;
        $obj->data = [];
        $obj->message = "User logged out successfully!" ;
        $this->response($obj, 200);  
    }


    function getContent_get(){
        $name=  $this->get('name');
        $result = $this->home_model->getContent($name);
        $this->response($result, 200);  
    }

#------------------------------ Navigation Start ----------------------------# 
function getNavigation_get(){
    $result = $this->home_model->getNavigation();
    $this->response(json_decode(json_encode($result, JSON_NUMERIC_CHECK)), 200); 
}
 #------------------------------ Navigation End -----------------------------------#


#------------------------------ Product Start ----------------------------# 
function getAllProduct_post(){
    $params = json_decode(file_get_contents('php://input'), TRUE);
    $result = $this->product_model->getAllProduct($params);
    $this->response($result, 200); 
}
 #------------------------------ Product End -----------------------------------#



#------------------------------ Cart Start ----------------------------#  
//create cart 
public function addToCart_post(){
    $params = json_decode(file_get_contents('php://input'), TRUE);
       $data = array(
        'product_id'=>$params['product_id'],
        'quantity'=>$params['quantity'] ?$params['quantity']:1   
        // 'quantity'=>$this->input->get_post('quantity')     
    );
        $result = $this->cart_model->addToCart($data);
        $this->response($result, 200); 
   
}

   //update cart 
   public function updateCart_post(){
    $params = json_decode(file_get_contents('php://input'), TRUE);
    $id = $params['id'];
       $data = array(
        'product_id'=>$params['product_id'],
        'quantity'=>$params['quantity']       
    );
    $obj = new stdClass();
    if($this->session->userData){
    $result = $this->cart_model->updateCart($data,$id);
    $this->response($result, 200); 
    }else{
    $result = $this->cart_model->updateGuestUserCart($data,$id);
    $this->response($result, 200); 
    }
   }

    //get cart 
    function getCart_get(){
        $user = $this->session->userData->data['id'];
        $obj = new stdClass();
        if($this->session->userData){
        $result = $this->cart_model->getCart($user);
        $this->response($result, 200); 
        }else{
        $result = $this->cart_model->getGuestUserCart($lang);
        $this->response($result, 200); 
        }
        
    }

     //delete cart
   function deleteCart_post(){
    $params = json_decode(file_get_contents('php://input'), TRUE);
    $id=  $params['id'];
    echo $id."asd";
    if($this->session->userData){
     $user=$this->session->userData->data['id'];
     $result = $this->cart_model->deleteCart($id,$user);
     $this->response($result, 200); 
    }else{
     $result = $this->cart_model->deleteGuestUserCart($id);
     $this->response($result, 200); 
    }

 }

     // to check product already in cart
     function checkCart_get(){
        $product_id=  $this->get('product_id');
        $user = $this->session->userData->data['id'];
        $obj = new stdClass();
        if($this->session->userData){
         $result = $this->cart_model->checkCart($product_id,$user);
         $this->response($result, 200); 
        }else{
        $obj->value=false;
        $obj->message="Please Login to continue";
        $this->response($obj, 200); 
        }
      }



        #------------------------------ Order Start ------------------------# 
   //submit order
   function submitOrder_post(){
    $params = json_decode(file_get_contents('php://input'), TRUE);
    $data = array(
        'user_id'=>$this->session->userData->data['id'],
        'first_name'=>$params['first_name'],
        'last_name'=>$params['last_name'],
        'email'=>$params['email'],
        'billing_name'=>$params['billing_name'],
        'billing_address'=>$params['billing_address'],
        'billing_contact'=>$params['billing_contact'],
        'billing_city'=>$params['billing_city'],
        'billing_state'=>$params['billing_state'],
        'billing_pincode'=>$params['billing_pincode'],
        'billing_country'=>$params['billing_country'],
        'shipping_city'=>$params['shipping_city'],
        'shipping_address'=>$params['shipping_address'],
        'shipping_name'=>$params['shipping_name'],
        'shipping_country'=>$params['shipping_country'],
        'shipping_contact'=>$params['shipping_contact'],
        'shipping_state'=>$params['shipping_state'],
        'shipping_pincode'=>$params['shipping_pincode'],
        'tracking_code'=>$params['tracking_code'],
        'default_currency'=>$params['default_currency'],
        'shipping_method'=>$params['shipping_method'],
        'orderstatus'=>$params['orderstatus'],
        'paymentmode'=>$params['paymentmode'],
        'transaction_id'=>$params['transaction_id']  
    );
    $obj = new stdClass();
    // if($this->session->userData){
    $result = $this->order_model->submitOrder($data);
    $this->response($result, 200); 
    // }else{
    // $obj->value=false;
    // $obj->message="Please Login to continue";
    // $this->response($obj, 200); 
    // }
   }

   //get orders based on user_id
function getOrderbyUserId_get(){
    $user_id=$this->session->userData->data['id'];
    $obj = new stdClass();
    if($this->session->userData){
    $result=$this->order_model->getOrderbyUserId($user_id);
    $this->response($result,200);
    }else{
    $obj->value=false;
    $obj->message="Please Login to continue";
    $this->response($obj, 200); 
    }
   
}
//get orders based on id
function getOrderbyId_get(){
    $id=$this->get('id');
    $result=$this->order_model->getOrderbyId($id);
    $this->response($result,200);
}
//delete orders based on Id(PK)
function deleteOrder_get(){
    $id=  $this->get('id');
    $result = $this->order_model->deleteOrder($id);
    $this->response($result, 200); 
    }
  #------------------------------ Order End -------------------------------#   


}