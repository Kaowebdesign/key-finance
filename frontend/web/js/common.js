$(document).ready(function(){
    var incomeSlider = $('.income-slider');

    if(incomeSlider.length){
        incomeSlider.owlCarousel({
            nav:false,
            items:4,
            margin:30,
            stagePadding: 50
        });
    }

});