


(function($, document, window, undefined) {

    'use strict';

    var slideAndSwipe_megamenu =

        $.fn.slideAndSwipe_megamenu = function(options) {

            var nav = $(this); // get the element to swipe
            var navWidth = -nav.outerWidth();
            var transInitial = navWidth;

            // get settings
            var settings = $.extend({
                triggerOnTouchEnd   : true,
                swipeStatus         : swipeStatus,
                allowPageScroll     : 'vertical',
                threshold           : 100,
                excludedElements    : 'label, button, input, select, textarea, .noSwipe',
                speed               : 250

            }, options );

            nav.swipe(settings);

            /**
             * Catch each phase of the swipe.
             * move : we drag the navigation
             * cancel : open navigation
             * end : close navigation
             */
            function swipeStatus(event, phase, direction, distance) {
                if(phase == 'start') {
                    if(nav.hasClass('ssm-nav-visible')) {
                        transInitial = 0;
                    } else {
                        transInitial = navWidth;
                    }
                }
                var mDistance;

                if (phase == 'move' && (direction == 'left')) {
                    if(transInitial < 0) {

                        mDistance = transInitial - distance;
                    } else {
                        mDistance = -distance;
                    }

                    scrollNav(mDistance, 0);

                } else if (phase == 'move' && direction == 'right') {
                    if(transInitial < 0) {
                        mDistance = transInitial + distance;
                    } else {
                        mDistance = distance;
                    }
                    scrollNav(mDistance, 0);
                } else if (phase == 'cancel' && (direction == 'left') && transInitial === 0) {
                    scrollNav(0, settings.speed);
                } else if (phase == 'end' && (direction == 'left')) {

                       hideNavigation();
                } else if ((phase == 'end' || phase == 'cancel') && (direction == 'right')) {
                    console.log('end');
                }
            }

            /**
             * Browser detect
             */
            function isSafari() {
                return /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);
            }

            function isChrome() {
                return /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
            }

            /**
             * Manually update the position of the nav on drag
             */
            function scrollNav(distance, duration) {
                nav.css('transition-duration', (duration / 1000).toFixed(1) + 's');

                if(distance >= 0) {
                    distance = 0;
                }
                if(distance <= navWidth) {
                    distance = navWidth;
                }
                if(isSafari() || isChrome()) {
                   nav.css('-webkit-transform', 'translate(' + distance + 'px,0)');
                }
                else{
                   nav.css('transform', 'translate(' + distance + 'px,0)');
                }
                if(distance == '0') {
                   /* $('#show-megamenu').addClass('ssm-nav-visible');
                    $('html').addClass('is-navOpen');
                    $('.ssm-overlay').fadeIn();	
                    $('#SHOW_FILTER_BTN').addClass('ssm-nav-visible'); */
                    $('html').addClass('is-navOpen');
                    $('.ssm-overlay').fadeIn();  
	

                }
                
            }

            /**
             * Open / close by click on burger icon
             */
            var hideNavigation = (function() {
                nav.removeClass('ssm-nav-visible');
                scrollNav(navWidth, settings.speed);
                $('html').removeClass('is-navOpen');
                $('.ssm-overlay').fadeOut();
            });

            var showNavigation = (function() {
                nav.addClass('ssm-nav-visible');
                scrollNav(0, settings.speed);
            });
	
              $('#show-megamenu').click(function(e) {
                                
                if(nav.hasClass('ssm-nav-visible')) {
                    hideNavigation();
                }
                else{
                    showNavigation();
   		    $("#MOBILE_FILTER_REGION").hide();
                    $("#MEGA_MENU_REGION").show();
                }
                e.preventDefault();
                 
            }); 

	   $('#show-megamenu1').click(function(e) {
                                
                if(nav.hasClass('ssm-nav-visible')) {
                    hideNavigation();
                }
                else{
                    showNavigation();
   		    $("#MOBILE_FILTER_REGION").hide();
                    $("#MEGA_MENU_REGION").show();
                }
                e.preventDefault();
                 
            });   
  
                
                // $('#SHOW_FILTER_BTN').click(function(e) {
                //  alert('hello web come buy product hc_homcenter');
                
                // if(nav.hasClass('ssm-nav-visible')) {
                //     hideNavigation();
                // }
                // else{
                //     showNavigation();
                //     $("#MEGA_MENU_REGION").hide();
                // }
                // e.preventDefault();
                 
            // });  


                 
           $('.ssm-toggle-nav, #remove-megamenu').click(function(e) {
                
                
               
                  hideNavigation();
               
               
                e.preventDefault();
                 
            });

       }
    ;
     var slideAndSwipe_filter =

        $.fn.slideAndSwipe_filter = function(options) {

            var nav = $(this); // get the element to swipe
            var navWidth = -nav.outerWidth();
            var transInitial = navWidth;

            // get settings
            var settings = $.extend({
                triggerOnTouchEnd   : true,
                swipeStatus         : swipeStatus,
                allowPageScroll     : 'vertical',
                threshold           : 100,
                excludedElements    : 'label, button, input, select, textarea, .noSwipe',
                speed               : 250

            }, options );

            nav.swipe(settings);
           
            function swipeStatus(event, phase, direction, distance) {
                if(phase == 'start') {
                    if(nav.hasClass('ssm-nav-visible')) {
                        transInitial = 0;
                    } else {
                        transInitial = navWidth;
                    }
                }
                var mDistance;

                if (phase == 'move' && (direction == 'left')) {
                    if(transInitial < 0) {

                        mDistance = transInitial - distance;
                    } else {
                        mDistance = -distance;
                    }

                    scrollNav(mDistance, 0);

                } else if (phase == 'move' && direction == 'right') {
                    if(transInitial < 0) {
                        mDistance = transInitial + distance;
                    } else {
                        mDistance = distance;
                    }
                    scrollNav(mDistance, 0);
                } else if (phase == 'cancel' && (direction == 'left') && transInitial === 0) {
                    scrollNav(0, settings.speed);
                } else if (phase == 'end' && (direction == 'left')) {

                       hideNavigation();
                } else if ((phase == 'end' || phase == 'cancel') && (direction == 'right')) {
                    console.log('end');
                }
            }

            /**
             * Browser detect
             */
            function isSafari() {
                return /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);
            }

            function isChrome() {
                return /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
            }

            /**
             * Manually update the position of the nav on drag
             */
            function scrollNav(distance, duration) {
                nav.css('transition-duration', (duration / 1000).toFixed(1) + 's');

                if(distance >= 0) {
                    distance = 0;
                }
                if(distance <= navWidth) {
                    distance = navWidth;
                }
                if(isSafari() || isChrome()) {
                   nav.css('-webkit-transform', 'translate(' + distance + 'px,0)');
                }
                else{
                   nav.css('transform', 'translate(' + distance + 'px,0)');
                }
                if(distance == '0') {
                   /* $('#show-megamenu').addClass('ssm-nav-visible');
                    $('html').addClass('is-navOpen');
                    $('.ssm-overlay').fadeIn(); 
                    $('#SHOW_FILTER_BTN').addClass('ssm-nav-visible'); */
                    $('html').addClass('is-navOpen');
                    $('.ssm-overlay').fadeIn();  
    

                }
                
            }

            /**
             * Open / close by click on burger icon
             */
            var hideNavigation = (function() {
                nav.removeClass('ssm-nav-visible');
                scrollNav(navWidth, settings.speed);
                $('html').removeClass('is-navOpen');
                $('.ssm-overlay').fadeOut();
            });

            var showNavigation = (function() {
                nav.addClass('ssm-nav-visible');
                scrollNav(0, settings.speed);
            });
    
                            
                // $('#SHOW_FILTER_BTN').click(function(e) {
                 // alert('hello web come buy product hc_homcenter');
                
                if(nav.hasClass('ssm-nav-visible')) {
                    hideNavigation();
                }
                else{
                    showNavigation();
                    $("#MEGA_MENU_REGION").hide();
                    $("#MOBILE_FILTER_REGION").show();
                }
                // e.preventDefault();
                 
            // });  

           $('.ssm-toggle-nav').click(function(e) {
                               
                  hideNavigation();             
                e.preventDefault();
                 
            });

       }
    ;
    var slideAndSwipe_vertical =

        $.fn.slideAndSwipe_vertical = function(options) {

            var nav = $(this); // get the element to swipe
            var navWidth = -nav.outerWidth();
            var transInitial = navWidth;

            // get settings
            var settings = $.extend({
                triggerOnTouchEnd   : true,
                swipeStatus         : swipeStatus,
                allowPageScroll     : 'vertical',
                threshold           : 100,
                excludedElements    : 'label, button, input, select, textarea, .noSwipe',
                speed               : 250

            }, options );

            nav.swipe(settings);

            /**
             * Catch each phase of the swipe.
             * move : we drag the navigation
             * cancel : open navigation
             * end : close navigation
             */
            function swipeStatus(event, phase, direction, distance) {
                if(phase == 'start') {
                    if(nav.hasClass('ssm-nav-visible')) {
                        transInitial = 0;
                    } else {
                        transInitial = navWidth;
                    }
                }
                var mDistance;

                if (phase == 'move' && (direction == 'left')) {
                    if(transInitial < 0) {

                        mDistance = transInitial - distance;
                    } else {
                        mDistance = -distance;
                    }

                    scrollNav(mDistance, 0);

                } else if (phase == 'move' && direction == 'right') {
                    if(transInitial < 0) {
                        mDistance = transInitial + distance;
                    } else {
                        mDistance = distance;
                    }
                    scrollNav(mDistance, 0);
                } else if (phase == 'cancel' && (direction == 'left') && transInitial === 0) {
                    scrollNav(0, settings.speed);
                } else if (phase == 'end' && (direction == 'left')) {

                       hideNavigation();
                } else if ((phase == 'end' || phase == 'cancel') && (direction == 'right')) {
                    console.log('end');
                }
            }

            /**
             * Browser detect
             */
            function isSafari() {
                return /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);
            }

            function isChrome() {
                return /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
            }

            /**
             * Manually update the position of the nav on drag
             */
            function scrollNav(distance, duration) {
                nav.css('transition-duration', (duration / 1000).toFixed(1) + 's');

                if(distance >= 0) {
                    distance = 0;
                }
                if(distance <= navWidth) {
                    distance = navWidth;
                }
                if(isSafari() || isChrome()) {
                   nav.css('-webkit-transform', 'translate(' + distance + 'px,0)');
                }
                else{
                   nav.css('transform', 'translate(' + distance + 'px,0)');
                }
                if(distance == '0') {
                    $('#show-verticalmenu').addClass('ssm-nav-visible');
                    $('html').addClass('is-navOpen');
                    $('.ssm-overlay').fadeIn();
                }
                
            }

            /**
             * Open / close by click on burger icon
             */
            var hideNavigation = (function() {
                nav.removeClass('ssm-nav-visible');
                scrollNav(navWidth, settings.speed);
                $('html').removeClass('is-navOpen');
                $('.ssm-overlay').fadeOut();
            });

            var showNavigation = (function() {
                nav.addClass('ssm-nav-visible');
                scrollNav(0, settings.speed);
            });

            $('#show-verticalmenu').click(function(e) {
                
                
                if(nav.hasClass('ssm-nav-visible')) {
                    hideNavigation();
                }
                else{
                    showNavigation();

                }
                e.preventDefault();
                 
            });
            $('.ssm-toggle-nav, #remove-verticalmenu').click(function(e) {
                
                
               
                  hideNavigation();
               
               
                e.preventDefault();
                 
            });
                        
        }
    ;
})(window.jQuery || window.$, document, window);



/*
 * Export as a CommonJS module
 */
if (typeof module !== 'undefined' && module.exports) {
    module.exports = slideAndSwipe;
}
