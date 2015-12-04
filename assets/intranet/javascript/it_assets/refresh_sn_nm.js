function refresh_sn_nad()
{
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			ref_sn_nad(xhr.responseXML);
		}
	};
	
	xhr.open("POST", "materiel/refresh_sn_nad" , true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("null");
}

function ref_sn_nad(oData)
{
	// alert(oData);
	var nodes = oData.getElementsByTagName("item");
	var attrs = nodes[0].attributes;
	
	// alert(nodes.length);
	
	$('#serial').html('<option value="" ></option>');
	$('#nomeqpt').html('<option value="" ></option>');
	
	for(var j = 0; j<nodes.length; j++)
	{
		var text = document.createTextNode(trim(nodes[j].attributes[0].nodeValue));
		if(text != "")
		{
			var op = document.createElement('option');
			op.setAttribute('value', trim(nodes[j].attributes[0].nodeValue));
			op.appendChild(text);
			$('#nomeqpt').append(op);
		}
	}
	
	for(var j=0; j<nodes.length; j++)
	{
		var text1 = document.createTextNode(trim(nodes[j].attributes[1].nodeValue));
		if(text1 != "")
		{
			var op1 = document.createElement('option');
			op1.setAttribute('value', trim(nodes[j].attributes[1].nodeValue));
			op1.appendChild(text1);
			$('#serial').append(op1);
		}
	}
}