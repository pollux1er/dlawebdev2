var ajouter=  document.getElementById("ajout");
var modifier=document.getElementById("modif");
var liste=document.getElementById("list");
var listbutt=document.getElementById("listbutt");
var addbutt= document.getElementById("addbutt");
var modbutt= document.getElementById("modbutt");

function listing(){
	
	if (!(liste.style.display=='block')){
		listbutt.className='blue_top';
		liste.style.display='block';
	}
	if ((modifier.style.display=='block') || (ajouter.style.display=='block')) {
	  modifier.style.display = 'none'; 
	   modbutt.className='blue_top1';
	    ajouter.style.display = 'none'; 
	   addbutt.className='blue_top1';
	}
}
// ajouter.onclick =function(){ ajouter();}
l//istbutt.onclick =function(){ listing();} 	

function add(){
	
	if (!(ajouter.style.display=='block')){
		addbutt.className='blue_top';
		ajouter.style.display='block';
	}
	if ((modifier.style.display=='block') || (liste.style.display=='block')) {
	  modifier.style.display = 'none'; 
	   modbutt.className='blue_top1';
	   liste.style.display = 'none'; 
	   listbutt.className='blue_top1';
	 
	}
}
// ajouter.onclick =function(){ ajouter();}
//addbutt.onclick =function(){ add();} 	
function mod()
{
	if (!(modifier.style.display=='block')){
		modbutt.className='blue_top';
		modifier.style.display='block';
	}
	
	if ((ajouter.style.display=='block') ||(liste.style.display=='block')) {
       ajouter.style.display = 'none'; 
	   addbutt.className='blue_top1';
	   liste.style.display = 'none'; 
	   listbutt.className='blue_top1';
	 
}
}
//modbutt.onclick =function(){ mod();}


function selection(i)
	{
		if (document.form_critere.choix[i].checked==true)
		{
			document.form_critere.choix[i].checked=false;
		}
		else if (document.form_critere.choix[i].checked==false)
		{
			document.form_critere.choix[i].checked=true;
		}
	}