$(document).ready(function() {
    //  SLIDER
    var slider = $("#slider-wp .section-detail");
    slider.owlCarousel({
        autoPlay: 4500,
        navigation: false,
        navigationText: false,
        paginationNumbers: false,
        pagination: true,
        items: 1, //10 items above 1000px browser width
        itemsDesktop: [1000, 1], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 1], // betweem 900px and 601px
        itemsTablet: [600, 1], //2 items between 600 and 0
        itemsMobile: true, // itemsMobile disabled - inherit from itemsTablet option
    });

    //  ZOOM PRODUCT DETAIL
    $("#zoom").elevateZoom({
        gallery: "list-thumb",
        cursor: "pointer",
        galleryActiveClass: "active",
        imageCrossfade: true,
        loadingIcon: "http://www.elevateweb.co.uk/spinner.gif",
    });

    //  LIST THUMB
    var list_thumb = $("#list-thumb");
    list_thumb.owlCarousel({
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 5, //10 items above 1000px browser width
        itemsDesktop: [1000, 5], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 5], // betweem 900px and 601px
        itemsTablet: [768, 5], //2 items between 600 and 0
        itemsMobile: true, // itemsMobile disabled - inherit from itemsTablet option
    });

    //  FEATURE PRODUCT
    var feature_product = $("#feature-product-wp .list-item");
    feature_product.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1], // itemsMobile disabled - inherit from itemsTablet option
    });

    //  SAME CATEGORY
    var same_category = $("#same-category-wp .list-item");
    same_category.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1], // itemsMobile disabled - inherit from itemsTablet option
    });

    //  SCROLL TOP
    $(window).scroll(function() {
        if ($(this).scrollTop() != 0) {
            $("#btn-top").stop().fadeIn(150);
        } else {
            $("#btn-top").stop().fadeOut(150);
        }
    });
    $("#btn-top").click(function() {
        $("body,html").stop().animate({ scrollTop: 0 }, 800);
    });

    // CHOOSE NUMBER ORDER
    var value = parseInt($("#num-order").attr("value"));
    $("#plus").click(function() {
        value++;
        $("#num-order").attr("value", value);
        update_href(value);
    });
    $("#minus").click(function() {
        if (value > 1) {
            value--;
            $("#num-order").attr("value", value);
        }
        update_href(value);
    });

    //  MAIN MENU
    $("#category-product-wp .list-item > li")
        .find("ul.sub-menu")
        .after('<i class="fa fa-angle-right arrow" aria-hidden="true"></i>');
    //  TAB
    tab();

    //  EVEN MENU RESPON
    $("html").on("click", function(event) {
        var target = $(event.target);
        var site = $("#site");

        if (target.is("#btn-respon i")) {
            if (!site.hasClass("show-respon-menu")) {
                site.addClass("show-respon-menu");
            } else {
                site.removeClass("show-respon-menu");
            }
        } else {
            $("#container").click(function() {
                if (site.hasClass("show-respon-menu")) {
                    site.removeClass("show-respon-menu");
                    return false;
                }
            });
        }
    });

    //  MENU RESPON
    $("#main-menu-respon li .sub-menu").after(
        '<span class="fa fa-angle-right arrow"></span>'
    );
    $("#main-menu-respon li .arrow").click(function() {
        if ($(this).parent("li").hasClass("open")) {
            $(this).parent("li").removeClass("open");
        } else {
            //            $('.sub-menu').slideUp();
            //            $('#main-menu-respon li').removeClass('open');
            $(this).parent("li").addClass("open");
            //            $(this).parent('li').find('.sub-menu').slideDown();
        }
    });
});
$(document).ready(function() {
    $('.custom1').owlCarousel({
        animateOut: 'slideOutDown',
        animateIn: 'flipInX',
        items: 1,
        margin: 30,
        stagePadding: 30,
        smartSpeed: 450
    });
})

function tab() {
    var tab_menu = $("#tab-menu li");
    tab_menu.stop().click(function() {
        $("#tab-menu li").removeClass("show");
        $(this).addClass("show");
        var id = $(this).find("a").attr("href");
        $(".tabItem").hide();
        $(id).show();
        return false;
    });
    $("#tab-menu li:first-child").addClass("show");
    $(".tabItem:first-child").show();
}
(function() {
    "use strict";

    var carousels = function() {
        $(".owl-carousel1").owlCarousel({
            loop: true,
            center: true,
            margin: 0,
            responsiveClass: true,
            nav: false,
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                },
                680: {
                    items: 1,
                    nav: false,
                    loop: false,
                },
                1000: {
                    items: 1,
                    nav: true,
                },
            },
        });
    };

    (function($) {
        carousels();
    })(jQuery);
})();

$('.custom1').owlCarousel({
    animateOut: 'slideOutDown',
    animateIn: 'flipInX',
    items: 1,
    margin: 30,
    stagePadding: 30,
    smartSpeed: 450
});
$(document).ready(function() {
    var src_img_click, src_img_first;
    //lấy bộ img li đầu tiên bằng cách first-child img
    // src_img_first =  $('#list-thumb li:first-child img').attr('src');
    // $("#show img").attr('src', src_img_first);
    // console.log('src', src_img_first);
    $("#list-thumb li a").click(function() {
        src_img_click = $(this).children('img').attr('src');
        $("#show>img").attr('src', src_img_click);
        $("ul#list-thumb li").removeClass('active');
        $(this).parent('li').addClass('active');
        return false;
    });
});
$(document).ready(function() {
    $("ul#list-thumb li").click(function() {
        $("ul#list-thumb li").removeClass('active');
        $(this).addClass('active');
        src_img_click = $(this).find('img').attr('src');
        $("#show img").attr('src', src_img_click);
    });
    $("#show .fa-angle-right").click(function() {
        //alert('Được rồi còn đâu ấn lắm thế Dũng chó');
        if ($("ul#list-thumb li:last-child").hasClass('active')) {
            $("ul#list-thumb li:first-child").click();
        } else {
            $("ul#list-thumb li.active").next().click();
        }
        $("#show .fa-angle-right").css('color', 'red');
    });
    $("#show .fa-angle-left").click(function() {
        //alert('Được rồi còn đâu ấn lắm thế Dũng chó');
        if ($("ul#list-thumb li:first-child").hasClass('active')) {
            $("ul#list-thumb li:last-child").click();
        } else {
            $("ul#list-thumb li.active").prev().click();
        }
        $("#show .fa-angle-left").css('color', 'blue');
    });
});
$(document).ready(function() {

    $('.increment-btn').click(function(e) {
        e.preventDefault();
        var incre_value = $(this).parents('.quantity').find('.qty-input').val();
        var value = parseInt(incre_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).parents('.quantity').find('.qty-input').val(value);
        }
    });

    $('.decrement-btn').click(function(e) {
        e.preventDefault();
        var decre_value = $(this).parents('.quantity').find('.qty-input').val();
        var value = parseInt(decre_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).parents('.quantity').find('.qty-input').val(value);
        }
    });

});