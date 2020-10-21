

<?php
require_once('header.php');
 ?>


<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Add Product</h1>
					<ol class="breadcrumb">
						<li><a href="#">Home</a></li>
						<li class="active">Add Product</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="user-dashboard page-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="list-inline dashboard-menu text-center">
					<li><a href="product.php">Product</a></li>
					<li><a class="active" href="addproduct.php">Add Product</a></li>
				</ul>


        <div class="block billing-details">
           <h4 class="widget-title">Product Details</h4>
           <form class="checkout-form" method="post">
              <div class="form-group">
                 <label for="full_name">Product Name</label>
                 <input type="text" class="form-control" name="name" id="full_name" placeholder="" required>
              </div>
              <div class="form-group">
                 <label for="full_name">Price by $</label>
                 <input type="number" step="0.01" class="form-control" name="price" id="full_name" placeholder="" required>
              </div>
              <div class="form-group">
              <select name="SelectCategory" class="form-control" required>
                <option value="">Category</option>
                <?= $crs->SELECT_category(); ?>
              </select>
              </div>
              <button type="submit" name="btnAddCategory" class="btn btn-main">Add</button>
           </form>
           <span class="error">
             <?php
               if(isset($_POST['btnAddCategory'])){
                 echo $crs->add_product();
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
