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
	for( i = 0; i < 4; i++){
		content = "<input type='text' name='tData_"+rowNo+"_"+i+"' />";
		toAppend += addCell(content);
	}
	toAppend += addCell("");
	toAppend += addCell("<button type='button' id='button"+index+"'>-</button>");
	return toAppend;
}

function addTransaction(){
	var toAppend = addCells(countRows());
	
	toAppend = addRow(toAppend);
	append(toAppend);
	$("#row" + index).click();
	index++;
}

function removeTransaction(rowNo = 0){
	if(rowNo == 0)
		$("#tContainer tr:nth-child("+(countRows())+")").remove();
	else
		$("#tContainer tr:nth-child("+rowNo+")").remove();
}

$(document).ready(function(){
	index = countRows();
	$("#addInvoice").click(addTransaction);
	$("#removeInvoice").click(removeTransaction);
});