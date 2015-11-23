jQuery(document).ready(function() {
	jQuery('.campaigncontainer .campaigncontent:nth-child(4n)').addClass('last-campaign');
	if (jQuery('.ign-days-left').length > 0) {
		jQuery.each(jQuery('.ign-days-left'), function() {
			if (jQuery(this).children().text().length <= 0) {
				jQuery(this).siblings('.ign-progress-raised').css('border-right', 'none');
			}
		});
	}
		
	// Search Form - show/hide
	jQuery('a.search').click(function() {
		jQuery('#header-search.search-form').fadeToggle();
		jQuery('a.search').hide();
		jQuery('a.search-close').show();
	}); // Search Form 
	
	jQuery('a.search-close').click(function() {
		jQuery('#header-search.search-form').fadeToggle();
		jQuery('a.search').show();
		jQuery('a.search-close').hide();
	}); // Search Form 
	
	jQuery( '.menu-toggle').click(function(e) {
		e.preventDefault();
		jQuery( '#menu-header').slideToggle();
	});
	
	jQuery( '#ign-share-button a').click(function(e) {
		e.preventDefault();
		jQuery( '#ign-hDeck-social').slideToggle();
	});
	
	jQuery('.idc_lightbox').attr('id', 'stellar_lightbox');

	// Smooth Scroll to Top
	jQuery('a.totop').click(function(){
	    jQuery('html, body').animate({
	        scrollTop: jQuery( jQuery(this).attr('href') ).offset().top
	    }, 500);
	    return false;
		
	});
	
	jQuery(window).on("hashchange", function () {
	    window.scrollTo(window.scrollX, window.scrollY - 100);
	}); // smooth scroll


});