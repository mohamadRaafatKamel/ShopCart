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

  function display_person($name){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      $sql="SELECT * FROM user where name LIKE '%$name%' ";
      $result=mysqli_query($GLOBALS['con'],$sql);
      $count=mysqli_num_rows($result);
      if ($count >0) {
        echo "<th>id</th><th>name</th><th>type</th><th>pass</th><th>email</th><th>phone</th><th>username</th><th>fb_account</th><th>birthdate</th><th>admin</th><th>balance</th>";
        while($row = mysqli_fetch_assoc($result)) {
          if($row['stat']==0)$admin="Not active";
          if($row['stat']==1)$admin="Member";
          if($row['stat']==2)$admin="Admin";
          if($row['type']==0)$type="Male";
          if($row['type']==1)$type="Female";
          echo "<tr>";
          echo "<td>".$row['uid']."</td><td>".$row['name']."</td><td>".$type."</td><td>".$row['pass']."</td><td>".$row['email']."</td><td>"
          .$row['phone']."</td><td>".$row['username']."</td><td>".$row['fb_account']."</td><td>".$row['bdate']."</td><td>".$admin."</td><td>"
          .$row['balance']."$</td>";
          echo "</tr>";
        }
      }else {
        echo "no member";
      }
    }
  }

  function set_person($id){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$sql="SELECT * FROM `user` WHERE `uid`='$id'";
    	$result=mysqli_query($GLOBALS['con'],$sql);
    	$count=mysqli_num_rows($result);
    	$row =mysqli_fetch_assoc($result);
    	if($count===1){
    	  $person = array();
        $person['name']=$row['name'];
        $person['phone']=$row['phone'];
        $person['bdate']=$row['bdate'];
        $person['email']=$row['email'];
        $person['username']=$row['username'];
        $person['fb']=$row['fb_account'];
        $person['stat']=$row['stat'];
        $person['balance']=$row['balance'];
        $person['type']=$row['type'];
        $person['img']=$row['img'];
        $person['pass']=$row['pass'];
        return $person;
      }
    }
  }

  function set_crs($id){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$sql="SELECT * FROM course WHERE cid='$id'";
    	$result=mysqli_query($GLOBALS['con'],$sql);
    	$count=mysqli_num_rows($result);
    	$row =mysqli_fetch_assoc($result);
    	if($count===1){
    	  $program = array();
        $program["name"]=$row['name'];
        $program["discription"]=$row['discription'];
        $program["teacher"]=$row['teacher'];
        $program["hour"]=$row['hour'];
        $program["img"]=$row['img'];
        $program["cost"]=$row['cost'];
        $program["did"]=$row['did'];
        $program["date"]=$row['date'];
        return $program;
      }
    }
  }

  function set_buyCrs($cid,$uid){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$sql="SELECT * FROM buy WHERE cid='$cid'and uid='$uid'";
    	$result=mysqli_query($GLOBALS['con'],$sql);
    	$count=mysqli_num_rows($result);
    	if($count===1){
        return 1;
      }else {
        return 0;
      }
    }
  }

  function set_department($id){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$sql="SELECT * FROM `department` WHERE `did`='$id'";
    	$result=mysqli_query($GLOBALS['con'],$sql);
    	$count=mysqli_num_rows($result);
    	$row =mysqli_fetch_assoc($result);
    	if($count===1){
        $program=$row['name'];
        return $program;
      }
    }
  }

  function SELECT_department(){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$sql="SELECT * FROM `department`";
    	$result=mysqli_query($GLOBALS['con'],$sql);
    	$count=mysqli_num_rows($result);

    	if($count>0){
        echo "<select name=\"SelectDepartment\">";
        while ($row =mysqli_fetch_assoc($result)) {
          echo "
          <option value=".$row['did'].">".$row['name']."</option>
          ";
        }
        echo "</select>";
      }
    }
  }

  function display_department(){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$sql="SELECT * FROM `department`";
    	$result=mysqli_query($GLOBALS['con'],$sql);
    	$count=mysqli_num_rows($result);

    	if($count>0){
        while ($row =mysqli_fetch_assoc($result)) {
          echo "
          <div class=\"col-md-4\">
            <ul class=\"footer_box\">
              <li align=\"center\"><a >".$row['name']."</a></li>
            </ul>
          </div>
          ";
        }
      }
    }
  }

// category
  function add_category(){
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

  function display_category($filter){
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

  function exchange (){
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

  function UPDATEcrs($col,$val,$idp){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$sql="SELECT * FROM `course` WHERE `cid`='$idp'";
    	$result=mysqli_query($GLOBALS['con'],$sql);
      $count=mysqli_num_rows($result);
      if($count==0){
        //printf("Errormessage: %s\n", mysqli_error($GLOBALS['con']));
        //die("<script>location.href ='logup.php'</script>");
      }else{
        $sql="UPDATE `course` SET `$col`='$val' WHERE `cid`='$idp'";
      	$result=mysqli_query($GLOBALS['con'],$sql);
      }
    }
  }

  function addApp(){
    if($GLOBALS['con']){
    	mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$name=$_POST['name'];
    	$cost=$_POST['cost'];
      $Teacher=$_POST['Teacher'];
    	$hour=$_POST['hour'];
      $description=$_POST['description'];
    	$SelectDepartment=$_POST['SelectDepartment'];
      date_default_timezone_set('Africa/Cairo');
      $current_date = date('Y-m-d h:i');

      $sql="INSERT INTO `course`(`name`,`discription`,`teacher`,`hour`,`img`,`cost`,`did`,`date`)
            VALUES ('$name','$description','$Teacher','$hour',' ' ,'$cost','$SelectDepartment','$current_date')";
      $query=mysqli_query($GLOBALS['con'],$sql);
      if($query===false){
          printf("Errormessage: %s\n", mysqli_error($GLOBALS['con']));
        }else{
        $sql="SELECT * FROM `course` WHERE `date`='$current_date' and `name`='$name'";
      	$result=mysqli_query($GLOBALS['con'],$sql);
      	$count=mysqli_num_rows($result);
        if($count===1){
          $row =mysqli_fetch_assoc($result);
          $idApp=$row['cid'];
          $icon="crsImg";
          $icon=$this->img($icon,"imgUP",$idApp);
          $this->UPDATEcrs("img",$icon,$idApp);
          die("<script>location.href ='aa_crs.php'</script>");
        }
      }
    }
  }

  function img($namePost,$fileName,$id) {
    if(isset($_FILES[$namePost])){
      $name_array = $_FILES[$namePost]['name'];
      $tmp_name_array = $_FILES[$namePost]['tmp_name'];
      $type_array = $_FILES[$namePost]['type'];
      //print_r($tmp_name_array);
      $path="";
      $count=count($tmp_name_array);
      for($i = 0; $i <$count ; $i++){
            if(move_uploaded_file($tmp_name_array[$i], $fileName."/".$namePost.$id.$i)){
                $path=$path.$fileName."/".$namePost.$id.$i;
            } else {
            }
            if($count>1)$path=$path."*";
      }
      return $path;
    }else {
      echo "nothing";
    }
  }

  function display_app(){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$sql="SELECT * FROM `course` ";
    	$result=mysqli_query($GLOBALS['con'],$sql);
    	$count=mysqli_num_rows($result);

    	if($count>0){
        while ($row =mysqli_fetch_assoc($result)) {
          echo "
          <div class=\"4u 12u(mobile)\">
            <section class=\"box\">
              <a href=\"single.php?id=".$row['cid']."\" class=\"image featured\"><img src=".$row['img']." alt=\"The content did not appear because of the weakness of the Internet. Click here to continue\" /></a>
              <header>
                <h3>".$row['name']."</h3>
              </header>
              <p>$".$row['cost']."</p>
              <footer>
                <a href=\"single.php?id=".$row['cid']."\" class=\"button alt\">View Course</a>
              </footer>
            </section>
          </div>";

        }
      }
    }
  }

  function display_media(){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$sql="SELECT * FROM `media` ";
    	$result=mysqli_query($GLOBALS['con'],$sql);
    	$count=mysqli_num_rows($result);

    	if($count>0){
        while ($row =mysqli_fetch_assoc($result)) {
          echo "
          <div class=\"4u 12u(mobile)\">
            <section class=\"box\">
              <a href=\"https://youtu.be/".$row['link']."\" class=\"image featured\"><img src=".$row['img']." alt=\"The content did not appear because of the weakness of the Internet. Click here to continue\" /></a>
              <header>
                <h3>".$row['text']."</h3>
              </header>
              <footer>
                <a href=\"https://youtu.be/".$row['link']."\" class=\"button alt\">Watch vedio</a>
              </footer>
            </section>
          </div>";

        }
      }
    }
  }

  function display_my_app(){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      $uid=$_SESSION["id_person"];
    	$sql="SELECT * FROM `buy` where `uid`='$uid'";
    	$result=mysqli_query($GLOBALS['con'],$sql);
    	$count=mysqli_num_rows($result);
    	if($count>0){
        while ($row2 =mysqli_fetch_assoc($result)) {
          $cc=$row2['cid'];
          $crsss=$this->set_crs($cc);
            echo "
            <div class=\"4u 12u(mobile)\">
              <section class=\"box\">
                <a href=\"single.php?id=".$cc."\" class=\"image featured\"><img src=".$crsss['img']." alt=\"The content did not appear because of the weakness of the Internet. Click here to continue\" /></a>
                <header>
                  <h3>".$crsss['name']."</h3>
                </header>
                <p>$".$crsss['cost']."</p>
                <footer>
                  <a href=\"single.php?id=".$cc."\" class=\"button alt\">View Course</a>
                </footer>
              </section>
            </div>";

        }
      }
    }
  }

  function buyApp($cid,$idp){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      $person=$this->set_person($idp);
      $program=$this->set_crs($cid);
      $balance=$person['balance'];
      $cost=$program["cost"];
      if($balance>=$cost){
        if($cost!=0){
          $balance-=$cost;
          $this->UPDATEuser("balance",$balance,$idp);
        }
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d');
        $sql="INSERT INTO `buy`(`uid`, `cid`, `date`) VALUES ('$idp', '$cid', '$date')";
        $query=mysqli_query($GLOBALS['con'],$sql);
        if($query===false){
          //printf("Errormessage: %s\n", mysqli_error($GLOBALS['con']));
          //die("<script>location.href ='logup.php'</script>");
        }else{
          die("<script>location.href ='single.php?id=".$cid."'</script>");
        }
      }else {
        echo "<br/>please not Enough";
      }
      //printf("Errormessage: %s\n", mysqli_error($GLOBALS['con']));
    }
  }

  function display_All_app($name){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      $sql="SELECT * FROM course where name LIKE '%$name%' ";
      $result=mysqli_query($GLOBALS['con'],$sql);
      $count=mysqli_num_rows($result);
      if ($count >0) {
        echo "<th>id</th><th>name</th><th>Teacher</th><th>cost</th><th>hour</th><th>Department</th>";
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>".$row['cid']."</td><td>".$row['name']."</td><td>".$row['teacher']."</td><td>"
          .$row['cost']." $</td><td>".$row['hour']."</td><td>"
          .$this->set_department($row['did'])."</td>";
          echo "</tr>";
        }
      }else {
        echo "no app";
      }
    }
  }

  function SELECT_crs(){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$sql="SELECT * FROM `course`";
    	$result=mysqli_query($GLOBALS['con'],$sql);
    	$count=mysqli_num_rows($result);

    	if($count>0){
        echo "<select name=\"SelectCrs\">";
        while ($row =mysqli_fetch_assoc($result)) {
          echo "
          <option value=".$row['cid'].">".$row['name']."</option>
          ";
        }
        echo "</select>";
      }
    }
  }

  function display_link($idp){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      $sql="SELECT * FROM video_link where  cid=$idp";
      $result=mysqli_query($GLOBALS['con'],$sql);
      $count=mysqli_num_rows($result);
      if ($count >0) {
        while($row = mysqli_fetch_assoc($result)) {
          echo"<li><a href='learn.php?cid=".$idp."&lid=".$row['link']."' class=\"list-group-item list-group-item-action list-group-item-dark\">".$row['text']."</a></li>";
        }
      }else {
        echo "no link";
      }
    }
  }

  function display_All_Media($name){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      $sql="SELECT * FROM `media` where `text` LIKE '%$name%' ";
      $result=mysqli_query($GLOBALS['con'],$sql);
      $count=mysqli_num_rows($result);
      if ($count >0) {
        echo "<th>id</th><th>name</th>";
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>".$row['mid']."</td><td>".$row['text']."</td>";
          echo "</tr>";
        }
      }else {
        echo "no app";
      }
    }
  }

  function add_Media(){
    if($GLOBALS['con']){
    	mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$link=$_POST['link'];
      $name=$_POST['text'];
      $file = explode("/",$link);
      $link=$file[count($file)-1];
      $sql="INSERT INTO `media`(`link`,`text`) VALUES ('$link','$name')";
      $query=mysqli_query($GLOBALS['con'],$sql);
      if($query===false){
        //printf("Errormessage: %s\n", mysqli_error($GLOBALS['con']));
        //die("<script>location.href ='logup.php'</script>");
      }else{
        $sql="SELECT * FROM `media` WHERE `link`='$link' and `text`='$name' ";
      	$result=mysqli_query($GLOBALS['con'],$sql);
      	$count=mysqli_num_rows($result);
        if($count===1){
          $row =mysqli_fetch_assoc($result);
          $id=$row['mid'];
          $icon="mediaImg";
          $icon=$this->img($icon,"imgUP",$id);
          echo $icon;
          $this->UPDATEmedia("img",$icon,$id);
          die("<script>location.href ='aa_media.php'</script>");
        }
      }
    }
  }

  function UPDATEmedia($col,$val,$idp){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$sql="SELECT * FROM `media` WHERE `mid`='$idp'";
    	$result=mysqli_query($GLOBALS['con'],$sql);
      $count=mysqli_num_rows($result);
      if($count==0){
        //printf("Errormessage: %s\n", mysqli_error($GLOBALS['con']));
        //die("<script>location.href ='logup.php'</script>");
      }else{
        $sql="UPDATE `media` SET `$col`='$val' WHERE `mid`='$idp'";
      	$result=mysqli_query($GLOBALS['con'],$sql);
      }
    }
  }

  function get_video($get,$val){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      if($get=="cid"){
        $sql="SELECT * FROM video_link where  cid=$val";
        $result=mysqli_query($GLOBALS['con'],$sql);
        $row = mysqli_fetch_assoc($result);
        return $row['link'];

      }elseif ($get=="lid") {
        return $val;

      }
    }
  }

  function display_code($code){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      $sql="SELECT * FROM payment where code LIKE '%$code%' ";
      $result=mysqli_query($GLOBALS['con'],$sql);
      $count=mysqli_num_rows($result);
      if ($count >0) {
        echo "<th>code</th><th>money</th><th>used</th>";
        while($row = mysqli_fetch_assoc($result)) {
          if($row['used']==0)$admin="not used";
          if($row['used']==1)$admin="used";
          echo "<tr>";
          echo "<td>".$row['code']."</td><td>".$row['val']." $</td><td>".$admin."</td>";
          echo "</tr>";
        }
      }else {
        echo "no code";
      }
    }
  }

  function add_code_payment(){
    if($GLOBALS['con']){
    	mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$val=$_POST['val'];
      $code=rand(0000000,9999999);
      $sql="INSERT INTO `payment`(`val`, `code`) VALUES ('$val', '$code')";
      $query=mysqli_query($GLOBALS['con'],$sql);
      if($query===false){
        //printf("Errormessage: %s\n", mysqli_error($GLOBALS['con']));
        //die("<script>location.href ='logup.php'</script>");
      }else{
        die("<script>location.href ='aa_code.php'</script>");
      }
    }
  }

  function add_link(){
    if($GLOBALS['con']){
    	mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$crsid=$_POST['SelectCrs'];
      $link=$_POST['link'];
      $file = explode("/",$link);
      $link=$file[count($file)-1];
      echo $link;
      $title=$_POST['text'];
      $sql="INSERT INTO `video_link`(`cid`,`link`,`text`) VALUES ('$crsid', '$link','$title')";
      $query=mysqli_query($GLOBALS['con'],$sql);
      if($query===false){
        //printf("Errormessage: %s\n", mysqli_error($GLOBALS['con']));
        //die("<script>location.href ='logup.php'</script>");
      }else{
        die("<script>location.href ='aa_crs.php'</script>");
      }
    }
  }

  function UPDATEPprogram($col,$val,$idg){//
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
    	$sql="UPDATE `program` SET `$col`='$val' WHERE `idprogram`='$idg'";
    	$result=mysqli_query($GLOBALS['con'],$sql);
      if($result===false){
        printf("Errormessage: %s\n", mysqli_error($GLOBALS['con']));
        //die("<script>location.href ='logup.php'</script>");
      }else{
      die("<script>location.href ='aa_editeApp.php?eid=".$idg."'</script>");
      }
    }
  }

  function paymentCode(){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      $idp=$_SESSION["id_person"];
      $code=$_POST['code'];
      $sql="SELECT * FROM `payment`where `code`='$code' and `used`=0";
      $result=mysqli_query($GLOBALS['con'],$sql);
      $row =mysqli_fetch_assoc($result);
      if($result){
      	$sql="UPDATE `payment` SET `used`=1 WHERE `code`='$code'";
      	$result=mysqli_query($GLOBALS['con'],$sql);
        if($result===false){
          echo "this code used";
          //printf("Errormessage: %s\n", mysqli_error($GLOBALS['con']));
          //die("<script>location.href ='logup.php'</script>");
        }else{
          $person=$this->set_person($idp);
          $balance=$row['val']+$person['balance'];
          $this->UPDATEuser("balance",$balance,$idp);
          //die("<script>location.href =". $_SERVER['REQUEST_URI']."</script>");
          echo "payment by ".$row['val']." $ last balance is ".$person['balance']." $ your balance naw is ".$balance." $";
        }
      }else {
        echo "this code used";
      }
    }
  }

  function display_department_nav(){
    if($GLOBALS['con']){
      mysqli_select_db($GLOBALS['con'],$GLOBALS['dbname']);
      $sql="SELECT * FROM department";
      $result=mysqli_query($GLOBALS['con'],$sql);
      $count=mysqli_num_rows($result);
      if ($count >0) {
        while($row = mysqli_fetch_assoc($result)) {
          echo "<a>".$row['name']."</a><br/>";
        }
      }
    }
  }


}
 ?>
