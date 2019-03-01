
$(function() {

    // add js class to body if javascript enabled
    $('body').addClass('js');

    /* Videos */
    $('.video .video-link').click(function(e){
        var that = $(this);
        var video = that.data('video');
        var width = $('img', that).width();
        var height = $('img', that).height();
        that.parent().addClass('on');
        that.parent().prepend('<iframe src="http://www.youtube.com/embed/' + video + '?rel=0&autoplay=1" width="' + width + '" height="' + height + '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>');
        that.fadeOut(1000);
        that.parent().fitVids();
        e.preventDefault();
    });

    /* Flexslider */
    $('#saturdays-gallery, #walkitout-gallery').flexslider({
        animation: "slide",
        slideshow: false,
        itemWidth: 333,
        move: 1,
        touch: true
    });
    $('#readwrite-gallery, #greek-gallery').flexslider({
        animation: "slide",
        slideshow: false,
        smoothHeight: true,
        touch: true
    });


    /* TopBar Menu dropdown */
    var $menu = $('#univ-nav'),
    $menulink = $('.menu-link');

    $menulink.click(function() {
        $menulink.toggleClass('active');
        $menu.toggleClass('active');
        return false;
    });     


    /* Navigation Sticky */
    var topBarHeight = $('#top-bar').outerHeight();
    var headerHeight = $('#header').outerHeight();
    var navHeight = $('#division-nav').outerHeight();
    var totalHeight = headerHeight + navHeight + topBarHeight;

    $(window).scroll(function(){

        //if scrolled down more than the header's height
        if ($(window).scrollTop() > totalHeight){

            // if yes, add "fixed" class to the <nav>
            // add padding top to the #content (value is same as the height of the nav)
            $('#nav-wrapper').addClass('fixed').css('top','0').next().addClass('padding-top');
        } else {

            // when scroll up or less than aboveHeight, remove the "fixed" class, and the padding-top
            $('#nav-wrapper').removeClass('fixed').next().removeClass('padding-top');
        }
    });

    /* Waypoints - adding .selected class to sub-nav links when scrolled into */
    var sections = $("section");
    var navigation_links = $(".sub-nav a");
    
    sections.waypoint({
        handler: function(event, direction) {
        
            var active_section;
            active_section = $(this);
            if (direction === "up") active_section = active_section.prev();

            var active_link = $('.sub-nav a[href="#' + active_section.attr("id") + '"]');
            navigation_links.removeClass("selected");
            active_link.addClass("selected");

        }, offset: 102
    })

    // Waypoints - smooth scrolling for internal links
    var scrollElement = 'html, body';
    $('html, body').each(function () {
        var initScrollTop = $(this).attr('scrollTop');
        $(this).attr('scrollTop', initScrollTop + 1);
        if ($(this).attr('scrollTop') == initScrollTop + 1) {
            scrollElement = this.nodeName.toLowerCase();
            $(this).attr('scrollTop', initScrollTop);
            return false;
        }    
    });
    $(".sub-nav a").click(function(event) {
        event.preventDefault();
        
        var $this = $(this),
        target = this.hash,
        $target = $(target);
        
        $(scrollElement).stop().animate({
            'scrollTop': $target.offset().top
        }, 1000, 'swing', function() {
            window.location.hash = target;
        });
        
    });

});
