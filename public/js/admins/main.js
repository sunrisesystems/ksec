/*!
 * Developer: Imran Shaikh
 * http://www.iwebkreative.com/
 *
 * 
 * Date: 2015-09-12
 */
 
$(function(){
	'use strict';
	
    // Preloader
    $(window).load(function() {
        $('#preloader').fadeOut(800); // will first fade out the loading animation
        $('#background-loader').delay(800).fadeOut(800); // will fade out the white DIV that covers the website.
        $('body').delay(800).css({'overflow':'visible'});
    });
	
	// Add body-small class if window less than 768px
    if ($(this).width() < 769) {
        $('body').addClass('body-small')
    } else {
        $('body').removeClass('body-small')
    }
	
	// Minimalize menu when screen is less than 768px
	$(window).bind("resize", function () {
		if ($(this).width() < 769) {
			$('body').addClass('body-small')
		} else {
			$('body').removeClass('body-small')
		}
	});
	
	// MetsiMenu
    $('#side-menu').metisMenu();
	
	$( ".datePicker" ).datepicker({
		dateFormat: 'mm-yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '1900:2050',

        onClose: function(dateText, inst) {  
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val(); 
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val(); 
            $(this).val($.datepicker.formatDate('mm-yy', new Date(year, month, 1)));
        }
    });
	
	

    $(".datePicker").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center bottom",
            at: "center bottom",
            of: $(this)
        });    
    });
		
	
	
	
	function SmoothlyMenu() {
    if (!$('body').hasClass('mini-navbar') || $('body').hasClass('body-small')) {
        // Hide menu in order to smoothly turn on when maximize menu
        $('#side-menu').hide();
        // For smoothly turn on menu
        setTimeout(
            function () {
                $('#side-menu').fadeIn(500);
            }, 100);
    } else if ($('body').hasClass('fixed-sidebar')) {
        $('#side-menu').hide();
        setTimeout(
            function () {
                $('#side-menu').fadeIn(500);
            }, 300);
    } else {
        // Remove all inline style from jquery fadeIn function to reset menu state
        $('#side-menu').removeAttr('style');
    }
}
	$(":file").filestyle({buttonText: " Browse"});
	// tooltip code
	$('[data-toggle="tooltip"]').tooltip();
	// Close menu in canvas mode
     // Minimalize menu
    $('.navbar-minimalize').click(function () {
        $("body").toggleClass("mini-navbar");
        SmoothlyMenu();

    });
	// Fixed Sidebar
    $(window).bind("load", function () {
        if ($("body").hasClass('fixed-sidebar')) {
            $('.sidebar-collapse').slimScroll({
                height: '100%',
                railOpacity: 0.9
            });
        }
    });
	
	 // // Full height of sidebar
  //   function fix_height() {
  //       var heightWithoutNavbar = $("body > #wrapper").height() - 61;
  //       $(".sidebard-panel").css("min-height", heightWithoutNavbar + "px");

  //       var navbarHeigh = $('nav.navbar-default').height();
  //       var wrapperHeigh = $('#page-wrapper').height();

  //       if (navbarHeigh > wrapperHeigh) {
  //           $('#page-wrapper').css("min-height", navbarHeigh + "px");
  //       }

  //       if (navbarHeigh < wrapperHeigh) {
  //           $('#page-wrapper').css("min-height", $(window).height() + "px");
  //       }

  //       if ($('body').hasClass('fixed-nav')) {
  //           $('#page-wrapper').css("min-height", $(window).height() - 60 + "px");
  //       }

  //   }

  //   fix_height();
	
	/**
	  * NAME: Bootstrap 3 Triple Nested Sub-Menus
	  * This script will active Triple level multi drop-down menus in Bootstrap 3.*
	*/
	$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
		// Avoid following the href location when clicking
		event.preventDefault(); 
		// Avoid having the menu to close when clicking
		event.stopPropagation(); 
		// Re-add .open to parent sub-menu item
		$(this).parent().addClass('open');
		$(this).parent().find("ul").parent().find("li.dropdown").addClass('open');
	});
	
	$('.search-filter').click(function(){
		$('.searchForm').slideDown('slowly');
		$('.close-filter').fadeIn('slowly');		
	});
	$('.close-filter').click(function(){
		$(this).fadeOut('slowly');
		$('.searchForm').slideUp('slowly');		
	})
	
	
    

});

function validateDatetime(txtDate){
    var currVal = txtDate;
    if(currVal == '')
        return false;
  
    //Declare Regex  
    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})(\s)(\d{1,2})(:)(\d{1,2})$/; 
    var dtArray = currVal.match(rxDatePattern); // is format OK?
    if (dtArray == null)
        return false;

    //Checks for d-m-Y format.
    dtDay= dtArray[1];
    dtMonth = dtArray[3];
    dtYear = dtArray[5];
    dtHour = dtArray[7];
    dtMinute = dtArray[9];

    if (dtMonth < 1 || dtMonth > 12)
        return false;
    else if (dtDay < 1 || dtDay> 31)
        return false;
    else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31)
        return false;
    else if (dtMonth == 2)
    {
        var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
        if (dtDay> 29 || (dtDay ==29 && !isleap))
            return false;
    }else if(dtHour < 0 || dtHour > 23 )
        return false;
    else if (dtMinute < 0 || dtMinute > 59)
        return false;
    return true;
}

function validateYesterdaysDate(datetime){
    var currVal = datetime;
    if(currVal == '')
        return false;
  
    //Declare Regex  
    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})(\s)(\d{1,2})(:)(\d{1,2})$/; 
    var dtArray = currVal.match(rxDatePattern); // is format OK?
    if (dtArray == null)
        return false;

    //Checks for d-m-Y format.
    dtDay= dtArray[1];
    dtMonth = dtArray[3];
    dtYear = dtArray[5];
    dtHour = dtArray[7];
    dtMinute = dtArray[9];

    var givenDate = new Date(dtYear, dtMonth - 1, dtDay, dtHour, dtMinute, 0);
    var date =  new Date();
    var previousDate =  new Date(date.getFullYear(),date.getMonth(),date.getDate(),0,0,0);
    previousDate.setDate(previousDate.getDate()-1);
    if(givenDate < previousDate){
        return false;
    }
    return true;
}

function checkDateTimeWithShiftTime (inputDateTime,startDateTime,endDateTime) {
    console.log("input date "+inputDateTime);
    console.log("start date "+startDateTime);
    console.log("end date "+endDateTime);
    var currVal = inputDateTime;
    if(currVal == '')
        return false;
  
    //Declare Regex  
    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})(\s)(\d{1,2})(:)(\d{1,2})$/; 
    var dtArray = currVal.match(rxDatePattern); // is format OK?
    if (dtArray == null)
        return false;

    var stArray = startDateTime.match(rxDatePattern); // is format OK?
    if (stArray == null)
        return false;

    var etArray = endDateTime.match(rxDatePattern); // is format OK?
    if (etArray == null)
        return false;

    //Checks for d-m-Y format.
    dtDay= dtArray[1];
    dtMonth = dtArray[3];
    dtYear = dtArray[5];
    dtHour = dtArray[7];
    dtMinute = dtArray[9];

    var givenDate = new Date(dtArray[5], dtArray[3] - 1, dtArray[1], dtArray[7], dtArray[9], 0);
    var stDate = new Date(stArray[5], stArray[3] - 1, stArray[1], stArray[7], stArray[9], 0);
    var etDate = new Date(etArray[5], etArray[3] - 1, etArray[1], etArray[7], etArray[9], 0);
   /* var date =  new Date();
    var previousDate =  new Date(date.getFullYear(),date.getMonth(),date.getDate(),0,0,0);
    previousDate.setDate(previousDate.getDate()-1);*/
    if(givenDate >= stDate && givenDate <= etDate){
        return true;
    }
    return false;   
}

function compareTwoDates (startDate,endDate) {
    if(startDate == '')
        return false;

    if(endDate == '')
        return false;
  
    //Declare Regex  
    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; 
    var stArray = startDate.match(rxDatePattern); // is format OK?
    if (stArray == null)
        return false;

    var etArray = endDate.match(rxDatePattern); // is format OK?
    if (etArray == null)
        return false;

    var stDate = new Date(stArray[5], stArray[3] - 1, stArray[1]);
    var etDate = new Date(etArray[5], etArray[3] - 1, etArray[1]);
    if(etDate < stDate){
        return false;
    }
    return true;  
}

function compareStartTimeEndTime (startDateTime,endDateTime) {
     if(startDateTime == '')
        return false;

    if(endDateTime == '')
        return false;
  
    //Declare Regex  
    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})(\s)(\d{1,2})(:)(\d{1,2})$/; 
    var stArray = startDateTime.match(rxDatePattern); // is format OK?
    if (stArray == null)
        return false;

    var etArray = endDateTime.match(rxDatePattern); // is format OK?
    if (etArray == null)
        return false;

    var stDate = new Date(stArray[5], stArray[3] - 1, stArray[1], stArray[7], stArray[9], 0);
    var etDate = new Date(etArray[5], etArray[3] - 1, etArray[1], etArray[7], etArray[9], 0);

    if(etDate < stDate){
        return false;
    }
    return true; 
}