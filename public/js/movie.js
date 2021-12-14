$(document).ready(function() {

  const autoplaySlider2 = $('.cast-carousel').lightSlider({
    auto:true,
    loop:true,
    item : 5,
    pager : false,
    pauseOnHover: true,
    slideMargin : 30,
    onSliderLoad: function() {
        $('#autoWidth2').removeClass('cS-hidden');
    } 
  });

  const autoplaySlider3 = $('.review-carousel').lightSlider({
    auto:true,
    loop:true,
    item : 3,
    pager : false,
    pauseOnHover: true,
    slideMargin : 30,
    onSliderLoad: function() {
        $('#autoWidth3').removeClass('cS-hidden');
    } 
  });

  const autoplaySlider = $('.movie-carousel').lightSlider({
    auto:true,
    loop:true,
    item : 5,
    pager : false,
    pauseOnHover: true,
    slideMargin : 30,
    onSliderLoad: function() {
        $('#autoWidth').removeClass('cS-hidden');
    } 
  });
  
  
});


