

<?php
require_once('header.php');
 ?>


<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Add Category</h1>
					<ol class="breadcrumb">
						<li><a href="#">Home</a></li>
						<li class="active">Add Category</li>
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
					<li><a href="category.php">Category</a></li>
					<li><a class="active" href="addcategory.php">Add Category</a></li>
				</ul>


        <div class="block billing-details">
           <h4 class="widget-title">Category Details</h4>
           <form class="checkout-form" method="post">
              <div class="form-group">
                 <label for="full_name">Category Name</label>
                 <input type="text" class="form-control" name="name" id="full_name" placeholder="" required>
              </div>
              <button type="submit" name="btnAddCategory" class="btn btn-main">Add</button>
           </form>
           <span class="error">
             <?php
               if(isset($_POST['btnAddCategory'])){
                 $crs->add_category();
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
