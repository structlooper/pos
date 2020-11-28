<!-- Start: Store Navigation -->
<div class="sub-header" id="site-nav">
        <div class="sub-header__wrapper">
            <div class="wrapper pos-wrapper">
                <div class="sub-header_right">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#">Home</a></li>
                        <li class="list-inline-item more-category" id="categories-dropdown"><a href="/">Categories<i class="icon-arrow-down ml-2"></i></a>
                            <ul class="list-unstyled list-more-category hide" id="categories-sublist">
                            <?php
                            $r = 0;
                            foreach (array_chunk($categories, 1) as $cats) {
                        ?>
                        <?php
                            foreach ($cats as $ctg) {
                        ?>
                                <li><a href="<?= $ctg->id; ?>"><?= $ctg->name; ?></a></li>
                            <?php }?>
                            <?php $r++;}?>
                            </ul>
                        </li>
                        <li class="list-inline-item" id="brands-dropdown"><a href="/">Brands<i class="icon-arrow-down ml-2"></i></a>
                        <ul class="list-unstyled list-more-category hide" id="brands-sublist">
                                <li><a href="#">Biscuits, Snacks &amp; Chocolates</a></li>
                                <li><a href="#">Beverages</a></li>
                                <li><a href="#">Breakfast &amp; Diary</a></li>
                                <li><a href="#">Best Value</a></li>
                                <li><a href="#">Noodles, Sauces &amp; Instant Food</a></li>
                                <li><a href="#">Home Furnishing and Decor</a></li>
                                <li><a href="#">Fresh &amp; Frozen Food</a></li>
                                <li><a href="#">Lowest Price</a></li>
                                <li><a href="#">Pet Care</a></li>
                                <li><a href="#">Baby Care</a></li>
                                <li><a href="#">Home Improvement and Accessories</a></li>
                                <li><a href="#">Fashion and Lifestyle</a></li>
                                <li><a href="#">Home Appliances</a></li>
                            </ul>
                        </li>
                        <li class="list-inline-item"><a href="#">Products</a></li>
                        <li class="list-inline-item"><a href="#">Checkout</a></li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End: Store Navigation -->
<div class="container">
        <div class="row">
            <div class="col-12">

                <div class="store-categories">
                <?php
                            $r = 0;
                            foreach (array_chunk($categories, 1) as $cats) {
                        ?>
                        <?php
                            foreach ($cats as $ctg) {
                        ?>
                        <a href="<?= shop_url('products/').$ctg->id; ?>">
                        <div class="store-categories--product">
                        
                            <div class="product-image">
                                <?php if($ctg->$image != ''){?>
                                    <img src="<?= base_url('assets/uploads/' . $ctg->image);?>" alt="">
                                <?php } else{?>
                                    <img src="https://image.pngaaa.com/721/1915721-middle.png" alt="<?= $ctg->name; ?>">
                                <?php }?>
                            </div>
                            <div class="product-title">
                                <h6><?= $ctg->name; ?><br></h6>
                            </div>
                            <?php }?>
                        </div>
                    </a>
                    <?php $r++; }?>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="delivery-note"><img class="img-fluid" src="https://cdn.grofers.com/layout-engine/2020-10/Gif-FnV-2.gif" draggable="false"></div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="products-top-list mt-0">
                    <div class="products-top-listbar">
                        <h5 class="mb-0 head"><?= lang('fruits-veggies')?></h5><a class="btn btn-more" href="<?php base_url();?>">See all</a></div>
                        <?php
                            $r = 0;
                            foreach (array_chunk($featured_products, 4) as $fps) {
                        ?>    
                    <div class="products-top-inner">
                        <div class="row">
                        <?php
                            foreach ($fps as $fp) {
                        ?>
                            <div class="col-6 col-lg-3 px-2">
                                
                                <div class="card product-card">
                                <a href="<?= $fp->id; ?>" style="text-decoration:none">
                                    <div class="card-body p-3">
                                    <?php
                                        if ($fp->promotion) {
                                    ?>
                                    <div class="offer-tag"><span class="badge badge-success">59% OFF</span></div>
                                    <?php
                                        } 
                                    ?>
                                        <div class="products-top-inner-img"><img class="img-fluid" src="<?= base_url('assets/uploads/' . $fp->image); ?>" alt="<?= $fp->name; ?>"></div>
                                        <div class="products-top-price mt-3">
                                        <?php
                                                            if ($fp->promotion) {
                                                                echo '<h5 class="mb-0">'.$this->sma->convertMoney($fp->promo_price). '</h5>';
                                                                echo '<p class="text-muted mb-0">' . $this->sma->convertMoney(isset($fp->special_price) && !empty(isset($fp->special_price)) ? $fp->special_price : $fp->price) . '<br></p>';
                                                                
                                                            } else {
                                                                echo '<h5 class="mb-0">'.$this->sma->convertMoney(isset($fp->special_price) && !empty(isset($fp->special_price)) ? $fp->special_price : $fp->price).'</h5>';
                                                            } ?>
                                        </div>
                                        <div class="products-top-list-inner">
                                            <p class="mb-0 product-name"><?= $fp->name; ?><br></p>
                                            <p class="text-muted">4 units (0.75-1 kg)<br></p>
                                        </div>
                                    </a>
                                        <div class="btn-group cart-button-group add-to-cart" role="group" data-id="<?= $fp->id; ?>"><button class="btn btn-add-left" type="button">ADD</button><button class="btn btn-add-right" type="button">+</button></div>
                                    </div>
                                </div>
                                
                            </div>
                        <?php }?>
                        </div>
                    </div>
                <?php $r++; }?>
                </div>
            </div>
        </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>