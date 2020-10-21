
<?php
require_once('header.php');
 ?>
<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Checkout</h1>
					<ol class="breadcrumb">
						<li><a href="#">Home</a></li>
						<li class="active">checkout</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="page-wrapper">
   <div class="checkout shopping">
      <div class="container">
         <div class="row">
            <div class="col-md-8">
              <h2>unit tests By $ :</h2>
              <p>
                User = 2 <br/>
                T-shirt<br/>
                T-shirt<br/>
                Shoes<br/>
                Jacket<br/>
                ------------------<br/>
              </p>
              <?php $crs->calc_cart(2) ?>

              <p>
                <br/><br/><br/>
                User = 3 <br/>
                T-shirt<br/>
                Pants<br/>
                ------------------<br/>
              </p>
              <?php $crs->calc_cart(3) ?>


              <h2>unit tests By EL :</h2>
              <p>
                User = 2 <br/>
                T-shirt<br/>
                T-shirt<br/>
                Shoes<br/>
                Jacket<br/>
                ------------------<br/>
              </p>
              <?php $crs->calc_cart(2,$crs->exchange()) ?>

              <p>
                <br/><br/><br/>
                User = 3 <br/>
                T-shirt<br/>
                Pants<br/>
                ------------------<br/>
              </p>
              <?php $crs->calc_cart(3,$crs->exchange()) ?>

            </div>
            <div class="col-md-4">
               <div class="product-checkout-details">
                  <div class="block">
                     <?php $crs->calc_cart() ?>

                     <div class="verified-icon">
                        <img src="images/shop/verified.png">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

   <?php
   require_once('footer.php');
    ?>
