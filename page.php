<?php

include 'fun.php';
$crs=new shop();

if(isset($_GET['tab']) && isset($_GET['id']) && isset($_GET['state']) && $_GET['state'] == 'delete'){
  $crs->myDelete($_GET['tab'] , $_GET['id']);
  if($_GET['tab'] == "discount"){
    die("<script>location.href ='discount.php'</script>");
  }
  if($_GET['tab'] == "cart"){
    die("<script>location.href ='cart.php'</script>");
  }
}

if(isset($_GET['id']) && isset($_GET['state']) && $_GET['state'] == 'add' && isset($_GET['type']) && $_GET['type'] == 'cart'){
  $crs->addtocart($_GET['id']);
}





die("<script>location.href ='index.php'</script>");
