$(document).ready(function(){
    //income vars
    var incomeSlider = $('.income-slider'),
        incomeSliderNext = $('.income-slider__arrow_next'),
        incomeSliderPrev = $('.income-slider__arrow_prev');
    //income card slider
    if(incomeSlider.length){
        incomeSlider.owlCarousel({
            nav:false,
            dots:false,
            items:4,
            margin:30,
            stagePadding: 10,
            responsiveClass:true
        });
    }
    //next button for income card carousel
    incomeSliderNext.on('click',function (e) {
        e.preventDefault();
        incomeSlider.trigger('next.owl.carousel');
    });
    //prev button for income card carousel
    incomeSliderPrev.on('click',function (e) {
        e.preventDefault();
        incomeSlider.trigger('prev.owl.carousel');
    });

});