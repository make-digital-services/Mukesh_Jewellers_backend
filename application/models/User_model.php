<?php
class User_model extends CI_model{
    public function __construct(){
        $this->load->database();
       }

public function getAllUsers(){
    $query = $this->db->query('select `id`, `name`, `username`, `password`, `email`, `date` FROM `user` WHERE 1');
    $obj = new stdClass();
   if($query->num_rows() > 0){
     $obj->value = true;
     $obj->data = $query->result_array();
     return $obj ;
   }else{
     $obj->value = false;
     $obj->data = [];
     $obj->message ="Records not found" ;
     return $obj ;
   }
}

public function login($username, $password){
       $query = $this->db->query("select `id`, `name`, `email`, `phone`, `accesslevel`, `status`, `billingaddress`, `billingcity`, `billingstate`, `billingcountry`, `shippingaddress`, `shippingcity`, `shippingcountry`, `shippingstate`, `shippingpincode`, `currency`, `companyname`, `companyregistrationno`, `vatnumber`, `country`, `fax`, `image`, `socialid`, `logintype`, `dob`, `street`, `address`, `city`, `state`, `pincode`, `facebook`, `google`, `twitter`, `timestamp`, `username`, `gender`, `billingpincode` FROM `user` WHERE  username='$username' and password='$password'");
       $obj = new stdClass();
       if($query->num_rows() > 0){
        $obj->value = true;
        $obj->data = $query->result_array()[0];
        return $obj ;
       }else{
        $obj->value = false;
        $obj->data = [];
        $obj->message ="Invalid Username/Password" ;
        return $obj ;
       }
   
}

public function register($name,$email,$username){
  $obj = new stdClass();
  if(trim($name, " ")  && trim($email, " ") && trim($username, " ")){
  if($this->user_model->checkUserEmail($email)->value){
    if($this->user_model->checkUser($username)->value){
 $query = $this->db->query("insert into user (name, email, username) values('$name','$email','$username')");
 if($query){
  $id=$this->db->insert_id();
  $this->user_model->createPassword($id);
  $obj->value = true;
  $obj->message = "User registered successfully!";
  return $obj ;
}else{
  $obj->value = false;
  $obj->message ="Something went wrong, please try again later." ;
  return $obj ;
}
}else{
  return $this->user_model->checkUser($username);
}
}else{
return $this->user_model->checkUserEmail($email);
}
}else{
  $obj->value = false;
  $obj->message ="Required" ;
  return $obj ;
}
}

public function createPassword($id){
  $obj = new stdClass();
  $this->load->helper('string');
  $passwrod=random_string('alnum',10);
  $query = $this->db->query("update user set password='$passwrod' where id=$id");
  if($query){
    $data = $this->db->query("select * from user where id=$id")->row();
    $sendData['data'] = $data;
    $viewcontent = $this->load->view('emailers/registeruser', $sendData, true);
    $this->email_model->emailer($viewcontent,'Welcome to Mukesh Jewellers',$data->email,"");
    $obj->value = true;
    $obj->message = "User registered successfully!";
    return $obj ;
  }else{
    $obj->value = false;
    $obj->message = "Error while generating password, please try again later.";
    return $obj ;
  }
}

public function checkUser($username){
  $query = $this->db->query("select * from user where username='$username'");
  $obj = new stdClass();
  if($query->num_rows() > 0){
    $obj->value = false;
    $obj->field = "username";
    $obj->message ="Username already exists. Please use a different username." ;
    return $obj ;
  }else{
    $obj->value = true;
    return $obj ;
 }
}
public function checkUserEmail($email){
  $this->load->helper('email');
 if (valid_email($email))
 {
  $query = $this->db->query("select * from user where email='$email'");
  $obj = new stdClass();
  if($query->num_rows() > 0){
    $obj->value = false;
    $obj->field = "email";
    $obj->message ="Email Address already registerd. Please use a different Email." ;
    return $obj ;
  }else{
    $obj->value = true;
    return $obj ;
 }
 }
 else
 {
$obj->value = false;
 $obj->field = "email";
 $obj->message ="Please enter valid Email Address." ;
 return $obj ;
 }
  
}

public function submitContact($name,$phone,$email,$subject,$message){
  $obj = new stdClass();
  if(trim($name, " ") && trim($phone, " ") && trim($email, " ") && trim($subject, " ") && trim($message, " ")){
    $this->load->helper('email');
    if (valid_email($email)){
$query=$this->db->query("insert into contact (`name`, `phone`, `email`, `subject`, `message`) VALUES('$name','$phone','$email','$subject','$message') ");
if($query){
  $obj->value = true;
  $obj->message = "Thank you for getting in touch! We will get back to you shortly.";
  return $obj ;
}else{
  $obj->value = false;
  $obj->message ="Something went wrong, please try again later." ;
  return $obj ;
} 
}else{
      $obj->value = false;
      $obj->field = "email";
      $obj->message ="Please enter valid Email Address." ;
      return $obj ;
    }
  }
  else{
    $obj->value = false;
    $obj->message ="All fields are mandatory." ;
    return $obj ;
  }
}

}
?>