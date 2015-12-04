function lasttrack() {
	
	// alert(o2);
	var xhr = getXMLHttpRequest();

	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			alert("ok");
		}
	};
	
	xhr.open("POST", "materiel/last_track" , true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(null);
	
}