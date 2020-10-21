<?php
class shop{
  private $servername ;
  private $username ;
  private $password ;
  private $dbname;
  private $con;

  function __construct(){
    $GLOBALS['servername'] = 'localhost';
    $GLOBALS['username'] = 'root';
    $GLOBALS['password'] = '';
    $GLOBALS['dbname']='shop_cart';
    // $GLOBALS['servername'] = 'localhost';
    // $GLOBALS['username'] = 'id5287639_root';
    // $GLOBALS['password'] = '123456789';
    // $GLOBALS['dbname']='id5287639_crs';
    $GLOBALS['con']=mysqli_connect($GLOBALS['servername'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['dbname']);
  }

// category
  function add_category()
  {
    if($GLOBALS['con']){
    	mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$name=$_POST['name'];
      $sql="INSERT INTO `category` (`name`)VALUES ('$name')";
      $query=mysqli_query($GLOBALS['con'],$sql);
      if($query===false){
        // printf("Errormessage: %s\n", mysqli_error($GLOBALS['con']));
      }else{
        die("<script>location.href ='category.php'</script>");
      }
    }
  }

  function display_category($filter)
  {
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      $sql="SELECT * FROM category where name LIKE '%$filter%' ";
      $result=mysqli_query($GLOBALS['con'],$sql);
      $count=mysqli_num_rows($result);
      if ($count >0) {
        echo "<thead><th>Name</th><th>Date</th></thead><tbody>";
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>".$row['name']."</td><td>".$row['date']."</td>";
          echo "</tr>";
        }
        echo "</tbody>";
      }else {
        echo "No Category";
      }
    }
  }

  function SELECT_category($select)
  {
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$sql="SELECT * FROM `category`";
    	$result=mysqli_query($GLOBALS['con'],$sql);
    	$count=mysqli_num_rows($result);

    	if($count>0){
        while ($row =mysqli_fetch_assoc($result)) {
          $sele="";
          if($select == $row['id'])$sele=" selected";
          echo "
          <option value=".$row['id'].$sele.">".$row['name']."</option>
          ";
        }
      }
    }
  }

  function getCategory($id)
  {
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$sql="SELECT * FROM `category` Where `id`=$id";
    	$result=mysqli_query($GLOBALS['con'],$sql);
    	$count=mysqli_num_rows($result);

    	if($count>0){
        $row =mysqli_fetch_assoc($result);
        return $row['name'];
      }
    }
  }

//product
  function add_product()
  {
    if($GLOBALS['con']){
    	mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$name=$_POST['name'];
      $price=$_POST['price'];
      $cat=$_POST['SelectCategory'];
      $sql="INSERT INTO `product` (`name`, `cat_id`, `price`)VALUES ('$name','$cat','$price')";
      $query=mysqli_query($GLOBALS['con'],$sql);
      if($query===false){
        // printf("Errormessage: %s\n", mysqli_error($GLOBALS['con']));
        return "Must Chose all fiald";
      }else{
        die("<script>location.href ='product.php'</script>");
      }
    }
  }

  function display_product($filter)
  {
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      $sql="SELECT * FROM product where name LIKE '%$filter%' ";
      $result=mysqli_query($GLOBALS['con'],$sql);
      $count=mysqli_num_rows($result);
      if ($count >0) {
        echo "<thead><th>Name</th><th>Price</th><th>Category</th><th>Date</th></thead><tbody>";
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>".$row['name']."</td><td>".$row['price']." $</td><td>".$this->getCategory($row['cat_id'])."</td><td>".$row['date']."</td>";
          echo "</tr>";
        }
        echo "</tbody>";
      }else {
        echo "No Product ";
      }
    }
  }

  function display_product_Shop($filter)
  {
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      $sql="SELECT * FROM product where name LIKE '%$filter%' ";
      $result=mysqli_query($GLOBALS['con'],$sql);
      $count=mysqli_num_rows($result);
      if ($count >0) {
        while($row = mysqli_fetch_assoc($result)) {
          $link = "page.php?state=add&id=".$row['id']."&type=cart";
          echo '<div class="col-md-4">
    				<div class="product-item">
    					<div class="product-thumb">
    						<img class="img-responsive" src="images/shop/products/product-3.jpg" alt="product-img" />
    						<div class="preview-meta">
    							<ul>
    								<li>
    									<span  data-toggle="modal" data-target="#product-modal">
    										<i class="tf-ion-ios-search-strong"></i>
    									</span>
    								</li>
    								<li>
                      <span  data-toggle="modal" data-target="#product-modal">
                        <i class="tf-ion-ios-heart"></i>
                      </span>
    								</li>
    								<li>
    									<a href="'.$link.'"><i class="tf-ion-android-cart"></i></a>
    								</li>
    							</ul>
                </div>
    					</div>
    					<div class="product-content">
    						<h4><a href="'.$link.'">'.$row['name'].'</a></h4>
    						<p class="price">'.$row['price'].' $</p>
    					</div>
    				</div>
    			</div>';


        }
      }else {
        //echo "No Product ";
      }
    }
  }

  function getProduct($id)
  {
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$sql="SELECT * FROM `product` Where `id`=$id";
    	$result=mysqli_query($GLOBALS['con'],$sql);
    	$count=mysqli_num_rows($result);

    	if($count>0){
        $row =mysqli_fetch_assoc($result);
        return $row;
      }
    }
  }

//discount
  function add_discount()
  {
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      $name=$_POST['name'];
      $ifBuy=$_POST['ifBuy'];
      $numBuy=$_POST['numBuy'];
      $discOn=$_POST['discOn'];
      $disVal=$_POST['disVal'];
      $discType=$_POST['discType'];
      $expDate=$_POST['expDate'];
      $discState=$_POST['discState'];
      $sql="INSERT INTO `discount` (`name`, `cat_id_if`, `num_buy`, `cat_id_discount`, `num_discount`, `type_discount`,`expired`,`state`)
                            VALUES ('$name','$ifBuy','$numBuy','$discOn','$disVal','$discType','$expDate','$discState')";
      $query=mysqli_query($GLOBALS['con'],$sql);
      if($query===false){
        printf("Errormessage: %s\n", mysqli_error($GLOBALS['con']));

      }else{
        die("<script>location.href ='discount.php'</script>");
      }
    }
  }

  function display_discount($filter)
  {
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      $sql="SELECT * FROM discount where name LIKE '%$filter%' ";
      $result=mysqli_query($GLOBALS['con'],$sql);
      $count=mysqli_num_rows($result);
      if ($count >0) {
        echo "<thead><th>Name</th><th>If Buy</th><th>number</th><th>Will Discount</th><th>FROM</th><th>Expire Date</th><th>Work</th></thead><tbody>";
        while($row = mysqli_fetch_assoc($result)) {
          $type =" %";
          ($row['type_discount']=="percentage")?$type=" %" : $type=" $";
          ($row['state']=="1")?$state="Yes" : $state="No";
          echo "<tr>";
          echo "<td>".$row['name']."</td><td>".$this->getCategory($row['cat_id_if'])."</td><td>".$row['num_buy']."</td><td>".
                $row['num_discount'].$type.
               "</td><td>".$this->getCategory($row['cat_id_discount'])."</td><td>".$row['expired']."</td><td>".$state.
               "</td><td><a href=\"adddiscount.php?id=".$row['id']."\">Edit</a></td>".
               "<td><a class=\"product-remove\" href=\"page.php?tab=discount&state=delete&id=".$row['id']."\">Delete</a></td>";
          echo "</tr>";
        }
        echo "</tbody>";
      }else {
        echo "No Product ";
      }
    }
  }

  function getDiscountByID($id)
  {
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$sql="SELECT * FROM `discount` Where `id`=$id";
    	$result=mysqli_query($GLOBALS['con'],$sql);
    	$count=mysqli_num_rows($result);

    	if($count>0){
        $row =mysqli_fetch_assoc($result);
        return $row;
      }
    }
  }

  function edit_discount($id)
  {
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      $name=$_POST['name'];
      $ifBuy=$_POST['ifBuy'];
      $numBuy=$_POST['numBuy'];
      $discOn=$_POST['discOn'];
      $disVal=$_POST['disVal'];
      $discType=$_POST['discType'];
      $expDate=$_POST['expDate'];
      $discState=$_POST['discState'];
      $sql="UPDATE `discount` SET
                    `name`='$name',
                    `cat_id_if`='$ifBuy',
                    `num_buy`='$numBuy',
                    `cat_id_discount`='$discOn',
                    `num_discount`='$disVal',
                    `type_discount`='$discType',
                    `expired`='$expDate',
                    `state`='$discState'
                    Where `id`=$id ";

      $query=mysqli_query($GLOBALS['con'],$sql);
      if($query===false){
        printf("Errormessage: %s\n", mysqli_error($GLOBALS['con']));

      }else{
        die("<script>location.href ='discount.php'</script>");
      }
    }
  }

  function myDelete($table , $id)
  {
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$sql="DELETE FROM `$table` Where `id`=$id";
    	$result=mysqli_query($GLOBALS['con'],$sql);


    }
  }

//cart
  function addtocart($id)
  {
    if($GLOBALS['con']){
    	mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      $sql="INSERT INTO `cart` (`pro_id`, `user_id`)VALUES ('$id','1')";
      $query=mysqli_query($GLOBALS['con'],$sql);
      if($query===false){
        // printf("Errormessage: %s\n", mysqli_error($GLOBALS['con']));
        //return "Must Chose all fiald";
      }else{
        die("<script>location.href ='shop.php'</script>");
      }
    }
  }

  function display_cart()
  {
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      $sql="SELECT * FROM cart where pay='0' AND user_id='1' ";
      $result=mysqli_query($GLOBALS['con'],$sql);
      $count=mysqli_num_rows($result);
      if ($count >0) {
        while($row = mysqli_fetch_assoc($result)) {
          $prod = $this->getProduct($row['pro_id']);
          $link = "page.php?tab=cart&id=".$row['id']."&state=delete";
          echo '
          <tr>
            <td>'.$prod['name'].'</td>
            <td>'.$prod['price'].' $</td>
            <td><a class="product-remove" href="'.$link.'">Remove</a></td>
          </tr>
    			';
        }
      }else {
        //echo "No Product ";
      }
    }
  }

//calc
  function calc_cart($userID = 1, $exchange = 1)
  {
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      $sql="SELECT * FROM cart where pay='0' AND user_id='$userID' ";
      $result=mysqli_query($GLOBALS['con'],$sql);
      $count=mysqli_num_rows($result);
      $subtotal = 0 ;$mycat=[];$myDiscount=[];
      if ($count >0) {
        //get my category and total monet
        while($row = mysqli_fetch_assoc($result)) {
          $prod = $this->getProduct($row['pro_id']);
          $subtotal += $prod['price'];
          if(isset($mycat[$prod['cat_id']])){
            $mycat[$prod['cat_id']]++ ;
            $mycat[$prod['cat_id'].'price'] += $prod['price'];
            $mycat[$prod['cat_id'].'pro'][] = $prod['id'];
          }  else {
            $mycat[$prod['cat_id']] = 1;
            $mycat[$prod['cat_id'].'price'] = $prod['price'];
            $mycat[$prod['cat_id'].'pro'][] = $prod['id'];
          }
        }
        //
        $sql2="SELECT * FROM discount ";
        $result2=mysqli_query($GLOBALS['con'],$sql2);
        $count2=mysqli_num_rows($result2);
        if ($count2 >0) {
          while($row2 = mysqli_fetch_assoc($result2)) {
            if(isset($mycat[$row2['cat_id_if']])){
              if($mycat[$row2['cat_id_if']] >= $row2['num_buy']){//pass number requer
                if(isset($mycat[$row2['cat_id_discount']])){//check if have category in discount
                  if($row2['num_buy'] == 0){ // discount for all category
                    if($row2['type_discount'] == "percentage"){
                      $myDiscount[$row2['id']]['detail']=$row2['name'];
                      $myDiscount[$row2['id']]['discount']=$mycat[$row2['cat_id_if'].'price'] * ($row2['num_discount'] / 100);
                    }else {
                      $myDiscount[$row2['id']]['detail']=$row2['name'];
                      $myDiscount[$row2['id']]['discount']=$mycat[$row2['cat_id_if'].'price'] - ($row2['num_discount']);
                    }
                  }else { // discount for if will
                    //$numAccept = $mycat[$row2['cat_id_if']] / $row2['num_buy'] ;

                    if($mycat[$row2['cat_id_discount']] == 1){ // have 1 Jacket
                      $productPrice = $mycat[$row2['cat_id_discount'].'price'] ;
                    }else {
                      $prodDiscount = $this->getProduct($row2['cat_id_discount']);
                      $productPrice = $prodDiscount['price'];
                    }

                    if($row2['type_discount'] == "percentage"){
                      $myDiscount[$row2['id']]['detail']=$row2['name'];
                      $myDiscount[$row2['id']]['discount']=$productPrice * ($row2['num_discount'] / 100);
                    }else {
                      $myDiscount[$row2['id']]['detail']=$row2['name'];
                      $myDiscount[$row2['id']]['discount']=$productPrice - ($row2['num_discount']);
                    }
                  }
                }
              }
            }
          }
        }
        $Taxes = $subtotal*0.14;
        $toptal= $subtotal+ $Taxes;
        echo "Subtotal : ".$subtotal*$exchange. "<br/>";
        echo "Taxes : ".$Taxes*$exchange. " <br/>";
        if(count($myDiscount)){
          echo "Discounts : <br/>";
          foreach ($myDiscount as $Discount) {
            echo "&nbsp;&nbsp;&nbsp;".$Discount['detail']." : -".$Discount['discount']*$exchange."<br/>";
            $toptal -= $Discount['discount'] ;
          }
        }
        echo '
        <div class="summary-total">
           <span>Total</span>
           <span>'.$toptal*$exchange.'</span>
        </div>
        ';

      }
    }
  }

  function exchange ()
  {
    //$request_url = 'https://api.exchangeratesapi.io/latest?base=USD';//&symbols=ILS,JPY';
    $request_url = 'https://www.freeforexapi.com/api/live?pairs=USDEGP';
    $curl = curl_init($request_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    $exhange = json_decode($response, true);
    //print_r($exhange['rates']['USDEGP']['rate']);
    return $exhange['rates']['USDEGP']['rate'];
  }

}
 ?>
