function rowon(xy, tds, target) {

	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			show_row(xhr.responseXML, target, tds, xy);
		}
	};
	
	xhr.open("GET", "materiel/ajax_mat_check?=num" + tds[0], true);
	xhr.send(null);
}

show_row(data, target, tds, xy)
{


}