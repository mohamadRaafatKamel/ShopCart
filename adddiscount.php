

<?php
require_once('header.php');


$name=$ifBuy=$numBuy=$discOn=$disVal=$discType=$expDate=$discState="";

if(isset($_GET['id'])){
  $disc = $crs->getDiscountByID($_GET['id']);
  $name=$disc['name'];
  $ifBuy=$disc['cat_id_if'];
  $numBuy=$disc['num_buy'];
  $discOn=$disc['cat_id_discount'];
  $disVal=$disc['num_discount'];
  $discType=$disc['type_discount'];
  $expDate=$disc['expired'];
  $discState=$disc['state'];
}
 ?>


<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
        <?php if(!isset($_GET['id'])){ ?>
          <div class="content">
  					<h1 class="page-name">Add Discount</h1>
  					<ol class="breadcrumb">
  						<li><a href="#">Home</a></li>
  						<li class="active">Add Discount</li>
  					</ol>
  				</div>
       <?php }else{ ?>
         <div class="content">
 					<h1 class="page-name">Edit Discount</h1>
 					<ol class="breadcrumb">
 						<li><a href="#">Home</a></li>
 						<li class="active">Edit Discount</li>
 					</ol>
 				</div>
       <?php } ?>

			</div>
		</div>
	</div>
</section>
<section class="user-dashboard page-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="list-inline dashboard-menu text-center">
					<li><a href="discount.php">Discount</a></li>
					<li><a class="active" href="adddiscount.php">Add Discount</a></li>
				</ul>


        <div class="block billing-details">
          <?php if(!isset($_GET['id'])){ ?>
           <h4 class="widget-title">Discount Details</h4>
         <?php }else{ ?>
           <h4 class="widget-title"><?= $name ?> Details</h4>
         <?php } ?>
           <form class="checkout-form" method="post">
              <div class="form-group">
                 <label for="full_name">Discount Name</label>
                 <input type="text" class="form-control" name="name" value="<?= $name ?>" id="full_name" placeholder="" required>
              </div>
              <div class="form-group">
                <select name="ifBuy" class="form-control" required>
                  <option value="">If Buy </option>
                  <?= $crs->SELECT_category($ifBuy); ?>
                </select>
              </div>
              <div class="form-group">
                 <label for="full_name">Number Buy</label>
                 <input type="number"class="form-control" name="numBuy" value="<?= $numBuy ?>" placeholder="" required>
              </div>
              <div class="form-group">
                <select name="discOn" class="form-control" required>
                  <option value="">Discount On</option>
                  <?= $crs->SELECT_category($discOn); ?>
                </select>
              </div>
              <div class="form-group">
                 <label for="full_name">Discount Value</label>
                 <input type="number" value="<?= $disVal ?>" step="0.01" class="form-control" name="disVal" id="full_name" placeholder="" required>
              </div>
              <div class="form-group">
                <select name="discType" class="form-control" required>
                  <option value="percentage" <?php if($discType == "percentage")echo" selected"; ?>>percentage %</option>
                  <option value="Amount"<?php if($discType == "Amount")echo" selected"; ?>>Amount</option>
                </select>
              </div>
              <div class="form-group">
                 <label for="full_name">Expire Date</label>
                 <input type="date" class="form-control" name="expDate" value="<?= $expDate ?>" min="<?= date("Y-m-d") ?>" required>
              </div>
              <div class="form-group">
                <select name="discState" class="form-control" required>
                  <option value="1"<?php if($discState == "1")echo" selected"; ?>>Enable</option>
                  <option value="0"<?php if($discState == "0")echo" selected"; ?>>Disabled</option>
                </select>
              </div>
              <?php if(!isset($_GET['id'])){ ?>
               <button type="submit" name="btnAddCategory" class="btn btn-main">Add</button>
             <?php }else{ ?>
               <button type="submit" name="btnEdit" class="btn btn-main">Edit</button>
             <?php } ?>

           </form>
           <span class="error">
             <?php
               if(isset($_POST['btnAddCategory'])){
                 $crs->add_discount();
               }
               if(isset($_POST['btnEdit']) && isset($_GET['id'])){
                 $crs->edit_discount($_GET['id']);
               }
              ?>
           </span>
        </div>



			</div>
		</div>
	</div>
</section>




<?php
require_once('footer.php');
 ?>
