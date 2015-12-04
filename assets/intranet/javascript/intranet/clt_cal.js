	
	
		function l_clt(x){
			if(x.value != '')
			{
				// alert(x.value);
				// var pos1 = $(x).offset();
				if($(x).attr('id') == "bbit-cal-caller")
				{
					// alert('gg');
					$('#list').css('left', 100).css('top', 68);
				}else{
					$('#list').css('left', 100).css('top', 180);
				}
				
				$('#list').mouseover(function(e){
					$(this).mouseleave(function(a){
						$(this).css('visibility','hidden');
					});
				});
				
				clt(x, x.value);
				// $('#list').css('visibility','visible');
			}else{
				$('#list').css('visibility','hidden');
			}
		};

//juste pour permettre dynamquement le choix d'un client... 
	//---------- begin ----------//
	function clt(a, av) {
		var xhr = getXMLHttpRequest();
		
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				charger_clt(xhr.responseXML, a);
			}
		};
		
		xhr.open("POST", "reservation/clt");
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("id="+av);
	}

	function charger_clt(Qdata, aa)
	{
		$('#list').html("");
		var nodes = Qdata.getElementsByTagName("item");
		
		if(nodes.length != 0)
		{
			var attrs = nodes[0].attributes;
			var ul = document.createElement("ul");
			
			for(var j=0; j<nodes.length; j++)
			{
				var temparr = [];
                temparr.push('put(this, "');
				temparr.push($(aa).attr('id'),'");');
				var onck = temparr.join("");
				temparr = null;
				
				var il = document.createElement('li');
				il.setAttribute('onclick',onck);
				
				var inp = document.createElement('input');
				inp.setAttribute('type','hidden');
				inp.setAttribute('value',nodes[j].attributes[0].nodeValue);
				
				var inp1 = document.createElement('input');
				inp1.setAttribute('type','hidden');
				inp1.setAttribute('value',nodes[j].attributes[3].nodeValue);
			
				var text = nodes[j].attributes[1].nodeValue+' '+nodes[j].attributes[2].nodeValue;
				
			
				
				$(il).append(text);
				$(il).append(inp);
				$(il).append(inp1);
				
				$(ul).append(il);
				
			}
			
			$('#list').append(ul);
			$('#list').css('visibility','visible')
		}else{
			
			$('#list').css('visibility','hidden');
		}
	}

	//---------- end ----------//
