
function charger_comd1(oData, oTarget) {
			
	var nodes = oData.getElementsByTagName("item"); 
	var attrs = nodes[0].attributes;
	
	pos = $(oTarget).offset();
	var ul = document.createElement("ul");
	ul.setAttribute('style','position:absolute; left:'+pos.left+'; top:'+pos.top+'; z-index:10')
	
	
	var li, a;
	
	for(var j=0; j<nodes.length; j++)
	{
		li = document.createElement("li");
		a = document.createElement('a');
		a.setAttribute('onclick','charg(this,'+oTarget+');')
		a.appendChild(document.createTextNode(attrs[0]));
		li.appendChild(a);
		ul.appendChild(li);
	}				
}

function charg(a,b)
{
	b.value = a.innerText;
}