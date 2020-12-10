<!-- Start: Store Navigation -->
<div class="sub-header" id="site-nav">
        <div class="sub-header__wrapper">
            <div class="wrapper pos-wrapper">
                <div class="sub-header_right">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#">Home</a></li>
                        <?php if ($isPromo) {
                                    ?>
                            <li class="list-inline-item <?= $m == 'shop' && $v == 'products' && $this->input->get('promo') == 'yes' ? 'active' : ''; ?>"><a href="<?= shop_url('products?promo=yes'); ?>"><?= lang('promotions'); ?></a></li>
                            <?php
                                } ?>
                        <li class="list-inline-item more-category" id="categories-dropdown"><a href="javascript:void(0)">Categories<i class="icon-arrow-down ml-2"></i></a>
                            <ul class="list-unstyled list-more-category hide text-left" id="categories-sublist">
                            <?php
                            foreach ($categories as $pc) {
                        ?>
                                <li><a href="<?= site_url('category/' . $pc->slug) ?>"><?= $pc->name; ?></a></li>
                            <?php }?>
                            </ul>
                        </li>
                        <li class="list-inline-item more-category" id="brands-dropdown"><a href="javascript:void(0)">Brands<i class="icon-arrow-down ml-2"></i></a>
                        <ul class="list-unstyled list-more-category hide text-left" id="brands-sublist">
                        <?php
                            $r = 0;
                            foreach (array_chunk($brands, 1) as $bd) {
                        ?>
                        <?php
                            foreach ($bd as $bs) {
                        ?>
                                <li><a href="<?= site_url('brands/' . $bs->id) ?>"><?= $bs->name; ?></a></li>
                            <?php }?>
                            <?php $r++; }?>
                            </ul>
                        </li>
                        <li class="list-inline-item <?= $m == 'shop' && $v == 'products' && $this->input->get('promo') != 'yes' ? 'active' : ''; ?>"><a href="<?= shop_url('products'); ?>">Products</a></li>
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
                        <a href="<?= site_url('category/' . $ctg->slug) ?>">
                        <div class="store-categories--product">

                            <div class="product-image">
                                <?php if(!empty($ctg->image)):?>
                                    <img src="<?php echo base_url('assets/uploads/' . $ctg->image);?>" alt="<?= $ctg->name; ?>" width="50" height="50">
                                <?php else:?>
                                    <img src="<?php echo base_url('assets/uploads/icecream.jpg');?>" alt="<?= $ctg->name; ?>" width="50" height="50">
                                <?php endif?>
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
                        <h5 class="mb-0 head"><?= lang('fruits-veggies')?></h5><a class="btn btn-more --><?= $m == 'shop' && $v == 'products' && $this->input->get('promo') != 'yes' ? 'active' : ''; ?><!--" href="--><?= shop_url('products'); ?><!--">See all</a></div>
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
                                <a href="--><?= site_url('product/' . $fp->slug); ?>" style="text-decoration:none">
                                    <div class="card-body p-3">
                                    <?php
                                        if ($fp->promotion) {
                                    ?>
                                    <div class="offer-tag"><span class="badge badge-success">59% OFF</span></div>
                                    <?php
                                        }
                                    ?>
                                        <div class="products-top-inner-img"><img class="img-fluid" src="--><?= base_url('assets/uploads/' . $fp->image); ?>" alt="<?= $fp->name; ?>"></div>
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
                                        <div class="btn-group cart-button-group add-to-cart" role="group" data-id="--><?//= $fp->id; ?><!--"><button class="btn btn-add-left" type="button">ADD</button><button class="btn btn-add-right" type="button">+</button></div>
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