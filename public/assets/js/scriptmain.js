

 
    /*
Author       : Dreamguys
Template Name: Kanakku - Bootstrap Admin Template
Version      : 1.0
*/

(function($) {
    "use strict";
	
	// Variables declarations
	
	var $wrapper = $('.main-wrapper');
	var $pageWrapper = $('.page-wrapper');
	var $slimScrolls = $('.slimscroll');
	
	// Sidebar
	// var Sidemenu = function () {
	// 	this.$menuItem = $('#sidebar-menu a');
	// };


   	// Country Code Selection
       if($('#mobile_code2').length > 0) {
		$( '#mobile_code2' ).intlTelInput( {
			initialCountry: "in",
			separateDialCode: true,	
		});
	}



})(jQuery);