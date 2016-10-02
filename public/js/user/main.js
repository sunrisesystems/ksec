/*
	Author Name: Imran Shaikh
	Author Url: http://www.iwebkreative.com
	Designation: Frontend UI Developer	
	Description: iwebkreative develop responsive website using latest technology, maintain wordpress website, create custom wordpress theme, build static & dynamic website using content management system, help to convert website from psd to html & psd to responsive mobile friendly website.
	
	Theme Introduction: This is custom theme created by http://www.iwebkreative.com.
*/
/* document ready */

$(window).load(function () {
    if ($('.preloader').length > 0) {
        $('.preloader').delay(800).fadeOut('slow');
    }
});
jQuery(document).ready(function(){
	// jquery take height from header and add padding top to body
	//jQuery('.has-fixed-footer').css('padding-top', jQuery('.sticky-navigation').outerHeight()+"px");
});
jQuery(document).ready(function($) {
    "use strict";
     var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };
    $(window).scroll(function() {
            if ( $(this).scrollTop() > 800 ) {
                $('.go-top').addClass('show');
            } else {
                $('.go-top').removeClass('show');
            }
        }); 

        $('.go-top').on('click', function() {            
            $("html, body").animate({ scrollTop: 0 }, 1000 , 'easeInOutExpo');
            return false;
        });
    /*---------------------------------------*/
    /*	BOOTSTRAP FIXES
	/*---------------------------------------*/
    var oldSSB = jQuery.fn.modal.Constructor.prototype.setScrollbar;
    $.fn.modal.Constructor.prototype.setScrollbar = function() {
        oldSSB.apply(this);
        if (this.scrollbarWidth) jQuery('.navbar-fixed-top').css('padding-right', this.scrollbarWidth);
    }
    var oldRSB = $.fn.modal.Constructor.prototype.resetScrollbar;
    $.fn.modal.Constructor.prototype.resetScrollbar = function() {
        oldRSB.apply(this);
        jQuery('.navbar-fixed-top').css('padding-right', '');
    }
    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
        var msViewportStyle = document.createElement('style')
        msViewportStyle.appendChild(
            document.createTextNode(
                '@-ms-viewport{width:auto!important}'
            )
        )
        document.querySelector('head').appendChild(msViewportStyle)
    }
});

/*=================================
===  SMOOTH SCROLL NAVIGATION     ====
=================================== */
jQuery(document).ready(function(){
  jQuery('#menu-primary a[href*=#]:not([href=#]), .banners a.arrow[href*=#]:not([href=#])').click('click',function () {
    var headerHeight;
    var hash    = this.hash;
    var idName  = hash.substring(1);    // get id name
    var alink   = this;                 // this button pressed
    // check if there is a section that had same id as the button pressed
    if ( jQuery('section [id*=' + idName + ']').length > 0 && jQuery(window).innerWidth() >= 767 ){
      jQuery('.current').removeClass('current');
      jQuery(alink).parent('li').addClass('current');
    }else{
      jQuery('.current').removeClass('current');
    }
    if ( jQuery(window).innerWidth() >= 767 ) {
      headerHeight =  0 //jQuery('.sticky-navigation').outerHeight();
    } else {
      headerHeight = 0;
    }
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = jQuery(this.hash);
      target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        jQuery('html,body').animate({
          scrollTop: target.offset().top - headerHeight + 10
        }, 1200);
        return false;
      }
    }
  });
    
    
    /*jQuery("#inpage_scroll_btn").click(function(event) {
        var anchor = jQuery('#inpage_scroll_btn').attr('data-anchor');
        var offset = -60;
        jQuery('html, body').animate({
            scrollTop: jQuery(anchor).offset().top + offset
        }, 1200);
    });*/
});

/* TOP NAVIGATION MENU SELECTED ITEMS */
function scrolled() {

    if ( jQuery(window).width() >= 751 ) {
        var prallax_one_scrollTop = jQuery(window).scrollTop();       // cursor position
        var headerHeight = jQuery('.sticky-navigation').outerHeight();   // header height
        var isInOneSection = 'no';                              // used for checking if the cursor is in one section or not
        // for all sections check if the cursor is inside a section
        jQuery("section").each( function() {
            var thisID = '#' + jQuery(this).attr('id');           // section id
            var parallax_one_offset = jQuery(this).offset().top;         // distance between top and our section
            var thisHeight  = jQuery(this).outerHeight();         // section height
            var thisBegin   = parallax_one_offset - headerHeight;                      // where the section begins
            var thisEnd     = parallax_one_offset + thisHeight - headerHeight;         // where the section ends  
            // if position of the cursor is inside of the this section
            if ( prallax_one_scrollTop >= thisBegin && prallax_one_scrollTop <= thisEnd ) {
                isInOneSection = 'yes';
                jQuery('.current').removeClass('current');
                jQuery('#menu-primary a[href$="' + thisID + '"]').parent('li').addClass('current');    // find the menu button with the same ID section
                return false;
            }
            if (isInOneSection == 'no') {
                jQuery('.current').removeClass('current');
            }
        });
    }

}

var timer;
jQuery(window).scroll(function(){
    if ( timer ) clearTimeout(timer);
    timer = setTimeout(function(){
        scrolled();
    }, 500);

});
jQuery(document).ready(function() {
	var bannerSlides = jQuery(".home-page-slider");
	
	
	bannerSlides.owlCarousel({
        pagination : false,
		navigation : false, // Show next and prev buttons
		slideSpeed : 300,
		paginationSpeed : 400,
		transitionStyle : "fade",
		singleItem:true
     
		// "singleItem:true" is a shortcut for:
		// items : 1, 
		// itemsDesktop : false,
		// itemsDesktopSmall : false,
		// itemsTablet: false,
		// itemsMobile : false
     
	});
     
});