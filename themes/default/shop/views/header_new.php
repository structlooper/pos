<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title><?= $page_title; ?></title>

	
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
	<link type="text/css" rel="stylesheet" href="<?= $assets; ?>asset/css/bootstrap.min.css" />
	<link type="text/css" rel="stylesheet" href="<?= $assets; ?>asset/css/slick.css" />
	<link type="text/css" rel="stylesheet" href="<?= $assets; ?>asset/css/slick-theme.css" />
	<link type="text/css" rel="stylesheet" href="<?= $assets; ?>asset/css/nouislider.min.css" />
	<link rel="stylesheet" href="<?= $assets; ?>asset/css/font-awesome.min.css">
	<link type="text/css" rel="stylesheet" href="<?= $assets; ?>asset/css/style.css" />

	 <meta property="og:url" content="<?= isset($product) && !empty($product) ? site_url('product/' . $product->slug) : site_url(); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= $page_title; ?>" />
    <meta property="og:description" content="<?= $page_desc; ?>" />
    <meta property="og:image" content="<?= isset($product) && !empty($product) ? base_url('assets/uploads/' . $product->image) : base_url('assets/uploads/logos/' . $shop_settings->logo); ?>" />

</head>

<body>
		<header>
		<div id="header">
			<div class="container">
				<div class="pull-left">
				
					<div class="header-logo">
						<a class="logo" href="index.php">
							<img src="<?= $assets; ?>asset/images/logo.png" alt="">
						</a>
					</div>
					
					
					
					<div class="header-search">
						<form>
							<input class="input search-input" type="text" placeholder="Enter your keyword">
							
							<button class="search-btn"><i class="fa fa-search"></i></button>
						</form>
					</div>
				
					<!-- /Search -->
				</div>
				<div class="pull-right">
					<ul class="header-btns">
						<!-- Account -->
						<li class="header-account dropdown default-dropdown">
							<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-user-o"></i>
								</div>
								<strong class="text-white">My Account <i class="fa fa-caret-down"></i></strong>
							</div>
							<a href="#" style="color: #fff;">Login</a> / <a href="#" style="color: #fff;">Signup</a>
							<ul class="custom-menu">
								<li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>
								<li><a href="#"><i class="fa fa-heart-o"></i> My Wishlist</a></li>
								<li><a href="#"><i class="fa fa-check"></i> Checkout</a></li>
								<li><a href="#"><i class="fa fa-unlock-alt"></i> Logout</a></li>
								
							</ul>
						</li>

						
						<li class="header-cart dropdown default-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-shopping-cart"></i>
									<span class="qty">0</span>
								</div>
								<strong class="text-uppercase">My Cart:</strong>
								<br>
								<span style="color: orange;">Rs 00.00</span>
							</a>
							<div class="custom-menu">
								<div id="shopping-cart">
									<div class="shopping-cart-list">
										<div class="product product-widget">
											<div class="product-thumb">
												<img src="images/p1.png" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-price">Rs 75.00 <span class="qty"></span></h3>
												<h2 class="product-name"><a href="#">product 1</a></h2>
											</div>
											<button class="cancel-btn"><i class="fa fa-trash"></i></button>
										</div>
										<div class="product product-widget">
											<div class="product-thumb">
												<img src="images/p2.png" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-price">Rs 60.00 <span class="qty"></span></h3>
												<h2 class="product-name"><a href="#">product 2</a></h2>
											</div>
											<button class="cancel-btn"><i class="fa fa-trash"></i></button>
										</div>
										<div class="product product-widget">
											<div class="product-thumb">
												<img src="images/p3.png" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-price">Rs 90.00 <span class="qty"></span></h3>
												<h2 class="product-name"><a href="#">product 3</a></h2>
											</div>
											<button class="cancel-btn"><i class="fa fa-trash"></i></button>
										</div>
									</div>
									<!--total-->
										
									<div class="shopping-cart-btns">
										<button class="main-btn">View Cart</button>
										<button class="primary-btn">Checkout <i class="fa fa-arrow-circle-right"></i></button>
									</div>
								</div>
							</div>
						</li>
					
					<li class="nav-toggle">
							<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
						</li>
					</ul>
				</div>
			</div>
			
		</div>
		
	</header>
	<div id="navigation">
		
		<div class="container">
			<div id="responsive-nav">
				
				<div class="category-nav show-on-click">
					<span class="category-header">All Product<i class="fa fa-bars"></i></span>
					<ul class="category-list">
						<li class="dropdown side-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Product<i class="fa fa-angle-right" style="margin-left: 10px; float: right;"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											<li>
												<h3 class="list-links-title">Categories</h3></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
										</ul>
										
									</div>
									
								</div>
								
							</div>
						</li>
						<li><a href="#">Product</a></li>
						<li class="dropdown side-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Product<i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											<li>
												<h3 class="list-links-title">Categories</h3></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
										</ul>
										<hr>
										
									</div>
									
									
								</div>
							</div>
						</li>
						<li><a href="#">Product</a></li>
						<li><a href="#">Product</a></li>
						<li><a href="#">Product</a></li>
						<li><a href="#">Product</a></li>
						<li><a href="#">Product</a></li>
						<li><a href="#">Product</a></li>

						</ul>
				</div>
				<!-- /category nav -->

				<!-- menu nav -->
				<div class="menu-nav">
					<span class="menu-header">Menu<i class="fa fa-bars"></i></span>
					<ul class="menu-list">
						<li><a href="index.php">Home</a></li>
						<li><a href="product.phpd">Product</a></li>
						<li class="dropdown mega-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Category <i class="fa fa-caret-down"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											<li>
												<h3 class="list-links-title">Categories</h3></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
										</ul>
										<hr class="hidden-md hidden-lg">
									</div>
									<div class="col-md-4">
										<ul class="list-links">
											<li>
												<h3 class="list-links-title">Categories</h3></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
										</ul>
										<hr class="hidden-md hidden-lg">
									</div>
									<div class="col-md-4">
										<ul class="list-links">
											<li>
												<h3 class="list-links-title">Categories</h3></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
										</ul>
									</div>
								</div>
								
							</div>
						</li>
						<li class="dropdown mega-dropdown full-width"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Brands<i class="fa fa-caret-down"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-3">
										
										<ul class="list-links">
											<li>
												<h3 class="list-links-title">Categories</h3></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
										</ul>
									</div>
									<div class="col-md-3">
										
										
										<ul class="list-links">
											<li>
												<h3 class="list-links-title">Categories</h3></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
											<li><a href="#">item</a></li>
										</ul>
									</div>
									
								</div>
							</div>
						</li>
						<li><a href="veg.php">Shopping</a></li>
						<li><a href="#">Checkout</a></li>
					</ul>
				</div>
				<!-- menu nav -->
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->