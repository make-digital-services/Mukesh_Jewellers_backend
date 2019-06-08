<?php
class Product_model extends CI_model{
    public function __construct(){
        $this->load->database();
       }

       public function getAllProduct($data){
           $categoryId =$data['categoryId'];
       $priceMin = $data['filterObj']['price'][0];
       if(!$priceMin){
        $priceMin=0;
       }
       $priceMax = $data['filterObj']['price'][1];
           if(!$priceMax){
            $priceMax=950000;
           }
        $inMetalArr ="";
        foreach($data['filterObj']['metal'] as $val){
                       $inMetalArr .= "'".$val. "',";
        }
        foreach($data['filterObj']['purity'] as $val){
            $inMetalArr .= "'".$val. "',";
        }
            $inMetalArr = substr_replace($inMetalArr, "", -1);
            $currency ='₹';
        if($data['sortBy']=='low'){
            $orderBy = 'asc';
         }else if($data['sortBy']=='high'){
             $orderBy = 'desc';
        }
        if($inMetalArr){
            $q="SELECT p.`id`, p.`name`,pi.image , p.`description`, p.`price`, p.`discount`,  p.`final_price`,  p.`metatitle`, p.`metadesc`, p.`metakeyword`, p.`quantity`, p.`subcategory`, p.`category`, p.`sizechart` FROM `product` p LEFT JOIN product_image pi ON p.id=pi.product_id LEFT JOIN product_specification ps ON ps.product_id=p.id WHERE p.category=$categoryId AND ps.value IN ($inMetalArr) AND p.`final_price` BETWEEN $priceMin AND $priceMax  GROUP BY p.id ORDER BY final_price $orderBy";
        }else{
            $q="SELECT p.`id`, p.`name`,pi.image , p.`description`, p.`price`, p.`discount`,  p.`final_price`,  p.`metatitle`, p.`metadesc`, p.`metakeyword`, p.`quantity`, p.`subcategory`, p.`category`, p.`sizechart` FROM `product` p LEFT JOIN product_image pi ON p.id=pi.product_id  WHERE p.category=$categoryId AND p.`final_price` BETWEEN $priceMin AND $priceMax  GROUP BY p.id ORDER BY final_price $orderBy";
        }
      
        //  echo $q;
             $query= $this->db->query($q);

        $products_list =  '<ul class="row">';
    foreach ($query->result_array() as $key => $row) {
        $discountPrice = $row['price']!=$row['final_price']  && $row['price']!=0?$currency.$row["price"]:'';
$products_list .= <<<EOT
<li class="col-lg-4 product_form">

<a href="details.php?name={$row['name']}"> <div class="listing-image-box"><img class="img-fluid" src="{$row["image"]}"></a>
   <div class="product-listing-buttons">
           <input id="{$row["id"]}" name="product_id" type="hidden" value="{$row["id"]}">
           <button><i id="{$row["id"]}" onclick="addToCart(event)" class="fa fa-shopping-bag"></i></button>
           <button type="submit"><i class="fa fa-exchange"></i></button>
           <button type="submit"><i class="fa fa-heart"></i></button>
           <button type="submit"><i class="fa fa-eye"></i></button>
       </div>
       </div>
   
   <span class="stock-available">Stock:{$row["quantity"]}</span>
   <h4><a href="details.php?name={$row['name']}">{$row["name"]}</a></h4>
   <span class="price-listing">
   <span class="offer-price"> {$discountPrice}</span>
   {$currency} {$row["final_price"]}</span> 
   <div class="listing-price-box">
  </div>
  
</li>

EOT;
    }
// }
$products_list .= '</ul></div>';

        $obj = new stdClass();
        if(!$query){
          $obj->value = false;
          $obj->html = '<h4>Data Not Found</h4>';
          $obj->message ="Records not found" ;
          return $obj ;
        }else{
          $obj->value = true;
          $obj->html = $query->num_rows() > 0?$products_list:'<h4>Data Not Found</h4>';
          $obj->data = $query->result_array();
         return $obj ;
        }
       }

}
?>