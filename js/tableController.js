function countRows(){
	return $("#tContainer tr").length;
}
function append(content){
	$("#tContainer").append(content);
}

function addRow(content){
	return "<tr>" + content + "</tr>";
}

function addCell(content = ""){
	return "<td>" + content + "</td>";
}

function addCells(rowNo){
	var toAppend = "";
	
	var content = "";
	for( i = 0; i < 4; i++){
		content = "<input type='text' name='tData_"+rowNo+"_"+i+"' />";
		toAppend += addCell(content);
	}
	for( i = 0; i < 2; i++){
		content = "";
		toAppend += addCell(content);
	}
	return toAppend;
}

function addTransaction(){
	var toAppend = addCells(countRows());
	
	toAppend = addRow(toAppend);
	append(toAppend);
}

function removeTransaction(){
	$("#tContainer tr:nth-child("+(countRows())+")").remove();
	alert(t);
}

$(document).ready(function(){
	$("#addInvoice").click(addTransaction);
	$("#removeInvoice").click(removeTransaction);
});