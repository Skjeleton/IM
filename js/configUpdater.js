function updateConfig(configKey, json = false){
	var currentValue = $("#" + configKey).val();
	console.log(currentValue);
	if(json){
		currentValue = currentValue.split(",");
		console.log(currentValue);
		currentValue.forEach(function(value, index){
			currentValue[index] = value.trim();
		});
		console.log(currentValue);
		currentValue = JSON.stringify(currentValue);
	}
	
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