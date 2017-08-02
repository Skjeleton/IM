function updateConfig(configKey){
	var currentValue = $("#" + configKey).val();
	var refUrl = rootLocation + "index.php/config_controller/config_edit/" + userId;
	var config = {};
	config[configKey] = currentValue;
	$.ajax({
        type        : 'POST', 
	    url         : refUrl,
	    data        : config,
	    dataType    : 'text'
	})/*.done(function(data) {
		
	})/**/;
}