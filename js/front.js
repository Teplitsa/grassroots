jQuery(document).ready(function($){

    // Masonry for campaigns list:
    if($('body').hasClass('leyka-campaigns-home')) {

        var $masonry_container = $('#posts');
        $masonry_container.imagesLoaded(function(){
            $masonry_container.masonry({
                itemSelector: '.leyka-campaign-item',
                gutter : 0
            });
        });
    }

    // Resize all embed media iframes to fit the page width:
    var resize_embed_media = function(){

        $('iframe').each(function(){

            var $iframe = $(this),
                $parent = $iframe.parent(),
                do_resize = false;

            if($parent.hasClass('embed-content')) {
                do_resize = true;
            } else if($parent.hasClass('yandex_money_quick_code') || $parent.hasClass('leyka-embed-preview')) {
                do_resize = false;
            } else {
                
                $parent = $iframe.parents('.post-content');
                if($parent.length)
                    do_resize = true;
            }

            if(do_resize) {

                var change_ratio = 0.98*$parent.width()/$iframe.attr('width');
                $iframe.width(change_ratio*$iframe.attr('width'));
                $iframe.height(change_ratio*$iframe.attr('height'));
            }
        });
    };
    resize_embed_media(); // Initial page rendering
    $(window).resize(resize_embed_media);

    // Lightbox effect:
    var arrowsOn = function(instance, selector) {

        var $arrows = $('<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left"></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right"></button>');

        $arrows.appendTo('body');

        $arrows.on('click touchend', function(e){
            e.preventDefault();

            var $this = $(this),
                $target = $(selector+'[href="'+$('#imagelightbox').attr('src')+'"]'),
                index = $target.index(selector);

            if($this.hasClass('imagelightbox-arrow-left')) {
                index = index - 1;
                if( !$(selector).eq(index).length )
                    index = $(selector).length;
            } else {
                index = index + 1;
                if( !$(selector).eq(index).length )
                    index = 0;
            }

            instance.switchImageLightbox(index);
            return false;
        });
    };

    var arrowsOff = function() {
        $('.imagelightbox-arrow').remove();
    };

    var overlayOn = function() {
        $('<div id="imagelightbox-overlay"></div>').appendTo('body');
    };

    var overlayOff = function() {
        $('#imagelightbox-overlay').remove();
    };

    var activityIndicatorOn = function() {
        $('<div id="imagelightbox-loading"><div></div></div>').appendTo('body');
    };

    var activityIndicatorOff = function() {
        $('#imagelightbox-loading').remove();
    };


    $('.wp-caption').each(function(index){

        var $this = $(this),
            selector = '.wp-caption:eq('+index+') a[data-imagelightbox]',
            instance = $(selector).imageLightbox({
                animationSpeed: 150,
                onStart: function(){
                    overlayOn();
                },
                onEnd: function(){
                    overlayOff();
                    activityIndicatorOff();
                },
                onLoadStart: function(){
                    activityIndicatorOn();
                },
                onLoadEnd: function(){
                    activityIndicatorOff();
                }
            });
    });

    $('.grt-gallery').each(function(index){

        var $this = $(this),
            selector = '.grt-gallery:eq('+index+') a[data-imagelightbox]',
            instance = $(selector).imageLightbox({
                animationSpeed: 150,
                onStart: function(){
                    overlayOn();
                    arrowsOn(instance, selector);
                },
                onEnd: function(){
                    overlayOff();
                    arrowsOff();
                    activityIndicatorOff();
                },
                onLoadStart: function(){
                    activityIndicatorOn();
                },
                onLoadEnd: function(){
                    $('.imagelightbox-arrow').css('display', 'block');
                    activityIndicatorOff();
                }
            });
    });

    $('a[data-imagelightbox]').each(function(index){

        var $this = $(this);
        if( !$this.parents('.wp-caption').length && !$this.parents('.grt-gallery').length ) {

            $('a[data-imagelightbox]:eq('+index+')').imageLightbox({ // Imagelightbox don't accept $(this) *facepalm*
                animationSpeed: 150,
                onStart: function(){
                    overlayOn();
//            arrowsOn($(this), '');
                },
                onEnd: function(){
                    overlayOff();
//            arrowsOff();
                    activityIndicatorOff();
                },
                onLoadStart: function(){
                    activityIndicatorOn();
                },
                onLoadEnd: function(){
                    $('.imagelightbox-arrow').css('display', 'block');
                    activityIndicatorOff();
                }
            });
        }
    });


    // Responsive nav:
    var navCont = $('#primary-menu-mobile');
    $('#menu-trigger').on('click', function(e){

        e.preventDefault();
        if (navCont.hasClass('toggled')) { 
            //remove
            navCont.slideUp('normal', function(){ navCont.removeClass('toggled'); });
            
        }
        else { 
            //add
            navCont.slideDown('normal', function(){ navCont.addClass('toggled'); });
            
        }
    });
});