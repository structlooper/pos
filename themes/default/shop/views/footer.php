<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if (DEMO && ($m == 'main' && $v == 'index')) {
    ?>
<div class="page-contents padding-top-no">
    <div class="container">
        <div class="alert alert-info margin-bottom-no">
            <p>
                <strong>Shop module is not complete item but add-on to Stock Manager Advance and is available separately.</strong><br>
                This is joint demo for main item (Stock Manager Advance) and add-ons (POS & Shop Module). Please check the item page on codecanyon.net for more info about what's not included in the item and you must read the page there before purchase. Thank you
            </p>
        </div>
    </div>
</div>
<?php
} ?>
<!-- Start: Footer -->
<div class="footer">
        <div class="container">
            <div class="quality-marks">
                <div class="row">
                    <div class="col">
                        <div class="quality-icon best-prices"></div>
                        <div class="d-table-cell quality-description">
                            <div class="quality-marks-name"><span>Best Prices &amp; Offers<br></span></div>
                            <div>
                                <p class="mb-0">Cheaper prices than your local supermarket, great&nbsp;<a href="https://grofers.com/grand-orange-bag-days">c</a>ashback offers&nbsp;to top it off.<br></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="quality-icon genuine-products"></div>
                        <div class="d-table-cell quality-description">
                            <div class="quality-marks-name"><span>Wide Assortment<br></span></div>
                            <div>
                                <p class="mb-0">Choose from 5000+ products across food, personal care, household &amp; other categories.<br></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="quality-icon easy-returns"></div>
                        <div class="d-table-cell quality-description">
                            <div class="quality-marks-name"><span>Easy Returns<br></span></div>
                            <div>
                                <p class="mb-0">Not satisfied with a product? Return it at the doorstep &amp; get a refund within hours.<br></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 pt-3 border-top">
                <div class="row">
                    <div class="col">
                        <div class="cat-links">
                            <h6 class="font-weight-bold">Categories</h6>
                            <div class="row">
                                <div class="col">
                                    <ul class="list-unstyled">
                                        <li><a href="#">Grocery &amp; Staples</a></li>
                                        <li><a href="#">Rice</a></li>
                                        <li><a href="#">Moong Dal</a></li>
                                        <li><a href="#">Detergent Powders</a></li>
                                        <li><a href="#">Noodles &amp; Pasta</a></li>
                                        <li><a href="#">Vegetables</a></li>
                                    </ul>
                                </div>
                                <div class="col">
                                    <ul class="list-unstyled">
                                        <li><a href="#">Tea</a></li>
                                        <li><a href="#">Salt &amp; Sugar</a></li>
                                        <li><a href="#">Ghee</a></li>
                                        <li><a href="#">Soap</a></li>
                                        <li><a href="#">Cooking Oil</a></li>
                                        <li><a href="#">Baby Diapers</a></li>
                                    </ul>
                                </div>
                                <div class="col">
                                    <ul class="list-unstyled">
                                        <li><a href="#">Atta</a></li>
                                        <li><a href="#">Toor Dal</a></li>
                                        <li><a href="#">Almonds</a></li>
                                        <li><a href="#">Biscuits &amp; Cookies</a></li>
                                        <li><a href="#">Fruits</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="cat-links border-right-0">
                            <div class="row">
                                <div class="col">
                                    <h6 class="font-weight-bold">Useful Links</h6>
                                    <ul class="list-unstyled">
                                        <li><a href="<?= site_url('page/' . $shop_settings->about_link); ?>">About Us</a></li>
                                        <li><a href="<?= site_url('page/' . $shop_settings->offer_link); ?>">Offers</a></li>
                                        <li><a href="<?= shop_url('privacy-policy'); ?>">Privacy Policy</a></li>
                                        <li><a href="#">Contact Us</a></li>
                                        <li><a href="<?= site_url('page/' . $shop_settings->tnc_link); ?>">Terms &amp; Conditions</a></li>
                                        <li><a href="#">Careers</a></li>
                                    </ul>
                                </div>
                                <div class="col">
                                    <div>
                                        <h6 class="font-weight-bold">Download App</h6>
                                        <div class="download-links"><a href="#"><img src="https://grofers.com/images/home/google-play_1x-6d4f8e0.png"></a><a href="#"><img src="https://grofers.com/images/home/app-store_1x-8362160.png"></a></div>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="font-weight-bold">Social Connect</h6>
                                        <ul class="list-inline social-list mb-0">
                                        <?php if (!empty($shop_settings->facebook)) { ?>
                                            <li class="list-inline-item"><a target="_blank" href="<?= $shop_settings->facebook; ?>"><i class="fab fa-facebook"></i></a>
                                        <?php } if (!empty($shop_settings->twitter)) { ?>
                                            <a target="_blank" href="<?= $shop_settings->twitter; ?>"><i class="fab fa-twitter"></i></a>
                                        <?php } if (!empty($shop_settings->linkedin)) { ?>
                                            <a target="_blank" href="<?= $shop_settings->linkedin; ?>"><i class="fab fa-linkedin-in"></i></a>
                                        <?php } if (!empty($shop_settings->instagram)) { ?>
                                            <a target="_blank" href="<?= $shop_settings->instagram; ?>"><i class="fab fa-instagram"></i></a></li>
                                        <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="brands-list border-top">
                        <h6 class="font-weight-bold">Brands</h6>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="#">Amul</a></li>
                            <li class="list-inline-item"><a href="#">Axe</a></li>
                            <li class="list-inline-item"><a href="#">Bambino</a></li>
                            <li class="list-inline-item"><a href="#">Best Value</a></li>
                            <li class="list-inline-item"><a href="#">Bingo</a></li>
                            <li class="list-inline-item"><a href="#">Bisleri</a></li>
                            <li class="list-inline-item"><a href="#">Boost</a></li>
                            <li class="list-inline-item"><a href="#">Bournvita</a></li>
                            <li class="list-inline-item"><a href="#">Britannia</a></li>
                            <li class="list-inline-item"><a href="#">Cadbury</a></li>
                            <li class="list-inline-item"><a href="#">Cheetos</a></li>
                            <li class="list-inline-item"><a href="#">Cinthol</a></li>
                            <li class="list-inline-item"><a href="#">Closeup</a></li>
                            <li class="list-inline-item"><a href="#">Coca-Cola</a></li>
                            <li class="list-inline-item"><a href="#">Dabour</a></li>
                            <li class="list-inline-item"><a href="#">Danone</a></li>
                            <li class="list-inline-item"><a href="#">Del Monte</a></li>
                            <li class="list-inline-item"><a href="#">Dettol</a></li>
                            <li class="list-inline-item"><a href="#">Durex</a></li>
                            <li class="list-inline-item"><a href="#">English Oven</a></li>
                            <li class="list-inline-item"><a href="#">Everest</a></li>
                            <li class="list-inline-item"><a href="#">Garnier</a></li>
                            <li class="list-inline-item"><a href="#">Gillette</a></li>
                            <li class="list-inline-item"><a href="#">Glucon-D</a></li>
                            <li class="list-inline-item"><a href="#">Gowardhan</a></li>
                            <li class="list-inline-item"><a href="#">Hajmola</a></li>
                            <li class="list-inline-item"><a href="#">Haldiram's</a></li>
                            <li class="list-inline-item"><a href="#">Head &amp; Shoulders</a></li>
                            <li class="list-inline-item"><a href="#">Himalaya</a></li>
                            <li class="list-inline-item"><a href="#">L'Oreal</a></li>
                            <li class="list-inline-item"><a href="#">Lay's</a></li>
                            <li class="list-inline-item"><a href="#">Maggi</a></li>
                            <li class="list-inline-item"><a href="#">Minute Maid</a></li>
                            <li class="list-inline-item"><a href="#">Mother Diary</a></li>
                            <li class="list-inline-item"><a href="#">Nestle</a></li>
                            <li class="list-inline-item"><a href="#">Nutella</a></li>
                            <li class="list-inline-item"><a href="#">Oral-B</a></li>
                            <li class="list-inline-item"><a href="#">Oreo</a></li>
                            <li class="list-inline-item"><a href="#">Pantene</a></li>
                            <li class="list-inline-item"><a href="#">Paper Boat</a></li>
                            <li class="list-inline-item"><a href="#">Parle</a></li>
                            <li class="list-inline-item"><a href="#">Patanjali</a></li>
                            <li class="list-inline-item"><a href="#">Pepsi</a></li>
                            <li class="list-inline-item"><a href="#">Princeware</a></li>
                            <li class="list-inline-item"><a href="#">Red Bull</a></li>
                            <li class="list-inline-item"><a href="#">Saffola</a></li>
                            <li class="list-inline-item"><a href="#">Smith &amp; Jones</a></li>
                            <li class="list-inline-item"><a href="#">Stayfree</a></li>
                            <li class="list-inline-item"><a href="#">Sunsilk</a></li>
                            <li class="list-inline-item"><a href="#">Tata Tea</a></li>
                            <li class="list-inline-item"><a href="#">Unibic</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="payment-methods">
                        <div class="row">
                            <div class="col">
                                <h6 class="font-weight-bold">Payment Options</h6><img src="https://grofers.com/images/payment/mobikwik-6d9eed3.png"><img src="https://grofers.com/images/payment/paytm-1cc911c.png"><img src="https://grofers.com/images/payment/visa-42f212a.png">
                                <img
                                    src="https://grofers.com/images/payment/mastercard-fafd4ad.png"><img src="https://grofers.com/images/payment/maestro-be32af5.png"><img src="https://grofers.com/images/payment/rupay-77f4f26.png"><img src="https://grofers.com/images/payment/bhim-upi-3c1ef19.png"><span>Net Banking</span><span>Cash On Delivery</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="copyright">© The Best One, Copyrights 2020. All Rights Reserved | Made with ❤ by Infirment Technologies Pvt. Ltd</p>
        </div>
    </div>
    <!-- End: Footer -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="<?= $assets; ?>js/bs-init.js"></script>
<script src="<?= $assets; ?>js/slick.min.js"></script>
<script src="<?= $assets; ?>js/custom.js"></script>


<?php if ($m == 'shop' && $v == 'product') {
        ?>
<script type="text/javascript">
$(document).ready(function ($) {
  $('.rrssb-buttons').rrssb({
    title: '<?= $product->code . ' - ' . $product->name; ?>',
    url: '<?= site_url('product/' . $product->slug); ?>',
    image: '<?= base_url('assets/uploads/' . $product->image); ?>',
    description: '<?= $page_desc; ?>',
    // emailSubject: '',
    // emailBody: '',
  });
});
</script>
<?php
    } ?>
<script type="text/javascript">
<?php if ($message || $warning || $error || $reminder) {
        ?>
$(document).ready(function() {
    <?php if ($message) {
            ?>
        sa_alert('<?=lang('success'); ?>', '<?= trim(str_replace(["\r", "\n", "\r\n"], '', addslashes($message))); ?>');
    <?php
        }
        if ($warning) {
            ?>
        sa_alert('<?=lang('warning'); ?>', '<?= trim(str_replace(["\r", "\n", "\r\n"], '', addslashes($warning))); ?>', 'warning');
    <?php
        }
        if ($error) {
            ?>
        sa_alert('<?=lang('error'); ?>', '<?= trim(str_replace(["\r", "\n", "\r\n"], '', addslashes($error))); ?>', 'error', 1);
    <?php
        }
        if ($reminder) {
            ?>
        sa_alert('<?=lang('reminder'); ?>', '<?= trim(str_replace(["\r", "\n", "\r\n"], '', addslashes($reminder))); ?>', 'info');
    <?php
        } ?>
});
<?php
    } ?>
</script>
</body>
</html>
