var loadFcChartTypes, bindFormElementEvents, populateDataSection;

loadFcChartTypes= (function(){
	var index,optionHTML="";
	for(index in fc_chartTypes) {
		optionHTML += "<option value='"+fc_chartTypes[index].id+"'>"+fc_chartTypes[index].name+"</option>"
	}
	jQuery("#fcwp_chartType").html(optionHTML);
});

populateDataSection = (function(element) {
	var value = jQuery.trim(jQuery(element).val());
	if(value != "") {
		switch(value) {
			case "json":
				if(jQuery("#fcwp_data").length)jQuery("#fcwp_data").remove();
				jQuery('<textarea id="fcwp_data" data-type="json">[{"label":"Bakersfield Central","value":"880000"},{"label":"Garden Groove harbour","value":"730000"},{"label":"Los Angeles Topanga","value":"590000"},{"label":"Compton-Rancho Dom","value":"520000"},{"label":"Daly City Serramonte","value":"330000"}]</textarea>').insertAfter( jQuery(element) );
			break;
			case "xml":
				if(jQuery("#fcwp_data").length)jQuery("#fcwp_data").remove();
				jQuery('<textarea id="fcwp_data" data-type="xml"></textarea>').insertAfter( jQuery(element) );
			break;
		}
	} else {
		if(jQuery("#fcwp_data").length)jQuery("#fcwp_data").remove();
	}
});

bindFormElementEvents = (function() {
	jQuery("#fcwp_chartDataType").unbind('change').on('change', function(event){
		populateDataSection(event.currentTarget);
	})
})

