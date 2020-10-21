

<?php
require_once('header.php');
 ?>


<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Product</h1>
					<ol class="breadcrumb">
						<li><a href="#">Home</a></li>
						<li class="active">Product</li>
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
					<li><a class="active" href="product.php">Product</a></li>
					<li><a href="addproduct.php">Add Product</a></li>
				</ul>
				<div class="dashboard-wrapper user-dashboard">

          <form class="checkout-form" method="post">
             <div class="form-group">
                <label for="full_name">Search By Name</label>
                <input type="text" class="form-control" name="name" id="full_name" placeholder="">
             </div>
             <button type="submit" name="btnAddCategory" class="btn btn-main">Search</button>
          </form>

					<div class="table-responsive">
						<table class="table">
							<?php

                $fliter="";
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                  if (isset($_POST['name'])) {
                    $fliter=$_POST['name'];
                  }

                }else {
                  $fliter="";
                }

                $crs->display_product($fliter);
               ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>




<?php
require_once('footer.php');
 ?>
