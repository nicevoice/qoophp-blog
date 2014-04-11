/**
 * Created by rogee on 14-2-23.
 */
$(function(){
    //fancy box load
    $( ".article_content a").has('img').fancybox( {
        'transitionIn'  : 'elastic' ,
        'transitionOut' : 'elastic'
    } );

    //pretty print
    window.prettyPrint && prettyPrint();

    $('.navbar-toggle').click(function() {
        return $('body, html').toggleClass("nav-open");
    });

//    nav menu
    (function(){
        var _delay_timer, _delay = 300;
        $(".dropdown").hover(function(){
            clearTimeout(_delay_timer);
            var _this = $(this);
            _delay_timer = setTimeout(function(){
                _this.find("ul.dropdown-menu").eq(0).stop(true,false).fadeIn();
            },_delay);
        }, function(){
            clearTimeout(_delay_timer);
            $(this).find("ul.dropdown-menu").eq(0).fadeOut('fast');
        });
    })();


    /*
     # =============================================================================
     #    TimeLine
     # =============================================================================
     */
    (function () {
        $( ".timeline-content" ).fitVids();

        timelineAnimate = function ( elem ) {
            return $( ".timeline.animated li" ).each( function ( i ) {
                var bottom_of_object, bottom_of_window;
                bottom_of_object = $( this ).position().top + $( this ).outerHeight();
                bottom_of_window = $( window ).scrollTop() + $( window ).height();
                if ( bottom_of_window > bottom_of_object ) {
                    return $( this ).addClass( "active" );
                }
            } );
        };
        timelineAnimate();
        $( window ).scroll( function () {
            return timelineAnimate();
        } );
    })();

    /*
     # =============================================================================
     #   Navbar scroll animation
     # =============================================================================
     */

    $(".navbar.scroll-hide").mouseover(function() {
        $(".navbar.scroll-hide").removeClass("closed");
        return setTimeout((function() {
            return $(".navbar.scroll-hide").css({
                overflow: "visible"
            });
        }), 150);
    });
    $(function() {
        var delta, lastScrollTop;
        lastScrollTop = 0;
        delta = 50;
        return $(window).scroll(function(event) {
            var st;
            st = $(this).scrollTop();
            if (Math.abs(lastScrollTop - st) <= delta) {
                return;
            }
            if (st > lastScrollTop) {
                $('.navbar.scroll-hide').addClass("closed");
            } else {
                $('.navbar.scroll-hide').removeClass("closed");
            }
            return lastScrollTop = st;
        });
    });
});