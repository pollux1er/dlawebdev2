function tl_mv(bData, Id)
{
	var cible1 = $('#res_'+Id);
	
	var nodes = bData.getElementsByTagName("item");
	var attrs = nodes[0].attributes;
		var cont1 = [];
		var stat = "";
		
		cont1.push('<table style="width:100%;">');
		cont1.push('<colgroup> <col> <col width="33%"> <col width="33%"> <col width="33%"></colgroup>');
		
		for(var j=0; j<nodes.length; j++)
		{
			if(nodes[j].attributes[1].nodeValue == "STAND BY")
			{
				stat = "background-color: white; color:black; border: 1px solid black; font-size:10pt; font-weight:bold;";
			}else if (nodes[j].attributes[1].nodeValue == "DEPART")
			{
				stat = "background-color: rgba(0,100,0,0.5); color:black; border: 1px solid black; font-size:10pt; font-weight:bold;";
			}else if (nodes[j].attributes[1].nodeValue == "ANNULEE")
			{
				stat = "background-color: yellow; color:black; border: 1px solid black; font-size:10pt; font-weight:bold;";
			}else{
				stat = "background-color: rgba(123,23,29,0.5); color:black; border: 1px solid black; font-size:10pt; font-weight:bold;";
			}
			
			cont1.push('<tr><td style="display:none">'+nodes[j].attributes[0].nodeValue+'</td><td align="center" style="'+stat+'">'+nodes[j].attributes[1].nodeValue);
			cont1.push('</td><td align="center" style="'+stat+'">'+nodes[j].attributes[2].nodeValue+'</td><td align="center" style="'+stat+'">'+nodes[j].attributes[3].nodeValue+'</td></tr>');
				
		}
		
		cont1.push('</table>');
		var c_cont1 = cont1.join("");
		
		cible1.after(c_cont1);
		
}

function list_mov(id)
{
	// alert(id);
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			tl_mv(xhr.responseXML, id);
		}
	};
	
	xhr.open("POST", "mouvement/show_mov", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("0="+id);
}

function hst_mv(aData)
{
	// alert(aData);
	var cible = $('#sh_move');
	cible.html("");
	
	var nodes = aData.getElementsByTagName("item");
	
	if(nodes.length == 0)
	{
		cible.html("<br><b> Aucune r&eacute;servation faites avec ce v&eacute;hicule </b>");
	}else
	{
		var attrs = nodes[0].attributes;
		
		for(var j=0; j<nodes.length; j++)
		{
			var cont = []
			cont.push('<div id="res_'+nodes[j].attributes[0].nodeValue+'" style="padding-left:20px; background-color:#9aa796; font-size:12pt; font-weight:bold;" align="left"> R&eacute;servation N&deg;'+nodes[j].attributes[0].nodeValue+'</div>');
			cont.push('<br><br>');
			
			var c_cont = cont.join("");
			
			cible.append(c_cont);
			
			list_mov(nodes[j].attributes[0].nodeValue);
		}
	}
	
	
}

function hist_mov(aA)
{
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			hst_mv(xhr.responseXML);
		}
	};
	
	xhr.open("POST", "mouvement/show_res", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("0="+aA);
}

function modifier(a)
{
	var tds = a.getElementsByTagName('td');
	line_color(a, "tck_list");
	hist_mov(trim(tds[0].innerHTML));

}

var trs = document.getElementById('tck_list').getElementsByTagName('tbody')[0].getElementsByTagName('tr');

window.setTimeout(function(){modifier(trs[0]);}, 500);
	
function load_rw(data, Ac)
{			
	// alert(data);
	var nodes = data.getElementsByTagName('item');

	// alert("aaaa");
	var content = [];
	for( var i = 0 ; i < nodes.length ; i++ )
	{
		content.push('<tr class="altcol cmd" onclick="modifier(this)" >');
		var tds = nodes[i].attributes;
		for ( var j = 0; j < tds.length; j++ )
		{
			if( (j == 0) )
			{
				content.push('<td style="display:none;" >'+tds[j].nodeValue+'</td>');
			}else{
				content.push('<td class="align_center" valign="middle" >'+Utf8.decode(tds[j].nodeValue)+'</td>');
			}
		}
		
		content.push('</tr>')
	}
	
	var cont = content.join("");
	content = null;		
	
	$(Ac).html( cont );
	$(Ac.getElementsByTagName('tr')[0]).trigger('click');
}