jQuery(document).ready(function(){
	
	var displayForm = (function() {
			if(!jQuery("#fcwp_popupDiv").length) {
				var formHTML = jQuery("#fcwp_formTemplate").html();
				jQuery('html,body').append(formHTML);	
			}
			bindEvents();
			window.fcwp_main.loadFcChartTypes();
			window.fcwp_main.bindFormElementEvents();
			loadPopupBox();
		}),
		unloadPopupBox = (function () {    // TO Unload the Popupbox
	        jQuery('#fcwp_popupDiv').fadeOut("slow");
	        jQuery("#fcwp_container").css({ // this is just for style        
	            "opacity": "1"  
	        }); 
	    }),
	    bindEvents = (function(){
			jQuery('#fcwp_popupBoxClose').unbind('click').on('click', function() {
		        unloadPopupBox();
		    });
		    
		    jQuery('#fcwp_container').unbind('click').on('click', function() {
		        unloadPopupBox();
		    });    	
	    }),    
        loadPopupBox = (function() {    // To Load the Popupbox
	        jQuery('#fcwp_popupDiv').fadeIn("slow");
	        jQuery("#fcwp_container").css({ // this is just for style
	            "opacity": "0.3"  
	        });         
	    });

	jQuery("#fcwp_button").unbind('click').on('click', function(){
		displayForm();
	});
});


 