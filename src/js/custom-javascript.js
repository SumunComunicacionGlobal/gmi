(function($) {
    //caches a jQuery object containing the header element
    var body = $("body");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 15) {
            body.addClass('scrolled');
        } else {
            body.removeClass('scrolled');
        }
    });

    $('.galeria-producto').on('init', function (slick) {
        $('.galeria-producto-controls a[data-slide="0"]').addClass('active');
        $(this).fadeIn();
    });
    $('.galeria-producto').slick();
    $('a[data-slide]').click(function(e) {
        e.preventDefault();
        var sliderId = $(this).attr('href');
        var slideNo = $(this).data('slide');
        $( sliderId ).slick('slickGoTo', slideNo );
    });
    $('.galeria-producto').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        console.log(event);
        var sliderId = event['currentTarget']['id'];

        $('.galeria-producto-controls a[href="#' + sliderId + '"]').removeClass('active');
        $('.galeria-producto-controls a[href="#' + sliderId + '"][data-slide="' + nextSlide + '"]').addClass('active');
    });

    $('#menu-principal a').click(function(e) {
        href = $(this).attr('href').split("#")[0];
        currentUrl = window.location.href.split("#")[0];
        href = href.replace(/(^\w+:|^)\/\//, '');
        currentUrl = currentUrl.replace(/(^\w+:|^)\/\//, '');
        
        // alert(href + ', ' + currentUrl );
        if(href == currentUrl) {
            $('#menu-principal').modal('hide');
        }
    });

})(jQuery);

