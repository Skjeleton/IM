var index = 0;

function countRows(){
	return $("#tContainer tr").length;
}
function append(content){
	$("#tContainer").append(content);
}

function addRow(content){
	return "<tr id='row"+index+"' >" + content + "</tr>";
}

function addCell(content = ""){
	return "<td>" + content + "</td>";
}

function addCells(rowNo){
	var toAppend = "";
	
	var content = "";
	
	toAppend += addCell("<textarea class='TextArea'></textarea>");
	for( i = 1; i < 4; i++){
		content = "<input type='text' />";
		toAppend += addCell(content);
	}
	toAppend += addCell("");
	toAppend += addCell("<button type='button'>-</button>");
	toAppend += "<input type='hidden'/>";
	return toAppend;
}

function addTransaction(){
	var toAppend = addCells(countRows());
	
	toAppend = addRow(toAppend);
	append(toAppend);
}

function addTableInputId(){
	$("#tContainer tr").each(function(indexi){
		$(this).find("textarea, input").each(function(indexj){
			//alert();
			$(this).attr("name", "tData_"+indexi+"_"+indexj);
		});
		$(this).find("input:hidden").attr("name", "tData_"+indexi+"_id");
	});
	return true;
	//return false;
}

$(document).ready(function(){
	index = countRows();
	$("#addInvoice").click(addTransaction);
	
	$("#tContainer").on("click", "button", function(){
		$(this).parent().parent().remove();
	});
	
	$("#mainForm").submit(addTableInputId);
});