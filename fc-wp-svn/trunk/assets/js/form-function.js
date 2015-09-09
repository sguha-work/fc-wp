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
				jQuery("p",jQuery(element).parent()[0]).css({
					"display": "none"
				});
			break;

			case "xml":
				if(jQuery("#fcwp_data").length)jQuery("#fcwp_data").remove();
				jQuery('<textarea id="fcwp_data" data-type="xml"></textarea>').insertAfter( jQuery(element) );
				jQuery("p",jQuery(element).parent()[0]).css({
					"display": "none"
				});
			break;

			case "jsonurl":
				if(jQuery("#fcwp_data").length)jQuery("#fcwp_data").remove();
				jQuery('<input type="text" placeholder="Enter JSON URL here" id="fcwp_data"/>').insertAfter( jQuery(element) );
				jQuery("p",jQuery(element).parent()[0]).css({
					"display": "none"
				});
			break;

			case "xmlurl":
				if(jQuery("#fcwp_data").length)jQuery("#fcwp_data").remove();
				jQuery('<input type="text" placeholder="Enter XML URL here" id="fcwp_data"/>').insertAfter( jQuery(element) );
				jQuery("p",jQuery(element).parent()[0]).css({
					"display": "none"
				});
			break;
		}
	} else {
		if(jQuery("#fcwp_data").length){
			jQuery("#fcwp_data").remove();
			jQuery("p",jQuery(element).parent()[0]).css({
				"display": "block"
			});
		}
	}
});

window.fcwp_main.validateChartForm = (function() {
	if(jQuery.trim(jQuery("#fcwp_chartTitle").val())=="") {
		alert("Please enter chart title");
		jQuery("#fcwp_chartTitle").focus().css({
			"border" : "1px solid red"
		});
		return 0;
	} else {
		jQuery("#fcwp_chartTitle").css({
			"border" : "1px solid green"
		});
	}
	if(jQuery.trim(jQuery("#fcwp_chartType").val())=="") {
		alert("Please enter chart type");
		jQuery("#fcwp_chartType").focus().css({
			"border" : "1px solid red"
		});
		return 0;
	} else {
		jQuery("#fcwp_chartType").css({
			"border" : "1px solid green"
		});
	}
	if(jQuery.trim(jQuery("#fcwp_chartId").val())=="") {
		alert("Please enter unique chart id");
		jQuery("#fcwp_chartId").focus().css({
			"border" : "1px solid red"
		});
		return 0;
	} else {
		jQuery("#fcwp_chartId").css({
			"border" : "1px solid green"
		});
	}
	if(jQuery.trim(jQuery("#fcwp_chartWidth").val())!==""&&!isNaN(jQuery("#fcwp_chartWidth").val())) {
		jQuery("#fcwp_chartWidth").css({
			"border" : "1px solid green"
		});

	} else {
		alert("Please enter chart width in number");
		jQuery("#fcwp_chartWidth").focus().css({
			"border" : "1px solid red"
		});
		return 0;
	}
	if(jQuery.trim(jQuery("#fcwp_chartHeight").val())!==""&&!isNaN(jQuery("#fcwp_chartHeight").val())) {
		jQuery("#fcwp_chartHeight").css({
			"border" : "1px solid green"
		});
	} else {
		alert("Please enter chart height in number");
		jQuery("#fcwp_chartHeight").focus().css({
			"border" : "1px solid red"
		});
		return 0;
	}
	if(jQuery.trim(jQuery("#fcwp_chartContainerId").val())=="") {
		alert("Please enter chart container div id");
		jQuery("#fcwp_chartContainerId").focus().css({
			"border" : "1px solid red"
		});
		return 0;
	} else {
		jQuery("#fcwp_chartContainerId").css({
			"border" : "1px solid green"
		});
	}
	if(jQuery.trim(jQuery("#fcwp_chartDataType").val())=="") {
		alert("Please select chart data type");
		jQuery("#fcwp_chartDataType").focus().css({
			"border" : "1px solid red"
		});
		return 0;
	} else {
		jQuery("#fcwp_chartDataType").css({
			"border" : "1px solid green"
		});
	}
	if(jQuery.trim(jQuery("#fcwp_data").val())=="") {
		alert("Please select chart data");
		jQuery("#fcwp_data").focus().css({
			"border" : "1px solid red"
		});
		return 0;
	} else {
		jQuery("#fcwp_data").css({
			"border" : "1px solid green"
		});
	}
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
				action : 'get_chart'
			};
		if(parseInt(fcData.chartWidth)>400){
			fcData.chartWidth = 400;
		}
		if(parseInt(fcData.chartHeight)>400){
			fcData.chartWidth = 400;
		}	
		jQuery.ajax({
			url: ajaxurl,
			data: fcData,
			type: "POST",
			success: function(returnData) {
				window.fcwp_main.fcwp_embedChartCode = returnData;
				returnData = "<!DOCTYPE html><html><head></head><body>"+returnData+"</body></html>";
				jQuery("#fcwp_preview object").css({
					"width" : (parseInt(fcData.chartWidth)+25)+"px",
					"height" : (parseInt(fcData.chartHeight)+25)+"px"
				});
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
		if(jQuery(event.currentTarget).val().indexOf("url")!=-1) {
			alert("If you select JSON/XML url as data type all the previous given data for chart may be overwritten by the url's data");
		}
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
});

