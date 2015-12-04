	
	$('body').click(function(){ $('#prop_user').fadeOut(); })

	function charger(li, input)
	{
		
		var data = li.getElementsByTagName('input')[0].value;			
		var dt = data.split('@@');
		var target = document.getElementById(input);
		// alert(input);
		if( input == "f_chauffeur" )
		{
			
			target.value = dt[1];
			target.setAttribute("name","f_chauf_"+dt[0]);
		} else if ( ( input == "f_destin" ) || ( input == "f_demand" ) || ( input == "f_benef" ) || ( input == "name_user" ) ) {
			target.value = dt[1] +" "+ dt[2];
			target.setAttribute("name","f_user_"+dt[0]);
		}else{
			target.value = dt[1] +" "+ dt[2];
			target.setAttribute("name","f_veh_"+dt[0]);
		}
	}
	
	function f_user(us){
		
		var Pos = $(us).offset();
				
		if( $('#prop_user').length == 0 )
		{
			$("#body_content").append("<div id='prop_user' style='' ><div align='center' style='padding:10px;'><img src='"+$('#imgurl').val()+"23.gif' /></div></div>");
			$("#prop_user").css('display','block').css('left',Pos.left).css('top',Pos.top+20);
		}else{
			$('#prop_user').html("<div align='center' style='padding:10px;'><img src='"+$('#imgurl').val()+"23.gif' /></div>");
			$("#prop_user").css('display','block').css('left',Pos.left).css('top',Pos.top+20);
			$('#prop_user').fadeIn();
		}
		
		var param = [ { "name" : "name_user" , value : us.value } ]
		
		if( $('#module').length != 0 )
		{
			if( $('#module').val() == "Logs" )
			{
				var url = "../user/staff_user";
			} else {
				var url = "user/staff_user";
			}
		}else{
			var url = "user/staff_user";
		}
		
		// alert(url);
		
		$.post( url, param, function(data){
			if(data)
			{ 
				// alert("aaaa");
				var lin = data.getElementsByTagName('item');
				
				if( lin.length != 0 )
				{
					var ul = document.createElement('ul');
					ul.setAttribute('id','cont_li');
					
					var li = document.createElement('li');
						li.setAttribute("align","left");
						li.setAttribute("onclick","charger(this, '"+us.getAttribute('id')+"');")
					
					var a = document.createElement('a');
						a.setAttribute("align","left");
						
					var span = document.createElement('span');
						span.setAttribute("align","left");
						
					var text = document.createTextNode("3rd Party");
					var inp = document.createElement('input');
						inp.setAttribute("id","user_"+i);
						inp.setAttribute("type","hidden");
						inp.setAttribute("value","");
						
						span.appendChild(text);
						a.appendChild(span);
						a.appendChild(inp);
						li.appendChild(a);
						
						ul.appendChild(li);
					for( var i = 0; i < lin.length; i++ )
					{
						var li = document.createElement('li');
							li.setAttribute("align","left");
							li.setAttribute("onclick","charger(this, '"+us.getAttribute('id')+"');")
						
						var a = document.createElement('a');
							a.setAttribute("align","left");
							
						var span = document.createElement('span');
							span.setAttribute("align","left");
							
						var text = document.createTextNode(lin[i].attributes[1].nodeValue+" "+lin[i].attributes[2].nodeValue);
						var inp = document.createElement('input');
							inp.setAttribute("id","user_"+i);
							inp.setAttribute("type","hidden");
							inp.setAttribute("value",lin[i].attributes[0].nodeValue+"@@"+lin[i].attributes[1].nodeValue+"@@"+lin[i].attributes[2].nodeValue+"@@"+lin[i].attributes[3].nodeValue+"@@"+lin[i].attributes[4].nodeValue);
							
							span.appendChild(text);
							a.appendChild(span);
							a.appendChild(inp);
							li.appendChild(a);
							
							ul.appendChild(li);
					}
					
					$('#prop_user').html(ul);
					
				}
			}else{
				// alert("zzz");
				$(us).val('');
				$(us).attr("name", "");
				$('#prop_user').fadeOut();
			}
		}, "xml");
	}
	
	function f_chauf(at)
	{
		var Pos = $(at).offset();
				
		if( $('#prop_user').length == 0 )
		{
			$("#body_content").append("<div id='prop_user' style='' ><div align='center' style='padding:10px;'><img src='"+$('#imgurl').val()+"23.gif' /></div></div>");
			$("#prop_user").css('display','block').css('left',Pos.left).css('top',Pos.top+20);
		}else{
			$('#prop_user').html("<div align='center' style='padding:10px;'><img src='"+$('#imgurl').val()+"23.gif' /></div>");
			$("#prop_user").css('display','block').css('left',Pos.left).css('top',Pos.top+20);
			$('#prop_user').fadeIn();
		}
		
		var param = [ { "name" : "name_chauf" , value : at.value } ]
		
		$.post("chauffeur/staff_chauf", param, function(data){
			if(data)
			{
				var lin = data.getElementsByTagName('item');
				
				if( lin.length != 0 )
				{
					var ul = document.createElement('ul');
					ul.setAttribute('id','cont_li');
					
					for( var i = 0; i < lin.length; i++ )
					{
						var li = document.createElement('li');
							li.setAttribute("align","left");
							li.setAttribute("onclick","charger(this, '"+at.getAttribute('id')+"');")
						
						var a = document.createElement('a');
							a.setAttribute("align","left");
							
						var span = document.createElement('span');
							span.setAttribute("align","left");
							
						var text = document.createTextNode(lin[i].attributes[1].nodeValue);
						var inp = document.createElement('input');
							inp.setAttribute("id","chauf_"+i);
							inp.setAttribute("type","hidden");
							inp.setAttribute("value",lin[i].attributes[0].nodeValue+"@@"+lin[i].attributes[1].nodeValue);
							
							span.appendChild(text);
							a.appendChild(span);
							a.appendChild(inp);
							li.appendChild(a);
							
							ul.appendChild(li);
					}
					
					$('#prop_user').html(ul);
					
				}else{
				
					$('#prop_user').fadeOut();
				}
			}
		}, "xml");
	}
	
	function f_car(at1)
	{
		var Pos = $(at1).offset();
				
		if( $('#prop_user').length == 0 )
		{
			$("#body_content").append("<div id='prop_user' style='' ><div align='center' style='padding:10px;'><img src='"+$('#imgurl').val()+"23.gif' /></div></div>");
			$("#prop_user").css('display','block').css('left',Pos.left).css('top',Pos.top+20);
		}else{
			$('#prop_user').html("<div align='center' style='padding:10px;'><img src='"+$('#imgurl').val()+"23.gif' /></div>");
			$("#prop_user").css('display','block').css('left',Pos.left).css('top',Pos.top+20);
			$('#prop_user').fadeIn();
		}
		
		var param = [ { "name" : "name_veh" , value : at1.value } ]
		
		$.post("vehicule/staff_veh", param, function(data){
			if(data)
			{
				var lin = data.getElementsByTagName('item');
				
				if( lin.length != 0 )
				{
					var ul = document.createElement('ul');
					ul.setAttribute('id','cont_li');
					
					// if( lin.length != 0 )
					// {
						for( var i = 0; i < lin.length; i++ )
						{
							var li = document.createElement('li');
								li.setAttribute("align","left");
								li.setAttribute("onclick","charger(this, '"+at1.getAttribute('id')+"');")
							
							var a = document.createElement('a');
								a.setAttribute("align","left");
								
							var span = document.createElement('span');
								span.setAttribute("align","left");
								
							var text = document.createTextNode(lin[i].attributes[1].nodeValue+" => "+lin[i].attributes[2].nodeValue);
							var inp = document.createElement('input');
								inp.setAttribute("id","chauf_"+i);
								inp.setAttribute("type","hidden");
								inp.setAttribute("value",lin[i].attributes[0].nodeValue+"@@"+lin[i].attributes[1].nodeValue+"@@"+lin[i].attributes[2].nodeValue);
								
								span.appendChild(text);
								a.appendChild(span);
								a.appendChild(inp);
								li.appendChild(a);
								
								ul.appendChild(li);
						}
					// }else{
						// $(at1).val('');
						// $(at1).attr("name", "");
						// $('#prop_user').fadeOut();
					// }
					
					$('#prop_user').html(ul);
					
				}else{
					// $(at1).val('');
					// $(at1).attr("name", "");
					$('#prop_user').fadeOut();
				}
			}
		}, "xml");
	}
	
	