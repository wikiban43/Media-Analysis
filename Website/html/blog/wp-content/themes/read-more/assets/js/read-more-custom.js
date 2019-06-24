/**
 * Custom JS
 *
 * @package AcmeThemes
 * @subpackage Read More
 */
jQuery(document).ready(function($){
    var at_body = $("body");
    var at_window = $(window);
    /*search*/
    $('.search-icon-menu').click(function(){
        $('.menu-search-toggle').fadeToggle();
    });

    at_window.on("load", function() {
        /*parallax scolling*/
        $('a[href*="#"]').click(function(event){
            $('html, body').animate({
                scrollTop: $( $.attr(this, 'href') ).offset().top-$('.at-navbar').height()
            }, 1000);
            event.preventDefault();
        });
        /*bootstrap sroolpy*/
        at_body.scrollspy({target: ".navbar-fixed-top", offset: $('.at-navbar').height()+50 } );

        //Sickey Sidebar
        if(at_body.hasClass('at-sticky-sidebar')){
            if(at_body.hasClass('both-sidebar')){
                $('#secondary-right, #primary-wrap').theiaStickySidebar();
            }
            else{
                $('.secondary-sidebar, #primary').theiaStickySidebar();
            }
        }
    });

    function read_more_stickyMenu() {

        var scrollTop = at_window.scrollTop();
        var at_navbar_wrapper = $('.at-navbar-wrapper');
        var at_navbar_container = $('#navbar > .container');

        at_navbar_wrapper.height(at_navbar_wrapper.height());
        var offset = $('.top-header').height() + at_navbar_container.height() -2;
        if ( scrollTop > offset ) {
            $('.main-navigation ').addClass('navbar-fixed-top ');
            $('.sm-up-container').show();
        }
        else {
            $('.main-navigation ').removeClass('navbar-fixed-top ');
            $('.sm-up-container').hide();
        }
    }
    //What happen on window scroll
    read_more_stickyMenu();
    at_window.on("scroll", function () {
        setTimeout(function () {
            read_more_stickyMenu();
        }, 300)
    });

    /*new pagination style*/
    var paged = parseInt(read_more_ajax.paged) + 1;
    var max_num_pages = parseInt(read_more_ajax.max_num_pages);
    var next_posts = read_more_ajax.next_posts;

    $(document).on( 'click', '.show-more', function( event ) {
        event.preventDefault();
        var show_more = $(this);
        var click = show_more.attr('data-click');

        if( (paged-1) >= max_num_pages){
            show_more.html(read_more_ajax.no_more_posts)
        }

        if( click == 0 || (paged-1) >= max_num_pages){
            return false;
        }
        show_more.html('<i class="fa fa-spinner fa-spin fa-fw"></i>');
        show_more.attr("data-click", 0);
        var page = parseInt( show_more.attr('data-number') );


        $('#read-more-temp-post').load(next_posts + ' article.post.acme-ajax', function() {
            /*http://stackoverflow.com/questions/17780515/append-ajax-items-to-masonry-with-infinite-scroll*/
            paged++;/*next page number*/
            next_posts = next_posts.replace(/(\/?)page(\/|d=)[0-9]+/, '$1page$2'+ paged);
            var read_more_temp_post = $('#read-more-temp-post');
            var html = read_more_temp_post.html();
            read_more_temp_post.html('');

            // Make jQuery object from HTML string
            var $moreBlocks = $( html ).filter('article.post.acme-ajax');

            // Append new blocks to container
            $('#main').append($moreBlocks);

            show_more.attr("data-number", page+1);
            show_more.attr("data-click", 1);
            show_more.html(read_more_ajax.show_more)

        });
        return false;
    });

    /*auto ajax*/
    if( 'auto-ajax' == read_more_ajax.pagination_option ){
        var $window = $(window);
        var $content = $('body #content');
        $window.scroll(function() {
            var content_offset = $content.offset();
            console.log(content_offset.top);
            if(($window.scrollTop() +
                    $window.height()) > ($content.scrollTop() +
                    $content.height() + content_offset.top)) {
                $(".show-more").trigger("click");
            }
        });
    }
});