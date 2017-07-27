function fetchCustomerForm(){
	var data = [];
	$("#customerAddModal input, textarea").each(function(index){
		var name = $(this).attr("name");
		var value = $(this).val();
		if(name == "Submit") return 0;
		var obj = {};
		obj[name] = value;
		data.push(obj);
	});
	return data;
}

function phpAddCustomer(){
	var formData = fetchCustomerForm();
	var refUrl = rootLocation + "index.php/customer_controller/customer_add/1";
	$.ajax({
        type        : 'POST', 
	    url         : refUrl,
	    data        : {data: formData},
	    dataType    : 'text'
	}).done(function(data) {
		var customer = JSON.parse(data);
		$("#mainForm select").append($('<option>', {
		    value: customer["id"],
		    text: customer["name"]
		}));
		$("#mainForm select").val(customer["id"]);
		
		console.log();
    });
	
	$("#customerAddModal").modal("toggle");
	return false;
}

$(document).ready(function(){
	$("#customerAddModal").submit(phpAddCustomer);
});