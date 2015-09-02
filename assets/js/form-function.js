var loadFcChartTypes, bindFormElementEvents, populateDataSection, previewTheChart, validateChartForm, backToChartSettings, showEmbedCode;
window.fcwp_main.loadFcChartTypes= (function(){
	var index,optionHTML="";
	for(index in fc_chartTypes) {
		optionHTML += "<option value='"+fc_chartTypes[index].id+"'>"+fc_chartTypes[index].name+"</option>"
	}
	jQuery("#fcwp_chartType").html(optionHTML);
});

window.fcwp_main.populateDataSection = (function(element) {
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

window.fcwp_main.validateChartForm = (function() {
	return 1;
});

window.fcwp_main.previewTheChart = (function() {
	if(window.fcwp_main.validateChartForm()) {
		var fcData = {
				chartTitle : jQuery("#fcwp_chartTitle").val(),
				chartType : jQuery("#fcwp_chartType").val(),
				chartId : jQuery("#fcwp_chartId").val(),
				chartWidth : jQuery("#fcwp_chartWidth").val(),
				chartHeight : jQuery("#fcwp_chartHeight").val(),
				chartContainerId : jQuery("#fcwp_chartContainerId").val(),
				chartDataType : jQuery("#fcwp_chartDataType").val(),
				chartData : jQuery("#fcwp_data").val(),
				filePath : window.fcwp_main.fcwp_pluginPath
			};
		jQuery.ajax({
			url : window.fcwp_main.fcwp_pluginPath+"fusioncharts.php",
			data : fcData,
			type: "POST",
			success: function(returnData) {
				window.fcwp_main.fcwp_embedChartCode = returnData;
				returnData = "<!DOCTYPE html><html><head></head><body>"+returnData+"</body></html>";
				jQuery("#fcwp_preview object").attr('data',"data:text/html;charset=utf-8,"+escape(returnData));
				jQuery("#fcwp_step1").fadeOut(function(){
					jQuery("#fcwp_preview").fadeIn();
				});
			}
		});	
	}
});

window.fcwp_main.showEmbedCode = (function() {
	jQuery("#fcwp_embedCode").text(window.fcwp_main.fcwp_embedChartCode);
	jQuery("#fcwp_preview").fadeOut(function() {
		jQuery("#fcwp_code").fadeIn();	
	});
});

window.fcwp_main.backToChartSettings = (function() {
	jQuery("#fcwp_preview").fadeOut(function(){
		jQuery("#fcwp_step1").fadeIn();
	});
});

window.fcwp_main.bindFormElementEvents = (function() {
	jQuery("#fcwp_chartDataType").unbind('change').on('change', function(event){
		window.fcwp_main.populateDataSection(event.currentTarget);
	});
	jQuery("#fcwp_previewButton").unbind('click').on('click', function(event){
		window.fcwp_main.previewTheChart();
	});
	jQuery("#fcwp_chartSettingsButton").unbind('click').on('click', function(){
		window.fcwp_main.backToChartSettings();
	});
	jQuery("#fcwp_embedChartButton").unbind('click').on('click', function() {
		window.fcwp_main.showEmbedCode();
	});
})

