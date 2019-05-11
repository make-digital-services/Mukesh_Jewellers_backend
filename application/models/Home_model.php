<?php
class Home_model extends CI_model{
    public function __construct(){
        $this->load->database();
       }

       public function getNavigation(){
        $query= $this->db->query("select * from `navigation`");
        $obj = new stdClass();
        if(!$query){
          $obj->value = false;
          $obj->message ="Records not found" ;
          return $obj ;
        }else{
          $obj->value = true;
          $obj->data = $query->result_array();
         return $obj ;
        }
       }

}
?>