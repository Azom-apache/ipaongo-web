


$('document').ready(function(){
    
//STICKY MENU
var height = $('#header-icon').height();
$(window).scroll(function (){
    if($(this).scrollTop() > height) {
        $('.navbar').addClass('fixed');
    }else{
        $('.navbar').removeClass('fixed');
    }
 
});
    //Owl-carousel

    $('.mentor .carousel .owl-carousel').owlCarousel({
        loop:true,
        autoplay:true,
        dots:true,
        responsive:{
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            },
        }
    })   
});
