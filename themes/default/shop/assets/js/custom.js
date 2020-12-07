(function($) {
	"use strict";

$('.btn-account-login').on('click',function(){
    $('.modal-login').modal('show');
});

$('.cart-browse').on('click',function(){
    $('.cart-modal').modal('show');
});

$('#btn-add-address').on('click',function(){
    $('#address-modal').modal('show');
});


$('.category-list-item .nav-detail').click(function() {
  // e.preventDefault();
  // $('.category-list-item').not(this).find('ul').slideUp();
  $(this).next('ul').stop(true, true).slideToggle();
  return false;
});


  $('.store-categories').slick({
    infinite: false,
    // autoplay: true,
    slidesToShow: 9,
    slidesToScroll: 6,
    speed: 300,
    arrows: true,
  });

$('.store-categories-inner').slick({
    infinite: true,
    autoplay: true,
    slidesToShow: 10,
    slidesToScroll: 6,
    speed: 3000,
    arrows: true,
  });

$('.product-image-slider').slick({
    infinite: true,
    autoplay: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    speed: 500,
    dots: true
  });

// $('#categories-dropdown').on('click',function(e){
//   e.preventDefault();
//   $('#categories-sublist').toggleClass('hide');
// });

// $('#brands-dropdown').on('click',function(e){
//   e.preventDefault();
//   $('#brands-sublist').toggleClass('hide');
// });

$('.close-tooltip').on('click',function(){
    $('.location-tooltip').css('display','none');
});

$('#btn-inc').on('click',function(){
  var e = $(this).parent().find("input");
  e.val(parseInt(e.val())+1);
})
$('#btn-desc').on('click',function(){
  var e=$(this).parent().find("input");
  parseInt(e.val())>1&&e.val(parseInt(e.val())-1);
})

$(window).ready(function(){
  var prevScrollpos = window.pageYOffset;
  window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
      document.getElementById("site-nav").style.top = "60px";
    } else {
      document.getElementById("site-nav").style.top = "0";
    }
    prevScrollpos = currentScrollPos;
  }
})

})(jQuery);