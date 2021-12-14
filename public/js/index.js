$(document).ready(function() {
    const autoplaySlider = $('.movie-carousel').lightSlider({
        auto:true,
        item : 5,
        pauseOnHover: true,
        slideMargin : 30,
        onSliderLoad: function() {
            $('#autoWidth').removeClass('cS-hidden');
        } 
    });
    
    const autoplaySlider2 = $('.movie-genre-carousel').lightSlider({
        auto:true,
        item : 6,
        pauseOnHover: true,
        slideMargin : 50,
        pager:false,
        onSliderLoad: function() {
            $('#autoWidth2').removeClass('cS-hidden');
        } 
    });
});


